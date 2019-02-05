<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah User Pelanggan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama </label>

                  <div class="col-sm-6">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-6">
                    <input type="email" name="email" class="form-control" placeholder="example@mail.com" required="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Passowrd</label>

                  <div class="col-sm-6">
                    <input type="passowrd" name="pass" class="form-control" placeholder="password" required="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Provinsi</label>

                  <div class="col-sm-6">
                    <select class="form-control" name="provinsi" id="provinsiasal">
                      <option>pilih provinsi asal</option>
                      <?php

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

                      $datax = json_decode($response, true);
                      for ($i=0; $i < count($datax['rajaongkir']['results']); $i++) {
                        echo "<option value='".$datax['rajaongkir']['results'][$i]['province_id']."'>".$datax['rajaongkir']['results'][$i]['province']."</option>";
                      }

                    
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kabupaten/kota</label>

                  <div class="col-sm-6">
                    <select class="form-control" name="asal" id="asal">
                      <option>pilih kab/kota asal</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Telepon/Hp</label>

                  <div class="col-sm-6">
                    <input type="text" name="telp" class="form-control" placeholder="Nomer Telepon/Hp">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>

                  <div class="col-sm-6">
                    <input type="text" name="alm" class="form-control" placeholder="Alamat Lengkap">
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input type="reset" class="btn btn-default" value="Cancel" />
                <input type="submit" name="save" class="btn btn-info pull-right" value="Simpan" />
              </div>
              <!-- /.box-footer -->
            </form>
            <?php
              if (isset($_POST['save'])) {

                $nama     = $_POST['nama'];
                $email    = $_POST['email'];
                $pass     = $_POST['pass'];
                $provinsi = $_POST['provinsi'];
                $kab      = $_POST['asal'];
                $telp     = $_POST['telp'];
                $alm      = $_POST['alm'];


                $ambil = $koneksi->query("SELECT*FROM pelanggan
                  WHERE email_pelanggan='$email'");
                $yangcocok = $ambil->num_rows;
                if ($yangcocok==1) {
                  
                  echo "<script>alert('Pendaftaran Gagal, email sudah digunkan');</script>";
                  //echo "<script>location='index.php?halaman=tambah_pelanggan';</script>";

                } else {
                  $sql = $koneksi->query("INSERT INTO pelanggan (email_pelanggan, password_pelanggan, nama_pelanggan, telepon_pelanggan, id_prov, id_kota, alamat_pelanggan) VALUES('$email', '$pass', '$nama', '$telp', '$provinsi', '$kab', '$alm')");
                  if ($sql) {

                    ?>
                    <script type="text/javascript">
                      alert("Data Berhasil disimpan."); document.location = '?halaman=pelanggan';
                    </script>
                    <?php

                  } else {

                    ?>
                    <script type="text/javascript">
                      alert("Data gagal disimpan."); document.location = '?halaman=pelanggan';
                    </script>
                    <?php

                  }
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