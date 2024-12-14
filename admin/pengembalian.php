<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar Pengembalian</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <!-- Form Filter Bulan dan Tahun -->
            <form method="POST" action="">
              <div class="form-group row">
                <div class="col-md-4">
                  <label for="month">Pilih Bulan:</label>
                  <select name="month" id="month" class="form-control">
                    <option value="">Semua Bulan</option>
                    <option value="1" <?php if (isset($_POST['month']) && $_POST['month'] == '1') echo 'selected'; ?>>Januari</option>
                    <option value="2" <?php if (isset($_POST['month']) && $_POST['month'] == '2') echo 'selected'; ?>>Februari</option>
                    <option value="3" <?php if (isset($_POST['month']) && $_POST['month'] == '3') echo 'selected'; ?>>Maret</option>
                    <option value="4" <?php if (isset($_POST['month']) && $_POST['month'] == '4') echo 'selected'; ?>>April</option>
                    <option value="5" <?php if (isset($_POST['month']) && $_POST['month'] == '5') echo 'selected'; ?>>Mei</option>
                    <option value="6" <?php if (isset($_POST['month']) && $_POST['month'] == '6') echo 'selected'; ?>>Juni</option>
                    <option value="7" <?php if (isset($_POST['month']) && $_POST['month'] == '7') echo 'selected'; ?>>Juli</option>
                    <option value="8" <?php if (isset($_POST['month']) && $_POST['month'] == '8') echo 'selected'; ?>>Agustus</option>
                    <option value="9" <?php if (isset($_POST['month']) && $_POST['month'] == '9') echo 'selected'; ?>>September</option>
                    <option value="10" <?php if (isset($_POST['month']) && $_POST['month'] == '10') echo 'selected'; ?>>Oktober</option>
                    <option value="11" <?php if (isset($_POST['month']) && $_POST['month'] == '11') echo 'selected'; ?>>November</option>
                    <option value="12" <?php if (isset($_POST['month']) && $_POST['month'] == '12') echo 'selected'; ?>>Desember</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="year">Pilih Tahun:</label>
                  <select name="year" id="year" class="form-control">
                    <option value="">Semua Tahun</option>
                    <?php
                      // Menampilkan tahun yang tersedia berdasarkan data transaksi
                      $sql_year = "SELECT DISTINCT YEAR(r.start_date) AS year FROM rentals r ORDER BY year DESC";
                      $year_result = mysqli_query($conn, $sql_year);
                      while ($year_row = mysqli_fetch_assoc($year_result)) {
                        $selected = (isset($_POST['year']) && $_POST['year'] == $year_row['year']) ? 'selected' : '';
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
                  <th style="width: 15%;">Order ID</th>
                  <th style="width: 20%;">Nama Mobil</th>
                  <th style="width: 15%;">Tanggal Mulai</th>
                  <th style="width: 15%;">Tanggal Selesai</th>
                  <th style="width: 10%;">Total</th>
                  <th style="width: 20%;">Nama Penyewa</th>
                  <th style="width: 10%;">Status</th>
                  <th style="width: 10%;" class="no-print">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 0;
                // Ambil data bulan dan tahun yang dipilih
                $month_filter = isset($_POST['month']) ? $_POST['month'] : '';
                $year_filter = isset($_POST['year']) ? $_POST['year'] : '';

                // Menambahkan filter bulan dan tahun pada query
                $sql_filter = "";
                if ($month_filter != '' && $year_filter != '') {
                  $sql_filter = " AND MONTH(r.start_date) = '$month_filter' AND YEAR(r.start_date) = '$year_filter'";
                } elseif ($month_filter != '') {
                  $sql_filter = " AND MONTH(r.start_date) = '$month_filter'";
                } elseif ($year_filter != '') {
                  $sql_filter = " AND YEAR(r.start_date) = '$year_filter'";
                }

                // Query untuk mengambil data transaksi dari tabel payments, rentals, users, dan cars
                $sql = "SELECT p.order_id, 
                               CONCAT(c.brand, ' ', c.model, ' ', c.year) AS car_name, 
                               r.start_date, 
                               r.end_date, 
                               p.gross_amount, 
                               p.payment_status, 
                               u.fullname AS customer_name,
                               c.car_id, c.status
                        FROM payments p
                        JOIN rentals r ON p.order_id = r.order_id
                        JOIN users u ON r.user_id = u.id
                        JOIN cars c ON r.car_id = c.car_id
                        WHERE 1=1 $sql_filter
                        ORDER BY r.start_date DESC"; // Urutkan berdasarkan tanggal mulai
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)){
                  $no++;
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row['order_id']; ?></td>
                  <td><?php echo $row['car_name']; ?></td> <!-- Menampilkan Nama Mobil -->
                  <td><?php echo date('d-m-Y', strtotime($row['start_date'])); ?></td>
                  <td><?php echo date('d-m-Y', strtotime($row['end_date'])); ?></td>
                  <td>Rp<?php echo number_format($row['gross_amount'], 0, ',', '.'); ?></td>
                  <td><?php echo $row['customer_name']; ?></td>
                  <td>
                  <?php
                  // Menggunakan DateTime untuk perbandingan tanggal
                  $current_date = new DateTime();
                  $end_date = new DateTime($row['end_date']);
                  $start_date = new DateTime($row['start_date']);

                  // Pastikan hanya perbandingan tanggal (tanpa waktu)
                  $current_date_only = $current_date->format('Y-m-d');
                  $end_date_only = $end_date->format('Y-m-d');

                  // Menentukan status penyewaan
                  if ($end_date_only < $current_date_only) {
                      // Jika tanggal selesai sudah lewat, tampilkan status "Penyewaan Selesai"
                      echo '<span class="badge-status badge-success">Penyewaan Selesai</span>';

                      // Tambahkan satu hari untuk masa maintenance
                      $maintenance_start_date = (clone $end_date)->modify('+1 day');
                      $maintenance_end_date = (clone $maintenance_start_date)->format('Y-m-d');

                      // Mengecek apakah masa perawatan sudah selesai
                      if ($current_date_only > $maintenance_end_date) {
                          // Jika masa perawatan sudah selesai dan status bukan "dipesan", update status mobil menjadi 'tersedia'
                          if ($row['status'] != 'dipesan' && $row['status'] != 'tersedia') {
                              // Hanya perbarui status jika tidak dalam status 'dipesan' atau 'tersedia'
                              $update_car_status = "UPDATE cars SET status = 'tersedia' WHERE car_id = " . $row['car_id'];
                              mysqli_query($conn, $update_car_status);
                          }
                      } else {
                          // Jika masih dalam masa perawatan, update status mobil menjadi 'dalam_perawatan' jika status belum 'dalam_perawatan'
                          if ($row['status'] != 'dalam_perawatan') {
                              // Hanya perbarui status jika belum dalam status 'dalam_perawatan'
                              $update_car_status = "UPDATE cars SET status = 'dalam_perawatan' WHERE car_id = " . $row['car_id'];
                              mysqli_query($conn, $update_car_status);
                          }
                      }
                  } else {
                      // Jika tanggal selesai belum lewat, status masih dalam masa penyewaan
                      if ($row['status'] != 'dipesan') {
                          // Hanya perbarui status jika berbeda dari 'dipesan'
                          $update_car_status = "UPDATE cars SET status = 'dipesan' WHERE car_id = " . $row['car_id'];
                          mysqli_query($conn, $update_car_status);
                      }
                      echo '<span class="badge-status badge-warning">Dipesan</span>';
                  }
                  ?>
                  </td>
                  <td class="no-print">
                    <a href="index.php?page=detail-pengembalian&orderid=<?php echo $row['order_id']; ?>" class="btn btn-info btn-sm">Detail</a>
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
  /* Badge untuk status penyewaan */
  .badge-status {
    padding: 4px 10px;
    border-radius: 6px; /* Mengurangi radius agar lebih sedikit rounded */
    font-weight: 600;
    text-transform: capitalize;
    display: inline-block;
    transition: all 0.3s ease;
    font-size: 14px; /* Ukuran font lebih kecil */
  }

  /* Badge untuk status "Sedang Disewa" */
  .badge-status.badge-warning {
    background-color: #ffc107; /* Kuning */
    color: black;
  }

  /* Badge untuk status "Penyewaan Selesai" */
  .badge-status.badge-success {
    background-color: #28a745; /* Hijau */
    color: white;
  }
</style>
