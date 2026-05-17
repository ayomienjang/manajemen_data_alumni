<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin | Manajemen Alumni</title>
    <link rel="stylesheet" href="style/dashboard.css?v=<?= time(); ?>">
</head>
<body>

<div class="main-wrapper">
    <header>
        <div class="nav-container">
            <div class="role-label">ADMIN</div>
            
            <h2>Manajemen Data Alumni</h2>
            
            <div class="user-menu" style="display: flex; align-items: center; gap: 15px;">
                <span class="welcome-text" style="color: white; font-size: 15px; font-weight: bold;">Hi Admin</span>
                <a class="logout" href="logout.php">Logout</a>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Daftar Alumni</h3>
                <div class="header-actions">
                    <form action="" method="GET">
                        <input type="text" name="cari" class="search-input" placeholder="Search nama..." value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
                    </form>
                    <a href="tambah.php" class="tambah">+ Tambah Data</a>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Angkatan</th>
                        <th>Jurusan</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $cari = isset($_GET['cari']) ? mysqli_real_escape_string($koneksi, $_GET['cari']) : '';
                    $query = $cari != '' ? "SELECT * FROM alumni WHERE nama LIKE '%$cari%'" : "SELECT * FROM alumni";
                    $data = mysqli_query($koneksi, $query);

                    if(mysqli_num_rows($data) > 0){
                        while($d = mysqli_fetch_array($data)){
                            echo "<tr>
                                    <td>".$no++."</td>
                                    <td>".$d['nama']."</td>
                                    <td>".$d['angkatan']."</td>
                                    <td>".$d['jurusan']."</td>
                                    <td align='center'>
                                        <a href='edit.php?id=".$d['id']."' class='edit'>Edit</a>
                                        <a href='delete.php?id=".$d['id']."' class='hapus' onclick='return confirm(\"Hapus data?\")'>Hapus</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' align='center' style='padding: 30px;'>Data tidak ditemukan</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<footer>
    &copy; 2026 BY AYOMI ENJANG UTAMI - All Rights Reserved
</footer>

</body>
</html>