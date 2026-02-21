<?php
// Menghubungkan ke database
include 'config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beranda</title>
    <!--Library Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">UNS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHome">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarHome">
                <ul class="navbar-nav ms-auto mt-3 mt-lg-0">
                    <li class="nav-item">
                        <a href="pages/admin.php" class="btn btn-light btn-sm fw-semibold text-primary px-3 rounded-pill w-100">Masuk Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--Konten-->
    <div class="container pb-5">
        <div class="mb-4">
            <h2 class="fw-bold">Data Mahasiswa</h2>
            <p class="text-muted">Rekapitulasi dan direktori data mahasiswa terdaftar.</p>
        </div>

        <!--Baris Pertama: Data statistik jumlah-->
        <div class="row g-3 mb-4">
            <?php
            // Query untuk menghitung total mahasiswa, laki-laki, dan perempuan
            $q_total = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM mahasiswa");
            $total = mysqli_fetch_assoc($q_total)['total'];

            $q_l = mysqli_query($koneksi, "SELECT COUNT(*) AS total_l FROM mahasiswa WHERE gender='Laki-laki'");
            $total_l = mysqli_fetch_assoc($q_l)['total_l'];

            $q_p = mysqli_query($koneksi, "SELECT COUNT(*) AS total_p FROM mahasiswa WHERE gender='Perempuan'");
            $total_p = mysqli_fetch_assoc($q_p)['total_p'];
            ?>
            <div class="col-md-4">
                <div class="card card-custom bg-primary text-white h-100 p-3">
                    <div class="stat-title">Total Mahasiswa</div>
                    <div class="stat-value"><?= $total ?></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom bg-success text-white h-100 p-3">
                    <div class="stat-title">Laki-laki</div>
                    <div class="stat-value"><?= $total_l ?></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom bg-warning text-dark h-100 p-3">
                    <div class="stat-title">Perempuan</div>
                    <div class="stat-value"><?= $total_p ?></div>
                </div>
            </div>
        </div>

        <!--Baris kedua: Pencarian-->
        <div class="table-wrapper">
            <form method="GET" action="index.php" class="mb-4 d-flex">
                <input type="text" name="cari" class="form-control me-2" placeholder="Cari berdasarkan nama..." value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
                <button type="submit" class="btn btn-primary px-4">Cari</button>
                <?php if(isset($_GET['cari']) && $_GET['cari'] != ''): ?>
                    <a href="index.php" class="btn btn-outline-danger ms-2">Reset</a>
                <?php endif; ?>
            </form>

            <!--Tabel data-->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th><th>NIM</th><th>Nama</th><th>Alamat</th><th>Tanggal Lahir</th><th>Gender</th><th>Usia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Logika untuk menampilkan data mahasiswa, dengan fitur pencarian berdasarkan nama
                        $no = 1;
                        if (isset($_GET['cari'])) {
                            $cari = $_GET['cari'];
                            $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nama LIKE '%$cari%' ORDER BY id DESC");
                        } else {
                            $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY nim DESC");
                        }

                        if(mysqli_num_rows($query) > 0) {
                            while ($data = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><span class="badge bg-secondary"><?= $data['nim'] ?></span></td>
                            <td class="fw-medium"><?= $data['nama'] ?></td>
                            <td><?= $data['alamat'] ?></td>
                            <td><?= date('d M Y', strtotime($data['tanggal_lahir'])) ?></td>
                            <td><?= $data['gender'] ?></td>
                            <td><?= $data['usia'] ?> Thn</td>
                        </tr>
                        <?php
                            }
                        // Jika tidak ada data yang ditemukan berdasarkan pencarian
                        } else {
                            echo "<tr><td colspan='7' class='text-center py-4 text-muted'>Data tidak ditemukan</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>