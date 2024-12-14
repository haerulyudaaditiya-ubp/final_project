<?php
require_once __DIR__ . '/vendor/autoload.php';  // Memuat autoloader Composer

// Memuat .env menggunakan phpdotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Ambil API Key Midtrans dari file .env menggunakan $_ENV
$serverKey = $_ENV['MIDTRANS_SERVER_KEY'];
$clientKey = $_ENV['MIDTRANS_CLIENT_KEY'];
$isProduction = $_ENV['MIDTRANS_IS_PRODUCTION'] === 'true';  // Konversi ke boolean

// Cek apakah kunci API sudah diatur dengan benar
if (!$serverKey || !$clientKey) {
    die("API Key Midtrans tidak ditemukan di .env.");
}

// Konfigurasi Midtrans
\Midtrans\Config::$serverKey = $serverKey;
\Midtrans\Config::$clientKey = $clientKey;
\Midtrans\Config::$isProduction = $isProduction;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

// Koneksi ke database
require_once 'config/config.php';

// Ambil data dari form rental
$car_id = filter_var($_POST['car_id'], FILTER_VALIDATE_INT);
$user_id = filter_var($_POST['user_id'], FILTER_VALIDATE_INT);

if (!$car_id || !$user_id) {
    die("ID mobil atau ID pengguna tidak valid.");
}

$model = $_POST['model'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$duration = $_POST['duration'];
$total_price = $_POST['total_price'];  // Total harga yang dihitung sebelumnya (tanpa format)

// Validasi tanggal
if ($start_date > $end_date) {
    die("Tanggal mulai sewa tidak boleh lebih besar dari tanggal selesai.");
}

// Menghapus 'Rp' dan titik (.), serta mengganti koma (,) dengan titik (.)
// Membersihkan format harga dari 'Rp' dan titik
$total_price_cleaned = str_replace(['Rp', '.'], '', $total_price);  // Hapus 'Rp' dan titik
$total_price_cleaned = str_replace(',', '.', $total_price_cleaned);  // Ganti koma dengan titik

// Pastikan harga adalah angka setelah pembersihan
if (!is_numeric($total_price_cleaned)) {
    die("Harga total tidak valid.");
}

$total_price_float = (float) $total_price_cleaned;

// Ambil informasi pengguna dari database
$sql_user = "SELECT fullname, email, phone FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql_user);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result_user = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result_user);

// Periksa apakah data pengguna ditemukan
if (!$user) {
    die("Pengguna tidak ditemukan.");
}

// Membuat transaksi Midtrans
$transaction_details = array(
    'order_id' => "R" . uniqid(),  // Generate unique order ID
    'gross_amount' => $total_price_float, // Harga tanpa format Rp dan titik
);

// Data pengguna untuk keperluan transaksi
$customer_details = array(
    'first_name' => $user['fullname'],
    'email' => $user['email'],
    'phone' => $user['phone'],
);

// Menambahkan detail item untuk transaksi (Mobil) dan menambahkan jumlah hari sebagai pengganti quantity
$item_details = array(
    array(
        'id' => $car_id, // ID Mobil
        'price' => $total_price_float,
        'name' => $model, // Nama Mobil
        'quantity' => 1,  // Menambahkan quantity (diatur ke 1 karena hanya satu item mobil)
        'custom_field1' => $duration . ' Hari', // Durasi Sewa (Jumlah Hari)
        'custom_field2' => 'Mulai: ' . $start_date,  // Tanggal Mulai
        'custom_field3' => 'Selesai: ' . $end_date, // Tanggal Selesai
        'custom_field4' => 'Total Harga: Rp ' . number_format($total_price_float, 0, ',', '.') // Total Harga
    )
);

// Data transaksi lengkap
$transaction = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,  // Menambahkan item detail beserta custom field
);

// Kirim transaksi ke Midtrans
try {
    // Membuat transaksi dengan Midtrans
    $payment_url = \Midtrans\Snap::createTransaction($transaction)->redirect_url;

    // Simpan transaksi ke dalam database
    $order_id = $transaction_details['order_id'];
    $payment_status = 'not_chosen';  // Status pembayaran sementara, menunggu pembayaran

    // Query untuk menyimpan data rental
    $sql_rental = "INSERT INTO rentals (user_id, car_id, start_date, end_date, duration, total_price, order_id, payment_status)
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_rental = mysqli_prepare($conn, $sql_rental);
    
    // Bind parameter dan eksekusi query untuk menyimpan rental
    mysqli_stmt_bind_param($stmt_rental, "iissdsss", $user_id, $car_id, $start_date, $end_date, $duration, $total_price_float, $order_id, $payment_status);
    mysqli_stmt_execute($stmt_rental);

    // Ambil rental_id yang baru disimpan
    $rental_id = mysqli_insert_id($conn);

    // Simpan link pembayaran ke dalam tabel payment_links
    $sql_payment_link = "INSERT INTO payment_links (rental_id, payment_url)
                         VALUES (?, ?)";
    $stmt_payment_link = mysqli_prepare($conn, $sql_payment_link);

    // Bind parameter dan eksekusi query untuk menyimpan payment_url
    mysqli_stmt_bind_param($stmt_payment_link, "is", $rental_id, $payment_url);
    mysqli_stmt_execute($stmt_payment_link);

    // Redirect ke halaman pembayaran Midtrans
    header('Location: ' . $payment_url);
    exit();
} catch (Exception $e) {
    // Tangani kesalahan dengan memberikan pesan yang jelas
    echo "Terjadi kesalahan dalam proses pembayaran: " . $e->getMessage();
    exit();
}
?>
