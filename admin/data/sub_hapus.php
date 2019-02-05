<?php
include 'koneksi.php';

$id = $_GET['id'];

$koneksi->query("DELETE FROM sub_kategori WHERE sub_id='$id'");

echo "<script>alert('Sub kategori terhapus');</script>";
echo "<script>location='index.php?halaman=kategori';</script>";

?>