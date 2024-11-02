<?php
include '../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$siswa = $conn->query("SELECT * FROM calon_siswa WHERE user_id = $user_id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bukti Pendaftaran</title>
</head>
<body onload="window.print()">
    <h2>Bukti Pendaftaran</h2>
    <p><strong>Nama:</strong> <?php echo $siswa['nama']; ?></p>
    <p><strong>NISN:</strong> <?php echo $siswa['nisn']; ?></p>
    <p><strong>Email:</strong> <?php echo $siswa['email']; ?></p>
    <p><strong>Status Verifikasi:</strong> <?php echo $siswa['status_verifikasi']; ?></p>
    <p><strong>Status Kelulusan:</strong> <?php echo $siswa['status_kelulusan']; ?></p>
</body>
</html>
