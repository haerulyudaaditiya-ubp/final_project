<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Memulai session hanya jika belum dimulai
}

$is_logged_in = isset($_SESSION['user_id']); // Cek apakah user sudah login
$current_page = basename($_SERVER['PHP_SELF']); // Mendapatkan nama file saat ini
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wejeatrans</title>
  <link rel="icon" type="image/png" href="img/logo.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cyborg/bootstrap.min.css" 
        integrity="sha384-nEnU7Ae+3lD52AK+RGNzgieBWMnEfgTbRHIwEvp1XXPdqdO6uLTd/NwXbzboqjc2" 
        crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
<?php if ($current_page !== 'login.php') { ?>
    <?php if (!$is_logged_in) { ?>
    <!-- Navbar Tamu (sebelum login) -->
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="img/logo.png" alt="Logo" style="width: 100px; height: auto;"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
          <span style="display: flex; width: 50px; height: 50px; justify-content: center; align-items: center">
            <i class="bi bi-list" style="color: #fff; font-size: 40px"></i>
          </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
          <form class="d-flex mx-auto" style="width: 50%;">
            <input class="form-control me-sm-2" type="search" placeholder="Cari">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
          </form>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link active" href="index-user.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Service <i class="fas fa-caret-down"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="service.php">Tanpa Supir</a>
                <a class="dropdown-item" href="service.php">Dengan Supir</a>
              </div>
            </li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
          </ul>
          <a href="login.php"><button type="button" class="btn btn-outline-light ms-3">Login</button></a>
        </div>
      </div>
    </nav>
    <?php } else { ?>
    <!-- Navbar User (setelah login) -->
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="img/logo.png" alt="Logo" style="width: 100px; height: auto;"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon" style="background-image: none;">
            <i class="fas fa-bars" style="font-size: 1.5rem; color: white;"></i>
          </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
          <form class="d-flex mx-auto" style="width: 50%;">
            <input class="form-control me-sm-2" type="search" placeholder="Cari">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
          </form>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
            <li class="nav-item"><a class="nav-link" href="service.php">Service</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="img/profile.png" alt="Profile" class="rounded-circle" style="width: 35px; height: 35px;">
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                <li><a class="dropdown-item" href="#">View Profile</a></li>
                <li><a class="dropdown-item" href="#">Edit Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <?php } ?>
<?php } // Tutup if navbar ?>
</body>

</html>
