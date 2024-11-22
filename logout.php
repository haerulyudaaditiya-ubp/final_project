<?php
session_start();
session_unset();
session_destroy();

// Redirect ke halaman utama (index.php) di folder utama
header("Location: index.php");
exit;
?>
