<?php
session_start();

if (isset($_SESSION['admin'])) {
  # ada super admin...
  # echo "ada super admin";
	unset($_SESSION['admin']);

} elseif (isset($_SESSION['akutansi'])) {
  # code...
  #echo "ada akutansi";
	unset($_SESSION['akutansi']);

} elseif (isset($_SESSION['gudang'])) {
  # code...
  # echo "ada user gudang ";
	unset($_SESSION['gudang']);

}

//session_destroy();
echo "<script>alert('anda telah logout');</script>";
echo "<script>location='login.php';</script>";
?>