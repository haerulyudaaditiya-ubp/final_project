<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">List User</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width: 1%;">No</th>
                  <th style="width: 20%;">Nama</th>
                  <th style="width: 10%;">Telp</th>
                  <th style="width: 25%;">Email</th>
                  <th style="width: 25%;">Alamat</th>
                  <th style="width: 19%;" class="no-print">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 0;
                $sql = "SELECT id, fullname, phone, email, address, status FROM users";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)){
                  $no++;
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row['fullname']; ?></td>
                  <td><?php echo $row['phone']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['address']; ?></td>
                  <td class="no-print">
                    <?php if ($row['status'] == 'aktif') { ?>
                      <!-- Tombol Nonaktifkan -->
                      <a onclick="ubah_status(<?php echo $row['id']; ?>, 'nonaktif')" class="btn btn-sm btn-danger">Nonaktifkan</a>
                    <?php } else { ?>
                      <!-- Tombol Aktifkan -->
                      <a onclick="ubah_status(<?php echo $row['id']; ?>, 'aktif')" class="btn btn-sm btn-success">Aktifkan</a>
                    <?php } ?>
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

<script>
  function ubah_status(user_id, status) {
    Swal.fire({
      title: "Apakah Anda Yakin?",
      text: "Status user akan diubah menjadi " + status + ".",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, ubah!"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: "Berhasil!",
          text: "Status user telah diperbarui.",
          icon: "success"
        });
        window.location = ("update/update_user_status.php?id=" + user_id + "&status=" + status);
      }
    });
  }
</script>
