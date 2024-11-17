<?php

require "heider.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak</title>
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
          <a class="nav-link" href="armada.php">Armada</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="kontak.php">Kontak</a>
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
              <p class="text-muted small">email</p>
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


  <!-- content Kontak -->
<div class="mt text-black p-4 bg-custom">
  <div class="row justify-content-start">
    <div class="col-4">
      <!-- Google Map Embed -->
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.752716711362!2d107.27737437402624!3d-6.296192361620696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e699d5b4f04d86b%3A0xb65c51bd4d2f288b!2sPT.%20WASONDA%20JAYA%20ABADI%20(WJA%20Trans%20%26%20Car%20Rentals)!5e0!3m2!1sid!2sid!4v1731417427069!5m2!1sid!2sid" 
              width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="col-8">
      <h2>PT. WASONDA JAYA ABADI <span>Indonesia</span></h2>
      <hr>
      <p><i class="fas fa-map-marker-alt"></i> Ds. Jenebin II RT 07/RW 04, Purwadana, Kec. TelukJambe Timur, Kab. Karawang, Jawa Barat</p>
      <p><i class="fas fa-envelope"></i> <a href="mailto:info.infinitytrans@gmail.com">info.infinitytrans@gmail.com</a></p>
      <p><i class="fas fa-phone"></i> <a href="tel:+6285888600888">+6285888600888</a></p>

      <div class="social-media">
        <span><i class="fas fa-infinity"></i> Sosial Media :</span>
        <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
        <a href="#" class="youtube"><i class="fab fa-youtube"></i></a>
        <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
        <a href="#" class="pinterest"><i class="fab fa-pinterest-p"></i></a>
      </div>
    </div>
  </div>
</div>

  
<!-- Pertanyaan -->
<div class="container mt-5">
            <div class="contact-section">
                <h6 class="text-uppercase text-muted">Contact Us</h6>
                <h2 class="contact-title">Get In Touch</h2>
                <p>Jangan ragu untuk menghubungi kami, tanyakan apa saja tentang rental mobil, tim kami akan membalas secepatnya.</p>

                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Anda</label>
                        <input type="text" class="form-control" id="name" placeholder="Nama Anda">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Anda</label>
                        <input type="email" class="form-control" id="email" placeholder="Email Anda">
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" placeholder="Subject">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Isi Pesan (opsional)</label>
                        <textarea class="form-control" id="message" rows="4" placeholder="Isi Pesan"></textarea>
                    </div>
                    <button type="submit" class="btn btn-submit">Submit</button>
                </form>
            </div>
        </div>

        <!-- Kolom untuk gambar di sebelah kanan -->
        <div class="col-lg-4 d-flex align-items-center">
            <img src="img/placeholder-image.jpg" alt="Contact Image" class="contact-image">
        </div>
    </div>
</div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>