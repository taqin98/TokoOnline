<?php
include 'koneksi.php';
 
$id   = $_GET['id'];
$pilih = mysqli_query($koneksi,"SELECT * from slider where id='$id'");
$data = mysqli_fetch_array($pilih);
$tempat_foto = "pages/slider/".$data['file_name']; // Lokasi file foto
unlink($tempat_foto); //untuk menghapus file di dalam folder
 
 
 
$query="DELETE from slider where id='$id'";
$del = mysqli_query($koneksi, $query);
 
if ($del)
    {
        ?>
 
        <script> alert("berhasil");document.location = "?halaman=sliderUpload";
        </script>
        <?php
    }else
    {
        ?>
   
        <script> alert("gagal");document.location:'?halaman=sliderUpload';
        </script>
        <?php
    }
?>