<?php
ob_start(); // Mulai output buffering
require 'includes/header.php';
require 'config/config.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Anda harus login untuk mengakses halaman ini!";
    header("Location: forms/login.php");
    exit;
}

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];  // Ambil order_id dari URL
} else {
    echo "ID order tidak ditemukan!";
    exit;
}

// Inisialisasi variabel
$rental = null;
$error_message = '';

// Ambil data rental berdasarkan order_id dan user_id
$user_id = $_SESSION['user_id'];
$query = "SELECT rentals.order_id, 
                 cars.model, 
                 cars.brand, 
                 cars.year, 
                 cars.price_24_hours, 
                 rentals.start_date, 
                 rentals.end_date, 
                 rentals.payment_status,
                 rentals.created_at, 
                 users.fullname AS user_name, 
                 users.address AS user_address, 
                 users.phone AS user_phone, 
                 users.email AS user_email 
          FROM rentals
          JOIN cars ON rentals.car_id = cars.car_id
          JOIN users ON rentals.user_id = users.id
          WHERE rentals.order_id = '$order_id' AND rentals.user_id = '$user_id'";
$result = mysqli_query($conn, $query);

if ($result) {
    $rental = mysqli_fetch_assoc($result);  // Ambil data rental sesuai dengan ID
    if (!$rental) {
        $error_message = "Data rental tidak ditemukan!";
    }
} else {
    $error_message = "Terjadi kesalahan saat mengambil data rental.";
}

ob_end_flush(); // Akhiri output buffering
?>

<style>
    /* CSS untuk tampilkan invoice yang rapi */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f9;
    }

    .container {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ddd;
        box-sizing: border-box;
    }

    .header {
        text-align: center;
        margin-bottom: 30px;
    }

    .header h2 {
        font-size: 24px;
        color: #333;
        margin: 0;
    }

    .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .invoice-table th, 
    .invoice-table td {
        padding: 12px;
        text-align: left;
    }

    .invoice-table th {
        background-color: #f8f8f8;
    }

    .invoice-table td {
        border-bottom: 1px solid #ddd;
    }

    /* Styling untuk tombol cetak */
    .btn {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        font-size: 16px;
        border-radius: 5px;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .no-print {
        display: block;
    }

    /* CSS untuk print */
    @media print {
        .container {
            width: 100%;
            padding: 10px;
        }

        .header {
            display: none;
        }

        .no-print {
            display: none;
        }

        .invoice-table th, 
        .invoice-table td {
            padding: 12px;
        }
    }
</style>

<body>
<div class="container">
    <div class="header">
        <h2>Invoice Sewa Kendaraan</h2>
    </div>

    <?php if ($rental): ?>
        <div class="invoice-details">
            <table class="invoice-table">
                <tr>
                    <th>Order ID</th>
                    <td><?= htmlspecialchars($rental['order_id']); ?></td>
                </tr>
                <tr>
                    <th>Tanggal & Waktu Rental</th>
                    <td><?= (new DateTime($rental['created_at']))->format('d M Y H:i'); ?></td>
                </tr>
                <tr>
                    <th>Nama Penyewa</th>
                    <td><?= htmlspecialchars($rental['user_name']); ?></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td><?= htmlspecialchars($rental['user_address']); ?></td>
                </tr>
                <tr>
                    <th>No HP</th>
                    <td><?= htmlspecialchars($rental['user_phone']); ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= htmlspecialchars($rental['user_email']); ?></td> 
                </tr>
                <tr>
                    <th>Nama Mobil</th>
                    <td><?= htmlspecialchars($rental['brand']) . ' ' . htmlspecialchars($rental['model']) . ' (' . htmlspecialchars($rental['year']) . ')'; ?></td>
                </tr>
                <tr>
                    <th>Tanggal Mulai</th>
                    <td><?= (new DateTime($rental['start_date']))->format('d M Y'); ?></td>
                </tr>
                <tr>
                    <th>Tanggal Selesai</th>
                    <td><?= (new DateTime($rental['end_date']))->format('d M Y'); ?></td>
                </tr>
                <tr>
                    <th>Durasi Sewa</th>
                    <td><?= (new DateTime($rental['start_date']))->diff(new DateTime($rental['end_date']))->days; ?> hari</td>
                </tr>
                <tr>
                    <th>Total Harga</th>
                    <td><strong>Rp <?= number_format($rental['price_24_hours'] * (new DateTime($rental['start_date']))->diff(new DateTime($rental['end_date']))->days, 0, ',', '.'); ?></strong></td>
                </tr>
                <tr>
                    <th>Status Pembayaran</th>
                    <td>
                        <?php 
                            if ($rental['payment_status'] == 'paid') {
                                echo '<span class="badge bg-success">Lunas</span>';
                            } elseif ($rental['payment_status'] == 'pending') {
                                echo '<span class="badge bg-warning">Menunggu Pembayaran</span>';
                            } else {
                                echo '<span class="badge bg-danger">Gagal</span>';
                            }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    <?php else: ?>
        <p>Data rental tidak ditemukan.</p>
    <?php endif; ?>
</div>

<script>
    // Auto print the invoice after page loads
    window.onload = function() {
        window.print();
    };
</script>
<br><br><br><br><br><br>
</body>
</html>
