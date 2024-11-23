// Memulai sesi
session_start();

// Impor koneksi database
require '../config/config.php';

// Impor PHPMailer dan autoload Composer
require '../libs/PHPMailer-master/src/PHPMailer.php';
require '../libs/PHPMailer-master/src/SMTP.php';
require '../libs/PHPMailer-master/src/Exception.php';
require '../vendor/autoload.php'; // Autoload Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load file .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Inisialisasi variabel
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Validasi input kosong
    if (empty($email)) {
        $error = "Email wajib diisi!";
    } else {
        // Validasi format email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Format email tidak valid!";
        } else {
            // Periksa apakah email ada di database
            $query = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                // Jika email ditemukan, buat token reset
                $reset_token = bin2hex(random_bytes(32)); // Token unik
                $reset_link = "http://localhost/final_project/forms/reset_password.php?token=" . $reset_token;

                // Simpan token reset ke database
                $update_query = "UPDATE users SET reset_token = '$reset_token', reset_token_expire = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = '$email'";
                if (mysqli_query($conn, $update_query)) {
                    // Kirim email dengan PHPMailer
                    $mail = new PHPMailer(true);

                    try {
                        // Konfigurasi SMTP
                        $mail->isSMTP();
                        $mail->Host = $_ENV['SMTP_HOST']; // Diambil dari .env
                        $mail->SMTPAuth = true;
                        $mail->Username = $_ENV['SMTP_USER']; // Diambil dari .env
                        $mail->Password = $_ENV['SMTP_PASS']; // Diambil dari .env
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = $_ENV['SMTP_PORT']; // Diambil dari .env

                        // Informasi pengirim
                        $mail->setFrom('no-reply@yourdomain.com', 'Wejea Trans');
                        $mail->addAddress($email); // Email penerima

                        // Konten email
                        $mail->isHTML(true);
                        $mail->Subject = 'Reset Password - WJA Trans';
                        $mail->Body = "
                            <p>Halo,</p>
                            <p>Kami menerima permintaan untuk mengatur ulang kata sandi Anda. Klik tautan berikut untuk melanjutkan:</p>
                            <a href='$reset_link'>$reset_link</a>
                            <p>Tautan ini berlaku selama 1 jam.</p>
                            <p>Email ini dikirim secara otomatis. Mohon untuk tidak membalas email ini.</p>
                        ";

                        $mail->send();
                        $success = "Kami telah mengirimkan link reset password ke email Anda!";
                    } catch (Exception $e) {
                        $error = "Email gagal dikirim. Error: {$mail->ErrorInfo}";
                    }
                } else {
                    $error = "Terjadi kesalahan saat memproses permintaan reset password.";
                }
            } else {
                $error = "Email tidak ditemukan!";
            }
        }
    }
}

// Tutup koneksi
mysqli_close($conn);

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - WJA Trans</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

        .btn-secondary {
            background-color: #dee2e6;
            color: #495057;
            transition: 0.3s;
        }

        .btn-secondary:hover {
            background-color: #ced4da;
            color: #343a40;
        }

        .form-control:focus {
            border-color: #495057;
            box-shadow: none;
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

        h3 {
            font-weight: bold;
        }

        p {
            font-size: 0.9rem;
        }

        .logo {
            max-width: 150px;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="text-center mb-4">
                <img src="../img/logo.png" alt="Logo" class="img-fluid logo">
            </div>

            <!-- Pesan Alert -->
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

            <h3 class="text-center text-dark mb-4">Lupa Password</h3>
            <form method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label text-secondary">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email Anda" required>
                </div>
                <button type="submit" class="btn btn-dark w-100 mb-3">Kirim Link Reset Password</button>
                <a href="../index.php" class="btn btn-secondary w-100 mb-3">Kembali</a>
            </form>
            <p class="text-center text-secondary mt-3">
                Pastikan Anda menggunakan email yang terdaftar di sistem kami.
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
