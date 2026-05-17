<?php
include 'koneksi.php';

if (isset($_POST['register'])) {
    // Ambil data dari form sesuai urutan baru
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']); 
    $user = mysqli_real_escape_string($koneksi, $_POST['username']);
    $jurusan = mysqli_real_escape_string($koneksi, $_POST['jurusan']); 
    $angkatan = mysqli_real_escape_string($koneksi, $_POST['angkatan']); // Mengambil data angkatan dari input text
    $pass = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi'];

    // 1. Cek apakah username sudah dipakai
    $cek_user = mysqli_query($koneksi, "SELECT username FROM users WHERE username = '$user'");
    
    if (mysqli_num_rows($cek_user) > 0) {
        echo "<script>alert('Gagal! Username sudah terdaftar.'); window.history.back();</script>";
    } 
    // 2. Cek apakah password cocok
    else if ($pass !== $konfirmasi) {
        echo "<script>alert('Konfirmasi kata sandi tidak cocok!'); window.history.back();</script>";
    } 
    else {
        $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
        
        // Simpan ke tabel users
        $query_users = "INSERT INTO users (nama, username, jurusan, password, role) 
                        VALUES ('$nama', '$user', '$jurusan', '$pass_hash', 'user')";
        
        // Simpan ke tabel alumni menggunakan variabel $angkatan yang diinput user
        $query_alumni = "INSERT INTO alumni (nama, angkatan, jurusan) 
                         VALUES ('$nama', '$angkatan', '$jurusan')";

        $simpan_user = mysqli_query($koneksi, $query_users);
        $simpan_alumni = mysqli_query($koneksi, $query_alumni);

        if ($simpan_user && $simpan_alumni) {
            echo "<script>alert('Berhasil daftar!'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Gagal mendaftar!');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <link rel="stylesheet" href="style/index.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="login-card">
        <div class="logo-container">
            <img src="assets/telkom.png" alt="Logo">
        </div>
        <h2>Daftar Akun</h2>
        <p class="subtitle">SMK Telkom Lampung</p>

        <form method="POST">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Buat username unik" required>
            </div>

            <div class="form-group">
                <label>Jurusan</label>
                <select name="jurusan" required>
                    <option value="" disabled selected>Pilih Jurusan</option>
                    <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                    <option value="Animasi">Animasi</option>
                    <option value="Teknik Jaringan Akses Telekomunikasi">Teknik Jaringan Akses Telekomunikasi</option>
                    <option value="Teknik Komputer Dan Jaringan">Teknik Komputer Dan Jaringan</option>
                </select>
            </div>

            <div class="form-group">
                <label>Angkatan</label>
                <input type="text" name="angkatan" placeholder="Masukkan tahun angkatan" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••" required>
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="konfirmasi" placeholder="Ulangi password" required>
            </div>

            <button type="submit" name="register" class="btn-primary">Buat Akun Sekarang</button>
        </form>
        
        <div class="footer-text">
            Sudah punya akun? <a href="login.php">Masuk di sini</a>
        </div>
    </div>
</body>
</html>