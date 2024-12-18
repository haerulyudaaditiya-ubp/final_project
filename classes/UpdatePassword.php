<?php
class UpdatePassword {
    private $conn;
    private $user_id;
    private $current_password;
    private $new_password;
    private $confirm_password;

    public $error = '';
    public $success = '';

    public function __construct($conn, $user_id, $current_password, $new_password, $confirm_password) {
        $this->conn = $conn;
        $this->user_id = mysqli_real_escape_string($conn, $user_id);
        $this->current_password = $current_password;
        $this->new_password = $new_password;
        $this->confirm_password = $confirm_password;
    }

    // Validasi input kosong dan panjang password
    public function validateInputs() {
        if (empty($this->current_password) || empty($this->new_password) || empty($this->confirm_password)) {
            $this->error = "Semua kolom harus diisi!";
            return false;
        } elseif (strlen($this->new_password) < 6) {
            $this->error = "Password baru harus minimal 6 karakter!";
            return false;
        } elseif ($this->new_password !== $this->confirm_password) {
            $this->error = "Password baru dan konfirmasi password tidak cocok!";
            return false;
        }
        return true;
    }

    // Verifikasi password lama
    public function verifyCurrentPassword() {
        $query = "SELECT password FROM users WHERE id = '{$this->user_id}'";
        $result = mysqli_query($this->conn, $query);

        if ($result && $row = mysqli_fetch_assoc($result)) {
            if (!password_verify($this->current_password, $row['password'])) {
                $this->error = "Password lama salah!";
                return false;
            }
            return true;
        } else {
            $this->error = "Terjadi kesalahan. Data pengguna tidak ditemukan.";
            return false;
        }
    }

    // Update password baru ke database
    public function updatePassword() {
        $hashed_password = password_hash($this->new_password, PASSWORD_DEFAULT);
        $update_query = "UPDATE users SET password = '$hashed_password' WHERE id = '{$this->user_id}'";

        if (mysqli_query($this->conn, $update_query)) {
            $this->success = "Password berhasil diperbarui! Anda akan diarahkan ke halaman login.";
            return true;
        } else {
            $this->error = "Terjadi kesalahan saat memperbarui password.";
            return false;
        }
    }
}
