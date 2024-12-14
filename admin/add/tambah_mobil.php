<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Data Mobil</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="insert/insert_mobil.php" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <!-- Model -->
                            <div class="form-group">
                                <label for="model">Model</label>
                                <input type="text" name="model" class="form-control" id="model" placeholder="Masukkan model mobil" required>
                            </div>
                            <!-- Brand -->
                            <div class="form-group">
                                <label for="brand">Brand</label>
                                <input type="text" name="brand" class="form-control" id="brand" placeholder="Masukkan merek mobil" required>
                            </div>
                            <!-- Tahun -->
                            <div class="form-group">
                                <label for="year">Tahun</label>
                                <input type="number" name="year" class="form-control" id="year" placeholder="Masukkan tahun produksi" required>
                            </div>
                            <!-- Transmisi -->
                            <div class="form-group">
                                <label for="transmission">Transmisi</label>
                                <select class="form-control" name="transmission" id="transmission" required>
                                    <option value="manual">Manual</option>
                                    <option value="matic">Matic</option>
                                </select>
                            </div>
                            <!-- Harga 24 Jam -->
                            <div class="form-group">
                                <label for="price_24_hours">Harga 24 Jam</label>
                                <input type="number" name="price_24_hours" class="form-control" id="price_24_hours" placeholder="Masukkan harga sewa 24 jam" required>
                            </div>
                            <!-- Status -->
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="tersedia">Tersedia</option>
                                    <option value="dipesan">Dipesan</option>
                                    <option value="dalam_perawatan">Dalam Perawatan</option>
                                </select>
                            </div>
                            <!-- Gambar -->
                            <div class="form-group">
                                <label for="image">Gambar</label>
                                <input type="file" name="image" class="form-control-file" id="image" required>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="index.php?page=mobil" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
