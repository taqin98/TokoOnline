<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Data Transaksi</h3>

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
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal transaksi</th>
                        <th>Total pembelian</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                          <?php
                          $sql = $koneksi->query("SELECT * FROM pembelian_produk JOIN pembelian ON pembelian_produk.id_pembelian=pembelian.id_pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan");
                          $nomor=1;
                          while ($pecah = $sql->fetch_assoc()) {
                            ?>

                            <tr>
                              <td><?php echo $nomor++; ?></td>
                              <td><?php echo $pecah['nama_pelanggan']; ?></td>
                              <td><?php echo $pecah['tanggal_pembelian']; ?></td>
                              <td>Rp. <?php echo number_format($pecah['total_pembelian']) ?></td>
                              <td>
                                <h5 style="background-color: orange; border-radius: 25px; text-align: center; margin: 10px;"><strong>
                                <?php echo $pecah['ket']; ?></strong>    
                                </h5>
                              </td>
                              <td>
                                <a href="index.php?halaman=detail_pembelian&id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-success"><i class="fa fa-files-o"></i> Detail</a>
                                <a href="index.php?halaman=mailer&id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-warning"><i class="fa fa-envelope"></i> Pesan</a>
                                <a href="index.php?halaman=hapus_pembelian&id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                              </td>
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