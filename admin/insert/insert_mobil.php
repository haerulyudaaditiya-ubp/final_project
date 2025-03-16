<?php
require_once '../../config/config.php'; // Koneksi database

// Periksa apakah data dikirim melalui form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $model = $_POST['model'];
    $brand = $_POST['brand'];
    $year = intval($_POST['year']);
    $transmission = $_POST['transmission'];
    $price_24_hours = floatval($_POST['price_24_hours']);
    $status = $_POST['status'];

    // Penanganan gambar (jika ada)
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        $file_ext = pathinfo($image, PATHINFO_EXTENSION); // Mendapatkan ekstensi file
        $hashed_name = hash('sha256', uniqid()) . '.' . $file_ext; // Membuat nama file yang dihash
        $target_dir = "../uploads/";
        $target_file = $target_dir . $hashed_name;

        // Validasi tipe file
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        $file_type = mime_content_type($_FILES['image']['tmp_name']);
        if (!in_array($file_type, $allowed_types)) {
            echo "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <style>
                    body {
                        font-family: 'Helvetica Neue', Arial, sans-serif; /* Font SweetAlert */
                    }
                </style>
            </head>
            <body>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Format file tidak valid!',
                    text: 'Hanya JPG, JPEG, dan PNG yang diperbolehkan.',
                }).then(function() {
                    window.history.back();
                });
            </script>
            </body>
            </html>";
            exit;
        }

        // Validasi ukuran file (maksimum 2MB)
        if ($_FILES['image']['size'] > 2 * 1024 * 1024) { // 2MB
            echo "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <style>
                    body {
                        font-family: 'Helvetica Neue', Arial, sans-serif; /* Font SweetAlert */
                    }
                </style>
            </head>
            <body>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Ukuran file terlalu besar!',
                    text: 'Maksimum 2MB.',
                }).then(function() {
                    window.history.back();
                });
            </script>
            </body>
            </html>";
            exit;
        }

        // Pindahkan file ke folder uploads
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            echo "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <style>
                    body {
                        font-family: 'Helvetica Neue', Arial, sans-serif; /* Font SweetAlert */
                    }
                </style>
            </head>
            <body>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal mengunggah gambar!',
                    text: 'Terjadi kesalahan saat mengunggah file.',
                }).then(function() {
                    window.history.back();
                });
            </script>
            </body>
            </html>";
            exit;
        }

        // Jika gambar diupload, gunakan nama yang sudah di-hash
        $image = $hashed_name;
    } else {
        // Jika tidak ada gambar, set image ke NULL (kosong)
        $image = null;
    }

    // Query untuk menyimpan data mobil
    $query = "
        INSERT INTO cars (
            model, 
            brand, 
            year, 
            transmission,  
            price_24_hours, 
            status, 
            image
        ) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ";

    // Cek jika $image null, maka tidak usah mengikat parameter untuk gambar
    if ($image !== null) {
        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            "ssisdss",
            $model,
            $brand,
            $year,
            $transmission,
            $price_24_hours,
            $status,
            $image
        );
    } else {
        // Jika tidak ada gambar, set $image menjadi null
        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            "ssisds",
            $model,
            $brand,
            $year,
            $transmission,
            $price_24_hours,
            $status,
            $image
        );
    }

    if ($stmt->execute()) {
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <style>
                body {
                    font-family: 'Helvetica Neue', Arial, sans-serif; /* Font SweetAlert */
                }
            </style>
        </head>
        <body>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Data mobil berhasil ditambahkan!',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = '../index.php?page=mobil';
            });
        </script>
        </body>
        </html>";
    } else {
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <style>
                body {
                    font-family: 'Helvetica Neue', Arial, sans-serif; /* Font SweetAlert */
                }
            </style>
        </head>
        <body>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi kesalahan saat menyimpan data mobil.'
            }).then(function() {
                window.history.back();
            });
        </script>
        </body>
        </html>";
    }
} else {
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <style>
            body {
                font-family: 'Helvetica Neue', Arial, sans-serif; /* Font SweetAlert */
            }
        </style>
    </head>
    <body>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Metode request tidak valid!'
        }).then(function() {
            window.history.back();
        });
    </script>
    </body>
    </html>";
}
?>