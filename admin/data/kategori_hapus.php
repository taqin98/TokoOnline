<?php
include 'koneksi.php';

$id = $_GET['id'];

$sql = $koneksi->query("SELECT * FROM sub_kategori WHERE kategori_id='$id'");
$sub = $sql->fetch_assoc();

if ($sub['kategori_id'] == $id) {

	$koneksi->query("DELETE FROM sub_kategori WHERE kategori_id='$id'");
}

$koneksi->query("DELETE FROM kategori WHERE kategori_id='$id'");

echo "<script>alert('kategori terhapus');</script>";
echo "<script>location='index.php?halaman=kategori';</script>";

?>