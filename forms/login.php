<?php
// Memulai sesi
session_start();

// Impor koneksi database
require '../config/config.php';
require '../classes/UserLogin.php'; // Include kelas User

$error = ''; // Pesan error

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Membuat objek User
    $user = new User($conn, $email, $password);

    // Coba login
    $loggedInUser = $user->login();

    if ($loggedInUser) {
        // Redirect berdasarkan role
        if ($loggedInUser['role'] === 'admin') {
            header("Location: ../admin/index.php"); // Admin diarahkan ke dashboard admin
        } else {
            header("Location: ../index.php"); // User diarahkan ke dashboard user
        }
        exit;
    } else {
        $error = $user->error; // Menampilkan pesan error jika login gagal
    }

    // Menutup koneksi database
    $user->closeConnection();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Wejea Trans</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="icon" type="image/png" href="../img/logo.png">
    <style>
        body {
            background-color: #e9ecef; /* Warna abu-abu terang */
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
            background-color: #ffffff; /* Latar belakang putih */
            width: 100%;
            max-width: 500px;
            padding: 2rem;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-dark {
            background-color: #495057; /* Warna abu-abu tema */
            border-color: #495057;
            transition: 0.3s;
        }

        .btn-dark:hover {
            background-color: #343a40; /* Warna tombol saat hover */
            border-color: #343a40;
        }

        .btn-secondary {
            background-color: #f8f9fa;
            color: #495057; /* Warna teks */
            transition: 0.3s;
        }

        .btn-secondary:hover {
            background-color: #e9ecef;
            color: #343a40;
        }

        .input-group-text {
            background-color: #495057; /* Warna ikon */
            color: #ffffff; /* Teks ikon putih */
        }

        .form-control:focus {
            border-color: #495057; /* Warna border input saat fokus */
            box-shadow: none;
        }

        .text-dark:hover {
            color: #495057 !important; /* Warna teks saat hover */
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

        .terms-text {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .terms-text a {
            color: #f39c12;
            text-decoration: none;
        }

        .terms-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card" data-aos="fade-up" data-aos-duration="1000">
            <div class="text-center mb-4">
                <img src="../img/logo.png" alt="Logo" class="img-fluid" style="max-width: 150px;">
            </div>

            <!-- Pesan Alert -->
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($error); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <h3 class="text-center text-dark mb-4">Login</h3>
            <form method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label text-secondary">Email</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-secondary">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                </div>
                <div class="mb-3 text-end">
                    <a href="forgot_password.php" class="text-dark">Lupa password?</a>
                </div>
                <button type="submit" class="btn btn-dark w-100 mb-3">Login</button>
                <a href="../index.php" class="btn btn-secondary w-100 mb-3">Cancel</a>
                <p class="text-center text-secondary underlined-text">
                    Belum punya akun? <a href="registrasi.php" class="text-dark">Daftar di sini</a>
                </p>
                <hr class="custom-divider">
            </form>
            <p class="terms-text text-center mt-3">
                Dengan melakukan login, Anda setuju dengan <a href="../syarat.php">Syarat dan Ketentuan</a>.
            </p>
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
