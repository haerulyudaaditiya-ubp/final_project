<?php
session_start();
require '../config/config.php';
require '../classes/UserRegistration.php'; // Memanggil kelas UserRegistration

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Membuat objek dari kelas UserRegistration
    $registration = new UserRegistration($conn, $fullname, $phone, $email, $address, $password, $confirm_password);

    // Menjalankan proses registrasi
    if ($registration->register()) {
        $_SESSION['register_success'] = "Registrasi berhasil! Silakan login.";
        header("Location: login.php");
        exit;
    } else {
        $_SESSION['error'] = $registration->error; // Menampilkan error dari kelas
        header("Location: registrasi.php");
        exit;
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Wejea Trans</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="icon" type="image/png" href="../img/logo.png">
    <style>
        body {
            background-color: #e9ecef;
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
            max-width: 600px;
            padding: 2rem;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-dark {
            background-color: #495057;
            border-color: #495057;
            transition: 0.3s ease-in-out;
        }

        .btn-dark:hover {
            background-color: #343a40;
            border-color: #343a40;
        }

        .btn-secondary {
            background-color: #f8f9fa;
            color: #495057;
            transition: 0.3s ease-in-out;
        }

        .btn-secondary:hover {
            background-color: #e9ecef;
            color: #343a40;
        }

        .input-group-text {
            background-color: #495057;
            color: #ffffff;
        }

        .form-control:focus {
            border-color: #495057;
            box-shadow: 0 0 0 0.2rem rgba(73, 80, 87, 0.25);
        }

        .form-check-label a {
            color: #f39c12;
            text-decoration: none;
        }

        .form-check-label a:hover {
            text-decoration: underline;
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

            <!-- Alerts -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php unset($_SESSION['error']); endif; ?>

            <h3 class="text-center text-dark mb-4">Registrasi</h3>
            <form method="POST" action="">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fullname" class="form-label text-secondary">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Nama Lengkap" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label text-secondary">Nomor Handphone</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa-solid fa-phone"></i>
                            </span>
                            <input type="text" id="phone" name="phone" class="form-control" placeholder="Nomor Telepon" pattern="\d*" maxlength="15" required>
                        </div>
                    </div>
                </div>

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
                    <label for="address" class="form-label text-secondary">Alamat</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-solid fa-map-marker-alt"></i>
                        </span>
                        <input type="text" id="address" name="address" class="form-control" placeholder="Alamat Lengkap" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label text-secondary">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="confirm-password" class="form-label text-secondary">Konfirmasi Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" id="confirm-password" name="confirm-password" class="form-control" placeholder="Konfirmasi Password" required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark w-100 mb-3">Register</button>
                <a href="../index.php" class="btn btn-secondary w-100 mb-3">Cancel</a>
                <p class="text-center text-secondary underlined-text">
                    Sudah punya akun? <a href="login.php" class="text-dark">Login di sini</a>
                </p>
                <hr class="custom-divider">
            </form>
            <p class="terms-text text-center mt-3">
                Dengan melakukan pendaftaran, Anda setuju dengan <a href="../syarat.php">Syarat dan Ketentuan</a>.
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
