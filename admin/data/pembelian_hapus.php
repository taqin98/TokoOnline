<?php
include 'koneksi.php';
$idpembelian = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$foto = $pecah['bukti'];

if (file_exists("../pages/bukti/$foto"))
{
	unlink("../pages/bukti/$foto");
}

$koneksi->query("DELETE FROM pembelian_produk WHERE id_pembelian='$_GET[id]'");
$koneksi->query("DELETE FROM pembelian WHERE id_pembelian='$_GET[id]'");

echo "<script>alert('pembelian produk terhapus');</script>";
echo "<script>location='index.php?halaman=pembelian';</script>";

?>