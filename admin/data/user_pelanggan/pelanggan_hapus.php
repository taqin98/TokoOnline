<?php
include 'koneksi.php';

$id = $_GET['id'];

$koneksi->query("DELETE FROM pelanggan WHERE id_pelanggan='$id'");

echo "<script>alert('User Pelanggan terhapus');</script>";
echo "<script>location='index.php?halaman=pelanggan';</script>";

?>