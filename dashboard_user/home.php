<?php

require "heider.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEJEA TRANS</title>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg custom-navbar">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="img/logo.png" alt="Logo" style="width: 80px; height: auto;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <form class="d-flex" role="search">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-light" type="submit">Search</button>
</form>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" href="home.php">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tentangkita.php">Tentang Kami</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="armada.php">Armada</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="kontak.php">Kontak</a>
        </li>

        <!-- Profil Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="img/profile.png" alt="Profile Image" class="profile-img"> 
          </a>
          <ul class="dropdown-menu dropdown-menu-end p-3" aria-labelledby="profileDropdown" style="width: 250px;">
            <li class="text-center">
              <img src="img/profile.png" alt="Profile Image" class="rounded-circle mb-2" style="width: 60px; height: 60px;">
              <p class="mb-0 fw-bold">Toriq Ardiansya</p>
              <p class="text-muted small">if23.toriqardiansya@mhs.ubpkarawang.ac.id</p>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-center" href="#">Kelola Akun Google Anda</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Tambah Akun</a></li>
            <li><a class="dropdown-item" href="#">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section Home -->
<section class="hero hero-home d-flex align-items-center">
  <div class="hero-text text-center">
    <h1 class="display-4">Sewa Mobil Tanpa ribet, Hanya Di WEJEATRANS Solusinya</h1>
    <p class="lead">Layanan sewa kendaraan profesional dan terpercaya untuk segala kebutuhan Anda.</p>
  </div>
</section>

<!-- Header section -->
<div class="mt bg-custom1">
  <div class="header">
      <div>
        <i class="fa-solid fa-headset"></i>
          <h2>Hotline 24/7</h2>
          <p>Kami siap membantu untuk memenuhi semua kebutuhan layanan transportasi Anda.</p>
      </div>
      <div>
        <i class="fa-solid fa-location-dot"></i>
          <h2>Area Layanan</h2>
          <p>Booking kendaraan jadi lebih mudah dengan dukungan jaringan luas di seluruh Indonesia.</p>
      </div>
      <div>
        <i class="fa-solid fa-shield"></i>
          <h2>Proteksi</h2>
          <p>Demi kenyamanan & rasa aman selama perjalanan, kami melindungi Anda dengan proteksi asuransi.</p>
      </div>
      <div>
        <i class="fa-solid fa-car"></i>
          <h2>Beragam Jenis</h2>
          <p>Penunjang kebutuhan perjalanan Anda dengan berbagai macam kendaraan transportasi.</p>
      </div>
  </div>

 <!-- card service -->
<div class="mt-4 text-center">
  <h2 class="title-underline">DAFTAR KENDARAAN</h2>
</div>

<div class="container mt-4">
  <div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col">
      <div class="card h-100">
        <img src="img/avanza 2016.png" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Toyota Avanza</h5>
          <p class="card-text">Mulai dari Rp350.000,00/hari</p>
          <p class="card-text">
            <i class="fa-regular fa-calendar"></i> 2016<br>
            <i class="fas fa-gas-pump"></i> Bensin<br>
            <i class="fas fa-users"></i> 7 Seater<br>
            <i class="fas fa-cogs"></i> Manual
          </p>
          <a href="reservasi.php" class="btn btn-orange">Booking</a>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card h-100">
        <img src="img/Avanza 2019png.png" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Toyota Avanza</h5>
          <p class="card-text">Mulai dari Rp450.000,00/hari</p>
          <p class="card-text">
            <i class="fa-regular fa-calendar"></i> 2019<br>
            <i class="fas fa-gas-pump"></i> Bensin<br>
            <i class="fas fa-users"></i> 7 Seater<br>
            <i class="fas fa-cogs"></i> Manual
          </p>
          <a href="reservasi.php" class="btn btn-orange">Booking</a>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card h-100">
        <img src="img/Avanza 2024.png" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Toyota Avanza</h5>
          <p class="card-text">Mulai dari Rp600.000,00/hari</p>
          <p class="card-text">
            <i class="fa-regular fa-calendar"></i> 2024<br>
            <i class="fas fa-gas-pump"></i> Bensin<br>
            <i class="fas fa-users"></i> 7 Seater<br>
            <i class="fas fa-cogs"></i> Manual
          </p>
          <a href="reservasi.php" class="btn btn-orange">Booking</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Button Lihat Selengkapnya with custom color -->
  <div class="container text-center mt-4">
    <a href="armada.php" class="btn btn-primary">Lihat Selengkapnya</a>
  </div>
</div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
