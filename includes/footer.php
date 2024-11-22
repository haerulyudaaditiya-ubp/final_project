<!-- Contact Section -->
<section id="contact" class="py-5" style="background-color: #343a40; color: #ffffff;">
  <div class="container">
    <div class="row align-items-start">
      <!-- Logo dan Deskripsi -->
      <div class="col-md-4 mb-4 mb-md-0" data-aos="fade-up" data-aos-duration="1000">
        <div class="d-flex align-items-center mb-3">
          <img src="img/logo.png" alt="Logo" class="me-2 logo-small" style="width: 50px; height: auto;">
          <h5 class="fw-bold mb-0" style="color: #f39c12;">WJA Trans</h5>
        </div>
        <p>WJA Trans adalah platform web terpercaya yang menyediakan layanan sewa mobil dengan mudah, aman, dan harga bersaing. Kami siap menemani perjalanan Anda.</p>
        <p>
          <i class="fas fa-phone me-2"></i> <strong>+62 850 1099 7854</strong> <br>
          <i class="fas fa-envelope me-2"></i> <strong>R8P9H@example.com</strong>
        </p>
      </div>

      <!-- Menu -->
      <div class="col-md-4 mb-4 mb-md-0" data-aos="fade-up" data-aos-duration="1200">
        <h6 class="fw-bold" style="color: #f39c12;">Menu</h6>
        <ul class="list-unstyled">
          <li><a href="./index.php" class="text-white text-decoration-none">Home</a></li>
          <li><a href="./about.php" class="text-white text-decoration-none">Tentang Kami</a></li>
          <li><a href="./daftar_mobil.php" class="text-white text-decoration-none">Daftar Mobil</a></li>
          <li><a href="./syarat.php" class="text-white text-decoration-none">Syarat & Ketentuan</a></li>
          <li><a href="./contact.php" class="text-white text-decoration-none">Hubungi Kami</a></li>
        </ul>
      </div>

      <!-- Socials -->
      <div class="col-md-4" data-aos="fade-up" data-aos-duration="1400">
        <h6 class="fw-bold" style="color: #f39c12;">Ikuti Kami</h6>
        <p>Ikuti kami di media sosial untuk mendapatkan penawaran terbaik dan informasi terbaru!</p>
        <div class="d-flex align-items-start gap-3 flex-column">
          <!-- WhatsApp -->
          <a href="https://wa.me/6289609317309?text=Halo%20WJA%20Trans,%20saya%20ingin%20bertanya%20tentang%20layanan%20rental%20mobil."
            target="_blank"
            class="d-flex align-items-center text-white text-decoration-none gap-2">
            <i class="fab fa-whatsapp fs-4"></i>
            <span>WhatsApp</span>
          </a>
          <!-- Instagram -->
          <a href="https://www.instagram.com/wejeatrans"
            target="_blank"
            class="d-flex align-items-center text-white text-decoration-none gap-2">
            <i class="fab fa-instagram fs-4"></i>
            <span>Instagram</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="text-center py-3" style="background-color: #23272a; color: #f8f9fa;">
  © 2024 <strong style="color: #f39c12;">RentalYukk</strong> | All Rights Reserved
</footer>


<!-- Tambahkan Bootstrap JS dan AOS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
  // Inisialisasi AOS
  AOS.init();

  // Inisialisasi ulang dropdown setelah AOS aktif
  document.addEventListener('DOMContentLoaded', function () {
    var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
    var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
      return new bootstrap.Dropdown(dropdownToggleEl);
    });
  });
</script>
