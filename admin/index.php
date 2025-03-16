<?php
session_start();

if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'user') {
  // Redirect ke halaman dashboard admin atau halaman lain
  header("Location: ../index.php");
  exit();
}

// Mengecek apakah pengguna sudah login dan apakah mereka adalah admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
  // Jika belum login atau bukan admin, arahkan ke halaman login
  header("Location: ../forms/login.php");
  exit(); // Menghentikan eksekusi lebih lanjut setelah pengalihan
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include('header.php'); ?>
<?php include('../config/config.php'); ?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


  <!-- Navbar -->
  <?php include('navbar.php'); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <?php include('logo.php'); ?>

    <!-- Sidebar -->
    <?php include('sidebar.php'); ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php include('content_header.php'); ?>
    <!-- /.content-header -->

    <!-- Main content -->
    <?php
    if (isset($_GET['page'])){
      if($_GET['page']=='dashboard'){
        include('dashboard.php');
      }
      else if($_GET['page']=='list-user'){
        include('list_user.php');
      }
      else if($_GET['page']=='mobil'){
        include('mobil.php');
      }
      else if($_GET['page']=='daftar-transaksi'){
        include('daftar_transaksi.php');
      }
      else if($_GET['page']=='pengembalian'){
        include('pengembalian.php');
      }
      else if($_GET['page']=='edit-mobil'){
        include('edit/edit_mobil.php');
      }
      else if($_GET['page']=='detail-transaksi'){
        include('view/detail_transaksi.php');
      }
      else if($_GET['page']=='detail-pengembalian'){
        include('view/detail_pengembalian.php');
      }
      else if($_GET['page']=='detail-laporan'){
        include('view/detail_laporan.php');
      }
      else if($_GET['page']=='tambah-mobil'){
        include('add/tambah_mobil.php');
      }
      else if($_GET['page']=='laporan'){
        include('laporan.php');
      }
      else{
        include('not_found.php');
      }
    }
    else{
      include('dashboard.php');
    }?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include('footer.php'); ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

</body>
</html>
