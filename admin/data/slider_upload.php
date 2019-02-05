<?php
include 'koneksi.php';
if(isset($_POST['submit'])){
  $judul=$_POST['a'];
  $name=$_FILES['photo']['name']; //['photo'] adalah name="photo" yg digunakan di code input
  $size=$_FILES['photo']['size']; //ukuran file
  $type=$_FILES['photo']['type']; //type file
  $temp=$_FILES['photo']['tmp_name']; //lokasi file
  $tgl = date('Y-m-d');
 
  move_uploaded_file($temp,"../pages/slider/".$name);
$query=$koneksi->query("INSERT into slider(tgl_upload,file_name,file_size,file_type,judul)
  values('$tgl','$name','$size','$type','$judul')");
if($query){
?>
<script> alert("berhasil");document.location = "?halaman=sliderUpload";
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
              <h3 class="box-title">Data Slider</h3>

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
              <div class="col-md-6">
                <label for="exampleInputName">Judul</label>
               
                <input type="text" name="a" id="exampleInputName" required="" class="form-control" placeholder="Judul Gambar">
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">File Gambar</label>
 
                <input type="file" name="photo" id="exampleInputName" required="" class="form-control">
              </div>
              <div class="col-md-6">
                <label for="exampleInputName"> &nbsp;</label><br>
                <input type="submit" name="submit" id="photo" value="simpan" class="btn btn-primary">
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12">
                <br><br>
              </div>
              
            </div>
          </div>
        </form>
      

            <div class="box-body">
        
              <table class="table table-bordered">

                <thead>
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Tgl Upload</th>
                  <th>Nama</th>
                  <th>Size</th>
                  <th>Type</th>
                  <th>Aksi</th>
                </tr>
              </thead>
                <tbody>
                <?php 
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
              //include pagignation
              include 'plugins/pagination.php';

              //Query
              $sql = "SELECT * from slider order by id desc";
              $result = mysqli_query($koneksi,$sql);

              //Setting start pagignation
              //pagination config start
              $rpp = 5; // jumlah record per halaman
              $reload = "?halaman=sliderUpload&pagination=true";
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
                  <td><?php echo $data['judul']; ?></td>
                  <td><?php echo $data['tgl_upload']; ?></td>
                  <td><?php echo $data['file_name']; ?></td>
                  <td><?php echo $data['file_size']; ?></td>
                  <td><?php echo $data['file_type']; ?></td>
                  <td>
                    <a href="../pages/slider/<?php echo $data['file_name']; ?>"  class="btn btn-success btn-sm fa fa-download" data-toggle="tooltip" title="Download"> </a>
 
                    <a href="?halaman=sliderUploadEdit&id=<?php echo $data['id']; ?>" class="btn btn-warning btn-sm fa fa-edit" data-toggle="tooltip" title="Edit"> </a>
 
                    <a href="?halaman=sliderUploadhapus&id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm fa fa-trash" data-toggle="tooltip" title="Delete"> </a>
                   
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

 

 
<div class="container">
   
    <div class="modal fade" id="ModalPreview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalPreviewLabel"><?php echo $data['judul']; ?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">  
          <?php  
          include '../koneksi.php';
     
      $id = $_GET['id'];
      $query = mysqli_query($koneksi,"SELECT * FROM slider WHERE id='$id'");
      while ($row=mysqli_fetch_array($query)) {      
        ?>
          <img src="pages/slider/<?php echo $data['file_name']; ?>" width="100%" height="100%">
        <?php
      }
    ?>          
           
          </div>
         
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="pages/slider/<?php echo $data['file_name']; ?>">Download</a>
          </div>
        </div>
      </div>
   
  </div>
</div>