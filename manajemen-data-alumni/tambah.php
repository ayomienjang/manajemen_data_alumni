<?php
session_start();
include 'koneksi.php';

// Pastikan hanya admin yang bisa akses
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit;
}

if(isset($_POST['simpan'])){
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $angkatan = $_POST['angkatan'];
    $jurusan = $_POST['jurusan'];

    // Menyesuaikan kolom tabel (id, nama, angkatan, jurusan)
    mysqli_query($koneksi,"INSERT INTO alumni VALUES(NULL,'$nama','$angkatan','$jurusan')");
    header("Location: dashboard_admin.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Alumni</title>
    <link rel="stylesheet" href="style/tambah.css?v=<?php echo time(); ?>">
</head>
<body>

<div class="box">
    <h2>Tambah Data Alumni</h2>
    <p style="color: #666; font-size: 14px; margin-bottom: 25px;">Masukkan data alumni dengan benar</p>

    <form method="POST">
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" placeholder="Masukkan Nama" required>
        </div>
        
        <div class="form-group">
            <label>Angkatan (Pilih Tanggal)</label>
            <input type="date" name="angkatan" required>
        </div>

        <div class="form-group">
            <label>Jurusan</label>
            <select name="jurusan" required>
                <option value="" disabled selected>Pilih Jurusan</option>
                <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                <option value="Teknik Komputer Dan Jaringan">Teknik Komputer Dan Jaringan</option>
                <option value="Teknik Jaringan Akses Telekomunikasi">Teknik Jaringan Akses Telekomunikasi</option>
                <option value="ANIMASI">ANIMASI</option>
            </select>
        </div>

        <div class="button-group">
            <button type="submit" name="simpan" class="btn-save">Simpan Data</button>
            <a href="dashboard_admin.php" class="btn-cancel">Kembali</a>
        </div>
    </form>
</div>

</body>
</html>