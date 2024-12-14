<?php
session_start();
require '../config/config.php';

$error = '';
$success = '';

// Hapus token yang telah kadaluwarsa
$delete_expired_tokens = "UPDATE users SET reset_token = NULL, reset_token_expire = NULL WHERE reset_token_expire < NOW()";
mysqli_query($conn, $delete_expired_tokens);

if (isset($_GET['token'])) {
    $token = mysqli_real_escape_string($conn, $_GET['token']);

    // Validasi token
    $query = "SELECT * FROM users WHERE reset_token = '$token' AND reset_token_expire > NOW()";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
            $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

            // Validasi kata sandi
            if (empty($new_password) || empty($confirm_password)) {
                $error = "Kata sandi wajib diisi!";
            } elseif ($new_password !== $confirm_password) {
                $error = "Kata sandi tidak cocok!";
            } elseif (strlen($new_password) < 6) {
                $error = "Kata sandi harus minimal 6 karakter!";
            } else {
                // Update password di database
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_query = "UPDATE users SET password = '$hashed_password', reset_token = NULL, reset_token_expire = NULL WHERE id = '{$user['id']}'";

                if (mysqli_query($conn, $update_query)) {
                    $success = "Kata sandi berhasil diperbarui. Anda akan diarahkan ke halaman login.";
                    echo "<script>
                        setTimeout(function() {
                            window.location.href = 'login.php';
                        }, 3000);
                    </script>";
                } else {
                    $error = "Terjadi kesalahan saat mengatur ulang kata sandi.";
                }
            }
        }
    } else {
        $error = "Token tidak valid atau telah kedaluwarsa.";
    }
} else {
    $error = "Token tidak ditemukan.";
}

// Tutup koneksi
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Wejea Trans</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../img/logo.png">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            border-radius: 15px;
            background-color: #ffffff;
            width: 100%;
            max-width: 480px;
            padding: 2rem;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-dark {
            background-color: #495057;
            border-color: #495057;
            transition: 0.3s;
        }

        .btn-dark:hover {
            background-color: #343a40;
            border-color: #343a40;
        }

        .alert {
            animation: fadeInAlert 0.5s ease-in-out;
        }

        @keyframes fadeInAlert {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .logo {
            max-width: 150px;
            margin-bottom: 2rem;
        }

        h3 {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="text-center mb-4">
                <img src="../img/logo.png" alt="Logo" class="img-fluid logo">
            </div>
            <div class="text-center mb-4">
                <h3 class="text-dark">Reset Password</h3>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($error); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($success); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label for="new_password" class="form-label fw-bold">Kata Sandi Baru</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Masukkan kata sandi baru" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label fw-bold">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Ulangi kata sandi baru" required>
                </div>
                <button type="submit" class="btn btn-dark w-100">Reset Password</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
