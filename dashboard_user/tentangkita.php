<?php

require "heider.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kita</title>
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
          <a class="nav-link active" href="tentangkita.php">Tentang Kami</a>
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


     <!-- Hero Section Tentang Kita -->
<section class="hero hero-armada">
  <div class="hero1-text">
    <h5 class="hero-subtitle">WEJEATRANS</h5>
    <h1 class="hero-title">TENTANG RENTAL MOBIL KARAWANG</h1>
    <p class="hero-description">PT. WASONDA JAYA ABADI</p>
  </div>
</section>

<!-- content tentang kita -->
<div class="container mt text-center p-4">
<div class="clearfix">
  <h2>Tentang Kami</h2>
  <p>
  WejeaTrans adalah perusahaan rental mobil yang berkomitmen memberikan pengalaman berkendara yang luar biasa bagi
        pelanggan kami. Kami menyediakan berbagai jenis mobil berkualitas dengan harga yang kompetitif serta pelayanan
        yang aman dan nyaman.
  </p>
  <p>
  Sejak didirikan, WejeaTran telah melayani ribuan pelanggan dengan profesionalisme dan dedikasi. Kami bangga
        untuk menyediakan layanan terbaik kepada pelanggan kami. Kami percaya bahwa perjalanan yang aman dan nyaman
        adalah hak setiap orang, dan kami berkomitmen untuk mewujudkannya.
  </p>
</div>
</div>

<!-- Accordion -->
<div class="mt-4">
    <div class="row justify-content-around">
      <div class="col-4">
        <div class="accordion accordion-flush" id="accordionFlushExample">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                <strong>Terlengkap</strong>
              </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">Kami memiliki banyak pilihan jenis mobil yang bisa disewa sesuai dengan kebutuhan.</div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                <strong>Terpercaya</strong>
              </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">Jasa sewa mobil kami ini sudah dipercaya sejak lama oleh banyak pelanggan.</div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                <strong>Terjangkau</strong>
              </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">Kami memberikan harga yang terjangkau untuk setiap jenis mobil yang disewakan.</div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                <strong>Tangguh</strong>
              </button>
            </h2>
            <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">Kami selalu memastikan bahwa mobil yang akan disewakan dalam kondisi yang tangguh.</div>
            </div>
          </div>
        </div>        
      </div>

      <div class="col-4">
        <img src="img/logo.png" alt="Gambar Mobil" class="img-fluid">
      </div>
    </div>
  </div>
    
<!-- Header section -->
<style>
  .con h2 {
    text-align: center;
  }
</style>

<div class="mt-4 text-black p-4 bg-custom">
<div class="con mt-4">
<h2>ABOUT US</h2>
  <div class="header1 mt-4">
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
  </div>

    
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>