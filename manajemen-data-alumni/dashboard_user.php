<?php
session_start();
include 'koneksi.php';

// Cek status login
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User | Manajemen Alumni</title>
    <link rel="stylesheet" href="style/dashboard.css?v=<?php echo time(); ?>">
</head>
<body>

<div class="main-wrapper">
    <header>
        <div class="nav-container" style="display: flex; justify-content: space-between; align-items: center; max-width: 1400px; margin: auto; width: 100%;">
            <div style="flex: 1; display: flex; justify-content: flex-start;">
                <div class="role-label">USER</div>
            </div>

            <h2 style="font-size: 22px; text-align: center; margin: 0; white-space: nowrap;">Manajemen Data Alumni</h2>
            
            <div style="flex: 1; display: flex; justify-content: flex-end;">
                <div class="user-menu" style="display: flex; align-items: center; gap: 15px;">
                    <span class="welcome-text" style="color: white; font-size: 15px; font-weight: bold;">
                        Welcome to <?php 
                            if (isset($_SESSION['nama'])) {
                                $nama_lengkap = $_SESSION['nama'];
                                $pecah_nama = explode(" ", $nama_lengkap);
                                echo $pecah_nama[0]; // Hanya menampilkan nama depan
                            } else {
                                echo 'User';
                            }
                        ?> 👋
                    </span>
                    <a class="logout" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Data Alumni</h3>
                <div class="header-actions">
                    <form action="" method="GET">
                        <input type="text" name="cari" class="search-input" placeholder="Cari nama atau jurusan..." value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
                    </form>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Angkatan</th>
                        <th>Jurusan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    // Logika pencarian data tetap dipertahankan
                    if(isset($_GET['cari'])){
                        $cari = mysqli_real_escape_string($koneksi, $_GET['cari']);
                        $query = "SELECT * FROM alumni WHERE nama LIKE '%$cari%' OR jurusan LIKE '%$cari%'";
                    } else {
                        $query = "SELECT * FROM alumni";
                    }

                    $data = mysqli_query($koneksi, $query);

                    if(mysqli_num_rows($data) > 0){
                        while($d = mysqli_fetch_array($data)){
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['nama']; ?></td>
                            <td><?php echo $d['angkatan']; ?></td>
                            <td><?php echo $d['jurusan']; ?></td>
                        </tr>
                    <?php 
                        }
                    } else {
                        echo "<tr><td colspan='4' style='text-align:center; padding: 30px;'>Data tidak ditemukan</td></tr>";
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