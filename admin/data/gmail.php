<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Detail Transaksi</h3>

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
                <?php 
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
    ON pembelian.id_pelanggan=pelanggan.id_pelanggan
    WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>


<strong><?php echo $detail['nama_pelanggan']; ?></strong><br>
<p>
    <?php echo $detail['telepon_pelanggan']; ?><br>
    <?php echo $detail['email_pelanggan']; ?>
</p>

<p>
    Tanggal :<?php echo $detail['tanggal_pembelian']; ?><br>
    Total :<?php echo $detail['total_pembelian']; ?>
</p>
              <table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>SubTotal</th>
        <tr>
    </thead>
    <tbody>
            <?php $nomor=1; ?>
            <?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON
                pembelian_produk.id_produk=produk.id_produk
                WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
            <?php while($pecah=$ambil->fetch_assoc()){ ?>   
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $pecah['nama_produk']; ?></td>
                <td><?php echo $pecah['harga_produk']; ?></td>
                <td><?php echo $pecah['jumlah']; ?></td>                
                <td>Rp. 
                    <?php echo number_format($pecah['harga_produk']*$pecah['jumlah']); ?>
                </td>
            </tr>
            
            <?php $nomor++; ?>
            <?php } ?>
            <tr>
                <td colspan="3"></td>
                <td>Ongkir : </td>
                <td>Rp. <?php echo number_format($detail['tarif']); ?></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td>Total : </td>
                <td>Rp. <?php echo number_format($detail['total_pembelian']); ?></td>
            </tr>
        
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





<?php
ob_start();
include 'data_invoice.php';
$page = ob_get_contents();
ob_clean();
?>


<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
require '../vendor/phpmailer/PHPMailer/src/Exception.php';
require '../vendor/phpmailer/PHPMailer/src/PHPMailer.php';
require '../vendor/phpmailer/PHPMailer/src/SMTP.php';

//Load Composer's autoloader
require '../vendor/autoload.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();                         // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
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
