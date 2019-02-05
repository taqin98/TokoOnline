<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Sub Kategori</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Kategori</label>

                  <div class="col-sm-6">
                    <select class="form-control" name="cat">
                      <option>pilih kategori</option>
                      <?php
                        $sql = $koneksi->query("SELECT * FROM kategori");
                        while ($data = $sql->fetch_assoc()) {
                          ?>
                          <option value="<?php echo $data['kategori_id']; ?>"><?php echo $data['nama_kategori']; ?></option>
                          <?php
                        }

                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Sub Kategori</label>

                  <div class="col-sm-6">
                    <input type="text" name="sub" class="form-control" placeholder="Nama Sub Kategori">
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
                $sub = $_POST['sub'];

                $sql = $koneksi->query("INSERT INTO sub_kategori (kategori_id, sub_nama) VALUES('$cat', '$sub')");
                if ($sql) {

                  ?>
                  <script type="text/javascript">
                    alert("Data Berhasil disimpan."); document.location = '?halaman=kategori';
                  </script>
                  <?php

                } else {

                  ?>
                  <script type="text/javascript">
                    alert("Data gagal disimpan."); document.location = '?halaman=kategori';
                  </script>
                  <?php

                }
              }
            ?>
          </div>


