<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Selamat Datang <?php echo $_SESSION['akutansi']['level']; ?></h3>

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
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      if (isset($_SESSION['admin'])) {
                        # code...
                        ?>
                        <tr>
                          <td><?php echo $_SESSION['admin']['username']; ?></td>
                          <td><?php echo $_SESSION['admin']['nama_lengkap']; ?></td>
                          <td><a href="?halaman=editAdmin&id=<?php echo $_SESSION['admin']['id_admin'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a></td>
                        </tr>
                        <?php

                      } elseif (isset($_SESSION['akutansi'])) {
                        # code...
                        ?>
                        <tr>
                          <td><?php echo $_SESSION['akutansi']['username']; ?></td>
                          <td><?php echo $_SESSION['akutansi']['nama_lengkap']; ?></td>
                          <td><a href="?halaman=editAdmin&id=<?php echo $_SESSION['admin']['id_admin'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a></td>
                        </tr>
                        <?php

                      } elseif (isset($_SESSION['gudang'])) {
                        # code...
                        ?>
                        <tr>
                          <td><?php echo $_SESSION['gudang']['username']; ?></td>
                          <td><?php echo $_SESSION['gudang']['nama_lengkap']; ?></td>
                          <td><a href="?halaman=editAdmin&id=<?php echo $_SESSION['admin']['id_admin'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a></td>
                        </tr>
                        <?php

                      }
                      ?>
            
                    </tbody>
                  </table>
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

      <?php print_r($_SESSION['gudang']); ?>