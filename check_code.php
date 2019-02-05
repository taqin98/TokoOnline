<?php
session_start();
//koneksi ke database
$koneksi = new mysqli("localhost","root","","distroku");
//$sid = session_id();
//echo $sid;
?>

<?
//get the code
mysqli_real_escape_string($connect, $_POST['code']);  

//mysql query to select field code if it's equal to the code that we checked '  
$result = mysqli_query($connect, 'select kode_promo, used from promo where kode_promo = "'. $code .'"');  
$record = mysqli_fetch_array($result);

//if number of rows fields is bigger them 0 that means the code in the database'  
if(mysqli_num_rows($result) > 0){  
    if($record['used'] == 0) {
        //and we send 0 to the ajax request  
        echo 0;
    } else{
        //and we send 1 to the ajax request  
        echo 1;  
    }
}else{  
    //else if it's not bigger then 0, then the code is not in the DB'  
    //and we send 2 to the ajax request  
    echo 2;  
}  
?>