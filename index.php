<?php
require 'header.php';
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
          <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
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

  <!-- Carousel -->
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="img/bg1.jpg" class="d-block w-100" alt="Gambar 1">
        <div class="carousel-caption d-none d-md-block">
          <h5>Welcome to Our Website</h5>
          <p class="text-primary font-weight-bold">We offer the best services for your needs.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="img/bg3.png" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Professional Team</h5>
          <p class="text-primary font-weight-bold">Our team is highly skilled and experienced.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="img/bg2.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Contact Us Today</h5>
          <p class="text-primary font-weight-bold">We are here to assist you with any inquiries.</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

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


  <!-- Card Section -->
  <div class="container mb-5">
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4 index-card">
          <img src="img/1.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-cogs"></i> Service 1</h5>
            <p class="card-text">Kami mengutamakan kenyamanan, keamanan, dan keselamatan. 
              Dengan mengecek terlebih dahulu setiap bagian mobilnya.</p>
            <a href="#" class="btn alert-primary"><i class="fas fa-arrow-right"></i> Learn More</a>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card mb-4 index-card">
          <img src="img/2.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><i class="fa-solid fa-key"></i> Service 2</h5>
            <p class="card-text">Kami menawarkan pilihan untuk anda agar dapat menyewa dengan supir atau lepas kunci.</p>
            <a href="#" class="btn alert-warning"><i class="fas fa-arrow-right"></i> Learn More</a>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card mb-4 index-card">
          <img src="img/3.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><i class="fa-solid fa-car"></i> Service 3</h5>
            <p class="card-text">Kami menawarkan berbagai banyak pilihan mobil mulai dari city car, LMPV, maupun travel.</p>
            <a href="#" class="btn alert-warning"><i class="fas fa-arrow-right"></i> Learn More</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- footer -->
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