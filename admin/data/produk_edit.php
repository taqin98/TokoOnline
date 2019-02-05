<?php
include 'koneksi.php';
//echo $_GET['id'];
$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah= $ambil->fetch_assoc();

//echo "<pre>";
//print_r($pecah);
//echo "</pre>";

?>

<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Produk</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Produk</label>

                  <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_produk']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Harga</label>

                  <div class="col-sm-10">
                    <input type="numeric" name="harga" class="form-control" value="<?php echo $pecah['harga_produk']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Stok</label>

                  <div class="col-sm-10">
                    <input type="numeric" name="stok" class="form-control" value="<?php echo $pecah['stok']; ?>">
                  </div>
                </div>
<?php $subID = $pecah['sub_id'];
 ?>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Kategori</label>
                  <div class="col-sm-10">
                    <select name="cat" class="form-control" id="cat">
                    <?php
                    
                    $sql = $koneksi->query("SELECT DISTINCT kategori_id, nama_kategori FROM sub_kategori JOIN kategori using(kategori_id) WHERE sub_kategori.sub_id='$subID'");
                    $datax = $sql->fetch_assoc();
                    $subIDD = $datax['kategori_id'];

                    $sql2 = $koneksi->query("SELECT * FROM kategori");

                    while ($data = $sql2->fetch_assoc()) {
                      if ($subIDD == $data['kategori_id']) {
                        # code...
                        ?>
                      <option selected=" class="form-control" value="<?php echo $data['kategori_id']; ?>"> <?php echo $data['nama_kategori']; ?></option>
                      <?php

                      } else {
                        ?>
                      <option class="form-control" value="<?php echo $data['kategori_id']; ?>"> <?php echo $data['nama_kategori']; ?></option>
                      <?php
                      }
                    }
                    ?>
                    
                  </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Sub kategori</label>
                  <div class="col-sm-10">
                    <select name="sub" class="form-control" id="sub">

                    <?php

                    $sql = $koneksi->query("SELECT * FROM sub_kategori WHERE sub_id='$subIDD'");
                    $datax = $sql->fetch_assoc();
                    $catID = $datax['kategori_id'];
                    $subID = $datax['sub_id'];

                    $sql2 = $koneksi->query("SELECT DISTINCT sub_id, sub_nama FROM sub_kategori JOIN kategori where sub_kategori.kategori_id='$catID'");

                    while ($data = $sql2->fetch_assoc()) {
                      if ($subID == $data['sub_id']) {
                        # code...
                        ?>
                        <option selected="" value="<?php echo $data['sub_id']; ?>">  <?php echo $data['sub_nama']; ?></option>
                        <?php

                      } else {
                        ?>
                        <option value="<?php echo $data['sub_id']; ?>"> <?php echo $data['sub_id']; ?> <?php echo $data['sub_nama']; ?></option>
                        <?php
                      }
                    }
                    ?>
                   
                    
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Brand</label>

                  <div class="col-sm-10">
                    <input type="text" name="brand" class="form-control" value="<?php echo $pecah['brand']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Deskripsi</label>

                  <div class="col-sm-10">
                	<textarea id="editor1" name="deskripsi" style="display: flex; width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                		<?php echo $pecah['deskripsi_produk']; ?>
                	</textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Foto</label>

                  <div class="col-sm-10">
                  	<img src="../foto_produk/<?php echo $pecah['foto_produk']; ?>" id="showgambar" style="max-width:200px;max-height:200px;float:left;" />
                  </div>

                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label"></label>

                  <div class="col-sm-10">
                  	<input type="file" id="inputgambar" name="foto"  class="validate"/ >
                  </div>
                  
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input type="reset" class="btn btn-default" value="Cancel" />
                <input type="submit" name="save" class="btn btn-info pull-right" value="Update" />
              </div>
              <!-- /.box-footer -->
            </form>
          </div>


<?php echo $pecah['foto_produk']; ?>

<?php

if (isset($_POST['save']))
{
  //print_r($_FILES);exit();
  if ($_FILES['foto']['name'] == "") 
  {
    $sql = mysqli_query($koneksi,"UPDATE produk SET 
    nama_produk   = '".$_POST['nama']."',
    harga_produk  = '".$_POST['harga']."',
    stok         = '".$_POST['stok']."',
    sub_id         = '".$_POST['sub']."',
    brand         = '".$_POST['brand']."',
    deskripsi_produk  ='".$_POST['deskripsi']."' WHERE id_produk='".$_GET['id']."' ");

    if($sql){ // Cek jika proses simpan ke database sukses atau tidak
    echo "<script>alert('Data telah diubah');</script>";
    echo "<script>location='index.php?halaman=produk';</script>";
    }else{
      // Jika Gagal, Lakukan :

      echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
      echo "<br><a href='index.php?halaman=produk'>Kembali Ke Form</a>";
    }

  } else 
    {
      $query = "SELECT * FROM produk WHERE id_produk='".$_GET['id']."' ";
      $sql = mysqli_query($koneksi, $query); // Eksekusi/Jalankan query dari variabel $query
      $data = mysqli_fetch_array($sql); // Ambil data dari hasil eksekusi $sql
      $tempat_foto = "../foto_produk/".$data['foto_produk'];

      if(is_file($tempat_foto)) { // Jika foto ada
        unlink($tempat_foto);

      $nama = $_POST['nama'];
      $harga = $_POST['harga'];
      $stok = $_POST['stok'];
      $sub = $_POST['sub'];
      $brand = $_POST['brand'];
      $namafoto = $_FILES['foto']['name'];
      $lokasifoto = $_FILES['foto']['tmp_name'];
      $deskripsi = $_POST['deskripsi'];
  
      $fotobaru = "../foto_produk/".$namafoto;
      move_uploaded_file($lokasifoto, $fotobaru);
      
    
      $sql2 = mysqli_query($koneksi,"UPDATE produk SET
      nama_produk   = '$nama',
      harga_produk  = '$harga',
      stok         = '$stok',
    sub_id         = '$sub',
      brand         = '$brand',
      foto_produk   = '$namafoto',
      deskripsi_produk  = '$deskripsi' WHERE id_produk = '$_GET[id]' ");

      if($sql2){ // Cek jika proses simpan ke database sukses atau tidak
      echo "<script>alert('Data telah diubah');</script>";
      echo "<script>location='index.php?halaman=produk';</script>";
      }else{
      // Jika Gagal, Lakukan :

      echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
      echo "<br><a href='index.php?halaman=produk'>Kembali Ke Form</a>";
      }
    }
    }
    
      
}
?>



<script type="text/javascript" src="assets/js/ajax_jquery.min.js"></script>
  <script type="text/javascript">

  $(document).ready(function(){
    $('#cat').change(function(){

      //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax 
      var kategori = $('#cat').val();

      $.ajax({
        type : 'GET',
        url : 'http://localhost/latihan/distroku/admin/data/kategoriAjax.php',
        //url : 'http://rajaongkir.indoweb.xyz/cek_kabupaten.php',
        data :  'kategori_id=' + kategori,
        success: function (data) {

              //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
              $("#sub").html(data);
          }

      });

    });




    
  });
  </script>