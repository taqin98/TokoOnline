<?php
session_start();
//koneksi ke database
include 'koneksi.php';
//$sid = session_id();
//echo $sid;

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>JDK Adventure</title>
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
	<style type="text/css">
		.img-replace {
  /* replace text with an image */
  display: inline-block;
  overflow: hidden;
  text-indent: 100%; 
  color: transparent;
  white-space: nowrap;
}
.bts-popup {
  position: fixed;
  left: 0;
  top: 0;
  height: 100%;
  width: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  opacity: 0;
  visibility: hidden;
  -webkit-transition: opacity 0.3s 0s, visibility 0s 0.3s;
  -moz-transition: opacity 0.3s 0s, visibility 0s 0.3s;
  transition: opacity 0.3s 0s, visibility 0s 0.3s;
}
.bts-popup.is-visible {
  opacity: 1;
  visibility: visible;
  -webkit-transition: opacity 0.3s 0s, visibility 0s 0s;
  -moz-transition: opacity 0.3s 0s, visibility 0s 0s;
  transition: opacity 0.3s 0s, visibility 0s 0s;
}

.bts-popup-container {
  position: relative;
  width: 90%;
  max-width: 400px;
  margin: 4em auto;
  background: transparent;
  border-radius: none; 
  text-align: center;
  box-shadow: 0 0 2px rgba(0, 0, 0, 0.2);
  -webkit-transform: translateY(-40px);
  -moz-transform: translateY(-40px);
  -ms-transform: translateY(-40px);
  -o-transform: translateY(-40px);
  transform: translateY(-40px);
  /* Force Hardware Acceleration in WebKit */
  -webkit-backface-visibility: hidden;
  -webkit-transition-property: -webkit-transform;
  -moz-transition-property: -moz-transform;
  transition-property: transform;
  -webkit-transition-duration: 0.3s;
  -moz-transition-duration: 0.3s;
  transition-duration: 0.3s;
}
.bts-popup-container img {
  padding: 20px 0 0 0;
}
.bts-popup-container p {
	color: white;
  padding: 10px 40px;
}
.bts-popup-container .bts-popup-button {
  padding: 5px 25px;
  border: 2px solid white;
	display: inline-block;
  margin-bottom: 10px;
}

.bts-popup-container a {
  color: white;
  text-decoration: none;
  text-transform: uppercase;
}






.bts-popup-container .bts-popup-close {
  position: absolute;
  top: 8px;
  right: 8px;
  width: 30px;
  height: 30px;
}
.bts-popup-container .bts-popup-close::before, .bts-popup-container .bts-popup-close::after {
  content: '';
  position: absolute;
  top: 12px;
  width: 16px;
  height: 3px;
  background-color: white;
}
.bts-popup-container .bts-popup-close::before {
  -webkit-transform: rotate(45deg);
  -moz-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  -o-transform: rotate(45deg);
  transform: rotate(45deg);
  left: 8px;
}
.bts-popup-container .bts-popup-close::after {
  -webkit-transform: rotate(-45deg);
  -moz-transform: rotate(-45deg);
  -ms-transform: rotate(-45deg);
  -o-transform: rotate(-45deg);
  transform: rotate(-45deg);
  right: 6px;
  top: 13px;
}
.is-visible .bts-popup-container {
  -webkit-transform: translateY(0);
  -moz-transform: translateY(0);
  -ms-transform: translateY(0);
  -o-transform: translateY(0);
  transform: translateY(0);
}
@media only screen and (min-width: 1170px) {
  .bts-popup-container {
    margin: 8em auto;
  }
}
	</style>

  </head>

<?php include 'menu.php'; ?>

<div id="carouselBlk">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner"> 
		<?php
         include 'koneksi.php';
         $sql = mysqli_query($koneksi,"SELECT * from slider order by id desc");
         while ($data = mysqli_fetch_array($sql))
         {
          //echo $data['file_name'];
            ?>
		  <div class="item">
		  <div class="container">
			<a href="#"><img style="width:100%" src="pages/slider/<?php echo $data['file_name']; ?>" alt=""/></a>
				<div class="carousel-caption">
				  <h4>Second Thumbnail label</h4>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				</div>
		  </div>
		  </div>
		   <?php
         }
      ?>

		  </div>
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
	  </div> 
</div>
<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	<div id="sidebar" class="span3">
		
		<div class="well well-small">
		<a id="myCart" href="keranjang.php" style="color: white;">	
				<img src="themes/images/shopping-cart.png" style="width: 20px; height: 100%; margin-top: 6px;" alt="cart">Keranjang Belanja
				<span class="badge badge-warning pull-right">
					<?php
					if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
					{
						echo "0";
					} else{
							echo count($_SESSION["keranjang"]);
						}

					?>
				</span>
			</a>
		</div>
		
		<ul id="sideManu" class="nav nav-tabs nav-stacked">
		<?php
		$sql = mysqli_query($koneksi,"SELECT * FROM kategori");

		while($r=mysqli_fetch_array($sql)) {
			//echo $r['kategori_id'];
			echo "<li class='subMenu open'><a href='#'>".$r['nama_kategori']."</a>";

			$sql2 = mysqli_query($koneksi,"SELECT * FROM sub_kategori WHERE kategori_id ='".$r['kategori_id']."' ");

			if($sql2) {
				echo "<ul>";
				while($d=mysqli_fetch_array($sql2)) {
					?>
					<li><a href="index.php?sub_id=<?php echo $d['sub_id']; ?>"><?php echo $d['sub_nama']; ?></a></li>
					<?php

				}
				echo "</ul>";
			} else {
				echo "</li>";
			}
		}
	?>
		</ul>
	</div>

<!-- Sidebar end=============================================== -->
		<div class="span9">		
		<?php
        if(isset($_GET['cari']))
        {
            $cari = $_GET['cari'];
            echo "<b>Hasil pencarian : ".$cari."</b>";
        }
        ?>     
        <h4>Produk </h4>
            <ul class="thumbnails">
        <?php
            if(isset($_GET['cari']))
            {
                $cari = $_GET['cari'];
                $sqlcari = "SELECT
  `produk`.`id_produk`,
  `produk`.`alamat_distro`,
  `produk`.`nama_produk`,
  `produk`.`harga_produk`,
  `produk`.`stok`,
  `produk`.`brand`,
  `produk`.`foto_produk`,
  `produk`.`deskripsi_produk`,
  `sub_kategori`.`sub_id`,
  `sub_kategori`.`sub_nama`,
  `kategori`.`kategori_id`,
  `kategori`.`nama_kategori`
FROM
  `produk`
  INNER JOIN `sub_kategori` ON `produk`.`sub_id` = `sub_kategori`.`sub_id`
  INNER JOIN `kategori` ON `sub_kategori`.`kategori_id` =
`kategori`.`kategori_id` where nama_produk like '%".$cari."%' GROUP BY id_produk ";
                $data = mysqli_query($koneksi,$sqlcari);            
            }elseif (isset($_GET['sub_id'])) {
            	# code...
            	$sql_cat = "SELECT * from produk join sub_kategori using(sub_id) join kategori using(Kategori_id) where sub_id='".$_GET['sub_id']."' GROUP BY id_produk";
            	$data = mysqli_query($koneksi,$sql_cat);
            } 
            else{
            	$sql = "SELECT
  `produk`.`id_produk`,
  `produk`.`alamat_distro`,
  `produk`.`nama_produk`,
  `produk`.`harga_produk`,
  `produk`.`stok`,
  `produk`.`brand`,
  `produk`.`foto_produk`,
  `produk`.`deskripsi_produk`,
  `sub_kategori`.`sub_id`,
  `sub_kategori`.`sub_nama`,
  `kategori`.`kategori_id`,
  `kategori`.`nama_kategori`
FROM
  `produk`
  INNER JOIN `sub_kategori` ON `produk`.`sub_id` = `sub_kategori`.`sub_id`
  INNER JOIN `kategori` ON `sub_kategori`.`kategori_id` =
`kategori`.`kategori_id` GROUP BY id_produk";
                $data = mysqli_query($koneksi,$sql);

}

                $no = 1;
                while($perproduk = mysqli_fetch_array($data))
                {
                    ?> 

                <li class="span2">
                  <div class="thumbnail">
                    <a  href="detail.php?id=<?php echo $perproduk['id_produk']; ?>"><img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt=""/></a>
                    <div class="caption">
                      <h5><?php echo $perproduk['nama_produk']; ?></h5>
                      <p>Kategori :
                        <?php echo $perproduk['nama_kategori']; ?>
                      </p>                     
                      <h4 style="text-align:center">
                      <a class="btn" href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" >Detail</a>
                      <a class="btn" href="beli.php?id=<?php echo $perproduk['id_produk']; ?>">Tambah ke <i class="icon-shopping-cart"></i></a>
                      <button class="btn btn-primary" >Rp. <?php echo number_format($perproduk['harga_produk']); ?></button></h4>
                    </div>
                  </div>
                </li>
                <?php 
            } 
            
            ?>
			  </ul>	

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
<!--<div id="secectionBox">
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
-->
<div class="bts-popup" role="alert">
    <div class="bts-popup-container">
      <?php 
          $data = $_SESSION['promo'];
          if (!empty($data)) {
            ?>
            <img src="pages/promo/<?php echo $data['foto']; ?>" alt="" width="80%" />
            <?php
            
            echo "<p>";
            echo $data['judul_promo'];
            echo "<br>";
            echo $data['desc_promo'];
            echo "</p>";
          }
          ?>
				<div class="bts-popup-button">
		       <a href="#0">Enter</a>
         </div>
        <a href="#0" class="bts-popup-close img-replace">Close</a>
    </div>
</div>


<?php
error_reporting(0);


if (isset($_SESSION['popup']) == 1) {
  $data = $_SESSION['pelanggan'];
  $nama = $data['nama_pelanggan'];
  //echo 'var nama = "'.$nama.'"';
	?>
	<script type="text/javascript">
  
	jQuery(document).ready(function($){   
  
	
  var nama = localStorage.getItem('nama');
    if (nama== null) {
        localStorage.setItem('nama', 1);

        // Show popup here
        $(".bts-popup").delay(700).addClass('is-visible');
    }

	//open popup
	$('.bts-popup-trigger').on('click', function(event){
		event.preventDefault();
		$('.bts-popup').addClass('is-visible');
	});
	
	//close popup
	$('.bts-popup').on('click', function(event){
		if( $(event.target).is('.bts-popup-close') || $(event.target).is('.bts-popup') ) {
			event.preventDefault();
			$(this).removeClass('is-visible');

      
		}

	});
	//close popup when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$('.bts-popup').removeClass('is-visible');

         
	    }
    });

});
</script>
	<?php

} else {
	?>
	<script type="text/javascript">
		console.log("session kosong");
	</script>
	<?php
}
?>
<script type="text/javascript">
  jQuery(document).ready(function($){   

        // Show popup here
        $('#jajal').on('click', function(event){
        localStorage.removeItem('nama');

  });



});
</script>
</body>
</html>