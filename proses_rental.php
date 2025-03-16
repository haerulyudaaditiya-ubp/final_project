<?php
session_start();
require 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_id = $_POST['car_id'];
    $user_id = $_POST['user_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Periksa durasi sewa
    $startDate = new DateTime($start_date);
    $endDate = new DateTime($end_date);
    $duration = $startDate->diff($endDate)->days;

    if ($duration <= 0) {
        $_SESSION['error'] = "Durasi sewa tidak valid.";
        header("Location: rental_form.php?id=$car_id");
        exit();
    }

    // Ambil harga kendaraan berdasarkan car_id
    $carQuery = "SELECT price_24_hours FROM cars WHERE car_id = '$car_id'";
    $carResult = mysqli_query($conn, $carQuery);
    if (!$carResult || mysqli_num_rows($carResult) === 0) {
        $_SESSION['error'] = "Data mobil tidak ditemukan.";
        header("Location: rental_form.php?id=$car_id");
        exit();
    }
    $carData = mysqli_fetch_assoc($carResult);
    $pricePerDay = $carData['price_24_hours'];

    // Hitung total harga
    $totalPrice = $pricePerDay * $duration;

    // Generate order_id unik
    $order_id = uniqid('ORD');

    // Insert data rental ke database
    $sql = "
    INSERT INTO rentals (
        car_id, 
        user_id, 
        start_date, 
        end_date, 
        duration, 
        total_price, 
        payment_status, 
        order_id, 
        created_at
    ) 
    VALUES (
        '$car_id', 
        '$user_id', 
        '$start_date', 
        '$end_date', 
        '$duration', 
        '$totalPrice', 
        'pending', 
        '$order_id', 
        NOW()
    )
    ";
    if (mysqli_query($conn, $sql)) {
        // Redirect ke halaman invoice
        header("Location: invoice.php?id=$order_id");
        exit();
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat memproses rental.";
        header("Location: rental_form.php?id=$car_id");
        exit();
    }
} else {
    $_SESSION['error'] = "Metode request tidak valid.";
    header("Location: index.php");
    exit();
}
?>
