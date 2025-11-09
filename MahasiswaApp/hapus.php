<?php
include 'koneksi.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM mahasiswa WHERE ID_Mahasiswa='$id'");
}
header("Location: dashboard.php");
exit;
?>
