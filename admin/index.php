<?php 
session_start();
//koneksi ke database
include 'data/koneksi.php';

// if (!isset($_SESSION['akutansi']))
// {
//   echo "<script>alert('Anda Harus Login');</script>";
//   echo "<script>location='login.php';</script>";
//   header('location:login.php');
//   exit();
// } 

if (isset($_SESSION['admin'])) {
  # ada super admin...
  # echo "ada super admin";

} elseif (isset($_SESSION['akutansi'])) {
  # code...
  # echo "ada akutansi";

} elseif (isset($_SESSION['gudang'])) {
  # code...
  echo "ada user gudang ";

} else {

  echo "tidak ada";
  echo "<script>alert('Anda Harus Login');</script>";
  echo "<script>location='login.php';</script>";
  header('location:login.php');
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>JDK SHOP | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style type="text/css">
    input[type=text]#total {
    width: 6%;
    text-align: center;
    padding: 5px;
    margin: 4px;
    margin-bottom: 15px;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>JDK</b> ADVENTURE</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->


          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle hitung" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning" id="count">
                8
              </span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <span id="count"></span> notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu" id="notif">
                  <?php
                  error_reporting(E_ALL ^ ( E_WARNING));

                  $sql = "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan order by id_pembelian desc LIMIT 5";
                  $result = mysqli_query($koneksi,$sql);

                  while ($data = mysqli_fetch_array($result)) {
                    # code...
                    ?>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua" id="dropdown-toggle"></i>
                      <?php
                        echo $data[nama_pelanggan];
                        echo " ";
                        echo $data[tanggal_pembelian];

                      ?>
                    </a>
                  </li>
                    <?php

                  }
                  ?>

                  <!--
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                -->
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">
                <?php
                  if (isset($_SESSION['admin'])) {
                    # code...
                    echo $_SESSION['admin']['nama_lengkap'];

                  } elseif (isset($_SESSION['akutansi'])) {
                    # code...
                    echo $_SESSION['akutansi']['nama_lengkap'];

                  } elseif (isset($_SESSION['gudang'])) {
                    # code...
                    echo $_SESSION['gudang']['nama_lengkap'];

                  }
                ?>                  
                </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php
                  if (isset($_SESSION['admin'])) {
                    # code...
                    echo $_SESSION['admin']['nama_lengkap'];

                  } elseif (isset($_SESSION['akutansi'])) {
                    # code...
                    echo $_SESSION['akutansi']['nama_lengkap'];

                  } elseif (isset($_SESSION['gudang'])) {
                    # code...
                    echo $_SESSION['gudang']['nama_lengkap'];

                  }
                  ?>
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <!--
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                -->
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <!--
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
              -->
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Logout out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php
                  if (isset($_SESSION['admin'])) {
                    # code...
                    echo $_SESSION['admin']['nama_lengkap'];

                  } elseif (isset($_SESSION['akutansi'])) {
                    # code...
                    echo $_SESSION['akutansi']['nama_lengkap'];

                  } elseif (isset($_SESSION['gudang'])) {
                    # code...
                    echo $_SESSION['gudang']['nama_lengkap'];

                  }
                ?>
                  
          </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="index.php">
             <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="../index.php">
            <i class="fa fa-home"></i> <span>Home Jdk Adventure</span>
          </a>
        </li>

        <?php

        if (isset($_SESSION['admin'])) {
                    # code...
          ?>         
          <li>
            <a href="index.php?halaman=produk">
              <i class="fa fa-files-o"></i>
              <span>Data Produk</span>
              <span class="pull-right-container">
                <span class="label label-primary pull-right">
                  <?php
                  $sql = mysqli_query($koneksi,"SELECT count(*) as jumlah FROM produk");
                  $result = mysqli_fetch_array($sql);
                  echo $result['jumlah'];
                  ?>
                </span>
              </span>
            </a>
          </li>

          <li>
            <a href="index.php?halaman=kategori">
              <i class="fa fa-files-o"></i>
              <span>Data Kategori</span>
              <span class="pull-right-container">
                <span class="label label-primary pull-right">
                  <?php
                  $sql = mysqli_query($koneksi,"SELECT count(*) as jumlah FROM kategori");
                  $result = mysqli_fetch_array($sql);
                  echo $result['jumlah'];
                  ?>
                </span>
              </span>
            </a>
          </li>

          <li>
            <a href="index.php?halaman=pembelian">
              <i class="fa fa-files-o"></i>
              <span>Data Transaksi</span>
              <span class="pull-right-container">
                <span class="label label-primary pull-right">
                  <?php
                  $sql = mysqli_query($koneksi,"SELECT count(*) as jumlah FROM pembelian");
                  $result = mysqli_fetch_array($sql);
                  echo $result['jumlah'];
                  ?>
                </span>
              </span>
            </a>
          </li>

          <li>
            <a href="index.php?halaman=pelanggan">
              <i class="fa fa-files-o"></i>
              <span>Data Pelanggan</span>
              <span class="pull-right-container">
                <span class="label label-primary pull-right">
                  <?php
                  $sql = mysqli_query($koneksi,"SELECT count(*) as jumlah FROM pelanggan");
                  $result = mysqli_fetch_array($sql);
                  echo $result['jumlah'];
                  ?>
                </span>
              </span>
            </a>
          </li>

          <li>
            <a href="index.php?halaman=user_admin">
              <i class="fa fa-files-o"></i>
              <span>Data Admin</span>
              <span class="pull-right-container">
                <span class="label label-primary pull-right">
                  <?php
                  $sql = mysqli_query($koneksi,"SELECT count(*) as jumlah FROM admin");
                  $result = mysqli_fetch_array($sql);
                  echo $result['jumlah'];
                  ?>
                </span>
              </span>
            </a>
          </li>

          <li>
            <a href="index.php?halaman=sliderUpload">
              <i class="fa fa-files-o"></i>
              <span>Slider</span>
              <span class="pull-right-container">
                <span class="label label-primary pull-right">
                 <?php
                 $sql = mysqli_query($koneksi,"SELECT count(*) as jumlah FROM slider");
                 $result = mysqli_fetch_array($sql);
                 echo $result['jumlah'];
                 ?>
               </span>
             </span>
           </a>
         </li>
         <li>
          <a href="index.php?halaman=promo">
            <i class="fa fa-files-o"></i>
            <span>Data Promo</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">
               <?php
               $sql = mysqli_query($koneksi,"SELECT count(*) as jumlah FROM promo");
               $result = mysqli_fetch_array($sql);
               echo $result['jumlah'];
               ?>
             </span>
           </span>
         </a>
       </li>
       <?php

        } elseif (isset($_SESSION['akutansi'])) {
                    # code...
          ?>
          <li>
            <a href="index.php?halaman=pembelian">
              <i class="fa fa-files-o"></i>
              <span>Data Transaksi</span>
              <span class="pull-right-container">
                <span class="label label-primary pull-right">
                  <?php
                  $sql = mysqli_query($koneksi,"SELECT count(*) as jumlah FROM pembelian");
                  $result = mysqli_fetch_array($sql);
                  echo $result['jumlah'];
                  ?>
                </span>
              </span>
            </a>
          </li>
          <?php

        } elseif (isset($_SESSION['gudang'])) {
          //session_destroy();
          ?>
          <li>
            <a href="index.php?halaman=produk">
              <i class="fa fa-files-o"></i>
              <span>Data Produk</span>
              <span class="pull-right-container">
                <span class="label label-primary pull-right">
                  <?php
                  $sql = mysqli_query($koneksi,"SELECT count(*) as jumlah FROM produk");
                  $result = mysqli_fetch_array($sql);
                  echo $result['jumlah'];
                  ?>
                </span>
              </span>
            </a>
          </li>

          <li>
            <a href="index.php?halaman=kategori">
              <i class="fa fa-files-o"></i>
              <span>Data Kategori</span>
              <span class="pull-right-container">
                <span class="label label-primary pull-right">
                  <?php
                  $sql = mysqli_query($koneksi,"SELECT count(*) as jumlah FROM kategori");
                  $result = mysqli_fetch_array($sql);
                  echo $result['jumlah'];
                  ?>
                </span>
              </span>
            </a>
          </li>
          <?php

        } else {

          ?>         

          <li>
            <a href="index.php?halaman=pelanggan">
              <i class="fa fa-files-o"></i>
              <span>Data Pelanggan</span>
              <span class="pull-right-container">
                <span class="label label-primary pull-right">
                  <?php
                  $sql = mysqli_query($koneksi,"SELECT count(*) as jumlah FROM pelanggan");
                  $result = mysqli_fetch_array($sql);
                  echo $result['jumlah'];
                  ?>
                </span>
              </span>
            </a>
          </li>

          <li>
            <a href="index.php?halaman=sliderUpload">
              <i class="fa fa-files-o"></i>
              <span>Slider</span>
              <span class="pull-right-container">
                <span class="label label-primary pull-right">
                 <?php
                 $sql = mysqli_query($koneksi,"SELECT count(*) as jumlah FROM slider");
                 $result = mysqli_fetch_array($sql);
                 echo $result['jumlah'];
                 ?>
               </span>
             </span>
           </a>
         </li>
         <li>
          <a href="index.php?halaman=promo">
            <i class="fa fa-files-o"></i>
            <span>Data Promo</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">
               <?php
               $sql = mysqli_query($koneksi,"SELECT count(*) as jumlah FROM promo");
               $result = mysqli_fetch_array($sql);
               echo $result['jumlah'];
               ?>
             </span>
           </span>
         </a>
       </li>
          <?php

        }
        ?>

        

        

        <li>
          <a href="logout.php">
            <i class="fa fa-sign-out"></i>
            <span>Logout</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">CPU Traffic</span>
              <span class="info-box-number">90<small>%</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Likes</span>
              <span class="info-box-number">41,410</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales</span>
              <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">New Members</span>
              <span class="info-box-number">2,000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

  

      <?php
      error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        include 'data/koneksi.php';
        
        switch ($_GET['halaman']) {
          case 'produk':
            include 'data/produk.php';
            break;

          case 'pembelian':
            include 'data/pembelian.php';
            break;
          
          case 'pelanggan':
            include 'data/pelanggan.php';
            break;


          //pembelian/transaksi
          case 'detail_pembelian':
            include 'data/pembelian_detail.php';
            break;

          case 'hapus_pembelian':
            include 'data/pembelian_hapus.php';
            break;

          case 'tambah_produk':
            include 'data/produk_tambah.php';
            break;

          case 'edit_produk':
            include 'data/produk_edit.php';
            break;
           case 'edit_proses':
             include 'data/produk_edit_proses.php';
             break;

          case 'hapus_produk':
            include 'data/produk_hapus.php';
            break;

          case 'mailer':
            include 'data/gmail.php';
            break;

          case 'sliderUpload':
            include 'data/slider_upload.php';
            break;

          case 'sliderUploadEdit':
            include 'data/slider_edit.php';
            break;
            

          case 'sliderUploadhapus':
            include 'data/slider_hapus.php';
            break;

          case 'logout':
            include 'logout.php';
            break;

          // promo
          case 'promo':
            include 'data/promo.php';
            break;

          case 'promoEdit':
            include 'data/promo_edit.php';
            break;

          case 'promoHapus':
            include 'data/promo_hapus.php';
            break;
          // End Promo


          //edit profile admin
          case 'editAdmin':
            include 'data/editAdmin.php';
            break;

          //kategori
          case 'kategori':
            include 'data/kategori.php';
            break;

          case 'tambah_kategori':
            include 'data/kategori_tambah.php';
            break;

          case 'edit_kategori':
            include 'data/kategori_edit.php';
            break;

          case 'hapus_kategori':
            include 'data/kategori_hapus.php';
            break;

          //sub kategori
          case 'tambah_sub':
            include 'data/sub_tambah.php';
            break;

          case 'edit_sub':
            include 'data/sub_edit.php';
            break;

          case 'hapus_sub':
            include 'data/sub_hapus.php';
            break;


          //Pelanggan
          case 'tambah_pelanggan':
            include 'data/user_pelanggan/pelanggan_tambah.php';
            break;

          case 'edit_pelanggan':
            include 'data/user_pelanggan/pelanggan_edit.php';
            break;

          case 'hapus_pelanggan':
            include 'data/user_pelanggan/pelanggan_hapus.php';
            break;

          //user admin
          case 'user_admin':
            include 'data/user_admin/admin_tampil.php';
            break;
          

          default:
            include 'data/home.php';
            break;
        }
      ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->

      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- CK Editor -->
<script src="bower_components/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>


<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<!--Datatables-->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

<script type="text/javascript">

      function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#showgambar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#inputgambar").change(function () {
        readURL(this);
    });

</script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    //$('.textarea').wysihtml5()
  })
</script>

<script type="text/javascript">
$(function() {
    $('#reservation').daterangepicker();
});
</script>


<!--

<script>
$(document).ready(function(){
 
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"data/ajax.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('#notif').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('#count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 

 
 $(document).on('click', '.hitung', function(){
  $('#count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();
 }, 10);
 
});
</script>

-->

</body>
</html>
