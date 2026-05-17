<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $user = mysqli_real_escape_string($koneksi, $_POST['username']);
    $pass = $_POST['password'];
    
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$user'");
    
    if (mysqli_num_rows($query) === 1) {
        $row = mysqli_fetch_assoc($query);
        
        // Cek password (bisa teks biasa seperti 'admin' atau hash acak)
        if ($pass === $row['password'] || password_verify($pass, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['nama']  = $row['nama'];
            $_SESSION['role']  = trim($row['role']);

            if ($_SESSION['role'] == 'admin') {
                header("Location: dashboard_admin.php");
            } else {
                header("Location: dashboard_user.php");
            }
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Sistem | SMK Telkom</title>
    <link rel="stylesheet" href="style/index.css?v=<?php echo time(); ?>">
</head>
<body>

    <div class="login-card">
        <div class="logo-container">
            <img src="assets/telkom.png" alt="Logo SMK Telkom">
        </div>

        <h2>Manajemen Data Alumni</h2>
        <p class="subtitle">SMK Telkom Lampung</p>
        
        <?php if (isset($error)) : ?>
            <div style="color: #f04747; background: #fee2e2; padding: 10px; border-radius: 8px; font-size: 13px; margin-bottom: 15px; text-align: center;">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan username" required>
            </div>
            
            <div class="form-group">
                <label>Kata Sandi</label>
                <input type="password" name="password" placeholder="Masukkan password" required>
            </div>
            
            <button type="submit" name="login" class="btn-primary">Masuk Sekarang</button>
        </form>
        
        <div class="footer-text">
            Belum punya akun? <a href="register.php">Daftar di sini</a>
        </div>
    </div>

</body>
</html>