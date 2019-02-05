<?php
include 'koneksi.php';
if(isset($_POST['submit'])){
  $kode       = $_POST['kode_promo'];
  $judul      = $_POST['judul'];
  $name       = $_FILES['photo']['name']; //['photo'] adalah name="photo" yg digunakan di code input
  $temp=$_FILES['photo']['tmp_name']; //lokasi file
  $des        = $_POST['des'];
  $diskon       = $_POST['diskon'];
  $tgl       = $_POST['tgl'];
 
  move_uploaded_file($temp,"../pages/promo/".$name);
$query=$koneksi->query("INSERT into promo(foto,kode_promo,judul_promo,desc_promo,diskon,tgl)
  values('$name','$kode','$judul','$des','$diskon','$tgl')");
if($query){
?>
<script> alert("berhasil");document.location = "?halaman=promo";
    </script>
 
<?php
 
}
else{
die(mysqli_error());
}
}
?>
 
 
<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Data Promo</h3>

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
               
                <input type="text" name="kode_promo" id="exampleInputName" required="" class="form-control" placeholder="Kode Promo">
              </div>

              <div class="col-md-3">
                <label for="exampleInputName">Judul</label>
               
                <input type="text" name="judul" id="exampleInputName" required="" class="form-control" placeholder="Judul Promo">
              </div>

              <div class="col-md-6">
                <label for="exampleInputName">File Gambar</label>
 
                <input type="file" name="photo" id="exampleInputName" required="" class="form-control">
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
               
                <input type="text" name="des" id="exampleInputName" required="" class="form-control" placeholder="Deskripsi Promo">
              </div>

              <div class="col-md-4">
                <label>Tgl mulai & berakhir</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tgl" class="form-control pull-right" id="reservation">
                </div>

              </div>
              <div class="col-md-2">
                <label for="exampleInputName">Dsikon</label>
 
                <input type="text" name="diskon" id="exampleInputName" required="" class="form-control">
              </div> 
            </div>
          </div>

            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <label for="exampleInputName"> &nbsp;</label><br>
                  <input type="submit" name="submit" value="simpan" class="btn btn-primary">
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
      

            <div class="box-body">
        
              <table class="table table-bordered">

                <thead>
                <tr>
                  <th>No</th>
                  <th>Foto</th>
                  <th>Kode Promo</th>
                  <th>Judul</th>
                  <th>Deskripsi</th>
                  <th>Dsikon</th>
                  <th>Tgl mulai</th>
                  <th>Aksi</th>
                </tr>
              </thead>
                <tbody>
                <?php 
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
              //include pagignation
              include 'plugins/pagination.php';

              //Query
              $sql = "SELECT * from promo order by id desc";
              $result = mysqli_query($koneksi,$sql);

              //Setting start pagignation
              //pagination config start
              $rpp = 5; // jumlah record per halaman
              $reload = "?halaman=promo&pagination=true";
              $page = intval($_GET["page"]);
              if($page<=1) $page = 1;  
              $tcount = mysqli_num_rows($result);
              $tpages = ($tcount) ? ceil($tcount/$rpp) : 1; // total pages, last page number
              $count = 0;
              $i = ($page-1)*$rpp;
              $no_urut = ($page-1)*$rpp;
              //pagination config end
              $nomor=1;
              
              while (($count<$rpp) && ($i<$tcount)) {
                    mysqli_data_seek($result,$i);
                $data = mysqli_fetch_array($result);
            
            ?>
                <tr>
                  <td><?php echo $nomor++; ?></td>
                  <td><?php echo $data['foto']; ?></td>
                  <td><?php echo $data['kode_promo']; ?></td>
                  <td><?php echo $data['judul_promo']; ?></td>
                  <td><?php echo $data['desc_promo']; ?></td>
                  <td><?php echo $data['diskon']; ?></td>
                  <td><?php echo $data['tgl']; ?></td>
                  <td>
                    <a href="../pages/promo/<?php echo $data['foto']; ?>"  class="btn btn-success btn-sm fa fa-download" data-toggle="tooltip" title="Lihat"> </a>
 
                    <a href="?halaman=promoEdit&id=<?php echo $data['id']; ?>" class="btn btn-warning btn-sm fa fa-edit" data-toggle="tooltip" title="Edit"> </a>
 
                    <a href="?halaman=promoHapus&id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm fa fa-trash" data-toggle="tooltip" title="Delete"> </a>
                   
                  </td>
                </tr>
        <?php
                  $nomor++;
                  $i++; 
                  $count++;
              }
          ?>
        </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <?php echo paginate_one($reload, $page, $tpages); ?>
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

 






