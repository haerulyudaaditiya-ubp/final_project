<?php
ob_start();
require 'includes/header.php';
require 'config/config.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Anda harus login untuk mengakses halaman ini!";
    header("Location: forms/login.php");
    exit;
}

// Ambil data pengguna dari database
$user_id = $_SESSION['user_id'];
$query = "SELECT fullname, phone, email, address, created_at FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);

// Periksa apakah data pengguna ditemukan
if (!$result || mysqli_num_rows($result) == 0) {
    $_SESSION['error'] = "Data profil tidak ditemukan.";
    header("Location: ../index.php");
    exit;
}

$user = mysqli_fetch_assoc($result);

// Proses penyimpanan jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // Validasi sederhana
    if (empty($fullname) || empty($phone) || empty($email) || empty($address)) {
        $_SESSION['error'] = "Semua field harus diisi!";
        header("Location: profile.php");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Format email tidak valid!";
        header("Location: profile.php");
        exit;
    }

    if (!ctype_digit($phone)) {
        $_SESSION['error'] = "Nomor telepon harus berupa angka!";
        header("Location: profile.php");
        exit;
    }

    // Update data di database
    $update_query = "UPDATE users SET fullname='$fullname', phone='$phone', email='$email', address='$address' WHERE id='$user_id'";
    if (mysqli_query($conn, $update_query)) {
        // Perbarui session dengan nama lengkap terbaru
        $_SESSION['user_name'] = $fullname;

        // Beri pesan sukses
        $_SESSION['success'] = "Profil berhasil diperbarui!";
        header("Location: profile.php");
        exit;
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat menyimpan perubahan.";
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
            <?php if (isset($_SESSION['error'])): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['success'])): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['success']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

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
