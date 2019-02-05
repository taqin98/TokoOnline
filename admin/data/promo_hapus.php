<?php
include 'koneksi.php';
$ambil = $koneksi->query("SELECT * FROM promo WHERE id='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$foto = $pecah['foto'];
if (file_exists("../pages/promo/$foto"))
{
	unlink("../pages/promo/$foto");
}

$koneksi->query("DELETE FROM promo WHERE id='$_GET[id]'");

echo "<script>alert('promo terhapus');</script>";
echo "<script>location='index.php?halaman=promo';</script>";

?>