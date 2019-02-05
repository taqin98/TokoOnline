
  <div class="col-md-12">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Produk</h3>

              <div class="box-tools pull-right">

                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>

                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>

              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form class="form-horizontal" method="POST" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Produk</label>

                  <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Produk">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Harga</label>

                  <div class="col-sm-10">
                    <input type="numeric" name="harga" class="form-control" placeholder="Harga Produk">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Stok</label>

                  <div class="col-sm-10">
                    <input type="numeric" name="stok" class="form-control" placeholder="Harga Produk">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Berat</label>

                  <div class="col-sm-10">
                    <input type="numeric" name="berat" class="form-control" placeholder="Berat dalam gram">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Kategori</label>
                  <div class="col-sm-10">
                    <select name="cat" class="form-control" id="cat">
                      <option>pilih kategori</option>
                    <?php
                    $sql = $koneksi->query("SELECT * FROM kategori");
                    while ($data = $sql->fetch_assoc()) {
                      ?>
                      <option class="form-control" value="<?php echo $data['kategori_id']; ?>"> <?php echo $data['kategori_id']; ?> <?php echo $data['nama_kategori']; ?></option>
                      <?php
                    }
                    ?>
                    
                  </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Sub Kategori</label>
                  <div class="col-sm-10">
                    <select name="sub" class="form-control" id="sub">
                      <option>pilih sub kategori</option>
                  </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Brand</label>

                  <div class="col-sm-10">
                    <input type="text" name="brand" class="form-control" placeholder="Brand Produk">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Deskripsi</label>

                  <div class="col-sm-10">
                	<textarea id="editor1" name="deskripsi" placeholder="Place some text here"
                          style="display: flex; width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Foto</label>

                  <div class="col-sm-10">
                  	<img src="http://placehold.it/100x100" id="showgambar" style="max-width:200px;max-height:200px;float:left;" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label"></label>

                  <div class="col-sm-10">
                  	<input type="file" id="inputgambar" name="foto" class="form-control"/ >
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input type="reset" class="btn btn-default" value="Cancel" />
                <input type="submit" name="save" class="btn btn-info pull-right" value="Tambah" />
              </div>
              <!-- /.box-footer -->
            </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
            


<?php 
if (isset($_POST['save']))
{
  $nama = $_FILES['foto']['name'];
  $lokasi =$_FILES['foto']['tmp_name'];

  $foto = "../foto_produk/".$nama;
  move_uploaded_file($lokasi, $foto);
  
  $koneksi->query("INSERT INTO produk
      (nama_produk,harga_produk,stok,berat,sub_id,brand,foto_produk,deskripsi_produk)
      VALUES('$_POST[nama]','$_POST[harga]','$_POST[stok]','$_POST[berat]','$_POST[sub]','$_POST[brand]','$nama','$_POST[deskripsi]')");
      
  echo "<div class='alert alert-info'>Data Tersimpan</div>";
  echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
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