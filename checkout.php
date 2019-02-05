<?php
session_start();
//koneksi ke database
include 'koneksi.php';
 
//jika tidak ada session pelanggan (blm login).mk dilarikan ke login
if (!isset($_SESSION["pelanggan"]))
{
    echo "<script>alert('Anda harus Login');</script>";
    echo "<script>location='login.php';</script>";
}
   
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Canshop Development</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<!--Less styles -->
   <!-- Other Less css file //different less files has different color scheam
    <link rel="stylesheet/less" type="text/css" href="themes/less/simplex.less">
    <link rel="stylesheet/less" type="text/css" href="themes/less/classified.less">
    <link rel="stylesheet/less" type="text/css" href="themes/less/amelia.less">  MOVE DOWN TO activate
    -->
    <!--<link rel="stylesheet/less" type="text/css" href="themes/less/bootshop.less">
    <script src="themes/js/less.js" type="text/javascript"></script> -->
   
<!-- Bootstrap style -->
    <link id="callCss" rel="stylesheet" href="themes/bootshop/bootstrap.min.css" media="screen"/>
    <link href="themes/css/base.css" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive -->
    <link href="themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
    <link href="themes/css/font-awesome.css" rel="stylesheet" type="text/css">
<!-- Google-code-prettify -->  
    <link href="themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
<!-- fav and touch icons -->
    <link rel="shortcut icon" href="themes/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="themes/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="themes/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="themes/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="themes/images/ico/apple-touch-icon-57-precomposed.png">
    <style type="text/css" id="enject"></style>
  </head>
 
<?php include 'menu.php'; ?>
<div id="mainBody">
    <div class="container">
    <div class="row">
<!-- Sidebar ================================================== -->
    <div id="sidebar" class="span3">
        <div class="well well-small"><a id="myCart" href="keranjang.php"><img src="themes/images/ico-cart.png" alt="cart">Keranjang Belanja  </a></div>
        
    </div>
<!-- Sidebar end=============================================== -->
    <div class="span9">
    <ul class="breadcrumb">
        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
        <li class="active"> Checkout</li>
    </ul>
    <h3>  Checkout <a href="index.php" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Lanjut Belanja </a></h3>   
    <hr class="soft"/> 
 
 
 
    <?php
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $sql = $koneksi->query("SELECT * FROM promo WHERE kode_promo='".$_POST['kode_promo']."' ");
    $data = $sql->fetch_assoc();
        
    $_SESSION['kode'] = $data['kode_promo'];
    $_SESSION['diskon'] = $data['diskon'];
    $kode = $_SESSION['kode'];
    $diskon = $_SESSION['diskon'];
    if (!empty(isset($_POST['kode_promo']) == " ")) {
        # code...
        if (!empty(isset($_POST['kode_promo']) == $kode)) {
            echo "Kode Promo Cocok : " .$kode. "<br>";
            echo "Diskon : " .$diskon. " %";
        } else {
            echo "Kode Promo tidak cocok... silahkan coba lagi !!";
        }
    }
    ?>
    <table class="table table-bordered" >
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Produk</th>
                  <th>Harga</th>
                  <th>Jumlah</th>
                  <th>Stok</th>
                  <th>Sub Total</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $nomor=1; ?>
                <?php $totalbelanja=0; ?>
                <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
                <!-- menampilkan produk yang sedang diperulangkan berdasarkan id_produk -->
                <?php
                $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                $pecah = $ambil->fetch_assoc();
                $subtotal = $pecah["harga_produk"]*$jumlah;
                
                $hasilx = ($subtotal*$diskon)/100;
                $subtotal = ($subtotal-$hasilx);
                ?>
                
                <tr>
                  <td><?php echo $nomor; ?></td>
                  <td><?php echo $pecah["nama_produk"]; ?></td>
                  <td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
                  <td><?php echo $jumlah; ?></td>
                  <td><?php echo $pecah['stok']; ?></td>
                  <td>Rp. <?php echo number_format($subtotal); ?></td>
                  <td><a href="detail.php?id=<?php echo $pecah['id_produk']; ?>" class="btn btn-primary"> Detail</a></td>
                </tr>
                <?php $nomor++; ?>
                <?php $totalbelanja+=$subtotal;

                //$hasilx = ($totalbelanja*$diskon)/100;
                //$hasil = ($totalbelanja-$hasilx);

                ?>
                <?php endforeach?>
 
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="6">Total Belanja</th>
                        <th id="hasil">Rp. <?php echo number_format($totalbelanja) ?></th>
                    </tr>
                <tfoot>
            </table>
            
            <?php
            $id = $_SESSION['pelanggan']['id_pelanggan'];
            $sql = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan = '$id'");
            $datax = $sql->fetch_assoc();
            ?>
            <form method="post">
            <ul class="thumbnails">
                <li class="span3">
                <div class="from-group">
                    <label>User</label>
                    <input type="text" readonly value="<?php echo $datax['nama_pelanggan']; ?>" class="from-control">
                </div></li>
                
                <?php
                $id = $_SESSION['pelanggan']['id_pelanggan'];
                $sql = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan = '$id'");
                $data = $sql->fetch_assoc();
                $telepon = $data['telepon_pelanggan'];

                if (!empty($telepon)) {
                    ?>
                    <li class="span3"> 
                        <div class="from-group">
                            <label>Telp/hp</label>
                            <input type="text" readonly value="<?php echo $telepon; ?>" class="from-control">
                        </div>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="span3"> 
                        <div class="from-group">
                            <p>Data belum diperbarui,<br><a href="userEdit.php?id=<?php echo $_SESSION['pelanggan']['id_pelanggan']; ?>" style="color: blue;">silahkan perbarudi data diri anda</a></p>
                        </div>
                    </li>
                    <?php
                }
                ?>

                <li class="span3"> 
                    <div class="from-group">
                        <label>Berat (gram)</label>
                        <input type="text" name="berat" id="berat" readonly="" value="<?php echo $pecah['berat']; ?>" class="from-control">
                    </div>
                </li>

                <li class="span3"> 
                <div class="from-group">
                    <label>Kurir</label>
                    <select class="form-control" name="kurir" id="kurir">
                    <option value="">Kurir Ongkir</option>
                    <?php
                        $ambil = $koneksi->query("SELECT * FROM ongkir");
                        while ($jasa = $ambil->fetch_assoc()) {
                            # code...
                            ?>
                            <option value="<?php echo $jasa['nama_jasa']; ?>"><?php echo $jasa['nama_jasa']; ?></option>
                            <?php
                        }
                    ?>
                    </select>
                    <?php
                        $ambil = $koneksi->query("SELECT * FROM admin");
                        $admin = $ambil->fetch_assoc();
                    ?>
                    <input type="hidden" name="asal" id="asal" value="<?php echo $admin['id_kota_toko']; ?>">
                    <input type="hidden" name="kabupaten" id="kabupaten" value="<?php echo $datax['id_kota']; ?>">
                </div>
                </li>

                <li class="span3"> 
                <div class="from-group">
                    <label>Tarif</label>
                    <select class="form-control" name="ongkir" id="ongkir">
                    <option value="">Tarif Ongkir</option>
                    </select>
                </div>
                </li>

                <li class="span3">
                    <div class="from-group">
                        <label>Kode promo</label>
                        <input id="txt_promo" type="text" name="kode_promo" class="form-control" value="<?php echo $_POST['kode_promo']; ?>">
                        <input id="btn_cek" type="submit" name="kirim" class="btn btn-warning" value="cek">
                    </div>
                </li>

                <?php
                $id = $_SESSION['pelanggan']['id_pelanggan'];
                $sql = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan = '$id'");
                $data = $sql->fetch_assoc();
                $alamat = $data['alamat_pelanggan'];

                if (!empty($alamat)) {
                    ?>
                    <li class="span3">
                        <div class="from-group">
                            <label> Alamat Tujuan Pembelian </label>
                            <input type="hidden" name="alamat_pengiriman" value="<?php echo $alamat; ?>">
                            <textarea name="alamat_pengiriman" disabled=""><?php echo $alamat; ?></textarea>
                        </div>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="span3">
                        <div class="from-group">
                            <label> Alamat Tujuan Pembelian </label>
                            <p>Data belum diperbarui,<br><a href="userEdit.php?id=<?php echo $_SESSION['pelanggan']['id_pelanggan']; ?>" style="color: blue;">silahkan perbarudi data diri anda</a></p>
                        </div>
                    </li>
                    <?php
                }
                ?>


            </ul>

            <button class="btn btn-primary" name="checkout"><i class="icon-arrow-right"></i> Checkout</button> 
            </form>    
           <?php //echo number_format($totalbelanja) ?>
            <?php
            if (isset($_POST["checkout"]))
            {

                $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
                $nama_jasa = $_POST["kurir"];
                $tarif_ongkir = $_POST['ongkir'];
                $tanggal_pembelian = date("Y-m-d");
                $alamat_pengiriman = $_POST['alamat_pengiriman'];
               

                $sql = $koneksi->query("SELECT * FROM promo WHERE kode_promo='".$_POST['kode_promo']."' ");
                $data = $sql->fetch_assoc();
        
                $kode = $data['kode_promo'];
                $diskon = $data['diskon'];

                $sql_ongkir = $koneksi->query("UPDATE ongkir SET tarif = '$tarif_ongkir' WHERE nama_jasa='$nama_jasa'");


                $ambil = $koneksi->query("SELECT * FROM ongkir WHERE nama_jasa='$nama_jasa'");
                $arrayongkir = $ambil->fetch_assoc();
                $kode_ongkir = $arrayongkir['kode_ongkir'];
                $nama_kurir = $arrayongkir['nama_jasa'];
                $tarif = $arrayongkir['tarif'];

                //$hasilx = ($totalbelanja*$diskon)/100;
                //$totalbelanja = ($totalbelanja*$diskon)/100;

                $total_pembelian = $totalbelanja + $tarif;
               
                //1. menyimpan data ke table pembelian
                $koneksi->query("INSERT INTO pembelian (
                    id_pelanggan,kode_ongkir,tanggal_pembelian,total_pembelian,nama_jasa,tarif,alamat_pengiriman,kode_promo)
                    VALUES ('$id_pelanggan','$kode_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kurir','$tarif','$alamat_pengiriman','".$_POST['kode_promo']."') "
                );
               
                //mendapatkan id_pembelian barusan terjadi
                $id_pembelian_barusan = $koneksi->insert_id;
               
                foreach ($_SESSION["keranjang"] as $id_produk => $jumlah)
                {
                   
                    //mendapatkan data produk berdasarkan id_produk
                    $ambil = $koneksi->query("SELECT * FROM produk join sub_kategori using(sub_id) WHERE id_produk='$id_produk'");
                    $perproduk = $ambil->fetch_assoc();
                   
                    $nama = $perproduk['nama_produk'];
                    $harga = $perproduk['harga_produk'];
                    $sub = $perproduk['sub_id'];
                    $brand = $perproduk['brand'];  
                   
                    $subharga = $perproduk['harga_produk']*$jumlah;
                    $koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,nama,harga,sub_id,brand,subharga,jumlah,ket)
                    VALUES ('$id_pembelian_barusan','$id_produk','$nama','$harga','$sub','$brand','$subharga','$jumlah','belum bayar') ");
 
                    //skrip update stok
                    $koneksi->query("UPDATE produk SET stok=stok -$jumlah WHERE id_produk='$id_produk'");
                }
               
                // mengkosongkan keranjang belanja
                unset($_SESSION['keranjang']);
               
                //tampilan dialihkan ke halaman nota, nota dari pembelian yang barusan
                echo "<script>alert('pembelian sukses');</script>";
                echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
            }
            ?>
           
        <!-- <pre><//?php print_r($_SESSION["pelanggan"]); ?></pre> -->
        <!-- <pre><//?php print_r($_SESSION["keranjang"]); ?></pre> -->
</div>
</div></div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->
    <div  id="footerSection">
    <div class="container">
        <div class="row">
            <div id="socialMedia" class="span3 pull-right">
                <h5>SOCIAL MEDIA </h5>
                <a href="#"><img width="30" height="30" src="themes/images/facebook.png" title="facebook" alt="facebook"/></a>
                <a href="#"><img width="30" height="30" src="themes/images/twitter.png" title="twitter" alt="twitter"/></a>
                <a href="#"><img width="30" height="30" src="themes/images/youtube.png" title="youtube" alt="youtube"/></a>
             </div>
         </div>
        <p class="pull-right">&copy;Tim Rewo</p>
    </div><!-- Container End -->
    </div>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
    <script src="themes/js/jquery.js" type="text/javascript"></script>
    <script src="themes/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="themes/js/google-code-prettify/prettify.js"></script>
   
    <script src="themes/js/bootshop.js"></script>
    <script src="themes/js/jquery.lightbox-0.5.js"></script>
   
    <!-- Themes switcher section ============================================================================================= -->
<div id="secectionBox">
<link rel="stylesheet" href="themes/switch/themeswitch.css" type="text/css" media="screen" />
<script src="themes/switch/theamswitcher.js" type="text/javascript" charset="utf-8"></script>
    <div id="themeContainer">
    <div id="hideme" class="themeTitle">Style Selector</div>
    <div class="themeName">Oregional Skin</div>
    <div class="images style">
    <a href="themes/css/#" name="bootshop"><img src="themes/switch/images/clr/bootshop.png" alt="bootstrap business templates" class="active"></a>
    <a href="themes/css/#" name="businessltd"><img src="themes/switch/images/clr/businessltd.png" alt="bootstrap business templates" class="active"></a>
    </div>
    <div class="themeName">Bootswatch Skins (11)</div>
    <div class="images style">
        <a href="themes/css/#" name="amelia" title="Amelia"><img src="themes/switch/images/clr/amelia.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="spruce" title="Spruce"><img src="themes/switch/images/clr/spruce.png" alt="bootstrap business templates" ></a>
        <a href="themes/css/#" name="superhero" title="Superhero"><img src="themes/switch/images/clr/superhero.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="cyborg"><img src="themes/switch/images/clr/cyborg.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="cerulean"><img src="themes/switch/images/clr/cerulean.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="journal"><img src="themes/switch/images/clr/journal.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="readable"><img src="themes/switch/images/clr/readable.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="simplex"><img src="themes/switch/images/clr/simplex.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="slate"><img src="themes/switch/images/clr/slate.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="spacelab"><img src="themes/switch/images/clr/spacelab.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="united"><img src="themes/switch/images/clr/united.png" alt="bootstrap business templates"></a>
        <p style="margin:0;line-height:normal;margin-left:-10px;display:none;"><small>These are just examples and you can build your own color scheme in the backend.</small></p>
    </div>
    <div class="themeName">Background Patterns </div>
    <div class="images patterns">
        <a href="themes/css/#" name="pattern1"><img src="themes/switch/images/pattern/pattern1.png" alt="bootstrap business templates" class="active"></a>
        <a href="themes/css/#" name="pattern2"><img src="themes/switch/images/pattern/pattern2.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="pattern3"><img src="themes/switch/images/pattern/pattern3.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="pattern4"><img src="themes/switch/images/pattern/pattern4.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="pattern5"><img src="themes/switch/images/pattern/pattern5.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="pattern6"><img src="themes/switch/images/pattern/pattern6.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="pattern7"><img src="themes/switch/images/pattern/pattern7.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="pattern8"><img src="themes/switch/images/pattern/pattern8.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="pattern9"><img src="themes/switch/images/pattern/pattern9.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="pattern10"><img src="themes/switch/images/pattern/pattern10.png" alt="bootstrap business templates"></a>
       
        <a href="themes/css/#" name="pattern11"><img src="themes/switch/images/pattern/pattern11.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="pattern12"><img src="themes/switch/images/pattern/pattern12.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="pattern13"><img src="themes/switch/images/pattern/pattern13.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="pattern14"><img src="themes/switch/images/pattern/pattern14.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="pattern15"><img src="themes/switch/images/pattern/pattern15.png" alt="bootstrap business templates"></a>
       
        <a href="themes/css/#" name="pattern16"><img src="themes/switch/images/pattern/pattern16.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="pattern17"><img src="themes/switch/images/pattern/pattern17.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="pattern18"><img src="themes/switch/images/pattern/pattern18.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="pattern19"><img src="themes/switch/images/pattern/pattern19.png" alt="bootstrap business templates"></a>
        <a href="themes/css/#" name="pattern20"><img src="themes/switch/images/pattern/pattern20.png" alt="bootstrap business templates"></a>
         
    </div>
    </div>
</div>
<span id="themesBtn"></span>
<script type="text/javascript">
    var txt_promo = document.getElementById('txt_promo').innerHTML;
    var btn = document.getElementById('btn_cek');

    btn.addEventListener('click', function () {
        // body...
        console.log(txt_promo);
    });
    
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">

      $(document).ready(function(){


        $("#kurir").change(function(){
      //Mengambil value dari option select provinsi asal, kabupaten, kurir, berat kemudian parameternya dikirim menggunakan ajax 
      var asal = $('#asal').val();
      var kab = $('#kabupaten').val();
      var kurir = $('#kurir').val();
      var berat = $('#berat').val();

      $.ajax({
        type : 'POST',
        //dataType : 'json',
        //url : 'http://rajaongkir.indoweb.xyz/cek_ongkir.php',
        url : 'http://localhost/latihan/rajaongkir/cek_ongkir.php',
        data :  {'kab_id' : kab, 'kurir' : kurir, 'asal' : asal, 'berat' : berat},
        success: function (data) {

          //jika data berhasil didapatkan, tampilkan ke dalam element p ongkir
          //$("#ongkir").html(JSON.parse(data));
          $("#ongkir").html(data);
          //document.getElementsByTagName('textarea')[0].value = data.length;
          //document.getElementsByTagName('textarea')[0].value = JSON.stringify(data);
          var jsonData = data;
          for (var i = 0; i < jsonData.counters.length; i++) {
              var counter = jsonData.counters[i];
              console.log(counter.counter_name);
          }

        }
      });
    });
      });
    </script>


</body>
</html>