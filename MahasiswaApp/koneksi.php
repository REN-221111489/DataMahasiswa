<?php
$host = "localhost";
$user = "root";
$pass = "Rennn123";
$db   = "data_mahasiswa";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
