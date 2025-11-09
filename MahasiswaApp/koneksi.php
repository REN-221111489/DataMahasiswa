<?php
$host = "db"; // nama service dari docker-compose
$user = "root";
$pass = "root";
$db   = "data_mahasiswa";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

