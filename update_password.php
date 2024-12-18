<?php
ob_start(); // Mulai output buffering
session_start();

require 'includes/header.php';
require 'config/config.php';
require 'classes/UpdatePassword.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Anda harus login untuk mengakses halaman ini!";
    header("Location: forms/login.php");
    exit;
}

// Inisialisasi variabel
$error_message = '';
$success_message = '';

// Jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil input dari form
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Membuat objek UpdatePassword
    $updatePassword = new UpdatePassword(
        $conn,
        $_SESSION['user_id'],
        $current_password,
        $new_password,
        $confirm_password
    );

    // Validasi input
    if ($updatePassword->validateInputs()) {
        // Verifikasi password lama
        if ($updatePassword->verifyCurrentPassword()) {
            // Update password
            if ($updatePassword->updatePassword()) {
                $success_message = $updatePassword->success;
                echo "<script>
                    setTimeout(function() {
                        window.location.href = 'forms/login.php';
                    }, 3000); // Redirect setelah 3 detik
                </script>";
            } else {
                $error_message = $updatePassword->error;
            }
        } else {
            $error_message = $updatePassword->error;
        }
    } else {
        $error_message = $updatePassword->error;
    }
}

ob_end_flush(); // Akhiri output buffering
?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white text-center py-3 rounded-top-4">
          <h3 class="fw-bold"><i class="fas fa-lock"></i> Ubah Password</h3>
        </div>
        <div class="card-body p-4">
          <!-- Tampilkan pesan error jika ada -->
          <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?= htmlspecialchars($error_message); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>

          <!-- Tampilkan pesan sukses jika ada -->
          <?php if (!empty($success_message)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <?= htmlspecialchars($success_message); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>

          <form method="POST" action="update_password.php">
            <div class="mb-3">
              <label for="current_password" class="form-label fw-bold">Password Lama</label>
              <input type="password" id="current_password" name="current_password" class="form-control" placeholder="Masukkan password lama Anda" required>
            </div>
            <div class="mb-3">
              <label for="new_password" class="form-label fw-bold">Password Baru</label>
              <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Masukkan password baru" required>
            </div>
            <div class="mb-3">
              <label for="confirm_password" class="form-label fw-bold">Konfirmasi Password Baru</label>
              <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Ulangi password baru" required>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary fw-bold px-4"><i class="fas fa-check-circle"></i> Update Password</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php 
require 'includes/footer.php';
?>
