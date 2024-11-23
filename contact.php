<?php
require 'includes/header.php'; // Memanggil header
?>

<div class="container py-5">
  <!-- Header -->
  <div class="row justify-content-center">
    <div class="col-lg-8 text-center" data-aos="fade-down" data-aos-duration="1200">
      <h1 class="fw-bold mb-4" style="color: #000;">Hubungi Kami</h1>
      <p class="text-muted" style="font-size: 1.1rem; line-height: 1.8;">
        Kami siap membantu Anda! Hubungi kami melalui kontak di bawah ini atau kirim pesan langsung menggunakan formulir yang tersedia.
      </p>
    </div>
  </div>

  <!-- Informasi Kontak dan Maps -->
  <div class="row justify-content-center mt-5">
    <!-- Informasi Kontak -->
    <div class="col-lg-5 mb-4" data-aos="fade-right" data-aos-duration="1200">
      <div class="p-4 shadow rounded" style="background-color: #f8f9fa;">
        <h5 class="fw-bold mb-3" style="color: #000;">Informasi Kontak</h5>
        <ul style="list-style: none; padding: 0; font-size: 1.1rem; line-height: 1.8; color: #333;">
          <li class="mb-3">
            <strong>Alamat:</strong><br>
            Ds. Jenebin, RT 007 RW 004, Desa Purwadana, Kec. Telukjambe Timur, Kab. Karawang, Jawa Barat, 41361
          </li>
          <li class="mb-3">
            <strong>Email:</strong><br>
            <a href="mailto:wejeatrans@gmail.com" style="text-decoration: none; color: #f39c12;">wejeatrans@gmail.com</a>
          </li>
          <li class="mb-3">
            <strong>WhatsApp:</strong><br>
            <a href="https://wa.me/6289609317309?text=Halo%20WJA%20Trans,%20saya%20ingin%20bertanya%20tentang%20layanan%20rental%20mobil." 
              target="_blank" 
              style="text-decoration: none; color: #f39c12;">
              +62 896-0931-7309
            </a>
          </li>
        </ul>
      </div>
    </div>


    <!-- Google Maps -->
    <div class="col-lg-6 mb-4" data-aos="fade-left" data-aos-duration="1200">
      <div class="shadow rounded">
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.752716711356!2d107.27737437441107!3d-6.296192361621519!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e699d5b4f04d86b%3A0xb65c51bd4d2f288b!2sWJA%20Trans!5e0!3m2!1sen!2sid!4v1732204043867!5m2!1sen!2sid" 
        width="100%" 
        height="300" 
        style="border: 0; border-radius: 8px;" 
        allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
      </div>
    </div>
  </div>

  <!-- Formulir Hubungi Kami -->
  <div class="row justify-content-center mt-5">
    <div class="col-lg-8" data-aos="zoom-in" data-aos-duration="1500">
      <div class="p-5 shadow rounded" style="background-color: #fff;">
        <h5 class="fw-bold mb-4" style="color: #000;">Kirim Pesan Kepada Kami</h5>
        <form action="kirim_pesan.php" method="POST">
          <div class="mb-3">
            <label for="name" class="form-label">Nama Anda</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama Anda" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email Anda</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email Anda" required>
          </div>
          <div class="mb-3">
            <label for="message" class="form-label">Pesan Anda</label>
            <textarea name="message" id="message" class="form-control" rows="5" placeholder="Tulis pesan Anda di sini" required></textarea>
          </div>
          <button type="submit" class="btn btn-warning fw-bold px-5 py-2" style="font-size: 1rem;">Kirim Pesan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
require 'includes/footer.php'; // Memanggil footer
?>
