<?php
require_once '../../config/config.php'; // Koneksi database

// Periksa apakah data dikirim melalui form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $id = intval($_POST['id']);
    $model = $_POST['model'];
    $brand = $_POST['brand'];
    $year = intval($_POST['year']);
    $transmission = $_POST['transmission'];
    $price_24_hours = floatval($_POST['price_24_hours']);
    $status = $_POST['status'];
    $old_image = $_POST['old_image']; // Gambar lama

    // Penanganan gambar baru (jika diunggah)
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        // Generate nama file gambar baru yang unik
        $image = uniqid('car_', true) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $target_dir = "../uploads";
        $target_file = $target_dir . '/' . $image;

        // Validasi tipe file
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($_FILES['image']['type'], $allowed_types)) {
            echo "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <style>
                    body {
                        font-family: 'Helvetica Neue', Arial, sans-serif; /* Pastikan font SweetAlert */
                    }
                </style>
            </head>
            <body>
            <script>
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Format file tidak valid! Hanya JPG, JPEG, dan PNG yang diperbolehkan.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.history.back();
                });
            </script>
            </body>
            </html>";
            exit;
        }

        // Pindahkan file gambar baru ke folder uploads
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Hapus gambar lama jika ada
            if (!empty($old_image) && file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        } else {
            echo "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <style>
                    body {
                        font-family: 'Helvetica Neue', Arial, sans-serif; /* Pastikan font SweetAlert */
                    }
                </style>
            </head>
            <body>
            <script>
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Gagal mengunggah gambar baru!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.history.back();
                });
            </script>
            </body>
            </html>";
            exit;
        }
    } else {
        // Jika tidak ada gambar baru, gunakan gambar lama yang ada di database
        $image = $old_image;
    }

    // Query untuk memperbarui data mobil
    $query = "UPDATE cars 
              SET model = ?, brand = ?, year = ?, transmission = ?, 
                  price_24_hours = ?, status = ?, image = ? 
              WHERE car_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "ssisdssi", 
        $model, 
        $brand, 
        $year, 
        $transmission, 
        $price_24_hours, 
        $status, 
        $image, 
        $id
    );

    if ($stmt->execute()) {
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <style>
                body {
                    font-family: 'Helvetica Neue', Arial, sans-serif; /* Pastikan font SweetAlert */
                }
            </style>
        </head>
        <body>
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data mobil berhasil diperbarui!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
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
                    font-family: 'Helvetica Neue', Arial, sans-serif; /* Pastikan font SweetAlert */
                }
            </style>
        </head>
        <body>
        <script>
            Swal.fire({
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat memperbarui data mobil.',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(() => {
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
                font-family: 'Helvetica Neue', Arial, sans-serif; /* Pastikan font SweetAlert */
            }
        </style>
    </head>
    <body>
    <script>
        Swal.fire({
            title: 'Gagal!',
            text: 'Metode request tidak valid!',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then(() => {
            window.history.back();
        });
    </script>
    </body>
    </html>";
}
?>
