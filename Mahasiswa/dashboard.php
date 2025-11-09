<?php
session_start();
include 'koneksi.php';

$nim        = "";
$nama       = "";
$alamat     = "";
$fakultas   = "";
$sukses     = "";
$error      = "";

// Ambil statistik
$total_mahasiswa = 0;
$total_informatika = 0;
$total_bisnis = 0;
$total_kesehatan = 0;

$sql_stat = "SELECT 
                COUNT(*) AS total,
                SUM(CASE WHEN Fakultas='Informatika' THEN 1 ELSE 0 END) AS informatika,
                SUM(CASE WHEN Fakultas='Bisnis' THEN 1 ELSE 0 END) AS bisnis,
                SUM(CASE WHEN Fakultas='Kesehatan' THEN 1 ELSE 0 END) AS kesehatan
            FROM mahasiswa";
$result_stat = mysqli_query($conn, $sql_stat);
if ($row_stat = mysqli_fetch_assoc($result_stat)) {
    $total_mahasiswa = $row_stat['total'];
    $total_informatika = $row_stat['informatika'];
    $total_bisnis = $row_stat['bisnis'];
    $total_kesehatan = $row_stat['kesehatan'];
}

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

// DELETE
if ($op == 'delete') {
    $id = $_GET['id'];
    $sql1 = "DELETE FROM mahasiswa WHERE ID_Mahasiswa = '$id'";
    $q1 = mysqli_query($conn, $sql1);
    if ($q1) {
        $sukses = "Berhasil menghapus data";
    } else {
        $error = "Gagal menghapus data";
    }
}

// EDIT
if ($op == 'edit') {
    $id = $_GET['id'];
    $sql1 = "SELECT * FROM mahasiswa WHERE ID_Mahasiswa = '$id'";
    $q1 = mysqli_query($conn, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $nim      = $r1['NIM'];
    $nama     = $r1['Nama'];
    $alamat   = $r1['Alamat'];
    $fakultas = $r1['Fakultas'];

    if ($nim == '') {
        $error = "Data tidak ditemukan";
    }
}

// CREATE / UPDATE
if (isset($_POST['simpan'])) {
    $nim      = $_POST['nim'];
    $nama     = $_POST['nama'];
    $alamat   = $_POST['alamat'];
    $fakultas = $_POST['fakultas'];

    if ($nim && $nama && $alamat && $fakultas) {
        if ($op == 'edit') {
            $sql1 = "UPDATE mahasiswa SET 
                        NIM='$nim', 
                        Nama='$nama', 
                        Alamat='$alamat', 
                        Fakultas='$fakultas' 
                     WHERE ID_Mahasiswa='$id'";
            $q1 = mysqli_query($conn, $sql1);
            if ($q1) $sukses = "Data berhasil diupdate";
            else $error = "Data gagal diupdate";
        } else {
            $sql1 = "INSERT INTO mahasiswa (NIM, Nama, Alamat, Fakultas) 
                     VALUES ('$nim','$nama','$alamat','$fakultas')";
            $q1 = mysqli_query($conn, $sql1);
            if ($q1) $sukses = "Berhasil memasukkan data baru";
            else $error = "Gagal memasukkan data";
        }
    } else {
        $error = "Silakan isi semua data";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .mx-auto { width: 900px; margin-top: 30px; }
        .card { margin-top: 20px; }
        .stat-box {
            display: flex;
            gap: 15px;
            justify-content: space-between;
        }
        .stat-card {
            flex: 1;
            border-radius: 10px;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .bg-info { background-color: #0dcaf0; }
        .bg-success { background-color: #198754; }
        .bg-warning { background-color: #ffc107; }
        .bg-danger { background-color: #dc3545; }
        .search-box {
            margin-bottom: 15px;
            display: flex;
            justify-content: end;
            gap: 10px;
        }
    </style>
</head>
<body>
<div class="mx-auto">

    <!-- Statistik -->
    <div class="stat-box">
        <div class="stat-card bg-info">
            <h5>Total Mahasiswa</h5>
            <h2><?= $total_mahasiswa ?></h2>
        </div>
        <div class="stat-card bg-success">
            <h5>Informatika</h5>
            <h2><?= $total_informatika ?></h2>
        </div>
        <div class="stat-card bg-warning text-dark">
            <h5>Bisnis</h5>
            <h2><?= $total_bisnis ?></h2>
        </div>
        <div class="stat-card bg-danger">
            <h5>Kesehatan</h5>
            <h2><?= $total_kesehatan ?></h2>
        </div>
    </div>

    <!-- Form Input -->
    <div class="card">
        <div class="card-header bg-primary text-white">Tambah / Edit Data Mahasiswa</div>
        <div class="card-body">
            <?php if ($error) : ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <?php if ($sukses) : ?>
                <div class="alert alert-success"><?= $sukses ?></div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">NIM</label>
                    <input type="text" class="form-control" name="nim" value="<?= $nim ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" value="<?= $nama ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="alamat" value="<?= $alamat ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Fakultas</label>
                    <select class="form-control" name="fakultas">
                        <option value="">- Pilih Fakultas -</option>
                        <option value="Informatika" <?= ($fakultas == "Informatika") ? "selected" : "" ?>>Informatika</option>
                        <option value="Bisnis" <?= ($fakultas == "Bisnis") ? "selected" : "" ?>>Bisnis</option>
                        <option value="Kesehatan" <?= ($fakultas == "Kesehatan") ? "selected" : "" ?>>Kesehatan</option>
                    </select>
                </div>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="login.php" class="btn btn-secondary">Keluar</a>
            </form>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="card">
        <div class="card-header bg-secondary text-white">Data Mahasiswa</div>
        <div class="card-body">

            <!-- Search Bar -->
            <form method="GET" class="search-box">
                <input type="text" name="search" class="form-control w-25" placeholder="Cari Nama atau NIM..." 
                       value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                <button type="submit" class="btn btn-outline-primary">Cari</button>
                <a href="dashboard.php" class="btn btn-outline-secondary">Reset</a>
            </form>

            <?php
            // Query search
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            if ($search != '') {
                $sql2 = "SELECT * FROM mahasiswa 
                         WHERE Nama LIKE '%$search%' 
                         OR NIM LIKE '%$search%' 
                         ORDER BY ID_Mahasiswa DESC";
            } else {
                $sql2 = "SELECT * FROM mahasiswa ORDER BY ID_Mahasiswa DESC";
            }

            $q2 = mysqli_query($conn, $sql2);
            $jumlahData = mysqli_num_rows($q2);

            // Alert merah kalau tidak ada hasil
            if ($search != '' && $jumlahData == 0) {
                echo "<div class='alert alert-danger text-center'>⚠️ Data dengan kata kunci '<strong>" . htmlspecialchars($search) . "</strong>' tidak ditemukan!</div>";
            }
            ?>

            <table class="table table-bordered text-center">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Fakultas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($jumlahData > 0) {
                        while ($r2 = mysqli_fetch_array($q2)) :
                    ?>
                            <tr>
                                <td><?= $r2['ID_Mahasiswa'] ?></td>
                                <td><?= $r2['NIM'] ?></td>
                                <td><?= $r2['Nama'] ?></td>
                                <td><?= $r2['Alamat'] ?></td>
                                <td><?= $r2['Fakultas'] ?></td>
                                <td>
                                    <a href="dashboard.php?op=edit&id=<?= $r2['ID_Mahasiswa'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="dashboard.php?op=delete&id=<?= $r2['ID_Mahasiswa'] ?>" 
                                       onclick="return confirm('Yakin ingin menghapus data ini?')" 
                                       class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                    <?php
                        endwhile;
                    } else {
                        echo "<tr><td colspan='6'>Tidak ada data untuk ditampilkan.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>