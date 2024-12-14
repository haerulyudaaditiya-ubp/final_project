<?php
// Validasi dan atur default untuk parameter $_GET['page']
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard'; // Default ke 'dashboard' jika page tidak didefinisikan
?>
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Dashboard -->
    <li class="nav-item">
      <a href="index.php?page=dashboard" class="nav-link <?php echo ($page === 'dashboard') ? 'active' : ''; ?>">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
      </a>
    </li>

    <!-- Sewa -->
    <li class="nav-item <?php echo (in_array($page, ['daftar-transaksi', 'pengembalian'])) ? 'menu-open' : ''; ?>">
      <a href="#" class="nav-link <?php echo (in_array($page, ['daftar-transaksi', 'pengembalian'])) ? 'active' : ''; ?>">
        <i class="nav-icon fas fa-shopping-cart"></i>
        <p>
          Sewa
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="index.php?page=daftar-transaksi" class="nav-link <?php echo ($page === 'daftar-transaksi') ? 'active' : ''; ?>">
            <i class="far fa-circle nav-icon"></i>
            <p>Daftar Transaksi</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?page=pengembalian" class="nav-link <?php echo ($page === 'pengembalian') ? 'active' : ''; ?>">
            <i class="far fa-circle nav-icon"></i>
            <p>Daftar Pengembalian</p>
          </a>
        </li>
      </ul>
    </li>

    <!-- Mobil -->
    <li class="nav-item">
      <a href="index.php?page=mobil" class="nav-link <?php echo ($page === 'mobil') ? 'active' : ''; ?>">
        <i class="nav-icon fas fa-car"></i>
        <p>Mobil</p>
      </a>
    </li>

    <!-- User -->
    <li class="nav-item">
      <a href="index.php?page=list-user" class="nav-link <?php echo ($page === 'list-user') ? 'active' : ''; ?>">
        <i class="nav-icon fas fa-users"></i>
        <p>User</p>
      </a>
    </li>

    <!-- User -->
    <li class="nav-item">
      <a href="index.php?page=laporan" class="nav-link <?php echo ($page === 'laporan') ? 'active' : ''; ?>">
        <i class="nav-icon fas fa-chart-line"></i>
        <p>Laporan</p>
      </a>
    </li>

    <!-- Logout -->
    <li class="nav-item">
      <a href="logout.php" class="nav-link text-red">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>Logout</p>
      </a>
    </li>
  </ul>
</nav>
