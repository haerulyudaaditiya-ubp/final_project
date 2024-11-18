<?php
require 'header.php';

// Cek parameter untuk menentukan kategori layanan
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : 'tanpa-supir';
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
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Service <i class="fas fa-caret-down"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="service.php?kategori=tanpa-supir">Tanpa Supir</a>
              <a class="dropdown-item" href="service.php?kategori=dengan-supir">Dengan Supir</a>
            </div>
          </li>
          <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        </ul>
        <a href="login.php"><button type="button" class="btn btn-outline-light ms-3">Login</button></a>
      </div>
    </div>
  </nav>

  <!-- List Kendaraan -->
  <div class="container my-5">
    <h2 class="custom-title text-center mb-5">List Kendaraan - <?= $kategori === 'tanpa-supir' ? 'Tanpa Supir' : 'Dengan Supir'; ?></h2>
    <div class="row justify-content-center">
      <!-- Card 1 -->
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100 service-card">
          <img src="img/avz16.png" class="card-img-top" alt="Avanza16">
          <div class="card-body text-center">
            <h5 class="card-title">Toyota Avanza</h5>
            <p class="text-warning">Mulai dari Rp350rb/hari</p>
            <ul class="list-unstyled">
              <li><i class="fas fa-gas-pump"></i> Bensin</li>
              <li><i class="fas fa-users"></i> 7 Seater</li>
              <li><i class="fa-solid fa-calendar-days"></i> 2016</li>
              <li><i class="fas fa-cogs"></i> Manual</li>
            </ul>
            <a href="login.php" class="btn btn-warning">Booking</a>
          </div>
        </div>
      </div>
      <!-- Card 2 -->
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100 service-card">
          <img src="img/avz19.png" class="card-img-top" alt="Avanza19">
          <div class="card-body text-center">
            <h5 class="card-title">Toyota Avanza</h5>
            <p class="text-warning">Mulai dari Rp450rb/hari</p>
            <ul class="list-unstyled">
              <li><i class="fas fa-gas-pump"></i> Bensin</li>
              <li><i class="fas fa-users"></i> 7 Seater</li>
              <li><i class="fa-solid fa-calendar-days"></i> 2019</li>
              <li><i class="fas fa-cogs"></i> Manual</li>
            </ul>
            <a href="login.php" class="btn btn-warning">Booking</a>
          </div>
        </div>
      </div>
      <!-- Card 3 -->
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100 service-card">
          <img src="img/avz24.png" class="card-img-top" alt="Avanza 2024">
          <div class="card-body text-center">
            <h5 class="card-title">Toyota Avanza</h5>
            <p class="text-warning">Mulai dari Rp500rb/hari</p>
            <ul class="list-unstyled">
              <li><i class="fas fa-gas-pump"></i> Bensin</li>
              <li><i class="fas fa-users"></i> 7 Seater</li>
              <li><i class="fa-solid fa-calendar-days"></i> 2024</li>
              <li><i class="fas fa-cogs"></i> Manual</li>
            </ul>
            <a href="login.php" class="btn btn-warning">Booking</a>
          </div>
        </div>
      </div>
      <!-- Card 4 -->
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100 service-card">
          <img src="img/Luxio24.png" class="card-img-top" alt="Luxio24.png">
          <div class="card-body text-center">
            <h5 class="card-title">Luxio</h5>
            <p class="text-warning">Mulai dari Rp600rb/hari</p>
            <ul class="list-unstyled">
              <li><i class="fas fa-gas-pump"></i> Bensin</li>
              <li><i class="fas fa-users"></i> 7 Seater</li>
              <li><i class="fa-solid fa-calendar-days"></i> 2024</li>
              <li><i class="fas fa-cogs"></i> Matic/Manual</li>
            </ul>
            <a href="login.php" class="btn btn-warning">Booking</a>
          </div>
        </div>
      </div>
      <!-- Card 5 -->
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100 service-card">
          <img src="img/Innova13.png" class="card-img-top" alt="Innova 2013">
          <div class="card-body text-center">
            <h5 class="card-title">Innova</h5>
            <p class="text-warning">Mulai dari Rp500rb/hari</p>
            <ul class="list-unstyled">
              <li><i class="fas fa-gas-pump"></i> Bensin</li>
              <li><i class="fas fa-users"></i> 7 Seater</li>
              <li><i class="fa-solid fa-calendar-days"></i> 2013</li>
              <li><i class="fas fa-cogs"></i> Matic/Manual</li>
            </ul>
            <a href="login.php" class="btn btn-warning">Booking</a>
          </div>
        </div>
      </div>
      <!-- Card 6 -->
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100 service-card">
          <img src="img/innova-reborn.png" class="card-img-top" alt="innova-reborn">
          <div class="card-body text-center">
            <h5 class="card-title">Innova Reborn</h5>
            <p class="text-warning">Mulai dari Rp700rb/hari</p>
            <ul class="list-unstyled">
              <li><i class="fas fa-gas-pump"></i> Bensin</li>
              <li><i class="fas fa-users"></i> 7 Seater</li>
              <li><i class="fa-solid fa-calendar-days"></i> 2015</li>
              <li><i class="fas fa-cogs"></i> Manual</li>
            </ul>
            <a href="login.php" class="btn btn-warning">Booking</a>
          </div>
        </div>
      </div>
      <!-- Card 7 -->
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100 service-card">
          <img src="img/fortuner.png" class="card-img-top" alt="Fortuner">
          <div class="card-body text-center">
            <h5 class="card-title">Fortuner</h5>
            <p class="text-warning">Mulai dari Rp800rb/hari</p>
            <ul class="list-unstyled">
              <li><i class="fas fa-gas-pump"></i> Bensin</li>
              <li><i class="fas fa-users"></i> 6 Seater</li>
              <li><i class="fa-solid fa-calendar-days"></i> 2020</li>
              <li><i class="fas fa-cogs"></i> Manual</li>
            </ul>
            <a href="login.php" class="btn btn-warning">Booking</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Teks Pembeda di Bawah -->
    <!-- Section for Terms and Conditions -->
    <section class="terms-section container">
        <h2 class="section-title">Syarat & Ketentuan</h2>
        <p class="intro-text">Sebelumnya kami ucapkan, terima kasih telah mengunjungi situs website kami, Rentalyukk.com. Kami selalu menyediakan layanan terbaik dalam jasa rental mobil di Bangka, untuk segala keperluan Anda dan keluarga selama bisnis atau liburan Anda di Bangka.</p>
        <p class="intro-text">Pemesanan bisa dilakukan dengan mengisi form pemesanan kami dengan lengkap dan diisi dengan data yang valid. Dengan pengisian data yang lengkap dan valid akan memudahkan kami dalam memproses permintaan Anda dalam pemesanan sewa mobil.</p>

        <!-- Perbedaan Syarat & Ketentuan Tanpa Supir dan Dengan Supir -->
        <?php if ($kategori === 'tanpa-supir'): ?>
            <div class="terms-details">
                <h3>Layanan Tanpa Supir</h3>
                <p class="intro-text">Layanan ini cocok untuk Anda yang ingin berkendara secara mandiri tanpa pendampingan. Beberapa syarat khusus untuk layanan tanpa supir meliputi:</p>
                <ul>
                    <li>Wajib menyediakan softcopy dokumen perusahaan jika rental untuk perusahaan (misalnya, Akta Perusahaan, NIB, dan NPWP).</li>
                    <li>Identitas penyewa meliputi KTP penyewa dan penjamin, serta SIM yang berlaku.</li>
                    <li>Untuk penyewaan bulanan atau lebih, survei lokasi mungkin diperlukan untuk pelanggan baru.</li>
                </ul>
                <p class="highlight-text">Pastikan semua dokumen Anda lengkap sebelum melakukan pemesanan agar proses berjalan lancar.</p>
            </div>
        <?php elseif ($kategori === 'dengan-supir'): ?>
            <div class="terms-details">
                <h3>Layanan Dengan Supir</h3>
                <p class="intro-text">Layanan ini ideal bagi Anda yang ingin berkendara dengan nyaman tanpa perlu mengemudi sendiri. Kami menyediakan sopir berpengalaman yang akan menemani perjalanan Anda. Syarat khusus untuk layanan dengan supir adalah sebagai berikut:</p>
                <ul>
                    <li>Penyewa hanya perlu menyediakan dokumen identitas dasar seperti fotokopi KTP, SIM A, dan KK atau Buku Nikah.</li>
                    <li>Diperlukan form pemesanan yang diisi dengan lengkap dan valid.</li>
                    <li>Jaminan dapat berupa kendaraan bermotor (minimal tahun 2018) atau deposit senilai minimal Rp 2 juta.</li>
                    <li>Pelanggan baru mungkin perlu disurvei terlebih dahulu sebelum persetujuan pemesanan.</li>
                </ul>
                <p class="highlight-text">Jika ada pertanyaan terkait persyaratan, jangan ragu untuk menghubungi kami. Kami selalu siap membantu.</p>
            </div>
        <?php endif; ?>

        <p class="highlight-text">Jika ada dari syarat dan ketentuan sewa mobil di atas yang kurang jelas, atau susah dimengerti, silakan tanyakan kepada kami! Kami selalu siap membantu menjelaskan sebaik mungkin kepada setiap pelanggan sewa kendaraan di Rentalyukk.com.</p>
    </section>

  </div>

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
