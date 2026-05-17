<?php
// host, user, password, nama_database
$koneksi = mysqli_connect("localhost", "root", "", "db_alumni");

if (!$koneksi) {
    die("Gagal terhubung ke database: " . mysqli_connect_error());
}
?>