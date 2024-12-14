<?php 
require 'includes/header.php';
?>

<!-- Hero Section -->
<div class="hero-section position-relative" data-aos="fade-in" data-aos-duration="1000" 
     style="background: url('img/background.jpg') no-repeat center bottom/cover; height: 100vh;">
  <div class="overlay" style="background-color: rgba(0, 0, 0, 0.6); position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div>
  <div class="hero-content text-center text-light position-relative" style="z-index: 2; padding-top: 15%;">
    <h1 class="fw-bold" 
        style="font-size: 3rem;" 
        data-aos="zoom-in" 
        data-aos-duration="1500">
      Sewa Mobil <span style="color: #f39c12;">Mudah</span>, <br> Perjalanan Anda Lebih Nyaman
    </h1>
    <p class="lead mt-3" data-aos="fade-up" data-aos-duration="1200" style="font-size: 1.2rem;">
      Kami memberikan pengalaman terbaik dalam menyewa kendaraan dengan harga terjangkau dan layanan prima.
    </p>
    <div class="d-flex justify-content-center mt-4" data-aos="zoom-in" data-aos-duration="1400">
      <a href="daftar_mobil.php" class="btn btn-warning fw-bold" style="box-shadow: 0px 4px 6px rgba(0,0,0,0.2); text-decoration: none;">Lihat Mobil →</a>
    </div>
  </div>
</div>

<!-- Why Choose Us Section -->
<section id="about" class="why-choose-us py-5" style="background-color: #fff;">
  <div class="container">
    <h2 class="text-center fw-bold mb-5" data-aos="fade-down" data-aos-duration="1000" style="color: #343a40;">Kenapa Harus Memilih <span style="color: #f39c12;">Wejea Trans</span>?</h2>
    <div class="row g-4">
      <!-- Card 1 (diganti) -->
      <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="200">
        <div class="card border-0 shadow-sm text-center h-100" style="box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);">
          <div class="card-body">
            <i class="fas fa-car-side fa-3x mb-3" style="color: #f39c12;"></i>
            <h5 class="card-title fw-bold" style="color: #343a40;">Mobil Terbaru</h5>
            <p class="card-text" style="color: #495057;">Kami menyediakan mobil-mobil terbaru dengan kondisi prima dan teknologi terbaru.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="400">
        <div class="card border-0 shadow-sm text-center h-100" style="box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);">
          <div class="card-body">
            <i class="fas fa-clock fa-3x mb-3" style="color: #f39c12;"></i>
            <h5 class="card-title fw-bold" style="color: #343a40;">Layanan 24/7</h5>
            <p class="card-text" style="color: #495057;">Kami siap melayani kebutuhan Anda kapan saja, di mana saja.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="600">
        <div class="card border-0 shadow-sm text-center h-100" style="box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);">
          <div class="card-body">
            <i class="fas fa-car fa-3x mb-3" style="color: #f39c12;"></i>
            <h5 class="card-title fw-bold" style="color: #343a40;">Mobil Terawat</h5>
            <p class="card-text" style="color: #495057;">Armada kami selalu dalam kondisi prima untuk kenyamanan perjalanan Anda.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="800">
        <div class="card border-0 shadow-sm text-center h-100" style="box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);">
          <div class="card-body">
            <i class="fas fa-dollar-sign fa-3x mb-3" style="color: #f39c12;"></i>
            <h5 class="card-title fw-bold" style="color: #343a40;">Harga Terbaik</h5>
            <p class="card-text" style="color: #495057;">Nikmati harga yang kompetitif tanpa mengorbankan kualitas layanan.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="testimonials" class="py-5" style="background-color: #3e4651;">
  <div class="container">
    <h2 class="text-center fw-bold mb-5 text-white" data-aos="fade-down" data-aos-duration="1000">
      Apa Kata <span style="color: #f39c12;">Pelanggan Kami?</span>
    </h2>

    <!-- Carousel -->
    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <!-- Slide 1 -->
        <div class="carousel-item active">
          <div class="row g-4 justify-content-center">
            <!-- Testimoni 1 -->
            <div class="col-md-4 col-12">
              <div class="card testimonial-card border-0 shadow-sm text-center p-4" style="background-color: #fff; border-radius: 12px; height: 100%; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);">
                <div class="mb-3">
                  <i class="fas fa-user-circle fa-3x" style="color: #f39c12;"></i>
                </div>
                <h5 class="fw-bold" style="color: #343a40;">Andi Pratama</h5>
                <p class="text-muted" style="margin: 0; min-height: 50px;">
                  Pelayanan sangat profesional, mobil dalam kondisi bersih dan nyaman. Pasti akan sewa di sini lagi!
                </p>
              </div>
            </div>
            <!-- Testimoni 2 (hidden on mobile) -->
            <div class="col-md-4 d-none d-md-block">
              <div class="card testimonial-card border-0 shadow-sm text-center p-4" style="background-color: #fff; border-radius: 12px; height: 100%; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);">
                <div class="mb-3">
                  <i class="fas fa-user-circle fa-3x" style="color: #f39c12;"></i>
                </div>
                <h5 class="fw-bold" style="color: #343a40;">Siti Rahmawati</h5>
                <p class="text-muted" style="margin: 0; min-height: 50px;">
                  Harga terjangkau dengan pilihan mobil yang beragam. Proses booking juga sangat mudah.
                </p>
              </div>
            </div>
            <!-- Testimoni 3 (hidden on mobile) -->
            <div class="col-md-4 d-none d-md-block">
              <div class="card testimonial-card border-0 shadow-sm text-center p-4" style="background-color: #fff; border-radius: 12px; height: 100%; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);">
                <div class="mb-3">
                  <i class="fas fa-user-circle fa-3x" style="color: #f39c12;"></i>
                </div>
                <h5 class="fw-bold" style="color: #343a40;">Budi Santoso</h5>
                <p class="text-muted" style="margin: 0; min-height: 50px;">
                  Driver yang ramah dan tepat waktu, perjalanan jadi menyenangkan. Sangat direkomendasikan!
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
          <div class="row g-4 justify-content-center">
            <!-- Testimoni 4 -->
            <div class="col-md-4 col-12">
              <div class="card testimonial-card border-0 shadow-sm text-center p-4" style="background-color: #fff; border-radius: 12px; height: 100%; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);">
                <div class="mb-3">
                  <i class="fas fa-user-circle fa-3x" style="color: #f39c12;"></i>
                </div>
                <h5 class="fw-bold" style="color: #343a40;">Rina Susanti</h5>
                <p class="text-muted" style="margin: 0; min-height: 50px;">
                  Mobilnya sangat terawat dan nyaman dipakai untuk perjalanan jauh. Layanan customer service juga cepat tanggap.
                </p>
              </div>
            </div>
            <!-- Testimoni 5 (hidden on mobile) -->
            <div class="col-md-4 d-none d-md-block">
              <div class="card testimonial-card border-0 shadow-sm text-center p-4" style="background-color: #fff; border-radius: 12px; height: 100%; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);">
                <div class="mb-3">
                  <i class="fas fa-user-circle fa-3x" style="color: #f39c12;"></i>
                </div>
                <h5 class="fw-bold" style="color: #343a40;">Agus Wirawan</h5>
                <p class="text-muted" style="margin: 0; min-height: 50px;">
                  Pengalaman pertama sewa di sini dan sangat memuaskan. Proses pengambilan mobil cepat dan mudah.
                </p>
              </div>
            </div>
            <!-- Testimoni 6 (hidden on mobile) -->
            <div class="col-md-4 d-none d-md-block">
              <div class="card testimonial-card border-0 shadow-sm text-center p-4" style="background-color: #fff; border-radius: 12px; height: 100%; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);">
                <div class="mb-3">
                  <i class="fas fa-user-circle fa-3x" style="color: #f39c12;"></i>
                </div>
                <h5 class="fw-bold" style="color: #343a40;">Lutfi Andika</h5>
                <p class="text-muted" style="margin: 0; min-height: 50px;">
                  Harga sangat bersaing dengan kualitas layanan yang luar biasa. Sangat puas!
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Navigasi Carousel -->
      <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev" style="background-color: rgba(0, 0, 0, 0.3); border-radius: 50%; width: 45px; height: 45px;">
        <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(1);"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next" style="background-color: rgba(0, 0, 0, 0.3); border-radius: 50%; width: 45px; height: 45px;">
        <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(1);"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</section>

<?php 
require 'includes/footer.php';
?>  
