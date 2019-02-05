<?php
include 'koneksi.php';
$ambil=$koneksi->query("SELECT * FROM promo WHERE id='$_GET[id]'");
$pecah= $ambil->fetch_assoc();

//echo "<pre>";
//print_r($pecah);
//echo "</pre>";
$awal = substr($pecah[tgl], 0,10);
$akhir = substr($pecah[tgl], 13);
echo $awal . "<br>";
echo $akhir . "<br>";

if ($awal >= $akhir) {
  # code...
  echo "ex";
} else {
  echo "masih";
}
?>
 
 
<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Promo</h3>

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
        <form method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-3">
                <label for="exampleInputName">kode promo</label>
               
                <input type="text" name="kode_promo" id="exampleInputName" required="" class="form-control" value="<?php echo $pecah[kode_promo]; ?>">
              </div>

              <div class="col-md-3">
                <label for="exampleInputName">Judul</label>
               
                <input type="text" name="judul" id="exampleInputName" required="" class="form-control" value="<?php echo $pecah[judul_promo]; ?>">
              </div>

              <div class="col-md-6">
                <label for="exampleInputName">File Gambar</label>
 
                <input type="file" name="foto" id="exampleInputName" class="form-control">
              </div> 
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <label for="exampleInputName"> &nbsp;</label><br>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Deskripsi</label>
               
                <input type="text" name="des" id="exampleInputName" required="" class="form-control" value="<?php echo $pecah[desc_promo]; ?>">
              </div>

              <div class="col-md-4">
                <label>Tgl mulai & berakhir</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tgl" class="form-control pull-right" id="reservation" value="<?php echo $pecah[tgl]; ?>">
                </div>

              </div>
              <div class="col-md-2">
                <label for="exampleInputName">Dsikon</label>
 
                <input type="text" name="diskon" id="exampleInputName" required="" class="form-control" value="<?php echo $pecah[diskon]; ?>">
              </div> 
            </div>
          </div>

            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <label for="exampleInputName"> &nbsp;</label><br>
                  <input type="submit" name="save" value="simpan" class="btn btn-primary">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                <div class="col-md-12">
                  <label for="exampleInputName"> &nbsp;</label><br>
                </div>
              </div>
            </div>
        </form>
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

if (isset($_POST['save']))
{
  //print_r($_FILES);exit();
  if ($_FILES['foto']['name'] == "") 
  {
    $sql = mysqli_query($koneksi,"UPDATE promo SET 
    kode_promo   = '".$_POST['kode_promo']."',
    judul_promo  = '".$_POST['judul']."',
    desc_promo         = '".$_POST['des']."',
    diskon         = '".$_POST['diskon']."',
    tgl  ='".$_POST['tgl']."' WHERE id ='".$_GET['id']."' ");

    if($sql){ // Cek jika proses simpan ke database sukses atau tidak
    echo "<script>alert('Data telah diubah');</script>";
    echo "<script>location='index.php?halaman=promo';</script>";
    }else{
      // Jika Gagal, Lakukan :

      echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
      echo "<br><a href='index.php?halaman=promo'>Kembali Ke Form</a>";
    }

  } else 
    {
      $query = "SELECT * FROM promo WHERE id='".$_GET['id']."' ";
      $sql = mysqli_query($koneksi, $query); // Eksekusi/Jalankan query dari variabel $query
      $data = mysqli_fetch_array($sql); // Ambil data dari hasil eksekusi $sql
      $tempat_foto = "../pages/promo/".$data['foto'];

      if(is_file($tempat_foto)) // Jika foto ada
        unlink($tempat_foto);

      $namafoto=$_FILES['foto']['name'];
      $lokasifoto = $_FILES['foto']['tmp_name'];
  
      $fotobaru = "../pages/promo/".$namafoto;
      move_uploaded_file($lokasifoto, $fotobaru);
      
    
      $sql2 = mysqli_query($koneksi,"UPDATE promo SET
      foto =  '".$namafoto."',
      kode_promo   = '".$_POST['kode_promo']."',
      judul_promo  = '".$_POST['judul']."',
      desc_promo         = '".$_POST['des']."',
      diskon         = '".$_POST['diskon']."',
      tgl  ='".$_POST['tgl']."' WHERE id='".$_GET['id']."' ");

      if($sql2){ // Cek jika proses simpan ke database sukses atau tidak
      echo "<script>alert('Data telah diubah');</script>";
      echo "<script>location='index.php?halaman=promo';</script>";
      }else{
      // Jika Gagal, Lakukan :

      echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
      echo "<br><a href='index.php?halaman=promo'>Kembali Ke Form</a>";
      }
    }
    
      
}
?>