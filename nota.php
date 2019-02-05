<?php
//koneksi ke database
session_start();
include 'koneksi.php';
 //jika tidak ada session pelanggan (blm login).mk dilarikan ke login

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

                <div class="container">
                    <h3>  Nota Pembelian </a></h3> 
                    <hr class="soft"/>
                    <?php
                    $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
                        ON pembelian.id_pelanggan=pelanggan.id_pelanggan
                        WHERE pembelian.id_pembelian='$_GET[id]'");
                    $detail = $ambil->fetch_assoc();
//print_r($detail);
                    ?>

                    <ul class="thumbnails">
                        <li class="span4">
                            <div class="col-md-3">
                                <h3>Pembelian</h3>
                                <strong>No. Pembelian: <?php echo $detail['id_pembelian'] ?></strong><br>
                                Tanggal :<?php echo $detail['tanggal_pembelian']; ?><br>
                                Total : Rp. <?php echo number_format($detail['total_pembelian']); ?>
                            </div>
                        </li>
                        <li class="span4">
                            <div class="col-md-3">
                                <h3>Pelanggan</h3>
                                <strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
                                <p>
                                    <?php echo $detail['telepon_pelanggan']; ?><br>
                                    <?php echo $detail['email_pelanggan']; ?>
                                </p>   
                            </div>
                        </li>
                        <li class="span4">
                            <div class="col-md-3">
                                <h3>Pengiriman</h3>
                                <strong style="text-transform: uppercase;"><?php echo $detail['nama_jasa']; ?></strong> <br>
                                Ongkos Kirim: Rp. <?php echo number_format($detail['tarif']); ?> <br>
                                Alamat lengkap: <?php echo $detail['alamat_pelanggan']; ?>
                            </div>
                        </li>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Sub Kategori</th>
                                    <th>Brand</th>
                                    <th>Jumlah</th>
                                    <th>SubTotal</th>
                                    <tr>
                                    </thead>
                                    <tbody> <?php
                                    $tarif = $detail['tarif'];
                                    ?>
                                    <?php $nomor=1; ?>
                                    <?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk join sub_kategori using(sub_id) WHERE id_pembelian='$_GET[id]'"); ?>
                                    <?php while($pecah=$ambil->fetch_assoc()){ ?>  
                                    <tr>
                                        <td><?php echo $nomor; ?></td>
                                        <td><?php echo $pecah['nama']; ?></td>
                                        <td>Rp. <?php echo number_format($pecah['harga']); ?></td>
                                        <td><?php echo $pecah['sub_nama']; ?></td>
                                        <td><?php echo $pecah['brand']; ?></td>
                                        <td><?php echo $pecah['jumlah']; ?></td>
                                        <td>
                                            <span class="subtot">Rp. <?php echo number_format($pecah['subharga']+$tarif); ?>
                                            </span>
                                            &nbsp; &nbsp; &nbsp;
                                            <span id="txt_diskon"></span>
                                        </td>   
                                    </tr>      
                                    <?php $nomor++;
                                    if ($detail['total_pembelian'] >= ($pecah['subharga']+$tarif)) {
    //echo  ($pecah['subharga']+$tarif) . "kurang dari " . $detail['total_pembelian'];
                                    } else {
    //echo  ($pecah['subharga']+$tarif) . "lebih dari " . $detail['total_pembelian'];
                                        ?>
                                        <style type="text/css">
                                        .subtot {
                                            text-decoration : line-through;
                                        }
                                    </style>
                                    <script type="text/javascript">
        //
        <?php
        $sql = $koneksi->query("SELECT * FROM pembelian JOIN promo
            ON pembelian.kode_promo=promo.kode_promo
            JOIN pelanggan 
            ON pembelian.id_pelanggan=pelanggan.id_pelanggan
            WHERE pembelian.id_pembelian='$_GET[id]'");
        $data = $sql->fetch_assoc();
        $diskon = $data['diskon'];
        ?>
        var diskon = <?php echo $diskon; ?>;
        console.log(diskon);

        var subtot = document.getElementsByClassName('span.subtot');
        var txt_diskon = document.getElementById('txt_diskon');

        txt_diskon.innerHTML = "Diskon Anda : " + diskon + " %";
        //subtot.addClass("subtotx");

    </script>
    <?php
}
?>
<?php } ?>     
</tbody>
</table>
        <div class="col-md-5">
            <div class="alert alert-warning">
                <?php
                $sql = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian = '$_GET[id]'");
                $pembelian_produk = $sql->fetch_assoc();
                $gambar = $pembelian_produk['bukti'];
                
                if (!empty($gambar)) {
                    
                    //echo "ada";
                    ?>
                    <img src="pages/bukti/<?php echo $gambar; ?>">
                    
                    <?php
                } else {

                    //echo "tidak ada";
                    ?>
                    <form method="POST" enctype="multipart/form-data">
                        <input type="file" name="bukti" class="form-control" required="">
                        <input type="submit" class="btn btn-primary" name="submit" value="submit">
                        <?php
                        if (isset($_POST['submit'])) {
                            $bukti  = $_FILES['bukti']['name'];
                            $lokasi = $_FILES['bukti']['tmp_name'];

                            $foto = "pages/bukti/".$bukti;
                            if (move_uploaded_file($lokasi, $foto)) {
                                $sql = $koneksi->query("UPDATE pembelian_produk SET bukti = '$bukti' WHERE id_pembelian = '$_GET[id]'");

                                $sqlx = $koneksi->query("UPDATE pembelian_produk SET ket = 'pengecekan' WHERE id_pembelian = '$_GET[id]'");

                                echo "<script>";
                                echo "alert('Berhasil Upload Bukti');";
                                echo "document.location = 'nota.php?id=$_GET[id]';";
                                echo "</script>";
                            } else {
                                echo "<script>";
                                echo "alert('Gagal Upload Bukti');";
                                echo "</script>";
                            }
                        }
                        ?>
                    </form>
                    <?php
                }


                ?>

            </div>
        </div>
    
        <div class="col-md-5">
            <div class="alert alert-info">
                <p>
                    Silahkan melakukan pembayaran Rp.<span id="total"><?php echo number_format($detail['total_pembelian']); ?></span> <br> ke
                    <strong> BANK Jateng 111-1021-0011 AN. Tim Magang Can Creative</strong>
                    <p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div> 
<!-- Footer ================================================================== -->
<?php include 'footer.php'; ?>
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
</body>
</html>

<?php
ob_start();
include 'admin/data/data_invoice.php';
$page = ob_get_contents();
ob_clean();
?>


<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
require 'vendor/phpmailer/PHPMailer/src/Exception.php';
require 'vendor/phpmailer/PHPMailer/src/PHPMailer.php';
require 'vendor/phpmailer/PHPMailer/src/SMTP.php';

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();                         // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'distrokutesting@gmail.com';                 // SMTP username
    $mail->Password = 'Distrokutesting123';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                      // TCP port to connect to
    $mail->SMTPOptions = array(
     'ssl' => array(
         'verify_peer' => false,
         'verify_peer_name' => false,
         'allow_self_signed' => true
     )
         );                                    // TCP port to connect to


    $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
        ON pembelian.id_pelanggan=pelanggan.id_pelanggan
        WHERE pembelian.id_pembelian='$_GET[id]'");
    $detail = $ambil->fetch_assoc();

    $sql = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON
        pembelian_produk.id_produk=produk.id_produk
        WHERE pembelian_produk.id_pembelian='$_GET[id]'");
    $pecah = $sql->fetch_assoc();

    //Recipients
    $mail->setFrom('distrokutesting@gmail.com', 'Admin Distroku');
    $mail->addAddress($detail['email_pelanggan']);     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $pesan = $page;
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "INVOICE#DISTROKU ".$detail['tanggal_pembelian']." PEMBERITAHUAN PEMBAYARAN";
    $mail->Body    = $pesan
    ;
    $mail->AltBody = 'Di Mohon untuk segera melakukan Pembayaran ke REKENING BANK Jateng 111-1021-0011 AN. Tim Magang Can Creative ';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

?>