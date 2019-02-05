<?php
//koneksi ke database
session_start();
include 'koneksi.php';

//Jika tidak ada session pelanggan (blm login)
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
{
	echo "<script>alert('Silahkan Login Dahulu');</script>";
	echo "<script>location='login.php';</script>";
	exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>CAN SHOP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<!--Less styles -->
   <!-- Other Less css file //different less files has different color scheam
	<link rel="stylesheet/less" type="text/css" href="themes/less/simplex.less">
	<link rel="stylesheet/less" type="text/css" href="themes/less/classified.less">
	<link rel="stylesheet/less" type="text/css" href="themes/less/amelia.less">  MOVE DOWN TO activate
	-->
	<!--<link rel="stylesheet/less" type="text/css" href="themes/less/bootshop.less">
	<script src="themes/js/less.js" type="text/javascript"></script> -->
	
<!-- Bootstrap style --> 
    <link id="callCss" rel="stylesheet" href="themes/bootshop/bootstrap.min.css" media="screen"/>
    <link href="themes/css/base.css" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive -->	
	<link href="themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
	<link href="themes/css/font-awesome.css" rel="stylesheet" type="text/css">
<!-- Google-code-prettify -->	
	<link href="themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
<!-- fav and touch icons -->
    <link rel="shortcut icon" href="themes/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="themes/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="themes/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="themes/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="themes/images/ico/apple-touch-icon-57-precomposed.png">
	<style type="text/css" id="enject"></style>
  </head>
<?php include 'menu.php'; ?>
<div id="mainBody">
    <div class="container">
    <div class="row">
 
<section class="riwayat">
	<div class="container">
		<?php
		$id = $_SESSION["pelanggan"]['id_pelanggan'];
		$ambil = $koneksi-> query("SELECT * FROM pembelian JOIN pembelian_produk using(id_pembelian) WHERE id_pelanggan='$id'");
		while ($data = $ambil->fetch_assoc()) {
			//echo $data['id_pembelian']."<br>";

			if ($data['ket'] == "belum bayar") {
				?>
				<h3>Tagihan Belanja <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?> (Belum dibayar)</h3>
				<h6>Segera lakukan pembayaran tagihan belanja anda.</h6>
				<?php
			} elseif ($data['ket'] == "pengecekan") {
				?>
				<h3>Tagihan Belanja <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?> (pengecekan)</h3>
				<h6>bukti transfer akan dicek dalam 1x24 jam.</h6>
				<?php
			} elseif ($data['ket'] == "dikirim") {
				?>
				<h3>Tagihan Belanja <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?> (dikirim)</h3>
				<h6>resi pengiriman <strong style="text-transform: uppercase;"><?php echo $data['nama_jasa']; ?></strong> : <?php echo $data['resi']; ?> </h6>
				<?php
			} else {
				
			}


		}
		
		

		
		?>
	</div>
<br>
	<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table table-bordered">
						<tr class="table-head">
							<th class="column-1">No</th>
							<th class="column-2">Tanggal</th>
							<th class="column-4">Total</th>
							<th>Keterangan</th>
							<th class="column-5">Opsi</th>
						</tr>
						<?php
						$nomor=1;
						// mendapatkan id_pelanggan yg login dari sesion
						$id_pelanggan = $_SESSION["pelanggan"]['id_pelanggan'];
						$selesai = 'selesai';
						$pengecekan = 'pengecekan';
						$dikirim = 'dikirim';
						$belum = 'belum bayar';

						$ambil = $koneksi-> query("SELECT * FROM pembelian JOIN pembelian_produk using(id_pembelian) WHERE id_pelanggan='$id_pelanggan'");
						while($pecah = $ambil->fetch_assoc()){
							?>
						<tr class="table-row">
							<td class="column-1"><?php echo $nomor; ?></td>
							<td class="column-2"><?php echo $pecah["tanggal_pembelian"] ?></td>
							<td class="column-4">Rp. <?php echo number_format($pecah["total_pembelian"]) ?></td>
							<td><?php echo $pecah['ket']; ?></td>
							<td class="column-5">
								<a href="nota.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-default">Detail</a>
								<?php
									if ($pecah['ket'] == "selesai") {
										echo " ";
									} elseif ($pecah['ket'] == "dikirim") {
										?>
										<form method="POST">
											<input type="submit" name="selesai" value="Terima Barang" class="btn btn-success">
										</form>
										<?php
										if (isset($_POST['selesai'])) {
											$sql = $koneksi->query("UPDATE pembelian_produk SET ket = 'selesai' WHERE id_pembelian = '$pecah[id_pembelian]'");
											?>
											<script type="text/javascript">
												alert("Terimakasih sudah berbelanja di toko kami");
												document.location = 'riwayat.php';
											</script>
											<?php
										}
									}
								?>
							</td>
								
						</tr>
						<?php $nomor++; ?>
					<?php } ?>
					
					</table>
				</div>
			</div>
</section>
</div>
</div>
<!-- Footer ================================================================== -->
	<?php include 'footer.php'; ?>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
	<script src="themes/js/jquery.js" type="text/javascript"></script>
	<script src="themes/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="themes/js/google-code-prettify/prettify.js"></script>
	
	<script src="themes/js/bootshop.js"></script>
    <script src="themes/js/jquery.lightbox-0.5.js"></script>
	
	<!-- Themes switcher section ============================================================================================= -->
<div id="secectionBox">
<link rel="stylesheet" href="themes/switch/themeswitch.css" type="text/css" media="screen" />
<script src="themes/switch/theamswitcher.js" type="text/javascript" charset="utf-8"></script>
	<div id="themeContainer">
	<div id="hideme" class="themeTitle">Style Selector</div>
	<div class="themeName">Oregional Skin</div>
	<div class="images style">
	<a href="themes/css/#" name="bootshop"><img src="themes/switch/images/clr/bootshop.png" alt="bootstrap business templates" class="active"></a>
	<a href="themes/css/#" name="businessltd"><img src="themes/switch/images/clr/businessltd.png" alt="bootstrap business templates" class="active"></a>
	</div>
	<div class="themeName">Bootswatch Skins (11)</div>
	<div class="images style">
		<a href="themes/css/#" name="amelia" title="Amelia"><img src="themes/switch/images/clr/amelia.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="spruce" title="Spruce"><img src="themes/switch/images/clr/spruce.png" alt="bootstrap business templates" ></a>
		<a href="themes/css/#" name="superhero" title="Superhero"><img src="themes/switch/images/clr/superhero.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="cyborg"><img src="themes/switch/images/clr/cyborg.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="cerulean"><img src="themes/switch/images/clr/cerulean.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="journal"><img src="themes/switch/images/clr/journal.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="readable"><img src="themes/switch/images/clr/readable.png" alt="bootstrap business templates"></a>	
		<a href="themes/css/#" name="simplex"><img src="themes/switch/images/clr/simplex.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="slate"><img src="themes/switch/images/clr/slate.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="spacelab"><img src="themes/switch/images/clr/spacelab.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="united"><img src="themes/switch/images/clr/united.png" alt="bootstrap business templates"></a>
		<p style="margin:0;line-height:normal;margin-left:-10px;display:none;"><small>These are just examples and you can build your own color scheme in the backend.</small></p>
	</div>
	<div class="themeName">Background Patterns </div>
	<div class="images patterns">
		<a href="themes/css/#" name="pattern1"><img src="themes/switch/images/pattern/pattern1.png" alt="bootstrap business templates" class="active"></a>
		<a href="themes/css/#" name="pattern2"><img src="themes/switch/images/pattern/pattern2.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern3"><img src="themes/switch/images/pattern/pattern3.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern4"><img src="themes/switch/images/pattern/pattern4.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern5"><img src="themes/switch/images/pattern/pattern5.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern6"><img src="themes/switch/images/pattern/pattern6.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern7"><img src="themes/switch/images/pattern/pattern7.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern8"><img src="themes/switch/images/pattern/pattern8.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern9"><img src="themes/switch/images/pattern/pattern9.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern10"><img src="themes/switch/images/pattern/pattern10.png" alt="bootstrap business templates"></a>
		
		<a href="themes/css/#" name="pattern11"><img src="themes/switch/images/pattern/pattern11.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern12"><img src="themes/switch/images/pattern/pattern12.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern13"><img src="themes/switch/images/pattern/pattern13.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern14"><img src="themes/switch/images/pattern/pattern14.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern15"><img src="themes/switch/images/pattern/pattern15.png" alt="bootstrap business templates"></a>
		
		<a href="themes/css/#" name="pattern16"><img src="themes/switch/images/pattern/pattern16.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern17"><img src="themes/switch/images/pattern/pattern17.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern18"><img src="themes/switch/images/pattern/pattern18.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern19"><img src="themes/switch/images/pattern/pattern19.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern20"><img src="themes/switch/images/pattern/pattern20.png" alt="bootstrap business templates"></a>
		 
	</div>
	</div>
</div>
<span id="themesBtn"></span>
</body>
</html>