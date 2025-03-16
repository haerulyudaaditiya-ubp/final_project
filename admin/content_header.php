<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">
          <?php
            // Memeriksa nilai parameter 'page' untuk menentukan judul
            if (isset($_GET['page'])) {
                switch ($_GET['page']) {
                    case 'dashboard':
                        echo 'Dashboard';
                        break;
                    case 'list-user':
                        echo 'List User';
                        break;
                    case 'mobil':
                        echo 'Data Mobil';
                        break;
                    case 'daftar-transaksi':
                        echo 'Daftar Transaksi';
                        break;
                    case 'pengembalian':
                        echo 'Daftar Pengembalian';
                        break;
                    case 'edit-mobil':
                        echo 'Edit Mobil';
                        break;
                    case 'detail-transaksi':
                        echo 'Detail Transaksi';
                        break;
                    case 'detail-pengembalian':
                        echo 'Detail Pengembalian';
                        break;
                    case 'detail-laporan':
                        echo 'Detail Laporan';
                        break;
                    case 'tambah-mobil':
                        echo 'Tambah Mobil';
                        break;
                    case 'laporan':
                        echo 'Laporan';
                        break;
                    default:
                        echo 'Halaman Tidak Ditemukan';
                        break;
                }
            } else {
                echo 'Dashboard';  // Default jika tidak ada parameter 'page'
            }
          ?>
        </h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
