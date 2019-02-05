<?php
session_start();
//koneksi ke database
include 'koneksi.php';

if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
	echo "<script>alert('Keranjang Kosong, silahkan berbelanja dulu');</script>";
	echo "<script>location='index.php';</script>";
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
<!-- Sidebar ================================================== -->
	<div id="sidebar" class="span3">
		
		<div class="well well-small">
		<a id="myCart" href="keranjang.php" style="color: white;">	
				<img src="themes/images/shopping-cart.png" style="width: 20px; height: 100%; margin-top: 6px;" alt="cart">Keranjang Belanja
				<span class="badge badge-warning pull-right">
					<?php
					if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
					{
						echo "0";
					} else{
							echo count($_SESSION["keranjang"]);
						}

					?>
				</span>
			</a>
		</div>
		
		<ul id="sideManu" class="nav nav-tabs nav-stacked">
		<?php
		$sql = mysqli_query($koneksi,"SELECT * FROM kategori");

		while($r=mysqli_fetch_array($sql)) {
			//echo $r['kategori_id'];
			echo "<li class='subMenu open'><a href='#'>".$r['nama_kategori']."</a>";

			$sql2 = mysqli_query($koneksi,"SELECT * FROM sub_kategori WHERE kategori_id ='".$r['kategori_id']."' ");

			if($sql2) {
				echo "<ul>";
				while($d=mysqli_fetch_array($sql2)) {
					?>
					<li><a href="index.php?sub_id=<?php echo $d['sub_id']; ?>"><?php echo $d['sub_nama']; ?></a></li>
					<?php

				}
				echo "</ul>";
			} else {
				echo "</li>";
			}
		}
	?>
		</ul>
	</div>

<!-- Sidebar end=============================================== -->
	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.php">Home</a> <span class="divider">/</span></li>
		<li class="active"> Keranjang </li>
    </ul>
	<h3>  Keranjang Belanja <a href="index.php" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Lanjut Belanja </a></h3>	
	<hr class="soft"/>		
			
	<table class="table table-bordered" >
              <thead>
                <tr>
                  <th>No</th>
				  <th>Nama Produk</th>
				  <th>Harga</th>
                  <th>Jumlah</th>
                  <th>Sub Total</th>
				  <th>Aksi</th>
				</tr>
              </thead>
              <tbody>
				<?php $nomor=1; ?>
                <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
				<!-- menampilkan produk yang sedang diperulangkan berdasarkan id_produk -->
				<?php 
				$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
				$pecah = $ambil->fetch_assoc();
				$subtotal = $pecah["harga_produk"]*$jumlah;
				
				?>
				<tr>
                  <td><?php echo $nomor; ?></td>
				  <td><?php echo $pecah["nama_produk"]; ?></td>
				  <td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
				  <td><?php echo $jumlah; ?></td>
				  <td>Rp. <?php echo number_format($subtotal); ?></td>
				  <td>
					<a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs">Hapus</a>
					<a href="detail.php?id=<?php echo $id_produk ?>" class="btn btn-primary btn-xs">Detail</a>
				  </td>
                </tr>
				<?php $nomor++; ?>
				<?php endforeach?>
				
				
				</tbody>
            </table>
			
	<a href="index.php" class="btn btn-large"><i class="icon-arrow-left"></i> Lanjut Belanja </a>
	<a href="checkout.php" class="btn btn-large pull-right">Next <i class="icon-arrow-right"></i></a>
	
</div>
</div></div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->
	<?php include 'footer.php'; ?>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
	<script src="themes/js/jquery.js" type="text/javascript"></script>
	<script src="themes/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="themes/js/google-code-prettify/prettify.js"></script>
	
	<script src="themes/js/bootshop.js"></script>
    <script src="themes/js/jquery.lightbox-0.5.js"></script>
	
	<!-- Themes switcher section ============================================================================================= -->
</body>
</html>