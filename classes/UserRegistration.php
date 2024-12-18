<?php

class UserRegistration {
    private $conn;
    private $fullname;
    private $phone;
    private $email;
    private $address;
    private $password;
    private $confirm_password;
    public $error = '';

    // Konstruktor untuk menyimpan nilai dari form
    public function __construct($conn, $fullname, $phone, $email, $address, $password, $confirm_password) {
        $this->conn = $conn;
        $this->fullname = mysqli_real_escape_string($conn, $fullname);
        $this->phone = mysqli_real_escape_string($conn, $phone);
        $this->email = mysqli_real_escape_string($conn, $email);
        $this->address = mysqli_real_escape_string($conn, $address);
        $this->password = mysqli_real_escape_string($conn, $password);
        $this->confirm_password = mysqli_real_escape_string($conn, $confirm_password);
    }

    // Validasi data input
    public function validateInput() {
        if (empty($this->fullname) || empty($this->phone) || empty($this->email) || empty($this->address) || empty($this->password) || empty($this->confirm_password)) {
            $this->error = "Semua field harus diisi!";
            return false;
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->error = "Format email tidak valid!";
            return false;
        }

        if (!ctype_digit($this->phone) || strlen($this->phone) > 15) {
            $this->error = "Nomor telepon harus berupa angka dan maksimal 15 digit!";
            return false;
        }

        if (strlen($this->password) < 6) {
            $this->error = "Password harus minimal 6 karakter!";
            return false;
        }

        if ($this->password !== $this->confirm_password) {
            $this->error = "Password dan konfirmasi password tidak cocok!";
            return false;
        }

        return true;
    }

    // Cek apakah email atau nomor telepon sudah terdaftar
    public function checkDuplicate() {
        $query = "SELECT id FROM users WHERE email = '$this->email' OR phone = '$this->phone'";
        $result = mysqli_query($this->conn, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $this->error = "Email atau nomor telepon sudah terdaftar!";
            return false;
        }
        
        return true;
    }

    // Proses registrasi
    public function register() {
        if (!$this->validateInput()) {
            return false;
        }

        if (!$this->checkDuplicate()) {
            return false;
        }

        // Enkripsi password
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        // Query untuk menyimpan data ke database
        $query = "INSERT INTO users (fullname, phone, email, address, password, role) 
                  VALUES ('$this->fullname', '$this->phone', '$this->email', '$this->address', '$hashedPassword', 'user')";

        if (mysqli_query($this->conn, $query)) {
            return true;
        } else {
            $this->error = "Terjadi kesalahan saat menyimpan data.";
            return false;
        }
    }

    // Menutup koneksi
    public function closeConnection() {
        mysqli_close($this->conn);
    }
}
?>