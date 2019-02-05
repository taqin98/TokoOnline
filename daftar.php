<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Canshop Development</title>
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
<div class="container">
	<div class="row">
		<div class="col-md-offset-2">
			<div class="panel panel-default">
			<div class="panel-heading"> 	
				<h3 class="panel title">Daftar Pelanggan</h3>
			</div>
			<div class="panel-body">
			<form method="post" class="form-hotizontal">
			  <div class="form-group">
				<label class="control-label col-md-3">Nama</label>
					<div class="col-md-7">
					<input type="text" class="form-control" name="nama" required>
					</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3">Email</label>
					<div class="col-md-7">
					<input type="email" class="form-control" name="email" required>
					</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3">Password</label>
					<div class="col-md-7">
					<input type="password" class="form-control" name="password" required>
					</div>
			  </div>
			  <!--
			  <div class="form-group">
				<label class="control-label col-md-3">Alamat</label>
					<div class="col-md-7">
					<textarea class="from-control" name="alamat" required></textarea>
					</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3">Telp/Hp</label>
					<div class="col-md-7">
					<input type="text" class="form-control" name="telepon" required>
					</div>
			  </div>
			-->
			  <div class="form-group">
					<div class="col-md-7">
					<button class="btn btn-primaty" name="daftar">Daftar</button>
					</div>
			  </div>
			</form>	
			<?php 
			//jk ada tombol daftar(ditekan tombol daftar)
			if (isset($_POST["daftar"]))
			{
				$nama = $_POST["nama"];
				$email = $_POST["email"];
				$password = $_POST["password"];
				//$alamat = $_POST["alamat"];
				//$telepon = $_POST["telepon"];
				
				//cek apakah email sudah digunakan
				$ambil = $koneksi->query("SELECT*FROM pelanggan
					WHERE email_pelanggan='$email'");
				$yangcocok = $ambil->num_rows;
				if ($yangcocok==1)
				{
					echo "<script>alert('Pendaftaran Gagal, email sudah digunkan');</script>";
					echo "<script>location='index.php';</script>";
				}
				else
				{
					//query insert ke tabel pelanggan
					$koneksi->query("INSERT INTO pelanggan
						(email_pelanggan,password_pelanggan,nama_pelanggan)
						VALUES('$email','$password','$nama')");
						
					echo "<script>alert('Pendaftaran Sukses, Silahkan Login');</script>";
					echo "<script>location='login.php';</script>";
				}
					
			}
			?>
			

		  </div>
		  </div>
		</div>
	</div>
</div>

	<?php include 'footer.php'; ?>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
	<script src="themes/js/jquery.js" type="text/javascript"></script>
	<script src="themes/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="themes/js/google-code-prettify/prettify.js"></script>
	
	<script src="themes/js/bootshop.js"></script>
    <script src="themes/js/jquery.lightbox-0.5.js"></script>