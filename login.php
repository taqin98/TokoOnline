<?php
session_start();
//koneksi ke database
include 'koneksi.php';

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

<div class="container">
	<div class="row">
		<div class="col-md-offset-2">
			<div class="panel panel-default">
			<div class="panel-heading"> 	
				<h3 class="panel title">Login Pelanggan</h3>
			</div>
			<div class="panel-body">
			<form method="post">
			  <div class="form-group">
			  <label>Email</label>
				<input type="text" class="form-control" name="email">
			  </div>
			  <div class="form-group">
			  <label>Password</label>
				<input type="password" class="form-control" name="password">
			  </div>
			  <button class="btn btn-success" name="login">Login</button>
			  
			</form>		
			
		  </div>
		  </div>
		</div>
	</div>
</div>	
	<?php 
	// jika ada tombol simpan (tombol simpan di simpan)
	if (isset($_POST['login']))
	{
		$email = $_POST["email"];
		$password = $_POST["password"];
		//lakukan query ngecek akun di tabel pelanggan di db
		$ambil = $koneksi->query("SELECT * FROM pelanggan
		WHERE email_pelanggan='$email' AND password_pelanggan='$password'");
		
		//menghitung akun yang terambil
		$akunyangcocok = $ambil->num_rows;
		
		//jika 1 akun yang cocok, maka diloginkan
		if ($akunyangcocok==1)
		{
			//anda suksek login
			//mendapatkan akun dlm beltuk aray
			$akun = $ambil->fetch_assoc();
			//simpan di session pelanggan
			$_SESSION["pelanggan"] = $akun;
			echo "<script>alert('anda sukses login');</script>";
			
			//jika sudah belanja
			if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"]))
			{
				echo "<script>location='checkout.php';</script>";
			}
			else
			{
				echo "<script>location='index.php';</script>";
			}
			
		}
		else
		{
			//anda gagal login
			echo "<script>alert('anda gagal login, periksa akun anda');</script>";
			echo "<script>location='login.php';</script>";
		}
	}
	
	?>
	</div>
</body>
</html>