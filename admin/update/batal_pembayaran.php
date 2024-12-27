<?php
include('../../config/config.php');
// Pastikan ada ID order yang dikirimkan via GET
if (isset($_GET['orderid'])) {
    $order_id = $_GET['orderid'];

    // Gunakan prepared statement untuk mencegah SQL Injection
    $stmt_payment = $conn->prepare("UPDATE payments SET payment_status = ?, rental_status = ? WHERE order_id = ?");
    $stmt_payment->bind_param("sss", $status_failed, $status_cancelled, $order_id);
    $status_failed = 'failed';
    $status_cancelled = 'cancelled';

    // Update status di tabel rentals
    $stmt_rentals = $conn->prepare("UPDATE rentals SET payment_status = ? WHERE order_id = ?");
    $stmt_rentals->bind_param("ss", $status_failed, $order_id);

    // Eksekusi query untuk payments dan rentals
    if ($stmt_payment->execute() && $stmt_rentals->execute()) {
        $_SESSION['message'] = 'Pembayaran berhasil dibatalkan!';
        header('Location: ../index.php?page=daftar-transaksi');
        exit();
    } else {
        $_SESSION['error'] = 'Terjadi kesalahan saat membatalkan pembayaran.';
        header('Location: ../index.php?page=daftar-transaksi');
        exit();
    }

    // Menutup prepared statement
    $stmt_payment->close();
    $stmt_rentals->close();
} else {
    header('Location: ../index.php?page=daftar-transaksi');
    exit();
}
?>
