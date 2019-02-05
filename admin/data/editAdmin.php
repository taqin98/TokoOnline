<?php
include 'koneksi.php';

$ambil=$koneksi->query("SELECT * FROM admin WHERE id_admin='$_GET[id]'");
$pecah= $ambil->fetch_assoc();

//echo "<pre>";
//print_r($pecah);
//echo "</pre>";

?>

<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Selamat Datang Administator</h3>

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
                	<form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                		<div class="box-body">
                			<div class="form-group">
                				<label for="inputEmail3" class="col-sm-2 control-label">Username</label>

                				<div class="col-sm-10">
                					<input type="text" readonly="" class="form-control" value="<?php echo $pecah['username']; ?>">
                				</div>
                			</div>

                			<div class="form-group">
                				<label for="inputEmail3" class="col-sm-2 control-label">Nama Lengkap</label>

                				<div class="col-sm-10">
                					<input type="text" name="nama_lengkap" class="form-control" value="<?php echo $pecah['nama_lengkap']; ?>">
                				</div>
                			</div>

                			<div class="form-group">
                				<?php
                				if (!empty($pecah['id_prov_toko'])) {
							# code...ada data

                					$provinsi_id = $pecah['id_prov_toko'];
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

                					echo "<label class='col-sm-2 control-label'>Provinsi</label>";
                					echo "<div class='col-sm-10'>";
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
                					echo "</div>";

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

                					echo "<label class='col-sm-2 control-label'>Provinsi</label>";
                					echo "<div class='col-sm-10'>";
                					echo "<select name='provinsi' id='provinsiasal' class='form-control'>";
                					echo "<option>Pilih Provinsi Asal</option>";
                					$datax = json_decode($response, true);
                					for ($i=0; $i < count($datax['rajaongkir']['results']); $i++) {
                						echo "<option value='".$datax['rajaongkir']['results'][$i]['province_id']."'>".$datax['rajaongkir']['results'][$i]['province']."</option>";
                					}
                					echo "</select>";
                					echo "</div>";
                				}

                				?>
                			</div>

                			<div class="form-group">
                				<?php

                				if (!empty($pecah['id_kota_toko'])) {
								# code...
                					$kabupaten_id = $pecah['id_kota_toko'];
                					$provinsi_id = $pecah['id_prov_toko'];


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

                					echo "<label class='col-sm-2 control-label'>Kab/kota</label>";
                					echo "<div class='col-sm-10'>";
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
                					echo "<div>";
                				} else {
                					?>
                					
                						<label class="col-sm-2 control-label">Kapubaten/kota</label>
                						<div class="col-sm-10">
	                						<select name="asal" id="asal" class="form-control">
	                							<option>--Pilih kab/kota--</option>
	                						</select>
                						</div>

                					
                					<?php

                				}
                				?>
                			</div>

                			<div class="form-group">
                				<br>
                				<div class="col-sm-10">
                					<input type="submit" name="submit" value="Update" class="btn btn-primary">
                				</div>
                			</div>

                		</div>
                	</form>
                </div>
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
      	$nama 	 = $_POST['nama_lengkap'];
      	$id_prov = $_POST['provinsi'];
      	$id_kota = $_POST['asal'];

      	$sql = $koneksi->query("UPDATE admin SET
      		nama_lengkap = '$nama', 
      		id_prov_toko = '$id_prov',
      		id_kota_toko = '$id_kota' WHERE id_admin = '$_GET[id]'");

      	if ($sql) {
      		echo "<script>alert('data berhasil diupdate');</script>";
      		echo "<script>location='index.php';</script>";
      	} else {
      		echo "<script>alert('data gagal diupdate');</script>";
      		echo "<script>location='index.php';</script>";
      	}
      }
      ?>
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