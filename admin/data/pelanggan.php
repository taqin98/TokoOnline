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
                  <a href="?halaman=tambah_pelanggan" class="btn btn-success"><i class="fa fa-plus"></i> User Pelanggan</a>
                  <br><br>
                  <table class="table table-bordered" id="example1">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                        <tr>
                        </thead>
                        <tbody>
                          <?php

                          $sql = "SELECT * from pelanggan order by id_pelanggan";
                          $result = mysqli_query($koneksi,$sql);
                          $nomor=1;

                          while ($pecah = mysqli_fetch_array($result)) {            		

                            ?>
                            <tr>
                             <td><?php echo $nomor++; ?></td>
                             <td><?php echo $pecah['nama_pelanggan']; ?></td>
                             <td><?php echo $pecah['email_pelanggan']; ?></td>
                             <td><?php echo $pecah['telepon_pelanggan']; ?></td>
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