<?php
include 'koneksi.php';
$id = $_GET['id'];
$edit = mysqli_query($koneksi,"SELECT * FROM slider where id='$id'");
$data3 = mysqli_fetch_array($edit);
$data3['file_name'];
 
?>
 
<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Home</a>
        </li>
        <li class="breadcrumb-item active">Edit Slider</li>
     
       
</ol>
<!-- Edit Modal-->
<div class="card card-register-lg">
      <div class="card-header">Edit Slider</div>
      <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Judul</label>
                <input type="hidden" name="id" value="<?php echo $data3['id']; ?>">
                <input type="text" name="judul" id="exampleInputName" required="" class="form-control" placeholder="Judul Gambar" value="<?php echo $data3['judul']; ?>">
              </div>
              <div class="col-md-5">
                <label for="exampleInputName">Rubah Gambar</label>
                <input type="file" name="foto" id="exampleInputName" class="form-control">
               
              </div>
              
              <div class="col-md-6">
                <label for="exampleInputName">File Gambar</label>
                <img src="../pages/slider/<?php echo $data3['file_name']; ?>" width="100%">
              </div>
              <div class="col-md-6">
               
                
                <label for="exampleInputName"> &nbsp;</label><br>
                <input type="submit" name="save" value="simpan" class="btn btn-primary">
 
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
   
  </div>
  </div>

  <?php

    if (isset($_POST['save'])) {

      date_default_timezone_set('Asia/Jakarta');

      $foto = $_FILES['foto']['name'];
      $size = $_FILES['foto']['size'];
      $type = $_FILES['foto']['type'];
      $tmp = $_FILES['foto']['tmp_name'];
      $tgl = date('Y-m-d');
      $judul = $_POST['judul'];

      # jika foto kosong atau tidak ada file
      if ($_FILES['foto']['name'] == "") {
        # hanya melakukan update data saja

        $sql = $koneksi->query("UPDATE slider SET
          judul       = '".$judul."',
          tgl_upload  = '".$tgl."' WHERE id='".$id."' ");

        # kondisi ketika fungsi dijalankan
        # berhasil atau tidak
        if ($sql) {

          ?>
          <script type="text/javascript">
          alert("Data Berhasil Updated");
          document.location = '?halaman=sliderUpload';
          </script>
          <?php

        } else {

          ?>
          <script type="text/javascript">
          alert("Data Gagal Updated");
          document.location = '?halaman=sliderUpload';
          </script>
          <?php

        }

      } else {
        # kondisi ketika data file foto terisi atau ada.
        $sql = $koneksi->query("SELECT * FROM slider WHERE id = '$id'");
        $data = $sql->fetch_assoc();
        
        $tempat_foto = "../pages/slider/".$data['file_name'];

        # cek apakah data foto tersebut ada ditempat folder.
        if (is_file($tempat_foto)) {

            #jika ada, maka akan dihapus.
            unlink($tempat_foto);

            $fotobaru = "../pages/slider/".$foto;
            move_uploaded_file($tmp, $fotobaru);

            $sql = $koneksi->query("UPDATE slider SET
            tgl_upload='".$tgl."',
            file_name='".$foto."',
            file_size='".$size."',
            file_type='".$type."',
            judul='".$judul."' WHERE id='".$id."'");

            if ($sql) {

              ?>
              <script type="text/javascript">
                alert("Data Foto Berhasil Updated");
                document.location = '?halaman=sliderUpload';
              </script>
              <?php

            } else {

              ?>
              <script type="text/javascript">
                alert("Data Foto Gagal Updated");
                document.location = '?halaman=sliderUpload';
              </script>
              <?php

            }

        }

      }
    }
  ?>