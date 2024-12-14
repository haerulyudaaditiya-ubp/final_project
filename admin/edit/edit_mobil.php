<?php 

// Ambil ID mobil dari parameter URL
$id = $_GET['id'];

// Ambil data mobil dari database berdasarkan ID
$query = mysqli_query($conn, "SELECT * FROM cars WHERE car_id='$id'");
$view = mysqli_fetch_array($query);
?>

<section class="content">
    <div class="container-fluid">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Form Edit Data Mobil</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="post" action="update/update_mobil.php" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Model -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="model">Model</label>
                                <input type="text" id="model" name="model" class="form-control" placeholder="Masukkan model mobil" value="<?php echo $view['model']; ?>">
                            </div>
                        </div>
                        <!-- Brand -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="brand">Brand</label>
                                <input type="text" id="brand" name="brand" class="form-control" placeholder="Masukkan merek mobil" value="<?php echo $view['brand']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Tahun -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="year">Tahun</label>
                                <input type="number" id="year" name="year" class="form-control" placeholder="Masukkan tahun produksi" value="<?php echo $view['year']; ?>">
                            </div>
                        </div>
                        <!-- Transmisi -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="transmission">Transmisi</label>
                                <select id="transmission" name="transmission" class="form-control">
                                    <option value="manual" <?php echo ($view['transmission'] == 'manual') ? 'selected' : ''; ?>>Manual</option>
                                    <option value="matic" <?php echo ($view['transmission'] == 'matic') ? 'selected' : ''; ?>>Matic</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Harga 24 Jam -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="price_24_hours">Harga 24 Jam</label>
                                <input type="number" id="price_24_hours" name="price_24_hours" class="form-control" placeholder="Masukkan harga sewa 24 jam" value="<?php echo $view['price_24_hours']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Status -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="tersedia" <?php echo ($view['status'] == 'tersedia') ? 'selected' : ''; ?>>Tersedia</option>
                                    <option value="dipesan" <?php echo ($view['status'] == 'dipesan') ? 'selected' : ''; ?>>Dipesan</option>
                                    <option value="dalam_perawatan" <?php echo ($view['status'] == 'dalam_perawatan') ? 'selected' : ''; ?>>Dalam Perawatan</option>
                                </select>
                            </div>
                        </div>
                        <!-- Gambar -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="image">Gambar</label>
                                <input type="file" id="image" name="image" class="form-control">
                                <small>Gambar saat ini: <?php echo $view['image']; ?></small>
                                <input type="hidden" name="old_image" value="<?php echo $view['image']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- Input Hidden ID -->
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</section>
