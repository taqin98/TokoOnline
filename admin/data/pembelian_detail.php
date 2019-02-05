<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Detail Transaksi</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-wrench"></i></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="box">
            <div class="box-body">
            	<?php 
$ambil = $koneksi->query("SELECT * FROM pembelian
	JOIN pelanggan 
	ON pembelian.id_pelanggan=pelanggan.id_pelanggan
	WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
//echo "<pre>";
//print_r($detail);
//echo "</pre>";
//echo $detail['kode_promo'];
?>


<strong><?php echo $detail['nama_pelanggan']; ?></strong><br>
<p>
	<?php echo $detail['telepon_pelanggan']; ?><br>
	<?php echo $detail['email_pelanggan']; ?>
</p>

<p>
	Tanggal : <?php echo $detail['tanggal_pembelian']; ?><br>
	Total : Rp. <?php echo number_format($detail['total_pembelian']); ?>
</p>
              <table class="table table-bordered">
	<thead>
		<tr>
			<th>Produk</th>
			<th>Nama Produk</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>SubTotal</th>
		<tr>
	</thead>
	<tbody>
			<?php //$nomor=1; ?>
			<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON
				pembelian_produk.id_produk=produk.id_produk
				WHERE pembelian_produk.id_pembelian='$_GET[id]'");	?>
			<?php while($pecah=$ambil->fetch_assoc()){ ?>	
			<tr style="text-align: justify-all;">
				<td><img style="width: 100px; width: 100px;" src="../foto_produk/<?php echo $pecah['foto_produk']; ?>"></td>
				<td><?php echo $pecah['nama_produk']; ?></td>
				<td><?php echo $pecah['harga_produk']; ?></td>
				<td><?php echo $pecah['jumlah']; ?></td>				
				<td>Rp. 
					<?php echo number_format($pecah['harga_produk']*$pecah['jumlah']); ?>
				</td>
			</tr>
			
			<?php $nomor++; ?>
			<?php } ?>
			<tr>
				<td colspan="3"></td>
				<td>Ongkir : </td>
				<td>Rp. <?php echo number_format($detail['tarif']); ?></td>
			</tr>
						<tr>
				<td colspan="3"></td>
				<td>Diskon produk : </td>
				<td>
					<?php
					if (!$detail['diskon']) {
						echo "-";
					} else {
						echo $detail['diskon'];
					}
					?>%
				</td>
			</tr>
			<tr>
				<td colspan="3"></td>
				<td>Total : </td>
				<td>Rp. <?php echo number_format($detail['total_pembelian']); ?></td>
			</tr>
		
	</tbody>
</table>
<table class="table table-bordered" style="background-color: #ffc10763;">
	<thead>
		<tr>
			<th>Foto Bukti Transfer</th>
			<th>Keterangan</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON
				pembelian_produk.id_produk=produk.id_produk
				WHERE pembelian_produk.id_pembelian='$_GET[id]'");
		$data = $sql->fetch_assoc();
		$id_pembelian_produk = $data['id_pembelian_produk'];


		
			?>
			<tr>
				<td><img style="width: 10%;" src="../pages/bukti/<?php echo $data['bukti']; ?>"></td>
				<td><?php echo $data['ket']; ?></td>
				<td>
					<form method="POST">
						<input type="text" name="resi" placeholder="Resi Pengiriman Paket" class="form-control"><br>
						<select name="ket" class="form-control">
							<option>pilih action</option>
							<option value="pengecekan">pengecekan</option>
							<option value="dikirim">dikirim</option>
							<option value="selesai">selesai</option>
						</select><br>
						<input type="submit" name="submit" value="submit" class="btn btn-success">
					</form>
				</td>
			</tr>
			<?php
		
		?>
		
	</tbody>
</table>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->



<?php
if (isset($_POST['submit'])) {
	# code...
	$ket = $_POST['ket'];
	$resi = $_POST['resi'];
	
	$sql = $koneksi->query("UPDATE pembelian_produk SET 
		   ket = '$ket',
		   resi = '$resi' WHERE id_pembelian = '$_GET[id]'");

	if ($sql) {
		?>
		<script type="text/javascript">
			document.location = 'index.php?halaman=pembelian';
		</script>
		<?php
	} else {
		echo "<script>";
		echo "alert('Gagal')";
		echo "</script>";
	}
}
?>