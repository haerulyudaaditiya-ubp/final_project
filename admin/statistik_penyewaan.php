<?php
include('../config/config.php');

/// Query untuk pendapatan terbesar beserta tanggal transaksi dengan status pembayaran 'paid'
$sql_largest_revenue = "
    SELECT SUM(p.gross_amount) AS daily_revenue, DATE(p.created_at) AS transaction_date 
    FROM payments p
    WHERE p.payment_status = 'paid'
    GROUP BY DATE(p.created_at)
    ORDER BY daily_revenue DESC
    LIMIT 1";
$result_largest_revenue = mysqli_query($conn, $sql_largest_revenue);

if ($row = mysqli_fetch_assoc($result_largest_revenue)) {
$largest_revenue = $row['daily_revenue'];
$largest_revenue_date = $row['transaction_date'];
}

// Query untuk pendapatan terkecil beserta tanggal transaksi dengan status pembayaran 'paid'Z
$sql_smallest_revenue = "
    SELECT SUM(p.gross_amount) AS daily_revenue, DATE(p.created_at) AS transaction_date 
    FROM payments p
    WHERE p.payment_status = 'paid'
    GROUP BY DATE(p.created_at)
    ORDER BY daily_revenue ASC
    LIMIT 1";
$result_smallest_revenue = mysqli_query($conn, $sql_smallest_revenue);

if ($row = mysqli_fetch_assoc($result_smallest_revenue)) {
    $smallest_revenue = $row['daily_revenue'];
    $smallest_revenue_date = $row['transaction_date'];
}

// Query untuk rata-rata durasi sewa dengan status pembayaran 'paid'
$sql_avg_rental_duration = "SELECT AVG(DATEDIFF(r.end_date, r.start_date)) AS avg_duration 
                            FROM rentals r
                            JOIN payments p ON r.order_id = p.order_id
                            WHERE p.payment_status = 'paid'";
$result_avg_rental_duration = mysqli_query($conn, $sql_avg_rental_duration);

if ($row = mysqli_fetch_assoc($result_avg_rental_duration)) {
    $average_rental_duration = $row['avg_duration'];
}

// Query untuk user dengan reservasi terbanyak dan status pembayaran 'paid'
$sql_top_user = "SELECT u.fullname, COUNT(r.order_id) AS total_reservations 
                 FROM users u
                 JOIN rentals r ON u.id = r.user_id
                 JOIN payments p ON r.order_id = p.order_id
                 WHERE p.payment_status = 'paid'
                 GROUP BY u.id
                 ORDER BY total_reservations DESC
                 LIMIT 1";
$result_top_user = mysqli_query($conn, $sql_top_user);

if ($row = mysqli_fetch_assoc($result_top_user)) {
    $top_user_name = $row['fullname'];
}
?>

<!-- HTML untuk menampilkan informasi -->
<div class="card-header">
  <h3 class="card-title">
    <i class="fas fa-info-circle mr-2"></i>
    Statistik Penyewaan
  </h3>
</div><!-- /.card-header -->

<div class="card-body">
  <div class="row">
    <div class="col-md-6">
      <div class="stat-box">
        <div class="stat-header">
          <i class="fas fa-arrow-up text-success"></i> Pendapatan Terbesar
        </div>
        <div class="stat-value">Rp<?php echo number_format($largest_revenue, 0, ',', '.'); ?></div>
        <div class="stat-date">Tanggal: <?php echo date("d-m-Y", strtotime($largest_revenue_date)); ?></div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="stat-box">
        <div class="stat-header">
          <i class="fas fa-arrow-down text-danger"></i> Pendapatan Terkecil
        </div>
        <div class="stat-value">Rp<?php echo number_format($smallest_revenue, 0, ',', '.'); ?></div>
        <div class="stat-date">Tanggal: <?php echo date("d-m-Y", strtotime($smallest_revenue_date)); ?></div>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-6">
      <div class="stat-box">
        <div class="stat-header">
          <i class="fas fa-clock text-primary"></i> Rata-rata Durasi Sewa
        </div>
        <div class="stat-value"><?php echo round($average_rental_duration, 2); ?> Hari</div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="stat-box">
        <div class="stat-header">
          <i class="fas fa-users text-warning"></i> User dengan Reservasi Terbanyak
        </div>
        <div class="stat-value"><?php echo $top_user_name; ?></div>
      </div>
    </div>
  </div>
</div><!-- /.card-body -->

<style>
/* Gaya untuk seluruh card */
.card {
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    background-color: #fff;
}

/* Gaya untuk header card */
.card-header {
    background-color: #f7f7f7;
    border-bottom: 1px solid #ddd;
    padding: 15px 20px;
    font-size: 18px;
    font-weight: bold;
}

/* Gaya untuk setiap statistik box */
.stat-box {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    background-color: #f9f9f9;
    margin-bottom: 20px;
    text-align: center;
    transition: all 0.3s ease;
    min-height: 150px; /* Tetapkan tinggi minimum yang sama */
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Agar konten terdistribusi dengan baik */
}

.stat-box:hover {
    background-color: #f0f0f0;
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
}

/* Gaya untuk judul statistik */
.stat-header {
    font-size: 14px;
    font-weight: 600;
    color: #333;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Gaya untuk nilai statistik */
.stat-value {
    font-size: 18px;
    font-weight: 700;
    color: #333;
    margin-top: 10px;
}

/* Gaya untuk tanggal transaksi */
.stat-date {
    font-size: 12px;
    color: #888;
    margin-top: 10px;
}

/* Menambahkan margin pada row untuk lebih rapi */
.row {
    margin-bottom: 15px;
}
</style>
