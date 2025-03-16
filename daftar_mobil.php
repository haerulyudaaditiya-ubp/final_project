<?php
require 'includes/header.php'; // Menyisipkan Header
require 'config/config.php'; // Koneksi database

// Inisialisasi variabel filter dan sortir
$filter_brand = isset($_GET['filter_brand']) ? $_GET['filter_brand'] : 'all';
$sort_option = isset($_GET['sort_option']) ? $_GET['sort_option'] : '';

// Ambil daftar merek mobil unik
$brand_query = "SELECT DISTINCT brand FROM cars";
$brand_result = mysqli_query($conn, $brand_query);

// Ambil data mobil
$sql = "
    SELECT 
        car_id, 
        model, 
        brand, 
        year, 
        transmission, 
        image, 
        price_24_hours, 
        status 
    FROM 
        cars
";

// Filter berdasarkan merek
if ($filter_brand !== 'all') {
    $sql .= " WHERE brand = '$filter_brand'";
}

// Sortir berdasarkan opsi yang dipilih
if ($sort_option === 'name') {
    $sql .= " ORDER BY model ASC";
} elseif ($sort_option === 'low_to_high') {
    $sql .= " ORDER BY price_24_hours ASC";
} elseif ($sort_option === 'high_to_low') {
    $sql .= " ORDER BY price_24_hours DESC";
}

// Eksekusi query
$result = mysqli_query($conn, $sql);
?>

<div class="container py-5">
  <h1 class="text-center fw-bold mb-4" style="animation: fadeUp 1s;">Daftar Mobil</h1>
  
  <!-- Filter dan Sortir -->
  <div class="d-flex flex-wrap justify-content-between align-items-center mb-4" style="animation: fadeUp 1s 0.2s;">
    <div>
      <form method="GET" class="d-flex align-items-center">
          <!-- Dropdown Filter Merek -->
          <select name="filter_brand" class="form-select shadow-sm me-2" style="width: 200px;" onchange="this.form.submit()">
              <option value="all" <?php echo $filter_brand === 'all' ? 'selected' : ''; ?>>Semua Mobil</option>
              <?php 
              if ($brand_result && mysqli_num_rows($brand_result) > 0) {
                  while ($brand_row = mysqli_fetch_assoc($brand_result)) {
                      $brand = $brand_row['brand'];
                      $selected = $filter_brand === $brand ? 'selected' : '';
                      echo "<option value='$brand' $selected>$brand</option>";
                  }
              }
              ?>
          </select>
          
          <!-- Dropdown Sortir -->
          <select name="sort_option" class="form-select shadow-sm" style="width: 200px;" onchange="this.form.submit()">
              <option value="" disabled <?php echo empty($sort_option) ? 'selected' : ''; ?>>Urutkan</option>
              <option value="name" <?php echo $sort_option === 'name' ? 'selected' : ''; ?>>Nama</option>
              <option value="low_to_high" <?php echo $sort_option === 'low_to_high' ? 'selected' : ''; ?>>Harga: Rendah ke Tinggi</option>
              <option value="high_to_low" <?php echo $sort_option === 'high_to_low' ? 'selected' : ''; ?>>Harga: Tinggi ke Rendah</option>
          </select>
      </form>
    </div>
  </div>
  
  <!-- Daftar Mobil -->
  <div class="row g-4">
    <?php 
    // Menampilkan data mobil dari database
    if (mysqli_num_rows($result) > 0) {
        $no = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $no++;
            $car_id = $row['car_id'];
            $model = $row['model'];
            $brand = $row['brand'];
            $year = $row['year'];
            $transmission = ucfirst($row['transmission']);
            $image = $row['image'];
            $price_24_hours = number_format($row['price_24_hours'], 2, ',', '.');
            $status = ucfirst($row['status']);

            // Penyesuaian warna status
            $status_badge = '';
            switch ($status) {
                case 'Tersedia':
                    $status_badge = '<span class="badge bg-success">Tersedia</span>';
                    break;
                case 'Dipesan':
                    $status_badge = '<span class="badge bg-warning">Dipesan</span>';
                    break;
                case 'Dalam_perawatan':
                    $status_badge = '<span class="badge bg-danger">Dalam Perawatan</span>';
                    break;
            }

            // Path gambar yang benar
            $image_path = "admin/uploads/" . htmlspecialchars($image);
            if (!file_exists($image_path) || empty($image)) {
                $image_path = "img/image_not_found.jpg"; // Gambar default jika gambar tidak ditemukan
            }
    ?>
    <!-- Mobil <?php echo $no; ?> -->
    <div class="col-md-4" style="animation: zoomIn 1s <?php echo 0.2 * $no; ?>s;">
      <div class="card shadow-sm" style="border: 1px solid rgba(0, 0, 0, 0.1); border-radius: 15px; overflow: hidden; transition: transform 0.4s, box-shadow 0.4s;">
        <img src="<?php echo $image_path; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($model); ?>">
        <div class="card-body text-center">
          <p class="text-muted mb-2">
            <i class="fas fa-car me-1"></i> <?php echo htmlspecialchars($brand); ?>
            <i class="fas fa-calendar-alt ms-3 me-1"></i> <?php echo htmlspecialchars($year); ?> Model
            <i class="fas fa-cogs ms-3 me-1"></i> <?php echo htmlspecialchars($transmission); ?>
          </p>
          <h5 class="card-title fw-bold"><?php echo htmlspecialchars($model); ?></h5>
          <p class="text-muted">Rp <?php echo $price_24_hours; ?>/24 Jam</p>
          <div class="mb-3"><?php echo $status_badge; ?></div>
          
          <?php if ($status === 'Tersedia') { ?>
            <a href="rental.php?id=<?php echo $car_id; ?>&filter_brand=<?php echo $filter_brand; ?>&sort_option=<?php echo $sort_option; ?>" 
              class="btn btn-warning w-100 shadow-sm">Rental</a>
          <?php } else { ?>
            <button class="btn btn-secondary w-100 shadow-sm" disabled><?php echo $status === 'Dipesan' ? 'Sedang Dipesan' : 'Dalam Perawatan'; ?></button>
          <?php } ?>
        </div>
      </div>
    </div>

    <?php
        }
    } else {
        // Menampilkan pesan jika tidak ada data
        echo "<div class='col-12 text-center'>
                <p class='text-muted'>Tidak ada data mobil yang tersedia.</p>
              </div>";
    }
    ?>
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

/* Memastikan gambar pada card memiliki ukuran konsisten */
.card-img-top {
  height: 200px;   /* Set height tetap untuk semua gambar */
  object-fit: cover; /* Pastikan gambar menyesuaikan ukuran dengan benar */
}

/* Menjaga konsistensi tinggi card body */
.card-body {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  min-height: 250px; /* Menjamin tinggi card-body tetap seragam */
}

/* Menambahkan jarak antar card */
.row.g-3 {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
}

/* Card hover effect */
.card {
  border: 1px solid rgba(0, 0, 0, 0.1);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  border-radius: 15px;
  overflow: hidden;
  transition: transform 0.4s, box-shadow 0.4s;
}

.card:hover {
  transform: scale(1.05);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

/* Tombol hover effect */
.btn {
  transition: background-color 0.3s, transform 0.3s;
}

.btn:hover {
  transform: translateY(-2px);
  background-color: #ffc107 !important;
}

/* Styling badge status */
.badge {
  padding: 5px 10px;
  font-size: 12px;
  border-radius: 5px;
}
</style>

<?php
require 'includes/footer.php'; // Menyisipkan Footer
?>