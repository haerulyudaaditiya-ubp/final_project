<?php
include('../../config/config.php');

$id = $_GET['id'];
$status = $_GET['status'];

if (!in_array($status, ['aktif', 'nonaktif'])) {
    die("Status tidak valid.");
}

$query = $conn->prepare("UPDATE users SET status = ? WHERE id = ?");
$query->bind_param("si", $status, $id);

if ($query->execute()) {
    header("Location: ../index.php?page=list-user&message=success");
} else {
    header("Location: ../index.php?page=list-user&message=error");
}
?>
