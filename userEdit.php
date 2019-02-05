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
				<h3 class="panel title"><?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?></h3>
				<h6>Profile [Edit]</h6>
			</div>
			<?php
			$id = $_GET['id'];
			$sql = $koneksi->query("SELECT * FROM pelanggan where id_pelanggan='$id'");
			$data = $sql->fetch_assoc();
			?>
			<div class="panel-body">
			<form method="post">
				<div class="span4">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" class="form-control" name="nama" value="<?php echo $data['nama_pelanggan']; ?>">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" disabled="" class="form-control" name="email" value="<?php echo $data['email_pelanggan']; ?>">
					</div>

					<div class="form-group">
					<label>Password</label>
					<input type="password" disabled="" class="form-control" name="pass" value="<?php echo $data['password_pelanggan']; ?>">
					</div>
				</div>

				<div class="span4">
					<div class="form-group">
						<label>Telepon/Hp</label>
						<input type="decimal" required="" class="form-control" name="telp" value="<?php echo $data['telepon_pelanggan']; ?>">
					</div>
					<div class="form-group">
						<?php
						if (!empty($data['id_prov'])) {
							# code...ada data

							$provinsi_id = $data['id_prov'];
							$curl = curl_init();

							curl_setopt_array($curl, array(
								CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
								CURLOPT_RETURNTRANSFER => true,
								CURLOPT_ENCODING => "",
								CURLOPT_MAXREDIRS => 10,
								CURLOPT_TIMEOUT => 30,
								CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
								CURLOPT_CUSTOMREQUEST => "GET",
								CURLOPT_HTTPHEADER => array(
									"key: 1376e153b9b9c474f07901ed26d710ae"
								),
							));

							$response = curl_exec($curl);
							$err = curl_error($curl);

							curl_close($curl);

							echo "<label>Provinsi</label>";
							echo "<select name='provinsi' id='provinsiasal' class='form-control'>";
							$datax = json_decode($response, true);
							for ($i=0; $i < count($datax['rajaongkir']['results']); $i++) {

								if ($datax['rajaongkir']['results'][$i]['province_id'] == $provinsi_id) {
									# code...
									echo "<option selected='' value='".$datax['rajaongkir']['results'][$i]['province_id']."'>".$datax['rajaongkir']['results'][$i]['province']."</option>";
								} else {
									echo "<option value='".$datax['rajaongkir']['results'][$i]['province_id']."'>".$datax['rajaongkir']['results'][$i]['province']."</option>";
								}
								
							}
							echo "</select>";

						} else {
							//echo "tidak ada";

							$curl = curl_init();

							curl_setopt_array($curl, array(
								CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
								CURLOPT_RETURNTRANSFER => true,
								CURLOPT_ENCODING => "",
								CURLOPT_MAXREDIRS => 10,
								CURLOPT_TIMEOUT => 30,
								CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
								CURLOPT_CUSTOMREQUEST => "GET",
								CURLOPT_HTTPHEADER => array(
									"key: 1376e153b9b9c474f07901ed26d710ae"
								),
							));

							$response = curl_exec($curl);
							$err = curl_error($curl);

							curl_close($curl);

							echo "<label>Provinsi</label>";
							echo "<select name='provinsi' id='provinsiasal' class='form-control'>";
							echo "<option>Pilih Provinsi Asal</option>";
							$datax = json_decode($response, true);
							for ($i=0; $i < count($datax['rajaongkir']['results']); $i++) {
								echo "<option value='".$datax['rajaongkir']['results'][$i]['province_id']."'>".$datax['rajaongkir']['results'][$i]['province']."</option>";
							}
							echo "</select>";
						}

						?>

					</div>

					<?php

					if (!empty($data['id_kota'])) {
						# code...
						$kabupaten_id = $data['id_kota'];
						$provinsi_id = $data['id_prov'];

						
						$curl = curl_init();
						curl_setopt_array($curl, array(
							CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=$provinsi_id",
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_ENCODING => "",
							CURLOPT_MAXREDIRS => 10,
							CURLOPT_TIMEOUT => 30,
							CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST => "GET",
							CURLOPT_HTTPHEADER => array(
								"key: 1376e153b9b9c474f07901ed26d710ae"
							),
						));

						$response = curl_exec($curl);
						$err = curl_error($curl);

						curl_close($curl);

						if ($err) {
							echo "cURL Error #:" . $err;
						} else {
  							//echo $response;
						}

						echo "<label>Kab/kota</label>";
						echo "<select name='asal' id='asal' class='form-control'>";
						$datas = json_decode($response, true);
						for ($i=0; $i < count($datas['rajaongkir']['results']); $i++) {
							
							if ($datas['rajaongkir']['results'][$i]['city_id'] == $kabupaten_id) {
								# code...								
								echo "<option selected='' value='".$datas['rajaongkir']['results'][$i]['city_id']."'>".$datas['rajaongkir']['results'][$i]['type']." ".$datas['rajaongkir']['results'][$i]['city_name']."</option>";

							} else {
								
								echo "<option value='".$datas['rajaongkir']['results'][$i]['city_id']."'>".$datas['rajaongkir']['results'][$i]['type']." ".$datas['rajaongkir']['results'][$i]['city_name']."</option>";

							}

						}
						echo "</select>";
					} else {
						?>
						<div class="form-group">
							<label>Kapubaten/kota</label>
							<select name="asal" id="asal" class="form-control">
								<option>--Pilih kab/kota--</option>
							</select>

						</div>
						<?php

					}
					?>
					
				</div>
			  

			  
				<div class="span4">
					<div class="form-group">
						<label>Alamat Lengkap</label>
						<textarea required="" style="margin: 0px 0px 10px; width: 208px; height: 118px;" class="form-control" name="alm"><?php echo $data['alamat_pelanggan']; ?></textarea>
					</div>

					<div class="form-group">
						<button class="btn btn-success" name="update">Update</button>
					</div>
				</div>

			  
			  
			</form>		
			
		  </div>
		  </div>
		</div>
	</div>

</div>	
	<?php 
	if (isset($_POST['update'])) {
		$alm = $_POST['alm'];
		$telp = $_POST['telp'];
		$id_prov = $_POST['provinsi'];
		$id_kota = $_POST['asal'];

		$sql = $koneksi->query("UPDATE pelanggan SET 
			   id_prov = '$id_prov',
			   id_kota = '$id_kota',
			   alamat_pelanggan = '$alm',
			   telepon_pelanggan = '$telp'
			   WHERE id_pelanggan = '$id'");

		if ($sql) {
			?>
			<script type="text/javascript">
				alert("Data berjasil diUpdate"); document.location = 'user.php';
			</script>
			<?php
		} else {
			?>
			<script type="text/javascript">
				alert("Data Gagal diUpdate");
			</script>
			<?php
		}
	}
	
	?>
	</div>

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript">

	$(document).ready(function(){
	  $('#provinsiasal').change(function(){

      //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax 
      var prov = $('#provinsiasal').val();

      $.ajax({
      	type : 'GET',
      	url : 'http://localhost/latihan/rajaongkir/cek_kabupaten.php',
        //url : 'http://rajaongkir.indoweb.xyz/cek_kabupaten.php',
        data :  'prov_id=' + prov,
        success: function (data) {

          		//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
          		$("#asal").html(data);
      		}

  		});

  	});




	  
	});
	</script>
</body>
</html>