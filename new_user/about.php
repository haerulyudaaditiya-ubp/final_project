<?php
require '../header.php';
?>

<body>

  <!-- Navbar -->
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
          <li class="nav-item"><a class="nav-link" href="dashboard.php">Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="about.php">About</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Service <i class="fas fa-caret-down"></i> <!-- Tanda panah menggunakan Font Awesome -->
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

  <!-- About Us Section -->
  <section class="about-section py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h2 class="mb-4 text-primary">Tentang Kami</h2>
          <p>WejeaTrans adalah perusahaan transportasi terkemuka yang berdedikasi untuk menyediakan layanan berkualitas tinggi bagi pelanggan kami. 
            Kami menawarkan berbagai pilihan kendaraan dengan dan tanpa supir, siap memenuhi kebutuhan transportasi Anda dengan nyaman dan aman.</p>
          <p>Sejak didirikan, WejeaTrans telah melayani ribuan pelanggan dan terus berinovasi untuk memberikan pengalaman terbaik. Kami percaya bahwa 
            perjalanan yang aman dan nyaman adalah hak setiap orang, dan kami bekerja keras untuk mewujudkannya.</p>
        </div>
        <div class="col-md-6">
          <img src="img/logo.png" alt="WejeaTrans" class="img-fluid rounded">
        </div>
      </div>
    </div>
  </section>

  <!-- Our Values Section -->
  <section class="values-section bg-light py-5">
    <div class="container">
      <h3 class="text-center text-primary mb-4">Our Values</h3>
       <!-- Features Section -->
      <div class="container my-5">
        <div class="row text-center">
          <div class="col-lg-3">
            <i class="fas fa-headset icon-style"></i>
            <h3>Hotline 24/7</h3>
            <p>
              Kami Siap membantu untuk memenuhi semua kebutuhan layanan transportasi Anda. Hubungi <a href="tel:0818-0490-1510">0818-0490-1510</a> untuk pusat bantuan, informasi, maupun pemesanan.
            </p>
          </div>
          <div class="col-lg-3">
            <i class="fas fa-map-marker-alt icon-style"></i>
            <h3>Area Layanan</h3>
            <p>
              Booking kendaraan jadi lebih mudah dengan dukungan jaringan luas yang tersebar di 5 Kabupaten/Kota Besar di Indonesia.
            </p>
          </div>
          <div class="col-lg-3">
            <i class="fas fa-shield-alt icon-style"></i>
            <h3>Proteksi</h3>
            <p>
              Demi ketenangan & rasa aman selama perjalanan, kami melindungi Anda dengan proteksi asuransi & jaminan kondisi armada yang selalu prima.
            </p>
          </div>
          <div class="col-lg-3">
            <i class="fas fa-car icon-style"></i>
            <h3>Beragam Jenis</h3>
            <p>
              Penuhi kebutuhan perjalanan Anda dengan berbagai macam jenis kendaraan di PT Karawang Indah Transport. Mulai dari city car, SUV, LMPV, Sedan, dll.
            </p>
          </div>
        </div>
      </div>
  </section>  

   <!-- Footer -->
  <?php
  require 'footer.php';
  ?>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>