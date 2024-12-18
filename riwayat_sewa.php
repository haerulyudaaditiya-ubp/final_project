<?php
ob_start(); // Mulai output buffering
require 'includes/header.php';
require 'config/config.php';
require 'classes/RentalHistory.php'; // Menyertakan kelas RentalHistory

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Anda harus login untuk mengakses halaman ini!";
    header("Location: forms/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$rentalHistory = new RentalHistory($conn, $user_id);

// Ambil riwayat sewa dari database
$rentals = $rentalHistory->getRentals();
$error_message = '';

if ($rentals === null) {
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

                    <!-- Tampilkan riwayat sewa -->
                    <?php $rentalHistory->displayRentals($rentals); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php 
require 'includes/footer.php';
?>
