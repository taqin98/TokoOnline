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
              <table class="table table-bordered">
                <thead>
                  <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Telepon</th>
                  <tr>
                </thead>
                <tbody>
                <?php 
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        			//include pagignation
        			include 'plugins/pagination.php';

        			//Query
        			$sql = "SELECT * from pelanggan order by id_pelanggan";
        			$result = mysqli_query($koneksi,$sql);

        			//Setting start pagignation
        			//pagination config start
        			$rpp = 5; // jumlah record per halaman
        			$reload = "?halaman=pelanggan&pagination=true";
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
            		$pecah = mysqli_fetch_array($result);
            
        		?>
				<tr>
					<td><?php echo $nomor; ?></td>
					<td><?php echo $pecah['nama_pelanggan']; ?></td>
          <td><?php echo $pecah['email_pelanggan']; ?></td>
          <td><?php echo $pecah['telepon_pelanggan']; ?></td>
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