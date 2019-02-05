<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Data Pelanggan</h3>

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
                  <!--<a href="?halaman=tambah_pelanggan" class="btn btn-success"><i class="fa fa-plus"></i> User Admin</a>-->
                  <br><br>
                  <table class="table table-bordered" id="example1">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Level</th>
                        <th>Aksi</th>
                        </thead>
                        <tbody>
                          <?php

                          $sql = "SELECT * from admin order by id_admin";
                          $result = mysqli_query($koneksi,$sql);
                          $nomor=1;

                          while ($pecah = mysqli_fetch_array($result)) {            		

                            ?>
                            <tr>
                             <td><?php echo $nomor++; ?></td>
                             <td><?php echo $pecah['username']; ?></td>
                             <td><?php echo $pecah['nama_lengkap']; ?></td>
                             <?php
                             if ($pecah['level'] == "super admin") {
                               # code...
                              echo "<td style='background-color:#00c0ef; color:white;'><h4><strong>".$pecah['level']."</strong></h4></td>";
                             } elseif ($pecah['level'] == "akutansi") {
                               # code...
                              echo "<td style='background-color:#00a65a; color:white;'><h4><strong>".$pecah['level']."</strong></h4></td>";
                             } elseif ($pecah['level'] == "staf gudang") {
                               # code...
                              echo "<td style='background-color:#f39c12; color:white;'><h4><strong>".$pecah['level']."</strong></h4></td>";
                             }
                             ?>
                             <td>
                              <a href="?halaman=hapus_pelanggan&id=<?php echo $pecah['id_pelanggan'] ?>" class="btn-danger btn"><i class="fa fa-trash"></i> hapus</a>
                              <a href="?halaman=edit_pelanggan&id=<?php echo $pecah['id_pelanggan'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
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