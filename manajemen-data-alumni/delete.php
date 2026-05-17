<?php
session_start();
include 'koneksi.php';

// Proteksi admin: memastikan hanya yang sudah login admin bisa akses
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit;
}

// Cek apakah ada parameter 'id' yang dikirim lewat URL
if (isset($_GET['id'])) {
    // Ambil ID dan bersihkan (security)
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    // PERBAIKAN: Menggunakan kolom 'id' sesuai struktur database kamu
    $query = mysqli_query($koneksi, "DELETE FROM alumni WHERE id='$id'");

    if ($query) {
        // Jika berhasil, balik ke dashboard
        header("Location: dashboard_admin.php");
        exit();
    } else {
        // Jika query gagal (misal koneksi terputus)
        echo "Error Database: " . mysqli_error($koneksi);
    }
} else {
    // Jika akses file ini tanpa klik tombol hapus
    header("Location: dashboard_admin.php");
    exit();
}
?>