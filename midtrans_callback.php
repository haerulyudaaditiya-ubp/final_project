<?php
require_once __DIR__ . '/vendor/autoload.php';  // Memuat autoloader Composer

// Memuat .env menggunakan phpdotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Ambil API Key Midtrans dari file .env menggunakan $_ENV
$serverKey = $_ENV['MIDTRANS_SERVER_KEY'];
$isProduction = $_ENV['MIDTRANS_IS_PRODUCTION'] === 'true';  // Konversi ke boolean

// Cek apakah kunci API sudah diatur dengan benar
if (!$serverKey) {
    die("API Key Midtrans tidak ditemukan di .env.");
}

// Konfigurasi Midtrans
\Midtrans\Config::$serverKey = $serverKey;
\Midtrans\Config::$isProduction = $isProduction;

// Ambil data notifikasi dari Midtrans
$notif = new \Midtrans\Notification();

// Ambil status transaksi dan order_id
$order_id = $notif->order_id;
$payment_status = $notif->transaction_status;
$payment_type = $notif->payment_type;
$gross_amount = $notif->gross_amount;
$transaction_id = $notif->transaction_id;  // Menambahkan transaction_id

// Menambahkan log untuk memastikan data notifikasi diterima dengan benar
error_log("Received notification for order_id: $order_id with payment status: $payment_status");

// Koneksi ke database
require_once 'config/config.php';

// Query untuk mendapatkan data rental berdasarkan order_id
$sql_rental = "SELECT rental_id, car_id, payment_status FROM rentals WHERE order_id = ?";
$stmt_rental = mysqli_prepare($conn, $sql_rental);
mysqli_stmt_bind_param($stmt_rental, "s", $order_id);
mysqli_stmt_execute($stmt_rental);
$result_rental = mysqli_stmt_get_result($stmt_rental);
$rental = mysqli_fetch_assoc($result_rental);

// Cek apakah data rental ditemukan
if ($rental) {
    // Update status berdasarkan status pembayaran
    if ($payment_status == 'settlement' || $payment_status == 'capture') {
        // Pembayaran berhasil, insert data pembayaran ke tabel payments
        $new_payment_status = 'paid';
        
        // Insert data pembayaran ke tabel payments
        $sql_payment = "INSERT INTO payments (order_id, transaction_id, payment_type, gross_amount, payment_status)
                        VALUES (?, ?, ?, ?, ?)";
        $stmt_payment = mysqli_prepare($conn, $sql_payment);
        mysqli_stmt_bind_param($stmt_payment, "sssss", $order_id, $transaction_id, $payment_type, $gross_amount, $new_payment_status);
        mysqli_stmt_execute($stmt_payment);

        // Update status pembayaran di tabel rentals
        $sql_update_rental = "UPDATE rentals SET payment_status = ? WHERE order_id = ?";
        $stmt_update_rental = mysqli_prepare($conn, $sql_update_rental);
        mysqli_stmt_bind_param($stmt_update_rental, "ss", $new_payment_status, $order_id);
        mysqli_stmt_execute($stmt_update_rental);

        // Ambil car_id dari tabel rentals
        $car_id = $rental['car_id'];

        // Update status mobil menjadi 'dipesan' di tabel cars
        $sql_update_car = "UPDATE cars SET status = 'dipesan' WHERE car_id = ?";
        $stmt_update_car = mysqli_prepare($conn, $sql_update_car);
        mysqli_stmt_bind_param($stmt_update_car, "i", $car_id);
        mysqli_stmt_execute($stmt_update_car);

    } elseif ($payment_status == 'pending') {
        // Pembayaran masih pending, tidak perlu update payments
        $new_payment_status = 'pending';

        // Update status pembayaran di tabel rentals
        $sql_update_rental = "UPDATE rentals SET payment_status = ? WHERE order_id = ?";
        $stmt_update_rental = mysqli_prepare($conn, $sql_update_rental);
        mysqli_stmt_bind_param($stmt_update_rental, "ss", $new_payment_status, $order_id);
        mysqli_stmt_execute($stmt_update_rental);

    } 
    
    elseif ($payment_status == 'cancelled') {
        // Pembayaran dibatalkan, update status pembayaran di tabel rentals
        $new_payment_status = 'failed';

        // Update status pembayaran di tabel rentals
        $sql_update_rental = "UPDATE rentals SET payment_status = ? WHERE order_id = ?";
        $stmt_update_rental = mysqli_prepare($conn, $sql_update_rental);
        mysqli_stmt_bind_param($stmt_update_rental, "ss", $new_payment_status, $order_id);
        mysqli_stmt_execute($stmt_update_rental);

    } elseif ($payment_status == 'expire') {
        
        error_log("Payment expired for order_id: $order_id");

        // Pembayaran kadaluarsa, update status pembayaran di tabel rentals menjadi 'failed'
        $new_payment_status = 'failed';

        // Update status pembayaran di tabel rentals
        $sql_update_rental = "UPDATE rentals SET payment_status = ? WHERE order_id = ?";
        $stmt_update_rental = mysqli_prepare($conn, $sql_update_rental);
        mysqli_stmt_bind_param($stmt_update_rental, "ss", $new_payment_status, $order_id);
        mysqli_stmt_execute($stmt_update_rental);

    }
} else {
    // Jika transaksi tidak ditemukan di database
    error_log("Transaction not found for order_id: $order_id.");
    echo "Transaksi tidak ditemukan untuk order_id: " . $order_id;
}

// Kirim respons ke Midtrans (harus berupa HTTP 200 OK)
header('HTTP/1.1 200 OK');
echo 'OK';
?>
