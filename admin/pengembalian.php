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
                      include 'config/database.php';

                      $sql_year = "SELECT DISTINCT YEAR(r.start_date) AS year FROM rentals r ORDER BY year DESC";
                      $year_result = mysqli_query($conn, $sql_year);
                      if ($year_result) {
                        while ($year_row = mysqli_fetch_assoc($year_result)) {
                          $selected = (isset($_POST['year']) && $_POST['year'] == $year_row['year']) ? 'selected' : '';
                          echo "<option value='{$year_row['year']}' $selected>{$year_row['year']}</option>";
                        }
                      } else {
                        echo "<option value=''>Error: " . mysqli_error($conn) . "</option>";
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
                  <th style="width: 15%;">Nama Mobil</th>
                  <th style="width: 10%;">Tanggal Mulai</th>
                  <th style="width: 10%;">Tanggal Selesai</th>
                  <th style="width: 10%;">Total</th>
                  <th style="width: 15%;">Nama Penyewa</th>
                  <th style="width: 10%;">Status Penyewaan</th>
                  <th style="width: 30%;" class="no-print">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 0;
                $month_filter = isset($_POST['month']) ? $_POST['month'] : '';
                $year_filter = isset($_POST['year']) ? $_POST['year'] : '';

                $sql_filter = "";
                if ($month_filter != '' && $year_filter != '') {
                  $sql_filter = " AND MONTH(r.start_date) = '$month_filter' AND YEAR(r.start_date) = '$year_filter'";
                } elseif ($month_filter != '') {
                  $sql_filter = " AND MONTH(r.start_date) = '$month_filter'";
                } elseif ($year_filter != '') {
                  $sql_filter = " AND YEAR(r.start_date) = '$year_filter'";
                }

                $sql = "SELECT p.order_id, 
                        CONCAT(c.brand, ' ', c.model, ' ', c.year) AS car_name, 
                        r.start_date, 
                        r.end_date, 
                        p.gross_amount, 
                        p.payment_status, 
                        p.rental_status, 
                        u.fullname AS customer_name,
                        c.car_id, c.status
                FROM payments p
                JOIN rentals r ON p.order_id = r.order_id
                JOIN users u ON r.user_id = u.id
                JOIN cars c ON r.car_id = c.car_id
                WHERE p.payment_status = 'paid' $sql_filter
                ORDER BY 
                    CASE 
                        WHEN p.rental_status = 'active' THEN 1 
                        ELSE 2 
                    END, 
                    p.created_at DESC"; // Mengurutkan berdasarkan tanggal terbaru setelah status pengembalian

                $result = mysqli_query($conn, $sql);
                if ($result) {
                  while($row = mysqli_fetch_assoc($result)){
                    $no++;
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row['order_id']; ?></td>
                  <td><?php echo $row['car_name']; ?></td>
                  <td><?php echo date('d-m-Y', strtotime($row['start_date'])); ?></td>
                  <td><?php echo date('d-m-Y', strtotime($row['end_date'])); ?></td>
                  <td>Rp<?php echo number_format($row['gross_amount'], 0, ',', '.'); ?></td>
                  <td><?php echo $row['customer_name']; ?></td>
                  <td>
                    <?php 
                      if ($row['rental_status'] == 'completed') {
                        echo '<span class="badge-status badge-success">Penyewaan Selesai</span>';
                      } elseif ($row['rental_status'] == 'active') {
                        echo '<span class="badge-status badge-warning">Sedang Disewa</span>';
                      } elseif ($row['rental_status'] == 'cancelled') {
                        echo '<span class="badge-status badge-danger">Dibatalkan</span>';
                      }
                    ?>
                  </td>
                  <td class="no-print">
                    <?php if ($row['rental_status'] == 'active') { ?>
                      <a onclick="konfirmasiPengembalian('<?php echo htmlspecialchars($row['order_id']); ?>')" class="btn btn-success btn-sm">
                        <i class="fas fa-check-circle"></i>
                      </a>
                    <?php } ?>
                    <a href="index.php?page=detail-pengembalian&orderid=<?php echo $row['order_id']; ?>" class="btn btn-info btn-sm">
                      <i class="fas fa-info-circle"></i>
                    </a>
                  </td>
                </tr>
                <?php }} else { ?>
                <tr>
                  <td colspan="9" class="text-center">Data tidak ditemukan. Error: <?php echo mysqli_error($conn); ?></td>
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

<script>
    function konfirmasiPengembalian(order_id) {
      Swal.fire({
          title: "Apakah Anda Yakin?",
          text: "Konfirmasi pengembalian mobil untuk transaksi ini.",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, konfirmasi!"
      }).then((result) => {
          if (result.isConfirmed) {
            window.location = "update/konfirmasi_pengembalian.php?orderid=" + order_id;
          }
      });
    }
</script>

<style>
  .badge-status {
    padding: 4px 8px;
    border-radius: 6px;
    font-weight: 600;
    text-transform: capitalize;
    display: inline-block;
    transition: all 0.3s ease;
    font-size: 14px;
  }
  .badge-status.badge-warning {
    background-color: #ffc107;
    color: black;
  }
  .badge-status.badge-success {
    background-color: #28a745;
    color: white;
  }
  .badge-status.badge-danger {
    background-color: #dc3545;
    color: white;
  }
  .btn i {
    font-size: 18px;
  }
</style>
