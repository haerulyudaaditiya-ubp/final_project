<?php
ob_start(); // Memulai output buffering
session_start(); // Memulai sesi

require 'includes/header.php'; // Menyisipkan Header
require 'config/config.php'; // Koneksi database

// Jika pengguna belum login, arahkan ke halaman login
if (!isset($_SESSION['user_id'])) {
    header("Location: forms/login.php");
    exit();
}

// Ambil ID mobil dari URL
if (isset($_GET['id'])) {
    $car_id = $_GET['id'];

    // Ambil informasi mobil dari database
    $sql = "SELECT * FROM cars WHERE car_id = $car_id";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $model = $row['model'];
        $brand = $row['brand'];
        $year = $row['year'];
        $transmission = ucfirst($row['transmission']); // Transmisi
        $image = $row['image'];
        $price_24_hours = $row['price_24_hours']; // Harga 24 jam
        $image_path = "admin/uploads/" . htmlspecialchars($image);
        if (!file_exists($image_path) || empty($image)) {
            $image_path = "img/image_not_found.jpg"; // Gambar default jika gambar tidak ditemukan
        }
    } else {
        echo "<p>Mobil tidak ditemukan.</p>";
        exit();
    }
} else {
    echo "<p>ID mobil tidak diberikan.</p>";
    exit();
}

// Ambil data pengguna
$user_id = $_SESSION['user_id'];
$sql_user = "SELECT fullname, address, phone FROM users WHERE id = $user_id";
$result_user = mysqli_query($conn, $sql_user);

if ($row_user = mysqli_fetch_assoc($result_user)) {
    $user_fullname = $row_user['fullname'];
    $user_address = $row_user['address'];
    $user_phone = $row_user['phone'];
} else {
    $user_fullname = '';
    $user_address = '';
    $user_phone = '';
}
?>

<div class="container py-5">
    <div class="row">
        <!-- Detail Mobil -->
        <div class="col-md-6">
            <div class="card shadow-sm" style="border-radius: 15px;">
                <img src="<?php echo $image_path; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($model); ?>" style="border-radius: 15px 15px 0 0; object-fit: cover; height: 300px;">
                <div class="card-body text-center">
                    <h3 class="fw-bold"><?php echo htmlspecialchars($model); ?> - <?php echo htmlspecialchars($brand); ?></h3>
                    <p class="text-muted">Harga sewa harian: Rp <?php echo number_format($price_24_hours, 2, ',', '.'); ?>/hari</p>
                    <p>
                        <i class="fas fa-calendar-alt ms-3"></i> <?php echo htmlspecialchars($year); ?>
                        <i class="fas fa-cogs ms-3"></i> <?php echo htmlspecialchars($transmission); ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Form Rental -->
        <div class="col-md-6">
            <div class="card shadow-sm p-4" style="border-radius: 15px;">
                <h4 class="fw-bold mb-4">Lengkapi Form Rental Berikut!</h4>
                <form action="proses_rental.php" method="POST">
                    <input type="hidden" name="car_id" value="<?php echo htmlspecialchars($car_id); ?>">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                    <input type="hidden" name="model" value="<?php echo htmlspecialchars($model); ?>">

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Penyewa</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nama..." value="<?php echo htmlspecialchars($user_fullname); ?>" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Jl. Setia Budi No.xx" value="<?php echo htmlspecialchars($user_address); ?>" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Telepon</label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="08xxxxxxxxxx" value="<?php echo htmlspecialchars($user_phone); ?>" readonly required>
                    </div>

                    <!-- Tanggal Mulai dan Selesai -->
                    <div id="multiple_days_section" class="mb-3">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" required min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div id="multiple_days_section_end" class="mb-3">
                        <label for="end_date" class="form-label">Tanggal Selesai</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" required>
                    </div>

                    <!-- Durasi dan Total Harga -->
                    <div id="duration_section" class="mb-3">
                        <label for="duration" class="form-label">Durasi Sewa</label>
                        <input type="number" name="duration" id="duration" class="form-control" placeholder="0" readonly>
                        <span id="duration_label" class="text-muted">Hari</span>
                    </div>

                    <!-- Menampilkan Total Harga -->
                    <div id="total_price_section" class="mb-3">
                        <label for="total_price" class="form-label">Total Harga</label>
                        <input type="text" name="total_price" id="total_price" class="form-control" value="Rp 0" readonly>
                    </div>

                    <!-- Tempat untuk menampilkan alert -->
                    <div id="alert-container" class="mb-3" style="display: none;">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Perhatian!</strong> Total harga tidak valid. Silakan pilih durasi sewa yang sesuai.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>

                    <button type="submit" id="submit_button" class="btn btn-warning w-100">Sewa Sekarang</button>
                </form>

                <!-- Opsi untuk memperbarui data pengguna -->
                <div class="mt-3 text-center">
                    <p>Jika Anda ingin memperbarui informasi Anda, silakan <a href="profile.php">klik di sini</a> untuk mengedit profil Anda.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const alertContainer = document.getElementById('alert-container');
const startDateInput = document.getElementById('start_date');
const endDateInput = document.getElementById('end_date');
const durationInput = document.getElementById('duration');
const totalPriceInput = document.getElementById('total_price');
const submitButton = document.getElementById('submit_button');
const price24Hours = <?php echo $price_24_hours; ?>;

// Set tanggal minimum untuk input start_date
startDateInput.setAttribute('min', new Date().toISOString().split('T')[0]);

// Fungsi untuk menghitung durasi berdasarkan tanggal mulai dan selesai
function calculateDuration() {
    const startDate = new Date(startDateInput.value);
    const endDate = new Date(endDateInput.value);

    if (startDate && endDate && endDate > startDate) {
        const duration = (endDate - startDate) / (1000 * 60 * 60 * 24); // Menghitung durasi dalam hari
        durationInput.value = duration;
        calculateTotalPrice(); // Update total harga setelah durasi dihitung
    } else {
        durationInput.value = 0;
        totalPriceInput.value = "Rp 0";
    }
}

// Fungsi untuk menghitung total harga
function calculateTotalPrice() {
    let totalPrice = 0;
    const durationDays = durationInput.value;
    if (durationDays > 0) {
        totalPrice = price24Hours * durationDays; // Menggunakan harga per hari
    }
    totalPriceInput.value = "Rp " + totalPrice.toLocaleString('id-ID', {minimumFractionDigits: 2, maximumFractionDigits: 2});
}

// Menangani perubahan tanggal untuk durasi lebih dari 24 jam
startDateInput.addEventListener('change', function() {
    // Set tanggal minimum untuk input end_date berdasarkan tanggal mulai
    const startDate = new Date(startDateInput.value);
    const startDateString = startDate.toISOString().split('T')[0];
    endDateInput.setAttribute('min', startDateString); // Tanggal min untuk end_date tidak boleh lebih kecil dari start_date

    // Menonaktifkan tanggal yang sama dengan tanggal mulai di input end_date
    updateEndDateAvailability();
    
    // Recalculate duration if end_date is already set
    calculateDuration();
});

// Menangani perubahan tanggal untuk end_date
endDateInput.addEventListener('change', calculateDuration);

// Menonaktifkan tanggal yang sama dengan tanggal mulai di input end_date
function updateEndDateAvailability() {
    const startDate = new Date(startDateInput.value);
    const startDateString = startDate.toISOString().split('T')[0];

    // Pastikan tanggal selesai tidak bisa dipilih sama dengan tanggal mulai
    const endDate = new Date(startDate);
    endDate.setDate(startDate.getDate() + 1); // Mulai dari tanggal 1 hari setelah tanggal mulai
    
    // Set tanggal min dan disabled tanggal yang sama dengan tanggal mulai
    endDateInput.setAttribute('min', endDate.toISOString().split('T')[0]);

    // Update calendar agar tanggal yang sama dengan tanggal mulai tidak bisa dipilih
    const dateInputElements = document.querySelectorAll('input[type="date"]');
    const endDateCalendar = endDateInput.querySelector('input[type="date"]');
    if (endDateCalendar) {
        endDateCalendar.setAttribute('min', startDate.toISOString().split('T')[0]);
    }
}

// Tambahkan event listener pada tombol submit
submitButton.addEventListener('click', (event) => {
    const totalPrice = parseFloat(totalPriceInput.value.replace(/[^0-9.-]+/g, '')); // Ambil angka dari total harga
    if (isNaN(totalPrice) || totalPrice <= 0) {
        event.preventDefault(); // Mencegah pengiriman form
        // Tampilkan alert
        alertContainer.style.display = 'block';
    } else {
        // Sembunyikan alert jika harga valid
        alertContainer.style.display = 'none';
    }
});

</script>

<?php require 'includes/footer.php'; ?>
