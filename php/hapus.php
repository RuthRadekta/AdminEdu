<?php
// Menghubungkan ke database
include '../config/koneksi.php';

// Logika untuk menghapus data mahasiswa berdasarkan ID yang dipilih
$id = $_GET['id'];
$hapus = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id='$id'");
if ($hapus) {
    header("Location: ../pages/admin.php");
    exit;
} else {
    echo "Gagal menghapus data.";
}
?>