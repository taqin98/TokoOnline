<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Data Produk</h3>

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

              <a href="?halaman=tambah_produk" class="btn btn-success"><i class="fa fa-plus"></i> tambah produk</a>
              <br><br>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Sub Kategori</th>
                    <th>Brand</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                  </tr>
				        </thead>
                <tbody>
                <?php 

        			//Query
        			$sql = $koneksi->query("SELECT * from produk JOIN sub_kategori using(sub_id) order by id_produk desc");
        			$nomor=1;
        			
        			while ($pecah = $sql->fetch_assoc()) {            
        		?>
				<tr>
					<td><?php echo $nomor++; ?></td>
					<td><?php echo $pecah['nama_produk']; ?></td>
					<td><?php echo $pecah['harga_produk']; ?></td>
					<td><?php echo $pecah['sub_nama']; ?></td>
					<td><?php echo $pecah['brand']; ?></td>
					<td>
						<img src="../foto_produk/<?php echo $pecah['foto_produk']; ?>" width="100">
					</td>
					<td>
						<a href="?halaman=hapus_produk&id=<?php echo $pecah['id_produk'] ?>" class="btn-danger btn"><i class="fa fa-trash"></i> hapus</a>
						<a href="?halaman=edit_produk&id=<?php echo $pecah['id_produk'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
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