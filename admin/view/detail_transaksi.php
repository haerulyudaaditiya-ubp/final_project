<?php
// Memeriksa apakah ada parameter 'orderid' dalam URL
if (isset($_GET['orderid'])) {
    $orderid = $_GET['orderid']; // Menangkap order_id dari URL
    
    // Query untuk mengambil detail transaksi berdasarkan order_id
    $sql = "SELECT p.order_id, p.payment_type, p.gross_amount, p.payment_status, p.created_at, 
                   u.fullname AS customer_name, u.phone AS customer_phone, u.email AS customer_email, u.address AS customer_address,
                   r.car_id, r.start_date, r.end_date, c.model, c.brand, c.year
            FROM payments p
            JOIN rentals r ON p.order_id = r.order_id
            JOIN users u ON r.user_id = u.id
            JOIN cars c ON r.car_id = c.car_id
            WHERE p.order_id = '$orderid'"; // Filter berdasarkan order_id
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // Menampilkan detail transaksi
?>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Detail Transaksi #<?php echo $row['order_id']; ?></h3>
          </div>
          <div class="card-body">
            <div class="row">
              <!-- Kolom 1: Informasi Umum Transaksi -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="order_id">Order ID:</label>
                  <p><?php echo $row['order_id']; ?></p>
                </div>
                <div class="form-group">
                  <label for="customer_name">Nama Penyewa:</label>
                  <p><?php echo $row['customer_name']; ?></p>
                </div>
                <!-- Menambahkan informasi kontak -->
                <div class="form-group">
                  <label for="customer_phone">No HP:</label>
                  <p><?php echo $row['customer_phone']; ?></p>
                </div>
                <div class="form-group">
                  <label for="customer_email">Email:</label>
                  <p><?php echo $row['customer_email']; ?></p>
                </div>
                <div class="form-group">
                  <label for="customer_address">Alamat:</label>
                  <p><?php echo $row['customer_address']; ?></p>
                </div>
                <div class="form-group">
                  <label for="payment_type">Tipe Pembayaran:</label>
                  <p><?php echo ucfirst($row['payment_type']); ?></p>
                </div>
              </div>
              
              <!-- Kolom 2: Informasi Sewa Mobil -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="payment_status">Status Pembayaran:</label>
                  <p>
                    <?php
                    // Menentukan badge status pembayaran dengan class unik
                    if ($row['payment_status'] == 'paid') {
                        echo '<span class="badge badge-success">Paid</span>';
                    } elseif ($row['payment_status'] == 'failed') {
                        echo '<span class="badge badge-danger">Failed</span>';
                    } elseif ($row['payment_status'] == 'pending') {
                        echo '<span class="badge badge-warning">Pending</span>';
                    }
                    ?>
                  </p>
                </div>
                <div class="form-group">
                  <label for="created_at">Tanggal & Waktu Transaksi:</label>
                  <p><?php echo date('d-m-Y H:i:s', strtotime($row['created_at'])); ?></p>
                </div>
                <div class="form-group">
                  <label for="car">Mobil yang Disewa:</label>
                  <p><?php echo $row['brand'] . ' ' . $row['model'] . ' (' . $row['year'] . ')'; ?></p>
                </div>
                <div class="form-group">
                  <label for="rental_period">Periode Sewa:</label>
                  <p><?php echo date('d-m-Y', strtotime($row['start_date'])) . ' sampai ' . date('d-m-Y', strtotime($row['end_date'])); ?></p>
                </div>
                <div class="form-group">
                  <label for="gross_amount">Total Pembayaran:</label>
                  <p><strong>Rp <?php echo number_format($row['gross_amount'], 0, ',', '.'); ?></p>
                </div>
              </div>
            </div>

            <!-- Tombol Kembali ke Daftar -->
            <div class="d-flex justify-content-end mt-4">
              <a href="index.php?page=daftar-transaksi" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Transaksi
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
    } else {
        echo '<div class="alert alert-danger">Transaksi tidak ditemukan.</div>';
    }
} else {
    echo '<div class="alert alert-warning">Order ID tidak ditemukan.</div>';
}
?>
