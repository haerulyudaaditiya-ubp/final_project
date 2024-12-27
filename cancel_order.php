<?php
require 'config/config.php'; // Pastikan konfigurasi database diimpor

header('Content-Type: application/json');

// Pastikan hanya menerima permintaan POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data JSON dari permintaan
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['order_id'])) {
        $order_id = $data['order_id'];
        $user_id = $_SESSION['user_id']; // Pastikan pengguna terautentikasi

        // Debugging: Pastikan order_id dan user_id ada
        if (!$order_id || !$user_id) {
            echo json_encode(['success' => false, 'message' => 'ID pesanan atau pengguna tidak ditemukan.']);
            exit;
        }

        // Perbarui status pembayaran menjadi 'failed'
        $cancel_query = "UPDATE rentals SET payment_status = 'failed' WHERE order_id = '$order_id' AND user_id = '$user_id'";
        
        // Debugging: Cek apakah query berhasil
        if ($result = mysqli_query($conn, $cancel_query)) {
            echo json_encode(['success' => true]);
        } else {
            // Debugging: Tampilkan error query
            echo json_encode(['success' => false, 'message' => 'Gagal memperbarui status pesanan: ' . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID pesanan tidak ditemukan.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Metode HTTP tidak valid.']);
}
