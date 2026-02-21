<?php
// Menghubungkan ke database
include '../config/koneksi.php';

// Logika untuk mengambil data mahasiswa berdasarkan ID yang dipilih dan menyimpan perubahan ketika form disubmit
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

// Logika untuk menyimpan perubahan data mahasiswa ke database ketika form disubmit
if (isset($_POST['update'])) {
    $nama = $_POST['nama']; $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir']; $gender = $_POST['gender']; $usia = $_POST['usia'];

    $update = mysqli_query($koneksi, "UPDATE mahasiswa SET nama='$nama', alamat='$alamat', tanggal_lahir='$tanggal_lahir', gender='$gender', usia='$usia' WHERE id='$id'");
    if ($update) { header("Location: ../pages/admin.php"); exit; }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Data | Admin</title>
    <!--Library Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light align-items-center d-flex min-vh-100 py-5">
    <!--Form untuk mengedit data yang sudah ada-->
    <div class="container">
        <div class="form-container">
            <h3 class="fw-bold text-center mb-4">Edit Data Mahasiswa</h3>
            <form method="POST" action="">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-medium text-muted small">NIM</label>
                        <!--Kolom NIM diset agar tidak bisa diubah-->
                        <input type="text" name="nim" class="form-control bg-light text-secondary" value="<?= $data['nim'] ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium text-muted small">Usia</label>
                        <input type="number" name="usia" class="form-control" value="<?= $data['usia'] ?>" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-medium text-muted small">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-medium text-muted small">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control" rows="3" required><?= $data['alamat'] ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium text-muted small">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="<?= $data['tanggal_lahir'] ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium text-muted small">Jenis Kelamin</label>
                        <select name="gender" class="form-select" required>
                            <option value="Laki-laki" <?= ($data['gender'] == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="Perempuan" <?= ($data['gender'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                    <a href="../pages/admin.php" class="btn btn-light px-4">Batal</a>
                    <button type="submit" name="update" class="btn btn-warning px-5 fw-medium text-dark">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>