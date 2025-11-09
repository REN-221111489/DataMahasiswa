<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = $conn->query("SELECT * FROM mahasiswa WHERE ID_Mahasiswa = '$id'")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $fakultas = $_POST['fakultas'];
    $conn->query("UPDATE mahasiswa SET NIM='$nim', Nama='$nama', Alamat='$alamat', Fakultas='$fakultas' WHERE ID_Mahasiswa='$id'");
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<link rel="stylesheet" href="style.css">
<head>
<meta charset="UTF-8">
<title>Edit Data</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3 class="text-primary">Edit Data Mahasiswa</h3>
    <form method="POST">
        <div class="mb-3">
            <label>NIM</label>
            <input type="text" class="form-control" name="nim" value="<?= $data['NIM'] ?>">
        </div>
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama" value="<?= $data['Nama'] ?>">
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" class="form-control" name="alamat" value="<?= $data['Alamat'] ?>">
        </div>
        <div class="mb-3">
            <label>Fakultas</label>
            <select class="form-select" name="fakultas">
                <option value="Informatika" <?= ($data['Fakultas'] == 'Informatika') ? 'selected' : '' ?>>Informatika</option>
                <option value="Bisnis" <?= ($data['Fakultas'] == 'Bisnis') ? 'selected' : '' ?>>Bisnis</option>
                <option value="Kesehatan" <?= ($data['Fakultas'] == 'Kesehatan') ? 'selected' : '' ?>>Kesehatan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="dashboard.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
<script src="interaksi.js"></script>
</body>
</html>
