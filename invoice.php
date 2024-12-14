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

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];  // Ambil order_id dari URL
} else {
    echo "ID order tidak ditemukan!";
    exit;
}

// Inisialisasi variabel
$rental = null;
$error_message = '';

// Ambil data rental berdasarkan order_id dan user_id
$user_id = $_SESSION['user_id'];
$query = "SELECT rentals.order_id, 
                 cars.model, 
                 cars.brand, 
                 cars.year, 
                 cars.price_24_hours, 
                 rentals.start_date, 
                 rentals.end_date, 
                 rentals.payment_status,
                 rentals.created_at, 
                 users.fullname AS user_name, 
                 users.address AS user_address, 
                 users.phone AS user_phone, 
                 users.email AS user_email 
          FROM rentals
          JOIN cars ON rentals.car_id = cars.car_id
          JOIN users ON rentals.user_id = users.id
          WHERE rentals.order_id = '$order_id' AND rentals.user_id = '$user_id'";
$result = mysqli_query($conn, $query);

if ($result) {
    $rental = mysqli_fetch_assoc($result);  // Ambil data rental sesuai dengan ID
    if (!$rental) {
        $error_message = "Data rental tidak ditemukan!";
    }
} else {
    $error_message = "Terjadi kesalahan saat mengambil data rental.";
}

ob_end_flush(); // Akhiri output buffering
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header text-white text-center py-3" style="background-color: #343a40;">
                    <h3 class="fw-bold">Invoice Sewa Kendaraan</h3>
                </div>
                <div class="card-body p-4">
                    <!-- Tampilkan pesan error jika ada -->
                    <?php if (!empty($error_message)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= htmlspecialchars($error_message); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if ($rental): ?>
                        <!-- Menampilkan detail rental -->
                        <div class="mb-4">
                            <h5 class="text-muted mb-3">Detail Rental</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th>Order ID</th> 
                                    <td><?= htmlspecialchars($rental['order_id']); ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal & Waktu Rental</th>
                                    <td><?= (new DateTime($rental['created_at']))->format('d M Y H:i'); ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Penyewa</th>
                                    <td><?= htmlspecialchars($rental['user_name']); ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td><?= htmlspecialchars($rental['user_address']); ?></td>
                                </tr>
                                <tr>
                                    <th>No HP</th>
                                    <td><?= htmlspecialchars($rental['user_phone']); ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?= htmlspecialchars($rental['user_email']); ?></td> 
                                </tr>
                                <tr>
                                    <th>Nama Mobil</th>
                                    <td><?= htmlspecialchars($rental['brand']) . ' ' . htmlspecialchars($rental['model']) . ' (' . htmlspecialchars($rental['year']) . ')'; ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Mulai</th>
                                    <td><?= (new DateTime($rental['start_date']))->format('d M Y'); ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Selesai</th>
                                    <td><?= (new DateTime($rental['end_date']))->format('d M Y'); ?></td>
                                </tr>
                                <tr>
                                    <th>Durasi Sewa</th>
                                    <td><?= (new DateTime($rental['start_date']))->diff(new DateTime($rental['end_date']))->days; ?> hari</td>
                                </tr>
                                <tr>
                                    <th>Total Harga</th>
                                    <td><strong>Rp <?= number_format($rental['price_24_hours'] * (new DateTime($rental['start_date']))->diff(new DateTime($rental['end_date']))->days, 0, ',', '.'); ?></strong></td>
                                </tr>
                                <tr>
                                    <th>Status Pembayaran</th>
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
                                </tr>
                            </table>
                        </div>

                        <!-- Tombol Cetak Invoice dengan ikon -->
                        <div class="text-center mt-4">
                            <a href="print_invoice.php?id=<?= $rental['order_id']; ?>" class="btn btn-primary" target="_blank">
                                <i class="fa fa-print"></i> Cetak Invoice
                            </a>
                        </div>

                    <?php else: ?>
                        <p>Data rental tidak ditemukan.</p>
                    <?php endif; ?>

                </div>
            </div>

            <!-- Card Syarat dan Ketentuan -->
            <div class="card shadow-lg border-0 rounded-4 mt-4">
                <div class="card-header text-white text-center py-3" style="background-color: #343a40;">
                    <h3 class="fw-bold">Syarat dan Ketentuan Pengambilan Mobil</h3>
                </div>
                <div class="card-body p-4">
                    <h5 class="text-muted mb-3">Harap Lengkapi Syarat Berikut untuk Mengambil Mobil:</h5>
                    <ul>
                        <li><strong>Invoice yang sudah dicetak</strong> sebagai bukti pembayaran harus dibawa saat pengambilan mobil.</li>
                        <li><strong>Identitas diri</strong> berupa KTP atau SIM yang masih berlaku.</li>
                        <li><strong>Deposit</strong> (jika diperlukan), sesuai dengan ketentuan perusahaan.</li>
                        <li>Pastikan <strong>status pembayaran</strong> sudah <span class="badge bg-success">Lunas</span> sebelum pengambilan mobil.</li>
                        <li>Jika menggunakan <strong>kartu kredit</strong>, bawa kartu kredit yang digunakan untuk transaksi.</li>
                    </ul>

                    <p>Jika ada pertanyaan lebih lanjut, hubungi customer service kami di 
                        <a href="https://wa.me/6289609317309?text=Halo%20Wejea%20Trans,%20saya%20ingin%20bertanya%20tentang%20layanan%20rental%20mobil."
                            target="_blank"
                            style="color: #000000; text-decoration: none;"">
                            <strong>089609317309</strong>
                        </a>
                        atau email ke 
                        <a href="mailto:Wejeatrans@gmail.com" 
                            target="_blank" 
                            style="color: #000000; text-decoration: none;"">
                            <strong>Wejeatrans@gmail.com</strong>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
require 'includes/footer.php';
?>
