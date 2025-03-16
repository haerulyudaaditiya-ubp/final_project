<?php
class Profile {
    private $conn;
    private $user_id;

    public function __construct($conn, $user_id) {
        $this->conn = $conn;
        $this->user_id = $user_id;
    }

    // Ambil data pengguna
    public function getUserData() {
        $query = "SELECT fullname, phone, email, address, created_at FROM users WHERE id = '$this->user_id'";
        $result = mysqli_query($this->conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            return null;
        }
    }

    // Proses update data pengguna
    public function updateUserProfile($fullname, $phone, $email, $address) {
        $fullname = mysqli_real_escape_string($this->conn, $fullname);
        $phone = mysqli_real_escape_string($this->conn, $phone);
        $email = mysqli_real_escape_string($this->conn, $email);
        $address = mysqli_real_escape_string($this->conn, $address);
    
        // Validasi
        if (empty($fullname) || empty($phone) || empty($email) || empty($address)) {
            $_SESSION['error'] = "Semua field harus diisi!";
            return false;
        }
    
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Format email tidak valid!";
            return false;
        }
    
        if (!ctype_digit($phone) || strlen($phone) > 15) {
            $_SESSION['error'] = "Nomor telepon harus berupa angka dan maksimal 15 digit!";
            return false;
        }
    
        // Cek apakah email atau nomor telepon sudah terdaftar pada pengguna lain
        if (!$this->checkDuplicate($email, $phone)) {
            $_SESSION['error'] = "Email atau nomor telepon sudah digunakan oleh pengguna lain!";
            return false;
        }
    
        // Update data di database
        $query = "
            UPDATE users 
            SET fullname='$fullname', phone='$phone', email='$email', address='$address' 
            WHERE id='$this->user_id'
        ";
        if (mysqli_query($this->conn, $query)) {
            // Perbarui session dengan nama lengkap terbaru
            $_SESSION['user_name'] = $fullname;
            $_SESSION['success'] = "Profil berhasil diperbarui!";
            return true;
        } else {
            $_SESSION['error'] = "Terjadi kesalahan saat menyimpan perubahan.";
            return false;
        }
    }    

    // Cek apakah email atau nomor telepon sudah terdaftar pada pengguna lain
    public function checkDuplicate($email, $phone) {
        $query = "
            SELECT id 
            FROM users 
            WHERE (email = '$email' OR phone = '$phone') 
            AND id != '$this->user_id'
        ";
        $result = mysqli_query($this->conn, $query);

        // Jika ada data lain dengan email atau nomor telepon yang sama, kembalikan false
        if ($result && mysqli_num_rows($result) > 0) {
            return false;
        }

        return true;
    }

    // Menampilkan pesan error atau success
    public function displayMessage() {
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . htmlspecialchars($_SESSION['error']) .
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            unset($_SESSION['error']);
        }

        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . htmlspecialchars($_SESSION['success']) .
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            unset($_SESSION['success']);
        }
    }
}
?>
