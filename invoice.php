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
$success_message = '';

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
                 users.email AS user_email, 
                 payments.receipt_image
          FROM rentals
          JOIN cars ON rentals.car_id = cars.car_id
          JOIN users ON rentals.user_id = users.id
          LEFT JOIN payments ON rentals.order_id = payments.order_id
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

// Proses upload bukti transfer jika form di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['transfer_receipt']) && $_FILES['transfer_receipt']['error'] == 0) {
    // Path folder upload
    $upload_dir = __DIR__ . '/uploads/bukti_transfer/'; // Menyertakan __DIR__ untuk memastikan path yang benar

    // Mendapatkan ekstensi file terlebih dahulu
    $file_ext = strtolower(pathinfo($_FILES['transfer_receipt']['name'], PATHINFO_EXTENSION));

    // Membuat nama file unik
    $file_name = time() . '_' . uniqid() . '.' . $file_ext; // Membuat nama file unik dengan ekstensi yang benar
    $target_file = $upload_dir . $file_name;

    // Validasi ekstensi file
    $allowed_extensions = ['jpg', 'jpeg', 'png'];

    if (!in_array($file_ext, $allowed_extensions)) {
        $error_message = "Hanya file gambar (.jpg, .jpeg, .png) yang diperbolehkan!";
    }

    // Validasi ukuran file
    if ($_FILES['transfer_receipt']['size'] > 5 * 1024 * 1024) {
        $error_message = "Ukuran file terlalu besar. Maksimum 5MB!";
    }

    // Jika tidak ada error, lanjutkan upload file
    if (empty($error_message)) {
        if (move_uploaded_file($_FILES['transfer_receipt']['tmp_name'], $target_file)) {
            // Menyimpan bukti transfer ke tabel payments
            $query = "INSERT INTO payments (order_id, gross_amount, payment_status, receipt_image) 
                        VALUES ('$order_id', (SELECT total_price FROM rentals WHERE order_id = '$order_id'), 'verification', '$file_name')";

            if (mysqli_query($conn, $query)) {
                // Update status pembayaran di tabel rentals menjadi "verification"
                $update_query = "UPDATE rentals SET payment_status = 'verification' WHERE order_id = '$order_id' AND user_id = '$user_id'";
                if (mysqli_query($conn, $update_query)) {
                    // Redirect setelah sukses
                    header("Location: " . $_SERVER['PHP_SELF'] . "?id=$order_id&upload_success=true");
                    exit; // Hentikan eksekusi lebih lanjut
                } else {
                    $error_message = "Terjadi kesalahan saat memperbarui status pembayaran.";
                }
            } else {
                $error_message = "Terjadi kesalahan saat menyimpan bukti transfer.";
            }
        } else {
            $error_message = "Gagal mengupload file. Silakan coba lagi.";
        }
    }
}

// Proses pembatalan pemesanan
if (isset($_POST['cancel_order'])) {
    // Update status pembatalan di tabel rentals
    $cancel_query_rentals = "UPDATE rentals SET payment_status = 'failed' WHERE order_id = '$order_id' AND user_id = '$user_id'";
    $cancel_query_payments = "UPDATE payments SET payment_status = 'failed' WHERE order_id = '$order_id'";

    if (mysqli_query($conn, $cancel_query_rentals) && mysqli_query($conn, $cancel_query_payments)) {
        // Simpan pesan sukses di sesi
        $_SESSION['success_message'] = "Pemesanan berhasil dibatalkan.";
        // Redirect setelah sukses
        header("Location: " . $_SERVER['PHP_SELF'] . "?id=$order_id");
        exit; // Hentikan eksekusi lebih lanjut
    } else {
        $error_message = "Gagal membatalkan pemesanan. Silakan coba lagi.";
    }
}

// Tampilkan pesan sukses jika upload atau pembatalan berhasil
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']); // Hapus pesan setelah ditampilkan
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

                    <?php if (!empty($success_message)): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= htmlspecialchars($success_message); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if ($rental): ?>
                        <!-- Tombol Cetak Invoice -->
                        <div class="text-center mb-4">
                            <a href="print_invoice.php?id=<?= $rental['order_id']; ?>" class="btn btn-primary" target="_blank">
                                <i class="fa fa-print"></i> Cetak Invoice
                            </a>
                        </div>

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
                                    <td>
                                        <strong>
                                            <span class="badge bg-primary  fs-6">
                                                Rp <?= number_format($rental['price_24_hours'] * (new DateTime($rental['start_date']))->diff(new DateTime($rental['end_date']))->days, 0, ',', '.'); ?>
                                            </span>
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tujuan Transfer</th>
                                    <td><strong>Transfer BCA 2171014010 SUZANNA ARRYANI</strong></td>
                                </tr>
                                <tr>
                                    <th>Status Pembayaran</th>
                                    <td>
                                        <?php 
                                            if ($rental['payment_status'] == 'paid') {
                                                echo '<span class="badge bg-success fs-6">Lunas</span>';
                                            } elseif ($rental['payment_status'] == 'pending') {
                                                echo '<span class="badge bg-warning fs-6">Menunggu Pembayaran</span>';
                                            } elseif ($rental['payment_status'] == 'verification') {
                                                echo '<span class="badge bg-info fs-6">Menunggu Konfirmasi</span>';
                                            } else {
                                                echo '<span class="badge bg-danger fs-6">Gagal</span>';
                                            }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <!-- Menampilkan Bukti Transfer jika ada -->
                        <?php if ($rental['receipt_image']): ?>
                            <div class="mb-4">
                                <h5 class="text-muted mb-3">Bukti Transfer</h5>
                                <img src="uploads/bukti_transfer/<?= htmlspecialchars($rental['receipt_image']); ?>" alt="Bukti Transfer" class="img-fluid" width="300">
                            </div>
                        <?php endif; ?>

                        <!-- Form Upload Bukti Transfer -->
                        <?php if ($rental['payment_status'] == 'pending'): ?>
                            <div class="mb-4">
                                <h5 class="text-muted mb-3">Upload Bukti Transfer</h5>
                                <form action="<?= $_SERVER['PHP_SELF']; ?>?id=<?= $rental['order_id']; ?>" method="post" enctype="multipart/form-data" id="uploadForm">
                                    <div class="mb-3">
                                        <label for="transfer_receipt" class="form-label">Pilih File Bukti Transfer</label>
                                        <input type="file" class="form-control" id="transfer_receipt" name="transfer_receipt" required>
                                        <small id="fileHelp" class="form-text text-muted">Hanya file gambar (.jpg, .jpeg, .png) yang diperbolehkan. Maksimal ukuran file 5MB.</small>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Upload Bukti Transfer</button>
                                </form>
                            </div>
                        <?php endif; ?>

                        <?php if ($rental['payment_status'] == 'verification'): ?>
                            <div class="mb-4">
                                <form action="<?= $_SERVER['PHP_SELF']; ?>?id=<?= $rental['order_id']; ?>" method="post">
                                    <button type="submit" name="cancel_order" class="btn btn-danger">Batalkan Pemesanan</button>
                                </form>
                                <!-- Teks Informasi -->
                                <small class="text-muted d-block mt-2">
                                Pembatalan hanya dapat dilakukan jika pesanan <strong>belum terkonfirmasi</strong> oleh admin. 
                                Jika Anda membatalkan pesanan, proses pengembalian dana akan dilakukan sesuai ketentuan yang berlaku.
                                <br><br> 
                                Untuk informasi lebih lanjut atau bantuan terkait pembatalan, silakan hubungi kami sesuai kontak yang tersedia.
                                </small>
                            </div>
                        <?php endif; ?>

                    <?php else: ?>
                        <p>Data rental tidak ditemukan.</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <?php if ($rental['payment_status'] == 'paid'): ?>
                <?php require "card_pengambilan_mobil.php"; ?>
            <?php endif; ?>
            <?php if ($rental['payment_status'] == 'failed'): ?>
                <?php require "card_pengembalian_dana.php"; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php 
require 'includes/footer.php';
?> 
