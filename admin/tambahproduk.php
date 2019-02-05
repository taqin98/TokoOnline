<h2>Tambah Produk</h2>

<form method="post" enctype="multipart/form-data">
	<div class="from-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama">
	</div>
	<div class="from-group">
		<label>Harga</label>
		<input type="number" class="form-control" name="harga">
	</div>
	<div class="from-group">
		<label>Jenis</label>
		<input type="text" class="form-control" name="jenis">
	</div>
	<div class="from-group">
		<label>Brand</label>
		<input type="text" class="form-control" name="brand">
	</div>
	<div class="from-group">
		<label>Deskripsi</label>
		<textarea class="form-control" name="deskripsi" rows="10"></textarea>
	</div>
	<div class="from-group">
		<label>Foto</label>
		<input type="file" class="form-control" name="foto">
	</div>
	<br>
	<button class="btn btn-primary" name="save">Simpan</button>
</form>
<?php 
if (isset($_POST['save']))
{
	$nama = $_FILES['foto']['name'];
	$lokasi =$_FILES['foto']['tmp_name'];
	move_uploaded_file($lokasi, "../foto_produk/".$nama);
	$koneksi->query("INSERT INTO produk
			(nama_produk,harga_produk,jenis,brand,foto_produk,deskripsi_produk)
			VALUES('$_POST[nama]','$_POST[harga]','$_POST[jenis]','$_POST[brand]','$nama','$_POST[deskripsi]')");
			
	echo "<div class='alert alert-info'>Data Tersimpan</div>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
}
?>












