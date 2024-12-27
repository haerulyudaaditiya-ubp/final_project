<?php
include('../../config/config.php');
// Pastikan ada ID order yang dikirimkan via GET
if (isset($_GET['orderid'])) {
    $order_id = $_GET['orderid'];

    // Gunakan prepared statement untuk mencegah SQL Injection
    $stmt_payment = $conn->prepare("UPDATE payments SET payment_status = ?, rental_status = ? WHERE order_id = ?");
    $stmt_payment->bind_param("sss", $status_paid, $status_active, $order_id);
    $status_paid = 'paid';
    $status_active = 'active'; // Status penyewaan menjadi 'active' pada tabel payments

    $stmt_rentals = $conn->prepare("UPDATE rentals SET payment_status = ? WHERE order_id = ?");
    $stmt_rentals->bind_param("ss", $status_paid, $order_id);

    // Update status mobil menjadi 'dipesan' di tabel cars
    $stmt_car = $conn->prepare("UPDATE cars 
                                JOIN rentals ON cars.car_id = rentals.car_id 
                                SET cars.status = ? 
                                WHERE rentals.order_id = ?");
    $stmt_car->bind_param("ss", $status_dipesan, $order_id);
    $status_dipesan = 'dipesan'; // Status mobil yang diinginkan

    // Eksekusi query untuk payments, rentals, dan cars
    if ($stmt_payment->execute() && $stmt_rentals->execute() && $stmt_car->execute()) {
        $_SESSION['message'] = 'Pembayaran berhasil dikonfirmasi!';
        header('Location: ../index.php?page=daftar-transaksi');
        exit();
    } else {
        $_SESSION['error'] = 'Terjadi kesalahan saat mengonfirmasi pembayaran.';
        header('Location: ../index.php?page=daftar-transaksi');
        exit();
    }

    // Menutup prepared statement
    $stmt_payment->close();
    $stmt_rentals->close();
    $stmt_car->close();
} else {
    header('Location: ../index.php?page=daftar-transaksi');
    exit();
}
?>
