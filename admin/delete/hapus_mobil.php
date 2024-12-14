<?php
// Sertakan koneksi database
include '../../config/config.php';

// Periksa apakah ID mobil dikirimkan
if (isset($_GET['id'])) {
    $car_id = intval($_GET['id']); // Ambil ID mobil dengan aman

    // Ambil nama file gambar mobil dari database
    $query = "SELECT image FROM cars WHERE car_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $car_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $car = $result->fetch_assoc();

    if ($car) {
        // Hapus file gambar dari server jika ada
        $image_path = '../uploads' . $car['image'];
        if (file_exists($image_path) && !empty($car['image'])) {
            unlink($image_path); // Hapus file gambar
        }

        // Hapus data mobil dari database
        $delete_query = "DELETE FROM cars WHERE car_id = ?";
        $delete_stmt = $conn->prepare($delete_query);
        $delete_stmt->bind_param("i", $car_id);
        $delete_stmt->execute();
    }
}

// Redirect langsung ke halaman mobil
header('Location: ../index.php?page=mobil');
exit;
?>
