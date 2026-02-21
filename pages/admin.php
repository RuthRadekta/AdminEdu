<?php
// Menghubungkan ke database
include '../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | UNS</title>
    <!--Library Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4" style="background-color: #0d6efd !important;">
        <div class="container">
            <span class="navbar-brand fw-bold">Admin Panel UNS</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarAdmin">
                <ul class="navbar-nav ms-auto mt-3 mt-lg-0">
                    <li class="nav-item">
                        <a href="../index.php" class="btn btn-outline-light btn-sm rounded-pill px-3 w-100">Lihat Halaman Depan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--Konten-->
    <div class="container pb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0">Kelola Data Mahasiswa</h3>
                <small class="text-muted">Manajemen CRUD data mahasiswa</small>
            </div>
            <a href="../php/tambah.php" class="btn btn-primary rounded-pill px-4 shadow-sm">+ Tambah Data</a>
        </div>

        <!--Tabel untuk menampilkan data mahasiswa-->
        <div class="table-wrapper">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th><th>NIM</th><th>Nama</th><th>Alamat</th><th>Lahir</th><th>Gender</th><th>Usia</th><th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Logika untuk menampilkan data mahasiswa, dengan urutan DESC berdasarkan NIM terbesar
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY nim DESC");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><span class="badge bg-secondary"><?= $data['nim'] ?></span></td>
                            <td class="fw-medium"><?= $data['nama'] ?></td>
                            <td><?= $data['alamat'] ?></td>
                            <td><?= date('d/m/Y', strtotime($data['tanggal_lahir'])) ?></td>
                            <td><?= $data['gender'] ?></td>
                            <td><?= $data['usia'] ?></td>
                            <td class="text-center">
                                <a href="../php/edit.php?id=<?= $data['id'] ?>" class="btn btn-warning btn-sm px-3 rounded-pill">Edit</a>
                                <a href="../php/hapus.php?id=<?= $data['id'] ?>" class="btn btn-danger btn-sm px-3 rounded-pill" onclick="return confirm('Yakin ingin menghapus <?= $data['nama'] ?>?')">Hapus</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>