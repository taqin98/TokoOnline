<?php
// Load file koneksi.php
include 'koneksi.php';
date_default_timezone_set('Asia/Jakarta');
// Ambil data NIS yang dikirim oleh form_ubah.php melalui URL
$id = $_GET['id'];
 
// Ambil Data yang Dikirim dari Form
 
 
// Cek apakah user ingin mengubah fotonya atau tidak
if(isset($_POST['ubah_foto'])){ // Jika user menceklis checkbox yang ada di form ubah, lakukan :
  // Ambil data foto yang dipilih dari form
  $foto = $_FILES['foto']['name'];
  $size = $_FILES['foto']['size'];
  $type = $_FILES['foto']['type'];
  $tmp = $_FILES['foto']['tmp_name'];
  $tgl = date('Y-m-d');
  $judul = $_POST['judul'];
 
  $fotobaru = $foto;
  // Set path folder tempat menyimpan fotonya
  $path = "../pages/slider/".$foto;
 
  // Proses upload
  if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
    // Query untuk menampilkan data siswa berdasarkan NIS yang dikirim
    $query = "SELECT * FROM slider WHERE id='".$id."'";
    $sql = mysqli_query($koneksi, $query); // Eksekusi/Jalankan query dari variabel $query
    $data = mysqli_fetch_array($sql); // Ambil data dari hasil eksekusi $sql
    $tempat_foto = "../pages/slider/".$data['file_name'];
 
    // Cek apakah file foto sebelumnya ada di folder images
    if(is_file($tempat_foto)) // Jika foto ada
      unlink($tempat_foto); // Hapus file foto sebelumnya yang ada di folder images
   
    // Proses ubah data ke Database
    $query = "UPDATE slider SET
    tgl_upload='".$tgl."',
    file_name='".$fotobaru."',
    file_size='".$size."',
    file_type='".$type."',
    judul='".$judul."' WHERE id='".$id."'";
    $sql = mysqli_query($koneksi, $query); // Eksekusi/ Jalankan query dari variabel $query
 
    if($sql){ // Cek jika proses simpan ke database sukses atau tidak
      // Jika Sukses, Lakukan :
      header("location: ../index.php?halaman=sliderUpload"); // Redirect ke halaman index.php
    }else{
      // Jika Gagal, Lakukan :
      echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
      echo "<br><a href='../index.php?halaman=sliderUpload'>Kembali Ke Form</a>";
    }
  }else{
    // Jika gambar gagal diupload, Lakukan :
    echo "Maaf, Gambar gagal untuk diupload.";
    echo "<br><a href='?halaman=sliderUpload'>Kembali Ke Form</a>";
  }
}else{ // Jika user tidak menceklis checkbox yang ada di form ubah, lakukan :
  // Proses ubah data ke Database
    $tgl = date('Y-m-d');
  $judul = $_POST['judul'];
  $query = "UPDATE slider SET judul = '".$judul."', tgl_upload='".$tgl."' WHERE id='".$id."' ";
  $sql = mysqli_query($koneksi, $query); // Eksekusi/ Jalankan query dari variabel $query
 
  if($sql){ // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    header("location: index.php?halaman=sliderUpload"); // Redirect ke halaman index.php
  }else{
    // Jika Gagal, Lakukan :
 
    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
    echo "<br><a href='?halaman=sliderUpload'>Kembali Ke Form</a>";
  }
}
?>