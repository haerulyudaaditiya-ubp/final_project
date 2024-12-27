<?php
include('../../config/config.php');
// Pastikan ada ID order yang dikirimkan via GET
if (isset($_GET['orderid'])) {
    $order_id = $_GET['orderid'];

    // Gunakan prepared statement untuk mencegah SQL Injection
    $stmt_payment = $conn->prepare("UPDATE payments SET payment_status = ?, rental_status = ? WHERE order_id = ?");
    $stmt_payment->bind_param("sss", $status_paid, $status_completed, $order_id);
    $status_paid = 'paid';
    $status_completed = 'completed';

    $stmt_rentals = $conn->prepare("UPDATE rentals SET payment_status = ? WHERE order_id = ?");
    $stmt_rentals->bind_param("ss", $status_paid, $order_id);

    // Update status mobil menjadi 'tersedia' di tabel cars
    $stmt_car = $conn->prepare("UPDATE cars 
                                JOIN rentals ON cars.car_id = rentals.car_id 
                                SET cars.status = ? 
                                WHERE rentals.order_id = ?");
    $stmt_car->bind_param("ss", $status_tersedia, $order_id);
    $status_tersedia = 'tersedia'; // Status mobil yang diinginkan

    // Eksekusi query untuk payments, rentals, dan cars
    if ($stmt_payment->execute() && $stmt_rentals->execute() && $stmt_car->execute()) {
        $_SESSION['message'] = 'Status mobil berhasil diperbarui dan penyewaan selesai!';
        header('Location: ../index.php?page=pengembalian');
        exit();
    } else {
        $_SESSION['error'] = 'Terjadi kesalahan saat memperbarui status.';
        header('Location: ../index.php?page=pengembalian');
        exit();
    }

    // Menutup prepared statement
    $stmt_payment->close();
    $stmt_rentals->close();
    $stmt_car->close();
} else {
    header('Location: ../index.php?page=pengembalian');
    exit();
}
?>
