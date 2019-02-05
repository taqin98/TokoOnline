<?php
include('koneksi.php');


if(isset($_POST['view'])){

// $koneksi = mysqli_connect("localhost", "root", "", "notif");

if($_POST["view"] != '')
{
    $update_query = "UPDATE pembelian SET status = 1 WHERE status=0";
    mysqli_query($koneksi, $update_query);
}
$query = "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan ORDER BY id_pembelian DESC LIMIT 5";
$result = mysqli_query($koneksi, $query);
$output = '';
if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_array($result))
 {
   $output .= '
   <li>
   <a href="#">
   <strong>'.$row["nama_pelanggan"].'</strong><br />
   <small><em>'.$row["tanggal_pembelian"].'</em></small>
   </a>
   </li>
   ';

 }
}
else{
     $output .= '
     <li><a href="#" class="text-bold text-italic">No Noti Found</a></li>';
}



$status_query = "SELECT * FROM pembelian WHERE status=0";
$result_query = mysqli_query($koneksi, $status_query);
$count = mysqli_num_rows($result_query);
$data = array(
    'notification' => $output,
    'unseen_notification'  => $count
);

echo json_encode($data);

}

?>