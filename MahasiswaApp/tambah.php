<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $fakultas = $_POST['fakultas'];

    if ($nim && $nama && $alamat && $fakultas) {
        $sql = "INSERT INTO mahasiswa (NIM, Nama, Alamat, Fakultas)
                VALUES ('$nim', '$nama', '$alamat', '$fakultas')";
        $conn->query($sql);
    }
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<link rel="stylesheet" href="style.css">
<head>
<meta charset="UTF-8">
<title>Tambah Data</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3 class="text-primary">Tambah Data Mahasiswa</h3>
    <form method="POST">
        <div class="mb-3">
            <label>NIM</label>
            <input type="text" class="form-control" name="nim" required>
        </div>
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" class="form-control" name="alamat" required>
        </div>
        <div class="mb-3">
            <label>Fakultas</label>
            <select class="form-select" name="fakultas" required>
                <option value="">Pilih Fakultas</option>
                <option value="Informatika">Informatika</option>
                <option value="Bisnis">Bisnis</option>
                <option value="Kesehatan">Kesehatan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="dashboard.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
<script src="interaksi.js"></script>
</body>
</html>
