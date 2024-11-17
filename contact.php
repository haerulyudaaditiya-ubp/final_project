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
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
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
          <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
        </ul>
        <a href="login.php"><button type="button" class="btn btn-outline-light ms-3">Login</button></a>
      </div>
    </div>
  </nav>

  <!-- Contact Us Section -->
  <section class="contact-us-section contact-us-info">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 text-white">
          <h2 class="contact-title">Hubungi Kami</h2>
          <p>Punya pertanyaan seputar layanan dari Wejeatrans
            Jangan ragu untuk menghubungi kami melalui WhatsApp/Telepon.
             Kami siap menjawab pertanyaan Anda kapanpun dan dimanapun.</p>
        </div>
        <div class="col-md-6">
          <img src="img/logo.png" alt="WejeaTrans" class="contact-logo">
        </div>
      </div>
    </div>
  </section>

  <section id="faq-section">
    <h2 class="text-center" id="faq-title">Pertanyaan Umum (FAQ)</h2>

    <div id="faq-accordion">

      <!-- Jam Layanan Section -->
      <div id="faq-item">
        <div class="faq-header" id="headingPembayaran">
          <h2 class="mb-0">
            <button class="faq-button" type="button" data-toggle="collapse" data-target="#collapseLayanan" aria-expanded="true" aria-controls="collapseLayanan">
              Jam Layanan <i class="fas fa-plus float-right"></i>
            </button>
          </h2>
        </div>
        <div id="collapseLayanan" class="collapse" aria-labelledby="headingLayanan" data-parent="#faq-accordion">
          <div class="faq-body">
          Jam Layanan Rental Mobil
          <ul>
            <li>Hotline: 24 jam</li>
            <li>Jam Pengambilan Unit: 08:00 pagi</li>
            <li>Jam Pengembalian Unit: Maks. jam 04:00 pagi</li>
          </ul>
          </div>
        </div>
      </div>
       <!-- Pembayaran Section -->
      <div id="faq-item">
        <div class="faq-header" id="headingPembayaran">
          <h2 class="mb-0">
            <button class="faq-button" type="button" data-toggle="collapse" data-target="#collapsePembayaran" aria-expanded="true" aria-controls="collapsePembayaran">
              Pembayaran <i class="fas fa-plus float-right"></i>
            </button>
          </h2>
        </div>
        <div id="collapsePembayaran" class="collapse" aria-labelledby="headingPembayaran" data-parent="#faq-accordion">
          <div class="faq-body">
            Informasi terkait metode pembayaran, kebijakan pembayaran, dan lainnya.
          </div>
        </div>
      </div>

      <!-- Overtime Section -->
      <div id="faq-item">
        <div class="faq-header" id="headingOvertime">
          <h2 class="mb-0">
            <button class="faq-button" type="button" data-toggle="collapse" data-target="#collapseOvertime" aria-expanded="true" aria-controls="collapseOvertime">
              Overtime <i class="fas fa-plus float-right"></i>
            </button>
          </h2>
        </div>
        <div id="collapseOvertime" class="collapse" aria-labelledby="headingOvertime" data-parent="#faq-accordion">
          <div class="faq-body">
            Detail tentang kebijakan biaya overtime jika terjadi keterlambatan.
          </div>
        </div>
      </div>

      <!-- Pembatalan Section -->
      <div id="faq-item">
        <div class="faq-header" id="headingPembatalan">
          <h2 class="mb-0">
            <button class="faq-button" type="button" data-toggle="collapse" data-target="#collapsePembatalan" aria-expanded="true" aria-controls="collapsePembatalan">
              Pembatalan <i class="fas fa-plus float-right"></i>
            </button>
          </h2>
        </div>
        <div id="collapsePembatalan" class="collapse" aria-labelledby="headingPembatalan" data-parent="#faq-accordion">
          <div class="faq-body">
            Kebijakan terkait pembatalan, syarat dan ketentuan pengembalian uang.
          </div>
        </div>
      </div>

    </div>
  </section>

  <section class="contact-us-section contact-us-hotline">
    <div class="container text-center">
      <h2 class="contact-title">Hotline 24 Jam</h2>
      <div class="contact-phone">0812-8440-9311</div>
      <div class="contact-info">
        <p class="contact-email">
          <i class="fas fa-envelope"></i> cs@kinsrentalmobil.com
        </p>
        <p class="contact-instagram">
        <i class="fa-brands fa-square-instagram"></i> @Wejeatrans
        </p>
        <p class="contact-address">
          <i class="fas fa-map-marker-alt"></i> Ds. Jenebin II RT 07/ RW 04 (sebrang Masjid Nurul Hikmah Purwadana, Purwadana, 
          Telukjambe Timur, Karawang, Jawa Barat 41361)
        </p>
      </div>
      <a href="https://wa.me/081284409311" class="whatsapp-button">WhatsApp Kami</a>
    </div>
  </section>
   <!-- Peta -->
    <div class="container py-2">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253808.1712603654!2d106.99155818671873!3d-6.
        296197699999988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e699d5b4f04d86b%3A0xb65c51bd4d2f288b!2sPT.
        %20WASONDA%20JAYA%20ABADI%20(WJA%20Trans%20%26%20Car%20Rentals)!5e0!3m2!1sid!2sid!4v1731221188063!5m2!1sid!2sid" 
        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
  <script>
  $(document).ready(function(){
    $('.faq-button').click(function(){
      $(this).find('i').toggleClass('fa-plus fa-minus');
    });
  });
  </script>
</body>
</html>