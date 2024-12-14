<?php
ob_start(); // Mulai output buffering
require 'includes/header.php';
require 'config/config.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Anda harus login untuk mengakses halaman ini!";
    header("Location: forms/login.php");
    exit;
}

// Inisialisasi variabel
$rentals = [];
$error_message = '';

// Ambil riwayat sewa dari database berdasarkan user_id
$user_id = $_SESSION['user_id'];
$query = "SELECT rentals.order_id, 
                 cars.model, 
                 cars.brand, 
                 cars.year, 
                 cars.price_24_hours, 
                 rentals.start_date, 
                 rentals.end_date, 
                 rentals.payment_status,
                 rentals.created_at,   -- Kolom created_at untuk menampilkan tanggal dan waktu ketika rental dicatat
                 payment_links.payment_url
          FROM rentals
          JOIN cars ON rentals.car_id = cars.car_id
          LEFT JOIN payment_links ON rentals.rental_id = payment_links.rental_id
          WHERE rentals.user_id = '$user_id'
          ORDER BY rentals.created_at DESC"; // Urutkan berdasarkan waktu transaksi rental terbaru
$result = mysqli_query($conn, $query);

if ($result) {
    $rentals = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $error_message = "Terjadi kesalahan saat mengambil data riwayat sewa.";
}

ob_end_flush(); // Akhiri output buffering
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10"> <!-- Ubah lebar card menjadi lebih besar -->
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white text-center py-3 rounded-top-4">
                    <h3 class="fw-bold"><i class="fas fa-history"></i> Riwayat Sewa Kendaraan</h3>
                </div>
                <div class="card-body p-4">

                    <!-- Tampilkan pesan error jika ada -->
                    <?php if (!empty($error_message)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= htmlspecialchars($error_message); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Jika tidak ada riwayat sewa -->
                    <?php if (empty($rentals)): ?>
                        <div class="alert alert-info" role="alert">
                            Anda belum pernah melakukan penyewaan kendaraan.
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Mobil</th>
                                        <th>Harga Total</th> <!-- Mengganti "Harga per 24 jam" dengan "Harga Total" -->
                                        <th>Status Pembayaran</th>
                                        <th>Tanggal & Waktu Rental</th> <!-- Kolom Tanggal & Waktu Rental -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $no = 1;  // Inisialisasi nomor urut
                                foreach ($rentals as $rental): ?>
                                    <?php
                                    // Jika status pembayaran adalah 'not_chosen', lewati baris ini
                                    if ($rental['payment_status'] == 'not_chosen') {
                                        continue;
                                    }

                                    // Menghitung durasi sewa dalam hari
                                    $start_date = new DateTime($rental['start_date']);
                                    $end_date = new DateTime($rental['end_date']);
                                    $interval = $start_date->diff($end_date);
                                    $duration = $interval->days; // Durasi dalam hari

                                    // Menghitung harga total
                                    $total_price = $duration * $rental['price_24_hours']; // Durasi * Harga per hari
                                    ?>
                                    <tr>
                                        <td><?= $no++; ?></td>  <!-- Menampilkan nomor urut yang dihitung secara manual -->
                                        <td>
                                            <?= htmlspecialchars($rental['brand']) . ' ' . htmlspecialchars($rental['model']) . ' (' . htmlspecialchars($rental['year']) . ')'; ?>
                                        </td>
                                        <td>Rp <?= number_format($total_price, 0, ',', '.'); ?></td>
                                        <td>
                                            <?php 
                                                if ($rental['payment_status'] == 'paid') {
                                                    echo '<span class="badge bg-success">Lunas</span>';
                                                } elseif ($rental['payment_status'] == 'pending') {
                                                    echo '<span class="badge bg-warning">Menunggu Pembayaran</span>';
                                                } else {
                                                    echo '<span class="badge bg-danger">Gagal</span>';
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?= (new DateTime($rental['created_at']))->format('d-m-Y H:i:s'); ?>
                                        </td>
                                        <td>
                                            <?php if ($rental['payment_status'] == 'pending' && !empty($rental['payment_url'])): ?>
                                                <a href="<?= htmlspecialchars($rental['payment_url']); ?>" class="btn btn-primary btn-sm" target="_blank">Bayar Sekarang</a>
                                            <?php else: ?>
                                                <a href="invoice.php?id=<?= $rental['order_id']; ?>" class="btn btn-info btn-sm">Lihat Detail</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
require 'includes/footer.php';
?> 