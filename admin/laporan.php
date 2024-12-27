<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Laporan</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <?php 
              // Inisialisasi variabel total pendapatan dan filter bulan & tahun
              $total_income = 0; 
              $month_filter = isset($_POST['month']) ? $_POST['month'] : '';
              $year_filter = isset($_POST['year']) ? $_POST['year'] : '';

              // Menambahkan filter bulan dan tahun pada query
              $sql_filter = "";
              if ($month_filter != '' && $year_filter != '') {
                $sql_filter = " AND MONTH(p.created_at) = '$month_filter' AND YEAR(p.created_at) = '$year_filter'";
              } elseif ($month_filter != '') {
                $sql_filter = " AND MONTH(p.created_at) = '$month_filter'";
              } elseif ($year_filter != '') {
                $sql_filter = " AND YEAR(p.created_at) = '$year_filter'";
              }

              $sql = "SELECT 
                          p.order_id, 
                          CONCAT(c.brand, ' ', c.model, ' ', c.year) AS car_name, 
                          r.start_date, 
                          r.end_date, 
                          p.gross_amount, 
                          p.payment_status, 
                          p.created_at, 
                          u.fullname AS customer_name
                      FROM payments p
                      JOIN rentals r ON p.order_id = r.order_id
                      JOIN users u ON r.user_id = u.id
                      JOIN cars c ON r.car_id = c.car_id
                      WHERE p.payment_status = 'paid' $sql_filter
                      ORDER BY p.created_at DESC";
              $result = mysqli_query($conn, $sql);

              // Hitung total pendapatan di luar loop
              while($row = mysqli_fetch_assoc($result)) {
                $total_income += $row['gross_amount']; // Menambahkan gross_amount ke total pendapatan
              }
            ?>

            <!-- Menampilkan total akumulasi di luar tabel -->
            <div class="total-accumulated">
              <h5>Total Akumulasi Pendapatan:</h5>
              <p>Rp<?php echo number_format($total_income, 0, ',', '.'); ?></p>
            </div>
            
            <!-- Form Filter Bulan dan Tahun -->
            <form method="POST" action="">
              <div class="form-group row">
                <div class="col-md-4">
                  <label for="month">Pilih Bulan:</label>
                  <select name="month" id="month" class="form-control">
                    <option value="">Semua Bulan</option>
                    <option value="1" <?php if ($month_filter == '1') echo 'selected'; ?>>Januari</option>
                    <option value="2" <?php if ($month_filter == '2') echo 'selected'; ?>>Februari</option>
                    <option value="3" <?php if ($month_filter == '3') echo 'selected'; ?>>Maret</option>
                    <option value="4" <?php if ($month_filter == '4') echo 'selected'; ?>>April</option>
                    <option value="5" <?php if ($month_filter == '5') echo 'selected'; ?>>Mei</option>
                    <option value="6" <?php if ($month_filter == '6') echo 'selected'; ?>>Juni</option>
                    <option value="7" <?php if ($month_filter == '7') echo 'selected'; ?>>Juli</option>
                    <option value="8" <?php if ($month_filter == '8') echo 'selected'; ?>>Agustus</option>
                    <option value="9" <?php if ($month_filter == '9') echo 'selected'; ?>>September</option>
                    <option value="10" <?php if ($month_filter == '10') echo 'selected'; ?>>Oktober</option>
                    <option value="11" <?php if ($month_filter == '11') echo 'selected'; ?>>November</option>
                    <option value="12" <?php if ($month_filter == '12') echo 'selected'; ?>>Desember</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="year">Pilih Tahun:</label>
                  <select name="year" id="year" class="form-control">
                    <option value="">Semua Tahun</option>
                    <?php
                      // Menampilkan tahun yang tersedia berdasarkan data transaksi
                      $sql_year = "SELECT DISTINCT YEAR(p.created_at) AS year FROM payments p ORDER BY year DESC";
                      $year_result = mysqli_query($conn, $sql_year);
                      while ($year_row = mysqli_fetch_assoc($year_result)) {
                        $selected = ($year_filter == $year_row['year']) ? 'selected' : '';
                        echo "<option value='{$year_row['year']}' $selected>{$year_row['year']}</option>";
                      }
                    ?>
                  </select>
                </div>

                <div class="col-md-4">
                  <label>&nbsp;</label><br>
                  <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                </div>
              </div>
            </form>

            <!-- Menampilkan Data dalam Tabel -->
            <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th style="width: 5%;">No</th>
              <th style="width: 15%;">Tanggal & Waktu</th>
              <th style="width: 15%;">Order ID</th>
              <th style="width: 25%;">Nama Penyewa</th>
              <th style="width: 20%;">Nama Mobil</th>
              <th style="width: 10%;">Tanggal Mulai</th>
              <th style="width: 10%;">Tanggal Selesai</th>
              <th style="width: 15%;">Total</th>
              <th style="width: 10%;" class="no-print">Aksi</th>
            </tr>
            
            </thead>
            <tbody>
              <?php 
              $no = 0;
              mysqli_data_seek($result, 0); // Mengulang data result untuk digunakan kembali setelah perhitungan total_income
              while($row = mysqli_fetch_assoc($result)) {
                $no++;
              ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo date('d-m-Y H:i:s', strtotime($row['created_at'])); ?></td>
                <td><?php echo $row['order_id']; ?></td>
                <td><?php echo $row['customer_name']; ?></td>
                <td><?php echo $row['car_name']; ?></td>
                <td><?php echo date('d-m-Y', strtotime($row['start_date'])); ?></td>
                <td><?php echo date('d-m-Y', strtotime($row['end_date'])); ?></td>
                <td>
                  <span class="total-amount">+Rp<?php echo number_format($row['gross_amount'], 0, ',', '.'); ?></span>
                </td>
                <td class="no-print">
                  <a href="index.php?page=detail-laporan&orderid=<?php echo $row['order_id']; ?>" class="btn btn-info btn-sm">
                    <i class="fas fa-info-circle"></i></a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>

<!-- Menambahkan CSS untuk badge dengan desain yang lebih baik -->
<style>
  /* Badge untuk status pembayaran */
  .badge-status {
  padding: 4px 10px;
  border-radius: 6px; /* Mengurangi radius agar lebih sedikit rounded */
  font-weight: 600;
  text-transform: capitalize;
  display: inline-block;
  transition: all 0.3s ease;
  font-size: 14px; /* Ukuran font lebih kecil */
  }

  /* Badge untuk status 'Paid' */
  .badge-status.paid {
  background-color: #28a745; /* Hijau */
  color: white;
  }

  /* Badge untuk status 'Failed' */
  .badge-status.failed {
  background-color: #dc3545; /* Merah */
  color: white;
  }

  /* Badge untuk status 'Pending' */
  .badge-status.pending {
  background-color: #ffc107; /* Kuning */
  color: black;
  }

  /* CSS untuk styling jumlah total yang memiliki tanda "+" dan warna hijau */
  .total-amount {
    color: #28a745; /* Warna hijau untuk nominal */
    font-weight: bold;
    font-size: 16px;
  }

  /* Styling untuk menampilkan total akumulasi di luar tabel */
  .total-accumulated {
    margin-bottom: 10px;
    padding: 10px;
    background-color: #f8f9fa;
    border-radius: 5px;
    font-size: 18px;
    font-weight: bold;
  }

  /* CSS untuk form filter bulan dan tahun */
  form .form-group {
    margin-bottom: 20px;
  }
  
  form select, form button {
    display: inline-block;
    width: auto;
  }

  /* Styling untuk form filter */
  .form-control {
    width: 100%;
  }

  /* Styling untuk tombol filter */
  .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
  }

  .btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
  }
  /* Menggunakan FontAwesome Icons */
  .btn i {
    font-size: 18px;
  }

</style>
