<?php
class User {
    private $conn;
    private $email;
    private $password;
    public $error = '';

    public function __construct($conn, $email, $password) {
        $this->conn = $conn;
        $this->email = mysqli_real_escape_string($conn, $email);
        $this->password = mysqli_real_escape_string($conn, $password);
    }

    // Validasi input email dan password
    public function validateInput() {
        if (empty($this->email) || empty($this->password)) {
            $this->error = "Email dan password wajib diisi!";
            return false;
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->error = "Format email tidak valid!";
            return false;
        }
        
        return true;
    }

    // Periksa apakah email ada di database dan validasi password
    public function login() {
        if (!$this->validateInput()) {
            return false;
        }

        // Periksa apakah email ada di database
        $query = "SELECT * FROM users WHERE email = '$this->email'";
        $result = mysqli_query($this->conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Cek status user
            if ($user['status'] !== 'aktif') {
                $this->error = "Akun Anda tidak aktif. Silakan hubungi admin.";
                return false;
            }

            // Verifikasi password
            if (password_verify($this->password, $user['password'])) {
                // Simpan data user ke sesi
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['fullname'];
                $_SESSION['user_role'] = $user['role']; // Tambahkan role ke sesi
                return $user;
            } else {
                $this->error = "Email atau password tidak sesuai!";
                return false;
            }
        } else {
            $this->error = "Email atau password tidak sesuai!";
            return false;
        }
    }

    // Menutup koneksi
    public function closeConnection() {
        mysqli_close($this->conn);
    }
}
?>