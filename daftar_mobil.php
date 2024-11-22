<?php
require 'includes/header.php'; // Menyisipkan Header
?>

<div class="container py-5">
  <h1 class="text-center fw-bold mb-4" style="animation: fadeUp 1s;">Daftar Mobil</h1>
  
  <!-- Filter dan Sortir -->
  <div class="d-flex flex-wrap justify-content-between align-items-center mb-4" style="animation: fadeUp 1s 0.2s;">
    <div class="mb-3 mb-md-0">
      <button class="btn btn-warning shadow-sm mx-1">All Mobil</button>
      <button class="btn btn-outline-secondary shadow-sm mx-1">Honda</button>
      <button class="btn btn-outline-secondary shadow-sm mx-1">Suzuki</button>
      <button class="btn btn-outline-secondary shadow-sm mx-1">Toyota</button>
      <button class="btn btn-outline-secondary shadow-sm mx-1">Mitsubishi</button>
    </div>
    <div>
      <select class="form-select shadow-sm" style="width: 200px; animation: slideIn 1s;">
        <option selected>Urutkan</option>
        <option value="1">Nama</option>
        <option value="2">Harga: Rendah ke Tinggi</option>
        <option value="3">Harga: Tinggi ke Rendah</option>
      </select>
    </div>
  </div>
  
  <!-- Daftar Mobil -->
  <div class="row g-4">
    <!-- Mobil 1 -->
    <div class="col-md-4" style="animation: zoomIn 1s;">
      <div class="card shadow-sm" style="border: 1px solid rgba(0, 0, 0, 0.1); border-radius: 15px; overflow: hidden; transition: transform 0.4s, box-shadow 0.4s;">
        <img src="img/honda-crv.jpg" class="card-img-top" alt="Honda CRV">
        <div class="card-body text-center">
          <p class="text-muted mb-2">
            <i class="fas fa-gas-pump me-1"></i> Bensin
            <i class="fas fa-user-friends ms-3 me-1"></i> 4 Seats
            <i class="fas fa-calendar-alt ms-3 me-1"></i> 2020 Model
            <i class="fas fa-cogs ms-3 me-1"></i> Manual
          </p>
          <h5 class="card-title fw-bold">Honda CRV</h5>
          <p class="text-muted">Rp 500.000,00/Hari</p>
          <a href="#" class="btn btn-warning w-100 shadow-sm">Rental</a>
        </div>
      </div>
    </div>
    <!-- Mobil 2 -->
    <div class="col-md-4" style="animation: zoomIn 1s 0.2s;">
      <div class="card shadow-sm" style="border: 1px solid rgba(0, 0, 0, 0.1); border-radius: 15px; overflow: hidden; transition: transform 0.4s, box-shadow 0.4s;">
        <img src="img/toyota-avanza.jpg" class="card-img-top" alt="Avanza Veloz">
        <div class="card-body text-center">
          <p class="text-muted mb-2">
            <i class="fas fa-gas-pump me-1"></i> Bensin
            <i class="fas fa-user-friends ms-3 me-1"></i> 4 Seats
            <i class="fas fa-calendar-alt ms-3 me-1"></i> 2019 Model
            <i class="fas fa-cogs ms-3 me-1"></i> Matic
          </p>
          <h5 class="card-title fw-bold">Avanza Veloz</h5>
          <p class="text-muted">Rp 500.000,00/Hari</p>
          <a href="#" class="btn btn-warning w-100 shadow-sm">Rental</a>
        </div>
      </div>
    </div>
    <!-- Mobil 3 -->
    <div class="col-md-4" style="animation: zoomIn 1s 0.4s;">
      <div class="card shadow-sm" style="border: 1px solid rgba(0, 0, 0, 0.1); border-radius: 15px; overflow: hidden; transition: transform 0.4s, box-shadow 0.4s;">
        <img src="img/mitsubishi-alphard.jpg" class="card-img-top" alt="Alphard">
        <div class="card-body text-center">
          <p class="text-muted mb-2">
            <i class="fas fa-gas-pump me-1"></i> Bensin
            <i class="fas fa-user-friends ms-3 me-1"></i> 4 Seats
            <i class="fas fa-calendar-alt ms-3 me-1"></i> 2020 Model
            <i class="fas fa-cogs ms-3 me-1"></i> Matic
          </p>
          <h5 class="card-title fw-bold">Alphard</h5>
          <p class="text-muted">Rp 900.000,00/Hari</p>
          <a href="#" class="btn btn-warning w-100 shadow-sm">Rental</a>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
/* Animasi */
@keyframes fadeUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes zoomIn {
  from {
    opacity: 0;
    transform: scale(0.8);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

@keyframes slideIn {
  from {
    opacity: 0;
    transform: translateX(50px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.card {
  border: 1px solid rgba(0, 0, 0, 0.1);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  border-radius: 15px;
  overflow: hidden;
  transition: transform 0.4s, box-shadow 0.4s;
}

.card:hover {
  transform: scale(1.1);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.btn {
  transition: background-color 0.3s, transform 0.3s;
}

.btn:hover {
  transform: translateY(-2px);
  background-color: #ffc107 !important;
}
</style>

<?php
require 'includes/footer.php'; // Menyisipkan Footer
?> 
