<?php
ob_start();
require 'includes/header.php';
require 'config/config.php';
require 'classes/Profile.php'; // Menyertakan kelas Profile

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Anda harus login untuk mengakses halaman ini!";
    header("Location: forms/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$profile = new Profile($conn, $user_id);

// Ambil data pengguna dari database
$user = $profile->getUserData();
if (!$user) {
    $_SESSION['error'] = "Data profil tidak ditemukan.";
    header("Location: ../index.php");
    exit;
}

// Proses penyimpanan jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    if ($profile->updateUserProfile($fullname, $phone, $email, $address)) {
        header("Location: profile.php");
        exit;
    }
}

ob_end_flush();
?>

<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-lg border-0 rounded-4">
          <!-- Header Kartu -->
          <div class="card-header bg-dark text-white text-center py-3 rounded-top-4">
            <h3 class="fw-bold"><i class="fas fa-user-circle"></i> Informasi Pengguna</h3>
          </div>

          <!-- Body Kartu -->
          <div class="card-body p-4">
            <!-- Menampilkan Pesan Error atau Sukses -->
            <?php $profile->displayMessage(); ?>

            <!-- Form Profil -->
            <form method="POST" action="profile.php">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label fw-bold">Nama Lengkap</label>
                  <input type="text" class="form-control bg-light" name="fullname" value="<?= htmlspecialchars($user['fullname']); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label fw-bold">Alamat Email</label>
                  <input type="email" class="form-control bg-light" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label fw-bold">Telepon</label>
                  <input type="text" class="form-control bg-light" name="phone" value="<?= htmlspecialchars($user['phone']); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label fw-bold">Alamat</label>
                  <textarea class="form-control bg-light" rows="3" name="address" required><?= htmlspecialchars($user['address']); ?></textarea>
                </div>
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-success fw-bold px-4"><i class="fas fa-save"></i> Simpan Perubahan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require 'includes/footer.php'; ?> 
