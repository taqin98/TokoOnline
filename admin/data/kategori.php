<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Data Kategori</h3>

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
                <div class="box-body">

                  <a href="?halaman=tambah_kategori" class="btn btn-success"><i class="fa fa-plus"></i> tambah kategori</a>
                  <br><br>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Kode Kategori_id</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 

        			//Query
                      $sql = $koneksi->query("SELECT * from kategori");

                      while ($pecah = $sql->fetch_assoc()) {            
                        ?>
                        <tr>
                         <td><?php echo $pecah['kategori_id']; ?></td>
                         <td><?php echo $pecah['nama_kategori']; ?></td>
                         <td>
                          <a href="?halaman=hapus_kategori&id=<?php echo $pecah['kategori_id'] ?>" class="btn-danger btn"><i class="fa fa-trash"></i> hapus</a>
                          <a href="?halaman=edit_kategori&id=<?php echo $pecah['kategori_id'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                        </td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
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




<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Data Sub Kategori</h3>

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
                <div class="box-body">

                  <a href="?halaman=tambah_sub" class="btn btn-success"><i class="fa fa-plus"></i> tambah sub kategori</a>
              <br><br>
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Nama Kategori</th>
                    <th>Kode kategori_id</th>
                    <th>Kode sub_id</th>
                    <th>Nama Sub Kategori</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 

              //Query
                  $sql = $koneksi->query("SELECT * from sub_kategori JOIN kategori using(kategori_id) order by sub_id desc");

                  while ($pecah = $sql->fetch_assoc()) {            
                    ?>
                    <tr>
                     <td><?php echo $pecah['nama_kategori']; ?></td>
                     <td><?php echo $pecah['kategori_id']; ?></td>
                     <td><?php echo $pecah['sub_id']; ?></td>
                     <td><?php echo $pecah['sub_nama']; ?></td>
                     <td>
                      <a href="?halaman=hapus_sub&id=<?php echo $pecah['sub_id'] ?>" class="btn-danger btn"><i class="fa fa-trash"></i> hapus</a>
                      <a href="?halaman=edit_sub&id=<?php echo $pecah['sub_id'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                    </td>
                  </tr>
                  <?php
                }
                ?>
              </tbody>
            </table>
              </div>
              <!-- /.box-body -->
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





