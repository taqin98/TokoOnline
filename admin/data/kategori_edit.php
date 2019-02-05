<?php

include 'koneksi.php';
$sql = $koneksi->query("SELECT * FROM kategori WHERE kategori_id='$_GET[id]'");
$data = $sql->fetch_assoc();

?>

<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Kategori</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Kategori</label>

                  <div class="col-sm-6">
                    <input type="text" name="cat" class="form-control" value="<?php echo $data['nama_kategori']; ?>">
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
                $cat = $_POST['cat'];

                $sql = $koneksi->query("UPDATE kategori SET 
                  nama_kategori = '$cat' WHERE kategori_id = '$_GET[id]'");

                if ($sql) {

                  echo '<script>alert("Data Berhasil diupdate.");</script>';
                  echo "<meta http-equiv='refresh' content='0; url=index.php?halaman=kategori'>";

                } else {

                  echo '<div class="alert alert-danger">Data Gagal diupdate.</div>';
                  echo "<meta http-equiv='refresh' content='0; url=index.php?halaman=kategori'>";

                }
              }
            ?>
          </div>


