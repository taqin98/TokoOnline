<!-- Navbar ================================================== -->
<div id="logoArea" class="navbar">
<a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
</a>
  <div class="navbar-inner">
    <a class="brand" href="index.php"><img src="themes/images/shop.png" alt="Bootsshop" style="width: 40px;height: 5%;"/></a>
		<form class="form-inline navbar-search" method="" action="">
		<input  class="srchTxt" name="cari" type="text" />
		  <input class="btn btn-default" type="submit" value="Cari"/>
	
	
    </form>
    <ul id="topMenu" class="nav pull-right">
    <?php
    if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"])) {
    	?>
    	<li class=""><a href="#keranjang" role="button" data-toggle="modal">Keranjang</a></li>
    	<?php
    } else {
    	?>
    	<li class=""><a href="keranjang.php">Keranjang</a></li>
    	<?php
    }

	?>


	 
	 <?php
	 if (isset($_SESSION["pelanggan"])){
	 	$id = $_SESSION["pelanggan"]['id_pelanggan'];
	 	$ambil = $koneksi-> query("SELECT * FROM pembelian JOIN pembelian_produk using(id_pembelian) WHERE id_pelanggan='$id' order by id_pembelian desc LIMIT 1");
	 	$data = $ambil->fetch_assoc();

	 	if ($data['ket'] == "belum bayar") {
	 		echo '<li class=""><a href="riwayat.php">belum bayar</a></li>';
	 	} elseif ($data['ket'] == "pengecekan") {
	 		echo '<li class=""><a href="riwayat.php">pengecekan</a></li>';
	 	} elseif ($data['ket'] == "dikirim") {
	 		echo '<li class=""><a href="riwayat.php">dikirim</a></li>';
	 	} else {
	 		echo '<li class=""><a href="riwayat.php">Riwayat</a></li>';
	 		//echo $data['ket'];
	 	}
	 	?>

	 	<?php
	 } else {
	 	?>
	 	<script type="text/javascript"></script>
	 	<li class=""><a href="#riwayat" role="button" data-toggle="modal">Riwayat</a></li>
	 	<?php
	 }
	 ?>

	 <li class=""><a href="daftarpromo.php" role="button" >Daftar Promo</a></li>
	 	

	 <?php if (isset($_SESSION["pelanggan"])): ?>
	 	<li class=""><a href="user.php">User (<?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?>)</a></li>
		<li class=""><a href="logout.php" >
		<span class="btn btn-primary" id="jajal">Logout</span></a></li>
	 <?php else: ?>	
	 <li class=""><a href="daftar.php">Register</a></li>	
	 <li class="">
	 <a href="#login" role="button" data-toggle="modal"><span class="btn btn-default">Login</span></a>
	</li>
	 <?php endif ?>
    </ul>
    
  </div>
</div>
</div>
</div>
<!-- Header End====================================================================== -->


<!-- Modal Keranjang -->
<div id="keranjang" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3>Anda harus belanja dahulu!!</h3>
		  </div>
		  <div class="modal-body">
				<div class="alert alert-danger alert-dismissible">
  					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  					<strong>Keranjang Anda Kosong !!</strong>
				</div>
			<span>
				
			</span>			
		  </div>
</div>


<!-- Modal Riwayat -->
<div id="riwayat" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3>Login Pelanggan</h3>
		  </div>
		  <div class="modal-body">
			<form method="post">
			  <div class="form-group">
				<div class="alert alert-danger alert-dismissible">
  					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  					<strong>Anda Harus Login dahulu !</strong>
				</div>
			  <label>Email</label>
				<input type="text" class="form-control" name="email">
			  </div>
			  <div class="form-group">
			  <label>Password</label>
				<input type="password" class="form-control" name="password">
			  </div>
			  <button class="btn btn-primary" name="login">Login</button>
			  
			</form>
			<span>
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

			//session promo
			$sql = $koneksi->query("SELECT * FROM promo WHERE ket='checked'");
			$promo = $sql->fetch_assoc();

			$_SESSION["pelanggan"] = $akun;
			$_SESSION["promo"] = $promo;
			$_SESSION["popup"] = "1";
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
			</span>			
		  </div>
</div>


<!-- Modal Login User -->
<div id="login" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3>Login Pelanggan</h3>
		  </div>
		  <div class="modal-body">
			<form method="post">
				<div class="row-form-goup">
					<div class="col-md-12">
						<div class="form-group">
			  				<label>Email</label>
							<input type="email" required="" class="form-control" name="email">
			  			</div>
			  		</div>
			  	</div>

			  	<div class="row-form-goup">
					<div class="col-md-12">
			  			<div class="form-group">
			  				<label>Password</label>
							<input type="password" required="" class="form-control" name="password">
			  			</div>
			  		</div>
			  	</div>
			  	<div class="row-form-goup">
					<div class="col-md-12">
			  			<button class="btn btn-warning" name="login">Login</button>
					</div>
				</div>
			</form>
			<span>
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

			//session promo
			$sql = $koneksi->query("SELECT * FROM promo order by Id desc");
			$promo = $sql->fetch_assoc();

			$_SESSION["pelanggan"] = $akun;
			$_SESSION["promo"] = $promo;
			$_SESSION["popup"] = "1";
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
			</span>			
		  </div>
</div>