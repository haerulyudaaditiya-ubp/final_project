<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Mobil</h3>
            <a href="index.php?page=tambah-mobil" class="btn btn-primary btn-sm float-right">Tambah Data</a>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Model</th>
                  <th>Brand</th>
                  <th>Tahun</th>
                  <th>Transmisi</th>
                  <th>Gambar</th>
                  <th>Harga 24 Jam</th>
                  <th>Status</th>
                  <th class="no-print">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 0;
                $sql = "SELECT car_id, model, brand, year, transmission, image, price_24_hours, status FROM cars";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)){
                  $no++;
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row['model']; ?></td>
                  <td><?php echo $row['brand']; ?></td>
                  <td><?php echo $row['year']; ?></td>
                  <td><?php echo $row['transmission']; ?></td>
                  <td>
                    <img src="uploads/<?php echo $row['image']; ?>" alt="Gambar Mobil" style="width: 100px; height: auto;">
                  </td>
                  <td><?php echo number_format($row['price_24_hours'], 2); ?></td>
                  <td>
                    <?php 
                    $status = strtolower($row['status']); // Menyesuaikan status menjadi lowercase
                    if ($status == 'tersedia') {
                      echo '<span class="badge-status tersedia">Tersedia</span>';
                    } elseif ($status == 'dipesan') {
                      echo '<span class="badge-status dipesan">Dipesan</span>';
                    } elseif ($status == 'dalam_perawatan') {
                      echo '<span class="badge-status dalam_perawatan">Dalam Perawatan</span>';
                    }
                    ?>
                  </td>
                  <td class="no-print">
                    <!-- Tombol Edit dengan parameter page -->
                    <a href="index.php?page=edit-mobil&id=<?php echo $row['car_id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                    <!-- Tombol Hapus dengan konfirmasi SweetAlert -->
                    <button onclick="hapusData(<?php echo $row['car_id']; ?>)" class="btn btn-sm btn-danger">Hapus</button>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  function hapusData(car_id) {
    Swal.fire({
      title: "Apakah Anda Yakin?",
      text: "Data mobil akan dihapus secara permanen.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, hapus!"
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "delete/hapus_mobil.php?id=" + car_id;
      }
    });
  }
</script>

<!-- CSS untuk Badge Status -->
<style>
  /* Badge untuk status mobil */
  .badge-status {
    padding: 4px 10px; /* Ukuran lebih kecil */
    border-radius: 6px;
    font-weight: 600;
    text-transform: capitalize;
    display: inline-block;
    transition: all 0.3s ease;
    font-size: 14px; /* Ukuran font lebih kecil */
  }

  /* Badge untuk status 'Tersedia' */
  .badge-status.tersedia {
    background-color: #28a745; /* Hijau */
    color: white;
  }

  /* Badge untuk status 'Dipesan' */
  .badge-status.dipesan {
    background-color: #ffc107; /* Kuning */
    color: black;
  }

  /* Badge untuk status 'Dalam Perawatan' */
  .badge-status.dalam_perawatan {
    background-color: #6c757d; /* Abu-abu */
    color: white;
  }
</style>
