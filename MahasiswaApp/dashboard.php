<?php
session_start();
include 'koneksi.php';

// Ambil data mahasiswa
$sql = "SELECT * FROM mahasiswa ORDER BY ID_Mahasiswa DESC";
$result = $conn->query($sql);

// Hitung statistik
$stat = $conn->query("
    SELECT 
        COUNT(*) AS total,
        SUM(CASE WHEN Fakultas='Informatika' THEN 1 ELSE 0 END) AS informatika,
        SUM(CASE WHEN Fakultas='Bisnis' THEN 1 ELSE 0 END) AS bisnis,
        SUM(CASE WHEN Fakultas='Kesehatan' THEN 1 ELSE 0 END) AS kesehatan
    FROM mahasiswa
")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<link rel="stylesheet" href="style.css">
<head>
<meta charset="UTF-8">
<title>Dashboard Mahasiswa</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container mt-4">
    <h3 class="mb-4 text-primary text-center">Dashboard Data Mahasiswa</h3>

    <!-- Statistik -->
    <div class="row text-center mb-4">
        <div class="col bg-info text-white p-3 rounded me-2">Total: <?= $stat['total'] ?></div>
        <div class="col bg-success text-white p-3 rounded me-2">Informatika: <?= $stat['informatika'] ?></div>
        <div class="col bg-warning text-dark p-3 rounded me-2">Bisnis: <?= $stat['bisnis'] ?></div>
        <div class="col bg-danger text-white p-3 rounded">Kesehatan: <?= $stat['kesehatan'] ?></div>
    </div>

    <!-- Tombol Tambah -->
    <div class="d-flex justify-content-between mb-3">
        <a href="tambah.php" class="btn btn-success">Tambah Data</a>
        <a href="login.php" class="btn btn-secondary">Keluar</a>
    </div>

    <!-- 🔍 Kolom Pencarian -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <input
            type="text"
            id="searchInput"
            class="form-control search-box"
            placeholder="Cari data mahasiswa (NIM / Nama)..."
        />
    </div>


    <!-- Tabel Data -->
    <table class="table table-bordered text-center">
        <thead class="table-secondary">
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
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['ID_Mahasiswa'] ?></td>
                <td><?= $row['NIM'] ?></td>
                <td><?= $row['Nama'] ?></td>
                <td><?= $row['Alamat'] ?></td>
                <td><?= $row['Fakultas'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['ID_Mahasiswa'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus.php?id=<?= $row['ID_Mahasiswa'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script src="interaksi.js"></script>
</body>
</html>
