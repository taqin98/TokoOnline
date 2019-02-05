<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Invoice Pembayaran</title>
	<style type="text/css">
	body {
		font-family: Arial;
	}
		.container {
			width: 100%;
			height: 500px;
		}
		.card {
			padding: 25px;
			background-color: #fff;
    		border-radius: 4px;
    		box-shadow: 0 1px 8px 0 rgba(0,0,0,.2), 0 3px 4px 0 rgba(0,0,0,.14), 0 3px 3px -2px rgba(0,0,0,.12);
		}
		table {
    		border-collapse: collapse;
    		width: 100%;
    		height: 20%;
		}

		tr.bg { background-color: #FF5721; }

		td {
    		color: white;
    		text-align: center;
    		padding: 8px;
		}
		td.bg {
			background-color: #FF5721;
		}
		td.text-color {
			color: #FF5721
		}

		.flex {
			display: flex;
		}
		.box {
			padding: 20px;
			width: 100px;
		}
		img {
			width: 100%;
		}
		div#centered {
			padding: 20px; 
		}
		.dot {
  border-radius: 50%;
  width: 20px;
  height: 20px;
  padding: 8px;
  background: #ffbfb;
  border: 2px solid #666;
  color: #666;
  text-align: center;
  font: 22px Arial, sans-serif;
}
	</style>
</head>
<body>

<?php 
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
    ON pembelian.id_pelanggan=pelanggan.id_pelanggan
    WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
$tarif = $detail['tarif'];

?>

<div class="card">
		<div class="header">
			<P>Kepada Yth. <?php echo $detail['nama_pelanggan']; ?>
Ini adalah pengingat bahwa tagihan Anda yang dibuat pada <?php echo $detail['tanggal_pembelian']; ?> akan jatuh tempo pada xxxxx.</P>
		</div>
	<div class="container" style="overflow-x:auto;">
		<table border="0">
			<tr class="bg">	
				<td>Nama Produk</td>
				<td>harga</td>
				<td>Jenis</td>
				<td>Sub Total</td>
			</tr>

            <?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON
                pembelian_produk.id_produk=produk.id_produk
                WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
            <?php while($pecah=$ambil->fetch_assoc()){ ?>   
            <tr class="bg2">
                <td class="text-color"><?php echo $pecah['nama_produk']; ?></td>
                <td class="text-color"Rp. ><?php echo number_format($pecah['harga_produk']); ?></td>
                <td class="text-color"><?php echo $pecah['jenis']; ?></td>
                <td class="text-color">
                	<?php
if ($detail['total_pembelian'] >= ($pecah['subharga']+$tarif)) {
    //echo  ($pecah['subharga']+$tarif) . "kurang dari " . $detail['total_pembelian'];
    ?>
    <span class="subtot">Rp. <?php echo number_format($pecah['subharga']); ?></span>
                	&nbsp; &nbsp; &nbsp;
    <?php
} else {
    //echo  ($pecah['subharga']+$tarif) . "lebih dari " . $detail['total_pembelian'];
    $sql = $koneksi->query("SELECT * FROM pembelian JOIN promo
	ON pembelian.kode_promo=promo.kode_promo
	JOIN pelanggan 
	ON pembelian.id_pelanggan=pelanggan.id_pelanggan
	WHERE pembelian.id_pembelian='$_GET[id]'");
        $data = $sql->fetch_assoc();
        $diskon = $data['diskon'];
    ?>
    <span style="text-decoration : line-through;">Rp. <?php echo number_format($pecah['subharga']); ?></span>
                	&nbsp; &nbsp; &nbsp;
    <span>Diskon Anda : <?php echo $diskon; ?>%</span>
    <?php
    

}
            ?>
                	
                </td>        
            </tr>


            
            <?php } ?>
            <tr>
            	<td></td>
            	<td colspan="2" class="bg" style="color: white;">Ongkir :</td>
            	<td class="bg" style="color: white;">Rp. 
                    <?php echo number_format($tarif); ?>
                </td>
            </tr>
            <tr>
            <td></td>
            <td colspan="2" class="bg" style="color: white;">Total :</td>
            	<td class="bg" style="color: white;">Rp. 
                    <?php echo number_format($detail['total_pembelian']); ?>
                </td>
            </tr>
			</tbody>
		</table>
		<div id="flex" style="flex-direction: row;">
             <p>Gunakan ATM / iBanking / mBanking / Setor tunai untuk
                transfer ke rekening OrderLink berikut ini:</p>
		</div>

		<div class="flex">
			<div class="box">
				<img src="https://3.bp.blogspot.com/-ZK6W9UlA3lw/V15RGexr3yI/AAAAAAAAAJ4/nkyM9ebn_qg3_rQWyBZ1se5L_SSuuxcDACLcB/s640/Bank_Central_Asia.png">
			</div>
			<div class="box">
				<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/68/BANK_BRI_logo.svg/1280px-BANK_BRI_logo.svg.png">
			</div>
			<div class="box">
				<img src="https://3.bp.blogspot.com/-e1fOq9uUk8M/V15O0WHiIMI/AAAAAAAAAJA/IpxPlLevxLsjisy2I625Yvz-eNzgc6xfgCKgB/s1600/Logo%2BBank%2BBNI%2BPNG.png">
			</div>
		</div>

		<div class="flex">
			<P>
			No. Rekening: 084-5063112<br>
			Cabang: Wisma Asia<br>
			Nama Rekening: PT Tim Magang Kreatif.</P>
		</div>
	</div>
</div>

</body>
</html>