<?php 
require 'includes/header.php';
?>

<!-- About Us Section -->
<section id="about-us" class="py-5">
  <div class="container">
    <div class="row align-items-center">
      <!-- Deskripsi -->
      <div class="col-md-7" data-aos="fade-right" data-aos-duration="1000">
        <h2 class="fw-bold mb-3" style="color: #343a40;">Kenapa Memilih <span style="color: #f39c12;">WJA Trans</span>?</h2>
        <p style="color: #495057; font-size: 1.1rem; line-height: 1.8;">
          <strong>WJA Trans</strong> adalah platform web terpercaya yang menyediakan layanan sewa mobil dengan <strong>kemudahan</strong>, <strong>keamanan</strong>, dan <strong>harga yang kompetitif</strong>. Kami menawarkan berbagai pilihan mobil, termasuk Honda CRV, Avanza Veloz, dan Pajero Sport, yang cocok untuk perjalanan bisnis atau liburan keluarga.
        </p>
        <p style="color: #495057; font-size: 1.1rem; line-height: 1.8;">
          <i>Kami berkomitmen untuk memberikan pengalaman berkendara terbaik bagi Anda, dengan armada berkualitas tinggi dan layanan yang selalu siap membantu kapan saja.</i>
        </p>
        <a href="daftar_mobil.php" class="btn btn-warning fw-bold px-4 py-2 mt-3" style="color: #ffffff; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">Lihat Mobil →</a>
      </div>

      <!-- Gambar -->
      <div class="col-md-5 text-center" data-aos="fade-left" data-aos-duration="1000">
        <img src="img/logo.png" alt="RentalYukk" class="img-fluid rounded" style="max-width: 90%; box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);">
      </div>
    </div>
  </div>
</section>

<!-- FAQ Section -->
<section id="faq" class="py-5" style="background-color: #f8f9fa;">
  <div class="container">
    <h2 class="text-center fw-bold mb-4" style="color: #343a40;" data-aos="fade-down" data-aos-duration="1000">Pertanyaan Yang Sering Ditanyakan</h2>
    <p class="text-center mb-4" style="color: #495057; font-size: 1.1rem;" data-aos="fade-up" data-aos-duration="1200">
      Di bawah ini adalah beberapa pertanyaan yang sering diajukan oleh pelanggan kami. Jika Anda memiliki pertanyaan lainnya, jangan ragu untuk menghubungi kami!
    </p>
    <div class="accordion" id="faqAccordion">
      <!-- Pertanyaan 1 -->
      <div class="accordion-item border-0 shadow-sm mb-3" data-aos="fade-right" data-aos-duration="1000">
        <h2 class="accordion-header" id="faq1">
          <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#answer1" aria-expanded="false" aria-controls="answer1" style="background-color: #e9ecef; color: #343a40; transition: background-color 0.3s ease;">
            Bagaimana cara memesan mobil?
          </button>
        </h2>
        <div id="answer1" class="accordion-collapse collapse" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
          <div class="accordion-body" style="background-color: #f8f9fa;">
            Untuk memesan mobil, cukup klik tombol <strong>Rental Sekarang</strong> di halaman utama, pilih mobil yang Anda inginkan, dan isi formulir pemesanan dengan data yang diperlukan. Mudah dan praktis!
          </div>
        </div>
      </div>
      <!-- Pertanyaan 2 -->
      <div class="accordion-item border-0 shadow-sm mb-3" data-aos="fade-left" data-aos-duration="1000">
        <h2 class="accordion-header" id="faq2">
          <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#answer2" aria-expanded="false" aria-controls="answer2" style="background-color: #e9ecef; color: #343a40; transition: background-color 0.3s ease;">
            Bagaimana cara melihat daftar mobil yang tersedia?
          </button>
        </h2>
        <div id="answer2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
          <div class="accordion-body" style="background-color: #f8f9fa;">
            Anda dapat melihat daftar mobil kami di halaman <strong>Layanan</strong>. Di sana, Anda akan menemukan berbagai pilihan kendaraan lengkap dengan harga dan spesifikasi.
          </div>
        </div>
      </div>
      <!-- Pertanyaan 3 -->
      <div class="accordion-item border-0 shadow-sm mb-3" data-aos="fade-right" data-aos-duration="1000">
        <h2 class="accordion-header" id="faq3">
          <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#answer3" aria-expanded="false" aria-controls="answer3" style="background-color: #e9ecef; color: #343a40; transition: background-color 0.3s ease;">
            Apa yang perlu dibawa saat mengambil mobil?
          </button>
        </h2>
        <div id="answer3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
          <div class="accordion-body" style="background-color: #f8f9fa;">
            Anda hanya perlu membawa <strong>dokumen identitas (KTP atau SIM)</strong> dan bukti pemesanan. Jika ada dokumen tambahan yang diperlukan, tim kami akan menginformasikannya sebelumnya.
          </div>
        </div>
      </div>
      <!-- Pertanyaan 4 -->
      <div class="accordion-item border-0 shadow-sm mb-3" data-aos="fade-left" data-aos-duration="1000">
        <h2 class="accordion-header" id="faq4">
          <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#answer4" aria-expanded="false" aria-controls="answer4" style="background-color: #e9ecef; color: #343a40; transition: background-color 0.3s ease;">
            Bagaimana cara membatalkan pemesanan mobil?
          </button>
        </h2>
        <div id="answer4" class="accordion-collapse collapse" aria-labelledby="faq4" data-bs-parent="#faqAccordion">
          <div class="accordion-body" style="background-color: #f8f9fa;">
            Untuk membatalkan pemesanan, silakan hubungi kami melalui email atau nomor kontak yang tersedia. Mohon sertakan detail pemesanan Anda untuk mempercepat proses.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php 
require 'includes/footer.php';
?>
