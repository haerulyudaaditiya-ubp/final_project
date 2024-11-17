<?php

require "heider.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Mobil</title>
    <style>
       body {
          background-color: lightgrey; 
      }
  </style>

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
          <a class="nav-link" href="home.php">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tentangkita.php">Tentang Kami</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="armada.php">Armada</a>
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

 <!-- Hero Section Armada -->
<section class="hero hero-armada">
  <div class="hero-text1">
    <h5 class="hero-subtitle">WEJEATRANS</h5>
    <h1 class="hero-title">Katalog Armada Rental Mobil Karawang</h1>
    <p class="hero-description">PT. WASONDA JAYA ABADI</p>
  </div>
</section>


<!-- coloum armada -->
<style>
  .card {
    background-color: #001f3f; /* Warna biru dongker */
    color: white; /* Warna teks agar kontras */
  }
  .card .btn-orange {
    background-color: orange;
    color: white;
  }
</style>

<!-- Daftar Mobil -->
<div class="mt text-center p-4 ">
  <h2 class="title-underline">KENDARAAN KECIL</h2>
</div>

<div class="container mt-4 ">
  <div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col">
      <div class="card h-100">
        <img src="img/avanza 2016.png" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Toyota Avanza</h5>
          <p class="card-text">Mulai dari Rp350.000.00/hari</p>
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
          <p class="card-text">Mulai dari Rp450.000.00/hari</p>
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
          <h5 class="card-title">Toyota All New Avanza</h5>
          <p class="card-text">Mulai dari Rp600.000.00/hari</p>
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

    <div class="col">
      <div class="card h-100">
        <img src="img/Kijang_Innova_2013.png" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Toyota Kijang Innova</h5>
          <p class="card-text">Mulai dari Rp500.000.00/hari</p>
          <p class="card-text">
          <i class="fa-regular fa-calendar"></i> 2013<br>
            <i class="fas fa-gas-pump"></i> Bensin<br>
            <i class="fas fa-users"></i> 7 Seater<br>
            <i class="fas fa-cogs"></i>  Automatic
          </p>
          <a href="reservasi.php" class="btn btn-orange">Booking</a>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card h-100">
        <img src="img/Innova_Reborn-removebg-preview.png" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Toyota Kijang Innova Reborn</h5>
          <p class="card-text">Mulai dari Rp700.000.00/hari</p>
          <p class="card-text">
          <i class="fa-regular fa-calendar"></i> 2018<br>
            <i class="fas fa-gas-pump"></i> Bensin<br>
            <i class="fas fa-users"></i> 7 Seater<br>
            <i class="fas fa-cogs"></i>  Automatic
          </p>
          <a href="reservasi.php" class="btn btn-orange">Booking</a>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card h-100">
        <img src="img/Luxiowebp.webp" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Daihatsu Luxio</h5>
          <p class="card-text">Mulai dari Rp500.000.00/hari</p>
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

    <div class="col">
      <div class="card h-100">
        <img src="img/Fortuner.png" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Toyota Fortuner</h5>
          <p class="card-text">Mulai dari Rp800.000.00/hari</p>
          <p class="card-text">
          <i class="fa-regular fa-calendar"></i> 2018<br>
            <i class="fas fa-gas-pump"></i> Diesel<br>
            <i class="fas fa-users"></i> 7 Seater<br>
            <i class="fas fa-cogs"></i>  Automatic
          </p>
          <a href="reservasi.php" class="btn btn-orange">Booking</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="mt-4 text-center">
  <h2 class="title-underline">KENDARAAN BESAR</h2>
</div>

<div class="container mt-4">
  <div class="row row-cols-1 row-cols-md-2 g-4">
    <div class="col">
      <div class="card h-100">
        <img src="img/Toyota_Hiace.png" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Toyota Haice</h5>
          <p class="card-text">Mulai dari Rp........./hari</p>
          <p class="card-text">
          <i class="fa-solid fa-car"></i> Mini Bus<br>
            <i class="fas fa-gas-pump"></i> Diesel<br>
            <i class="fas fa-users"></i> 7 Seater<br>
            <i class="fas fa-cogs"></i> Manual
          </p>
          <a href="reservasi.php" class="btn btn-orange">Booking</a>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card h-100">
        <img src="img/Isuzu_elf.png" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Isuzu Elf</h5>
          <p class="card-text">Mulai dari Rp........../hari</p>
          <p class="card-text">
          <i class="fa-solid fa-car"></i> Mini bus<br>
            <i class="fas fa-gas-pump"></i> Bensin<br>
            <i class="fas fa-users"></i> 4 Seater<br>
            <i class="fas fa-cogs"></i> Manual
          </p>
          <a href="reservasi.php" class="btn btn-orange">Booking</a>
        </div>
      </div>
    </div>
    </div>
    </div>

    <!-- persyaratan -->
  
    
    
    


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>