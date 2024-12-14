<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar Transaksi</h3>
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
                      $sql_year = "SELECT DISTINCT YEAR(p.created_at) AS year FROM payments p ORDER BY year DESC";
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
                  <th style="width: 15%;">Tanggal & Waktu</th>
                  <th style="width: 15%;">Order ID</th>
                  <th style="width: 15%;">Tipe Pembayaran</th>
                  <th style="width: 10%;">Total</th>
                  <th style="width: 10%;">Status</th>
                  <th style="width: 20%;">Nama Penyewa</th>
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
                  $sql_filter = " AND MONTH(p.created_at) = '$month_filter' AND YEAR(p.created_at) = '$year_filter'";
                } elseif ($month_filter != '') {
                  $sql_filter = " AND MONTH(p.created_at) = '$month_filter'";
                } elseif ($year_filter != '') {
                  $sql_filter = " AND YEAR(p.created_at) = '$year_filter'";
                }

                // Query untuk mengambil data transaksi dari tabel payments, rentals, dan users
                $sql = "SELECT p.order_id, p.payment_type, p.gross_amount, p.payment_status, p.created_at, u.fullname AS customer_name
                        FROM payments p
                        JOIN rentals r ON p.order_id = r.order_id
                        JOIN users u ON r.user_id = u.id
                        WHERE 1=1 $sql_filter
                        ORDER BY p.created_at DESC"; // Urutkan berdasarkan tanggal terbaru
                $result = mysqli_query($conn, $sql);

                while($row = mysqli_fetch_assoc($result)){
                  $no++;
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo date('d-m-Y H:i:s', strtotime($row['created_at'])); ?></td>
                  <td><?php echo $row['order_id']; ?></td>
                  <td><?php echo ucfirst($row['payment_type']); ?></td>
                  <td>Rp<?php echo number_format($row['gross_amount'], 0, ',', '.'); ?></td>
                  <td>
                    <?php
                      // Menentukan badge status pembayaran dengan class unik
                      if ($row['payment_status'] == 'paid') {
                          echo '<span class="badge-status paid">Paid</span>';
                      } elseif ($row['payment_status'] == 'failed') {
                          echo '<span class="badge-status failed">Failed</span>';
                      } elseif ($row['payment_status'] == 'pending') {
                          echo '<span class="badge-status pending">Pending</span>';
                      }
                    ?>
                  </td>
                  <td><?php echo $row['customer_name']; ?></td>
                  <td class="no-print">
                    <a href="index.php?page=detail-transaksi&orderid=<?php echo $row['order_id']; ?>" class="btn btn-info btn-sm">Detail</a>
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
</style>
