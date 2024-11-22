<?php
// Konfigurasi database
$host = 'localhost';        // Nama host, biasanya localhost
$username = 'root';         // Username database Anda
$password = '';             // Password database Anda
$dbname = 'final_project';  // Nama database yang akan digunakan

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Fungsi ini untuk debugging koneksi (opsional)
// echo "Koneksi berhasil";
?>
