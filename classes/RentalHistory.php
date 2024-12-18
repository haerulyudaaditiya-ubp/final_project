<?php

class RentalHistory {
    private $conn;
    private $user_id;

    public function __construct($conn, $user_id) {
        $this->conn = $conn;
        $this->user_id = $user_id;
    }

    // Ambil riwayat sewa dari database
    public function getRentals() {
        $query = "SELECT rentals.order_id, 
                         cars.model, 
                         cars.brand, 
                         cars.year, 
                         cars.price_24_hours, 
                         rentals.start_date, 
                         rentals.end_date, 
                         rentals.payment_status,
                         rentals.created_at,
                         payment_links.payment_url
                  FROM rentals
                  JOIN cars ON rentals.car_id = cars.car_id
                  LEFT JOIN payment_links ON rentals.rental_id = payment_links.rental_id
                  WHERE rentals.user_id = '$this->user_id'
                  ORDER BY rentals.created_at DESC"; // Urutkan berdasarkan waktu transaksi rental terbaru
        $result = mysqli_query($this->conn, $query);

        if ($result) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return null;
        }
    }

    // Menghitung harga total berdasarkan durasi sewa
    public function calculateTotalPrice($price_per_day, $start_date, $end_date) {
        $start_date = new DateTime($start_date);
        $end_date = new DateTime($end_date);
        $interval = $start_date->diff($end_date);
        $duration = $interval->days; // Durasi dalam hari

        return $duration * $price_per_day; // Durasi * Harga per hari
    }

    // Menampilkan riwayat sewa
    public function displayRentals($rentals) {
        if (empty($rentals)) {
            echo '<div class="alert alert-info" role="alert">Anda belum pernah melakukan penyewaan kendaraan.</div>';
        } else {
            echo '<div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mobil</th>
                                <th>Harga Total</th>
                                <th>Status Pembayaran</th>
                                <th>Tanggal & Waktu Rental</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>';
            
            $no = 1;  // Inisialisasi nomor urut
            foreach ($rentals as $rental) {
                // Jika status pembayaran adalah 'not_chosen', lewati baris ini
                if ($rental['payment_status'] == 'not_chosen') {
                    continue;
                }

                // Menghitung total harga
                $total_price = $this->calculateTotalPrice($rental['price_24_hours'], $rental['start_date'], $rental['end_date']);
                
                echo '<tr>';
                echo '<td>' . $no++ . '</td>';
                echo '<td>' . htmlspecialchars($rental['brand']) . ' ' . htmlspecialchars($rental['model']) . ' (' . htmlspecialchars($rental['year']) . ')</td>';
                echo '<td>Rp ' . number_format($total_price, 0, ',', '.') . '</td>';
                echo '<td>';
                if ($rental['payment_status'] == 'paid') {
                    echo '<span class="badge bg-success">Lunas</span>';
                } elseif ($rental['payment_status'] == 'pending') {
                    echo '<span class="badge bg-warning">Menunggu Pembayaran</span>';
                } else {
                    echo '<span class="badge bg-danger">Gagal</span>';
                }
                echo '</td>';
                echo '<td>' . (new DateTime($rental['created_at']))->format('d-m-Y H:i:s') . '</td>';
                echo '<td>';
                if ($rental['payment_status'] == 'pending' && !empty($rental['payment_url'])) {
                    echo '<a href="' . htmlspecialchars($rental['payment_url']) . '" class="btn btn-primary btn-sm" target="_blank">Bayar Sekarang</a>';
                } else {
                    echo '<a href="invoice.php?id=' . $rental['order_id'] . '" class="btn btn-info btn-sm">Lihat Detail</a>';
                }
                echo '</td>';
                echo '</tr>';
            }

            echo '</tbody></table></div>';
        }
    }
}
?>
