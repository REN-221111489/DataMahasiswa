<?php
$host = "localhost";
$user = "root"; // ganti kalau kamu pakai user lain di Workbench
$pass = "Rennn123";     // isi password MySQL kamu di sini
$db   = "data_mahasiswa";

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>