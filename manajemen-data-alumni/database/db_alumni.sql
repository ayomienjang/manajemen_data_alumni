Langkah-Langkah Membuat database di xampp:

-- 1. Buat Database
CREATE DATABASE db_alumni;

-- 2. Gunakan Database tersebut
USE db_alumni;

-- Membuat tabel untuk akun (User & Admin)
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    jurusan ENUM('Rekayasa Perangkat Lunak', 'Animasi', 'Teknik Jaringan Akses Telekomunikasi', 'Teknik Komputer Dan Jaringan') NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user'
);
-- Membuat tabel untuk data alumni yang muncul di dashboard
CREATE TABLE alumni (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    angkatan YEAR NOT NULL,
    jurusan VARCHAR(100) NOT NULL)

    -- Mengisi data ke tabel Alumni
INSERT INTO alumni (nama, angkatan, jurusan) VALUES
('Bintang', 2025, 'Rekayasa Perangkat Lunak'),
('Raka Jawa', 2026, 'Rekayasa Perangkat Lunak'),
('Azni Lampung', 2026, 'Rekayasa Perangkat Lunak');

-- Mengisi data ke tabel Users
INSERT INTO users (username, password, role) VALUES
('user', 'user', 'user'),
('admin', 'admin', 'admin'),
('superadmin', 'superadmin', 'superadmin');

);