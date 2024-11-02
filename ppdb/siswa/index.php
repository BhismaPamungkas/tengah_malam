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
    <title>Dashboard Siswa</title>
</head>
<body>
    <h2>Selamat datang, <?php echo $siswa['nama']; ?>!</h2>
    <p>Status Verifikasi: <?php echo $siswa['status_verifikasi']; ?></p>
    <p>Status Kelulusan: <?php echo $siswa['status_kelulusan']; ?></p>
    
    <h3>Informasi Pendaftaran</h3>
    <p><strong>Nama:</strong> <?php echo $siswa['nama']; ?></p>
    <p><strong>NISN:</strong> <?php echo $siswa['nisn']; ?></p>
    <p><strong>Email:</strong> <?php echo $siswa['email']; ?></p>

    <a href="cetak.php" target="_blank">Cetak Bukti Pendaftaran</a>
</body>
</html>
