<?php

include 'koneksi.php';

$idcat = $_GET['kategori_id'];

$sql = $koneksi->query("SELECT * FROM sub_kategori WHERE kategori_id='$idcat'");
while ($data = $sql->fetch_assoc()) {
	?>
	<option class="form-control" value="<?php echo $data['sub_id']; ?>"> <?php echo $data['sub_id']; ?> <?php echo $data['sub_nama']; ?></option>
	<?php
}
?>