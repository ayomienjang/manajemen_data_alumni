<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit;
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$query = mysqli_query($koneksi, "SELECT * FROM alumni WHERE id='$id'");
$d = mysqli_fetch_assoc($query);

if(!$d){
    header("Location: dashboard_admin.php");
    exit;
}

if(isset($_POST['update'])){
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $angkatan = mysqli_real_escape_string($koneksi, $_POST['angkatan']);
    $jurusan = mysqli_real_escape_string($koneksi, $_POST['jurusan']);

    $update = mysqli_query($koneksi, "UPDATE alumni SET nama='$nama', angkatan='$angkatan', jurusan='$jurusan' WHERE id='$id'");

    if($update){
        echo "<script>alert('Data berhasil diperbarui!'); window.location='dashboard_admin.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Alumni | SMK Telkom</title>
    <link rel="stylesheet" href="style/index.css?v=<?= time(); ?>">
</head>
<body>

    <div class="login-card">
        <h2>Edit Data Alumni</h2>
        <p class="subtitle">Pilih tanggal untuk memperbarui data</p>

        <form method="POST">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" value="<?= $d['nama'] ?>" required>
            </div>
            
            <div class="form-group">
                <label>Angkatan (Pilih Tanggal)</label>
                <input type="date" name="angkatan" value="<?= $d['angkatan'] ?>" required>
            </div>

            <div class="form-group">
                <label>Jurusan</label>
                <select name="jurusan" required>
                    <option value="Rekayasa Perangkat Lunak" <?= $d['jurusan']=="Rekayasa Perangkat Lunak"?"selected":"" ?>>Rekayasa Perangkat Lunak</option>
                    <option value="Teknik Komputer dan Jaringan" <?= $d['jurusan']=="Teknik Komputer dan Jaringan"?"selected":"" ?>>Teknik Komputer dan Jaringan</option>
                    <option value="Animasi" <?= $d['jurusan']=="Animasi"?"selected":"" ?>>Animasi</option>
                    <option value="Teknik Jaringan Akses Telekomunikasi" <?= $d['jurusan']=="Teknik Jaringan Akses Telekomunikasi"?"selected":"" ?>>Teknik Jaringan Akses Telekomunikasi</option>
                </select>
            </div>

            <div class="button-group">
                <button type="submit" name="update" class="btn-primary">Simpan Perubahan</button>
                <a href="dashboard_admin.php" class="btn-batal">Batal</a>
            </div>
        </form>
    </div>

</body>
</html>