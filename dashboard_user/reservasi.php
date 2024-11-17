<?php

require "heider.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
</head>
<body>

 <!-- reservasi -->
 <div class="container reservation-container">
    <h2>Reservasi Mobil</h2>
    <form>
      <label for="namaPemesan">Nama Pemesan</label>
      <input type="text" id="namaPemesan" placeholder="Masukkan Nama Pemesan" required>

      <label for="noTelepon">Nomor Telepon</label>
      <input type="tel" id="noTelepon" placeholder="Masukkan Nomor Telepon" required>

      <label for="alamatPenjemputan">Alamat Penjemputan</label>
      <input type="text" id="alamatPenjemputan" placeholder="Masukkan Alamat Penjemputan" required>
  
      <div class="brand-selectors">
        <div>
          <label for="model">Jenis Mobil</label>
          <select id="model" required>
            <option value="">Pilih Salah Satu</option>
            <option>Avanza</option>
            <option>Jazz</option>
          </select>
        </div>
      </div>
  
      <label>Opsi Pengemudi</label>
      <div class="radio-group">
        <label><input type="radio" name="pengemudi" value="supir" required> Dengan Supir</label>
        <label><input type="radio" name="pengemudi" value="lepasKunci"> Lepas Kunci</label>
      </div>
  
      <label for="tanggalPenjemputan">Tanggal Penjemputan</label>
      <div class="date-time-group">
        <input type="date" id="tanggalPenjemputan" required>
        <input type="time" id="waktuPenjemputan" required>
      </div>
  
      <label for="tanggalPengantaran">Tanggal Pengantaran</label>
      <div class="date-time-group">
        <input type="date" id="tanggalPengantaran" required>
        <input type="time" id="waktuPengantaran" required>
      </div>
  
      <div class="button-container">
        <button type="submit">Berikutnya</button>
      </div>
    </form>
  </div>

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>