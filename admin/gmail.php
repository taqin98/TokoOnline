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
    $mail->SMTPDebug = 1;                                 // Enable verbose debug output
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
