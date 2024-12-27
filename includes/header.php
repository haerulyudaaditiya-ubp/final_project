<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require 'config/config.php';

$new_notifications = 0; // Default jumlah notifikasi adalah 0
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT fullname, role FROM users WHERE id = '$user_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        $_SESSION['user_name'] = $user_data['fullname']; // Update nama pengguna di session
        $_SESSION['user_role'] = $user_data['role']; // Simpan role pengguna di session
    }

    // Query untuk menghitung jumlah notifikasi baru
    $sql_count_notifications = "SELECT COUNT(*) AS new_notifications 
                                FROM rentals
                                WHERE user_id = '$user_id'
                                AND payment_status = 'verification'";
    $result_notifications = mysqli_query($conn, $sql_count_notifications);

    if ($result_notifications) {
        $row_notifications = mysqli_fetch_assoc($result_notifications);
        $new_notifications = $row_notifications['new_notifications']; // Simpan jumlah notifikasi
    }
}

if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
  // Redirect ke halaman dashboard admin atau halaman lain
  header("Location: admin/index.php");
  exit();
}

// Tentukan halaman aktif berdasarkan nama file
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wejea Trans</title>
  <link rel="stylesheet" href="./assets/style.css">
  <link rel="icon" type="image/png" href="./img/logo.png">
  <!-- Bootstrap 5.3.0 Stable -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
  <style>
    /* Custom Navbar Styling */
    .navbar {
        background: #343a40;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        padding: 1rem 0;
        z-index: 1040; /* Lebih rendah dari dropdown */
        position: relative; /* Pastikan posisi relatif */
    }
    .navbar-brand {
        font-size: 1.5rem;
        color: #f39c12 !important;
        font-weight: bold;
    }
    .nav-link {
        font-size: 1.1rem;
        color: #f8f9fa !important;
        transition: color 0.3s ease, transform 0.3s ease;
    }
    .nav-link:hover {
        color: #f39c12 !important;
        transform: scale(1.1);
    }
    .nav-item .dropdown-menu {
        background-color: #495057; /* Latar belakang dropdown */
        border: none; /* Hilangkan border */
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Tambahkan bayangan */
        z-index: 1050; /* Pastikan z-index lebih tinggi dari elemen lain */
        position: absolute; /* Posisi dropdown */
    }
    .nav-item.dropdown.show .dropdown-menu {
        display: block; /* Tampilkan dropdown di desktop */
        visibility: visible;
        opacity: 1;
    }
    .dropdown-item {
        color: #ffffff !important; /* Warna teks */
        transition: background-color 0.3s ease; /* Efek hover */
    }
    .dropdown-item:hover {
        background-color: #343a40; /* Latar belakang saat hover */
        color: #f39c12; /* Teks warna kuning */
    }
    .active {
        color: #f39c12 !important;
        font-weight: bold;
        text-decoration: underline;
    }

    /* Responsiveness untuk mobile */
    @media (max-width: 991px) {
      .navbar-collapse .dropdown-menu {
          position: static; /* Atur posisi dropdown */
          width: 100%; /* Lebar penuh di mobile */
          margin-top: 0;
      }
    }

    .navbar-toggler {
        border: none; /* Hilangkan border */
        background-color: transparent; /* Hilangkan warna latar belakang */
        box-shadow: none; /* Hilangkan bayangan */
        position: relative;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='orange' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        background-size: contain;
        background-repeat: no-repeat;
        background-position: relative;
    }

    .navbar-toggler-icon .badge {
      font-size: 0.75rem;
      position: absolute;
      top: -5px;
      right: -10px;
  }
  </style>
</head>
<body>
  <!-- Navbar -->
<nav class="navbar navbar-expand-lg" data-aos="fade-down" data-aos-duration="1000">
  <div class="container">
    <a class="navbar-brand" href="./index.php">Wejea Trans</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
            <?php if ($new_notifications > 0): ?>
                <span class="badge bg-danger rounded-circle" style="font-size: 0.75rem; position: absolute; top: -5px; right: -10px;"><?= $new_notifications; ?></span>
            <?php endif; ?>
        </span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <!-- Daftar menu lainnya -->
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'index.php') ? 'active' : ''; ?>" href="./index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'about.php') ? 'active' : ''; ?>" href="./about.php">Tentang Kami</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'daftar_mobil.php') ? 'active' : ''; ?>" href="./daftar_mobil.php">Daftar Mobil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'syarat.php') ? 'active' : ''; ?>" href="./syarat.php">Syarat & Ketentuan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'contact.php') ? 'active' : ''; ?>" href="./contact.php">Hubungi Kami</a>
        </li>

        <!-- Menu tambahan untuk user yang login -->
        <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])): ?>
            <li class="nav-item dropdown">
                <?php 
                // Batasi nama pengguna hingga 20 huruf
                $display_name = (strlen($_SESSION['user_name']) > 20) ? substr($_SESSION['user_name'], 0, 20) . '...' : $_SESSION['user_name'];
                ?>
                <a 
                    class="nav-link dropdown-toggle" 
                    href="#" 
                    id="navbarDropdown" 
                    role="button" 
                    data-bs-toggle="dropdown" 
                    aria-expanded="false"
                    style="color: #f8f9fa; font-size: 1.1rem; transition: color 0.3s ease;"
                    title="<?= htmlspecialchars($_SESSION['user_name']); ?>">
                    <?= htmlspecialchars($display_name); ?>
                    <?php if ($new_notifications > 0): ?>
                        <span class="badge bg-danger rounded-circle" style="font-size: 0.75rem; position: absolute; top: -5px; right: -10px;"><?= $new_notifications; ?></span>
                    <?php endif; ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="background-color: #495057; border: none; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                    <li><a class="dropdown-item" href="./profile.php" style="color: #ffffff; font-size: 1rem; transition: background-color 0.3s ease;">Profile</a></li>
                    <li><a class="dropdown-item" href="./update_password.php" style="color: #ffffff; font-size: 1rem; transition: background-color 0.3s ease;">Update Password</a></li>
                    <li><a class="dropdown-item" href="./riwayat_sewa.php" style="color: #ffffff; font-size: 1rem; transition: background-color 0.3s ease;">
                        Riwayat Sewa
                        <?php if ($new_notifications > 0): ?>
                            <span class="badge bg-danger rounded-circle" style="font-size: 0.75rem;"><?= $new_notifications; ?></span>
                        <?php endif; ?>
                    </a></li>
                    <li><hr class="dropdown-divider" style="border-color: #6c757d;"></li>
                    <li><a class="dropdown-item" href="./logout.php" style="color: #ffffff; font-size: 1rem; transition: background-color 0.3s ease;">Logout</a></li>
                </ul>
            </li>
        <?php else: ?>
            <li class="nav-item">
                <a class="nav-link <?= ($current_page == 'login.php') ? 'active' : ''; ?>" href="./forms/login.php">Login</a>
            </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
