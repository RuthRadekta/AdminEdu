<?php
// File untuk menyambungkan ke database
$host = "localhost";
$user = "root";
$pass = ""; // Default XAMPP
$db   = "db_siswa"; // Nama database yang digunakan

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>