<?php
// Menghubungkan ke database
include '../config/koneksi.php';

// Logika untuk menyimpan data mahasiswa baru ke database ketika form disubmit
if (isset($_POST['simpan'])) {
    $nim = $_POST['nim']; $nama = $_POST['nama']; $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir']; $gender = $_POST['gender']; $usia = $_POST['usia'];

    $insert = mysqli_query($koneksi, "INSERT INTO mahasiswa (nim, nama, alamat, tanggal_lahir, gender, usia) VALUES ('$nim', '$nama', '$alamat', '$tanggal_lahir', '$gender', '$usia')");
    if ($insert) { header("Location: ../pages/admin.php"); exit; }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Data | Admin</title>
    <!--Library Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light align-items-center d-flex min-vh-100 py-5">
    <!--Form untuk menambah data baru-->
    <div class="container">
        <div class="form-container">
            <h3 class="fw-bold text-center mb-4">Tambah Data Mahasiswa</h3>
            <form method="POST" action="">
                <div class="row g-3">
                    <!--Kolom NIM-->
                    <div class="col-md-6">
                        <label class="form-label fw-medium text-muted small">NIM</label>
                        <input type="text" name="nim" class="form-control" required>
                    </div>
                    <!--Kolom Usia-->
                    <div class="col-md-6">
                        <label class="form-label fw-medium text-muted small">Usia</label>
                        <input type="number" name="usia" class="form-control" required>
                    </div>
                    <!--Kolom Nama-->
                    <div class="col-12">
                        <label class="form-label fw-medium text-muted small">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <!--Kolom Alamat-->
                    <div class="col-12">
                        <label class="form-label fw-medium text-muted small">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control" rows="3" required></textarea>
                    </div>
                    <!--Kolom Tanggal Lahir-->
                    <div class="col-md-6">
                        <label class="form-label fw-medium text-muted small">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" required>
                    </div>
                    <!--Navbar-->
                    <div class="col-md-6">
                        <label class="form-label fw-medium text-muted small">Jenis Kelamin</label>
                        <select name="gender" class="form-select" required>
                            <option value="" selected disabled>Pilih...</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>
                <!--Pilihan tombol untuk kembali atau simpan-->
                <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                    <a href="../pages/admin.php" class="btn btn-light px-4">Kembali</a>
                    <button type="submit" name="simpan" class="btn btn-primary px-5">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>