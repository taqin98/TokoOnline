<h2>Ubah Produk</h2>
<?php
$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah= $ambil->fetch_assoc();

echo "<pre>";
print_r($pecah);
echo "</pre>";
?>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Produk</label>
		<input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Harga Produk</label>
		<input type="number" name="harga" class="form-control" value="<?php echo $pecah['harga_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Jenis</label>
		<input type="text" name="jenis" class="form-control" value="<?php echo $pecah['jenis']; ?>">
	</div>
	<div class="form-group">
		<label>Brand</label>
		<input type="text" name="brand" class="form-control" value="<?php echo $pecah['brand']; ?>">
	</div>
	<div class="form-group">
		<img src="../foto_produk/<?php echo $pecah['foto_produk'] ?>" width="200">
	</div>
	<div class="form-group">
		<label>Ganti produk</label>
		<input type="file" name="brand" class="form-control">
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea name="brand" class="form-control" rows="10"> 
		<?php echo $pecah['deskripsi_produk']; ?>
		</textarea>
	</div>
	<button class="btn btn-primary" name="ubah">Ubah</button>
</form>	


<?php
if (isset($_POST['ubah']))
{
	$namafoto=$_FILES['foto']['name'];
	$lokasifoto = $_FILES['foto']['tmp_name'];
	//jk foto diubah
	if (!empty($lokasifoto))
	{
		move_uploaded_file($lokasifoto, "../foto_produk/.$namafoto");
		
		$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',
		harga_produk='$_POST[harga]',jenis='$_POST[jenis]',brand'$_POST[brand]',
		foto_produk='$_namafoto',deskripsi_produk='$_POST[deskripsi]'
		WHERE id_produk='$_GET[id]'");
	}
	else
	{
		$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',
		harga_produk='$_POST[harga]',jenis='$_POST[jenis]',brand'$_POST[brand]',
		deskripsi_produk='$_POST[deskripsi]' WHERE id_produk='$_GET[id]'");
	}
	echo "<script>alert('Data telah diubah');</script>";
	echo "<script>location='index.php?halaman=produk';</script>";
}
?>