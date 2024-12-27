<?php
include("../config/config.php");

// Query untuk Transaksi Dibayar
$query_transaksi = mysqli_query($conn, "SELECT count(payment_id) AS jumlah_payment FROM payments WHERE payment_status = 'paid'"); 
$view_transaksi = mysqli_fetch_array($query_transaksi);

// Query untuk Konfirmasi Bayar
$query_perlu_konfirmasi = mysqli_query($conn, "SELECT count(payment_id) AS jumlah_perlu_konfirmasi FROM payments WHERE payment_status = 'verification'"); 
$view_perlu_konfirmasi = mysqli_fetch_array($query_perlu_konfirmasi);

// Query untuk Transaksi Dibatalkan
$query_transaksi_dibatalkan = mysqli_query($conn, "SELECT count(payment_id) AS jumlah_dibatalkan FROM payments WHERE payment_status = 'failed'"); 
$view_transaksi_dibatalkan = mysqli_fetch_array($query_transaksi_dibatalkan);

// Query untuk Perlu Konfirmasi Pengembalian Mobil
$query_konfirmasi_pengembalian = mysqli_query($conn, "SELECT count(payment_id) AS jumlah_konfirmasi_pengembalian FROM payments WHERE rental_status = 'active' AND payment_status = 'paid'"); 
$view_konfirmasi_pengembalian = mysqli_fetch_array($query_konfirmasi_pengembalian);

// Query untuk Total Mobil
$query_total_mobil = mysqli_query($conn, "SELECT count(car_id) AS total_mobil FROM cars"); 
$view_total_mobil = mysqli_fetch_array($query_total_mobil);

// Query untuk Total User
$query_total_user = mysqli_query($conn, "SELECT count(id) AS total_user FROM users"); 
$view_total_user = mysqli_fetch_array($query_total_user);

// Query untuk Mobil Dipesan
$query_mobil_dipesan = mysqli_query($conn, "SELECT count(car_id) AS jumlah_mobil_dipesan FROM cars WHERE status = 'dipesan'"); 
$view_mobil_dipesan = mysqli_fetch_array($query_mobil_dipesan);

// Query untuk Mobil Tersedia
$query_mobil_tersedia = mysqli_query($conn, "SELECT count(car_id) AS jumlah_mobil_tersedia FROM cars WHERE status = 'tersedia'"); 
$view_mobil_tersedia = mysqli_fetch_array($query_mobil_tersedia);

// Query untuk Mobil Dalam Perawatan
$query_mobil_perawatan = mysqli_query($conn, "SELECT count(car_id) AS jumlah_mobil_perawatan FROM cars WHERE status = 'dalam_perawatan'"); 
$view_mobil_perawatan = mysqli_fetch_array($query_mobil_perawatan);

// Query untuk User Aktif
$query_user_aktif = mysqli_query($conn, "SELECT count(id) AS jumlah_user_aktif FROM users WHERE status = 'aktif'"); 
$view_user_aktif = mysqli_fetch_array($query_user_aktif);

// Query untuk User Nonaktif
$query_user_nonaktif = mysqli_query($conn, "SELECT count(id) AS jumlah_user_nonaktif FROM users WHERE status = 'nonaktif'"); 
$view_user_nonaktif = mysqli_fetch_array($query_user_nonaktif);
?>

<!-- Menampilkan data dalam box -->

<div class="col-lg-3 col-6">
    <!-- small box Transaksi Dibayar -->
    <div class="small-box bg-info">
        <div class="inner">
            <h3><?php echo $view_transaksi['jumlah_payment']; ?></h3>
            <p>Transaksi Dibayar</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <!-- Link ke halaman daftar transaksi -->
        <a href="index.php?page=daftar-transaksi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">
    <!-- small box Konfirmasi Bayar -->
    <div class="small-box bg-warning">
        <div class="inner">
            <h3><?php echo $view_perlu_konfirmasi['jumlah_perlu_konfirmasi']; ?></h3>
            <p>Konfirmasi Bayar</p>
        </div>
        <div class="icon">
            <i class="fas fa-exclamation-circle"></i> <!-- Ikon untuk Konfirmasi Bayar -->
        </div>
        <!-- Link ke halaman konfirmasi pembayaran -->
        <a href="index.php?page=daftar-transaksi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-6">
    <!-- small box Transaksi Dibatalkan -->
    <div class="small-box bg-danger">
        <div class="inner">
            <h3><?php echo $view_transaksi_dibatalkan['jumlah_dibatalkan']; ?></h3>
            <p>Transaksi Dibatalkan</p>
        </div>
        <div class="icon">
            <i class="fas fa-times-circle"></i> <!-- Ikon untuk transaksi dibatalkan -->
        </div>
        <!-- Link ke halaman transaksi dibatalkan -->
        <a href="index.php?page=daftar-transaksi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">
    <!-- small box Konfirmasi Retur -->
    <div class="small-box bg-primary">
        <div class="inner">
            <h3><?php echo $view_konfirmasi_pengembalian['jumlah_konfirmasi_pengembalian']; ?></h3>
            <p>Konfirmasi Retur</p>
        </div>
        <div class="icon">
            <i class="fas fa-undo"></i> <!-- Ikon untuk pengembalian mobil -->
        </div>
        <!-- Link ke halaman konfirmasi pengembalian -->
        <a href="index.php?page=pengembalian" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">
    <!-- small box Total Mobil -->
    <div class="small-box bg-success">
        <div class="inner">
            <h3><?php echo $view_total_mobil['total_mobil']; ?></h3>
            <p>Total Mobil</p>
        </div>
        <div class="icon">
            <i class="fas fa-car"></i> <!-- Ikon untuk total mobil -->
        </div>
        <!-- Link ke halaman total mobil -->
        <a href="index.php?page=mobil" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">
    <!-- small box Mobil Dipesan -->
    <div class="small-box bg-warning">
        <div class="inner">
            <h3><?php echo $view_mobil_dipesan['jumlah_mobil_dipesan']; ?></h3>
            <p>Mobil Dipesan</p>
        </div>
        <div class="icon">
            <i class="fas fa-car"></i> <!-- Ikon untuk mobil dipesan -->
        </div>
        <!-- Link ke halaman mobil dipesan -->
        <a href="index.php?page=mobil" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">
    <!-- small box Mobil Tersedia -->
    <div class="small-box bg-success">
        <div class="inner">
            <h3><?php echo $view_mobil_tersedia['jumlah_mobil_tersedia']; ?></h3>
            <p>Mobil Tersedia</p>
        </div>
        <div class="icon">
            <i class="fas fa-car"></i> <!-- Ikon untuk mobil tersedia -->
        </div>
        <!-- Link ke halaman mobil tersedia -->
        <a href="index.php?page=mobil" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">
    <!-- small box Mobil Dalam Perawatan -->
    <div class="small-box bg-danger">
        <div class="inner">
            <h3><?php echo $view_mobil_perawatan['jumlah_mobil_perawatan']; ?></h3>
            <p>Mobil Dalam Perawatan</p>
        </div>
        <div class="icon">
            <i class="fas fa-cogs"></i> <!-- Ikon untuk mobil dalam perawatan -->
        </div>
        <!-- Link ke halaman mobil dalam perawatan -->
        <a href="index.php?page=mobil" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">
    <!-- small box Total User -->
    <div class="small-box bg-danger">
        <div class="inner">
            <h3><?php echo $view_total_user['total_user']; ?></h3>
            <p>Total User</p>
        </div>
        <div class="icon">
            <i class="ion ion-person"></i>
        </div>
        <!-- Link ke halaman total user -->
        <a href="index.php?page=list-user" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">
    <!-- small box User Aktif -->
    <div class="small-box bg-success">
        <div class="inner">
            <h3><?php echo $view_user_aktif['jumlah_user_aktif']; ?></h3>
            <p>User Aktif</p>
        </div>
        <div class="icon">
            <i class="fas fa-users"></i> <!-- Ikon untuk user aktif -->
        </div>
        <!-- Link ke halaman user aktif -->
        <a href="index.php?page=list-user" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">
    <!-- small box User Nonaktif -->
    <div class="small-box bg-warning">
        <div class="inner">
            <h3><?php echo $view_user_nonaktif['jumlah_user_nonaktif']; ?></h3>
            <p>User Nonaktif</p>
        </div>
        <div class="icon">
            <i class="fas fa-user-slash"></i> <!-- Ikon untuk user nonaktif -->
        </div>
        <!-- Link ke halaman user nonaktif -->
        <a href="index.php?page=list-user" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
