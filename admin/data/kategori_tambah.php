<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Kategori</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Kategori</label>

                  <div class="col-sm-6">
                    <input type="text" name="cat" class="form-control" placeholder="Nama Kategori">
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

                $sql = $koneksi->query("INSERT INTO kategori (nama_kategori) VALUES('$cat')");
                if ($sql) {

                  echo '<script>alert("Data Berhasil disimpan.");</script>';
                  echo "<meta http-equiv='refresh' content='0; url=index.php?halaman=kategori'>";

                } else {

                  echo '<div class="alert alert-danger">Data Gagal disimpan.</div>';
                  echo "<meta http-equiv='refresh' content='0; url=index.php?halaman=kategori'>";

                }
              }
            ?>
          </div>


