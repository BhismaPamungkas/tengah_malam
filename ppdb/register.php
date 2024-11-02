<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = secure($_POST['username']);
    $password = md5(secure($_POST['password']));
    $nama = secure($_POST['nama']);
    $nisn = secure($_POST['nisn']);
    $alamat = secure($_POST['alamat']);
    $tanggal_lahir = secure($_POST['tanggal_lahir']);
    $email = secure($_POST['email']);
    $telepon = secure($_POST['telepon']);

    // File upload handling
    $foto = $_FILES['foto'];
    $kk = $_FILES['kk'];
    $ijazah = $_FILES['ijazah'];

    $foto_new = 'foto_' . time() . '_' . $foto['name'];
    $kk_new = 'kk_' . time() . '_' . $kk['name'];
    $ijazah_new = 'ijazah_' . time() . '_' . $ijazah['name'];

    move_uploaded_file($foto['tmp_name'], 'uploads/foto/' . $foto_new);
    move_uploaded_file($kk['tmp_name'], 'uploads/kk/' . $kk_new);
    move_uploaded_file($ijazah['tmp_name'], 'uploads/ijazah/' . $ijazah_new);

    // Insert user
    $conn->query("INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'siswa')");
    $user_id = $conn->insert_id;

    // Insert calon_siswa data
    $conn->query("INSERT INTO calon_siswa (user_id, nama, nisn, alamat, tanggal_lahir, email, telepon, foto, kk, ijazah) 
                  VALUES ('$user_id', '$nama', '$nisn', '$alamat', '$tanggal_lahir', '$email', '$telepon', '$foto_new', '$kk_new', '$ijazah_new')");

    echo "Pendaftaran berhasil! Silakan login.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registrasi Calon Siswa</title>
</head>
<body>
    <h2>Form Registrasi Calon Siswa</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        
        <label>Password:</label>
        <input type="password" name="password" required><br>
        
        <label>Nama Lengkap:</label>
        <input type="text" name="nama" required><br>
        
        <label>NISN:</label>
        <input type="text" name="nisn" required><br>
        
        <label>Alamat:</label>
        <textarea name="alamat" required></textarea><br>
        
        <label>Tanggal Lahir:</label>
        <input type="date" name="tanggal_lahir" required><br>
        
        <label>Email:</label>
        <input type="email" name="email" required><br>
        
        <label>Telepon:</label>
        <input type="text" name="telepon" required><br>

        <label>Foto:</label>
        <input type="file" name="foto" required><br>
        
        <label>File KK:</label>
        <input type="file" name="kk" required><br>

        <label>Ijazah:</label>
        <input type="file" name="ijazah" required><br>
        
        <button type="submit">Daftar</button>
    </form>
</body>
</html>
