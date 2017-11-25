<!DOCTYPE html>
<html>
	</head>
		<title>Unch Chocolate</title>
		<link href="css/materialize.css" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="js/materialize.js"></script>
	</head>
	<body>
		<?php
			include_once "koneksi.php";
			
			if(!isset($_COOKIE['logged_q']) || $_COOKIE['logged_q'] != 1){
				echo "<script>window.location.href='index.html';</script>";
			}
			
			if(isset($_POST['btn_up_bukti_pembayaran'])){
				
				
				//UPLOAD GAMBAR
				$file = $_FILES['image']['tmp_name'];
				if(!isset($file)){
					echo 'Pilih file gambar';
				}else{
					$image 		= addslashes(file_get_contents($_FILES['image']['tmp_name']));
					$image_size	= getimagesize($_FILES['image']['tmp_name']);
			 
					
					if($image_size == false){
						echo 'File yang anda pilih tidak gambar';
					}else{
						$id_pesan = $_GET['id'];
						$hasil = $mysqli->query("UPDATE pesanan SET bukti_pembayaran='$image', status='Menunggu validasi' WHERE id_pesan=$id_pesan");
						if($hasil){
							echo "<script>alert('Pesanan berhasil, mohon tunggu sampai admin mengvalidasi pembelian anda');window.location.href='pesanan_saya.php';</script>";
						}else{
							echo $mysqli->error;
						}
						
					}
				}
			}
		?>
		<div class="container">
			<!--HEADER-->
			<div class="row">
				<div class="col s12" style="background-color:grey;">
					<h2>Unch Chocolate</h2>
				</div>
			</div>
			
			<!--NAVBAR-->
			<div class="row">
				<div class="col s12 m2">
					<a href="index_masuk.php">Halaman Utama</a>
				</div>
				<div class="col s12 m2">
					<a href="produk.php">Lihat Produk</a>
				</div>
				<div class="col s12 m2">
					<a href="pesanan_saya.php">Pesanan Saya</a>
				</div>
			</div>
			
			<!--GARIS AJA-->
			<div class="row">
				<hr/>
			</div>
			
			<!--ARTIKEL DAN SIDE BAR-->
			<div class="row">
				<!--ARTIKEL-->
				<div class="col s12 m9">
					<?php
						$id_pesanan = $_GET['id'];
						
						include_once "koneksi.php";
						$queri = "SELECT * FROM pesanan WHERE id_pesan='$id_pesanan'";
						$hasil = $mysqli->query($queri);
						while($row=mysqli_fetch_array($hasil)){
							$kode_produk = $row['kode_produk'];
							$jumlah_pesan = $row['jml_pesan'];
							$total_harga = $row['total_harga'];
							$pesan_tertulis = $row['pesan_produk'];
						}
					?>
					<h5>Upload bukti transfer</h5>
					<h6>Detil pembelian : </h6>
					Kode produk yang dipesan : <?php echo $id_pesanan; ?>
					<br/>Jumlah dipesan : <?php echo $jumlah_pesan; ?>
					<br/>Pesan Tertulis : <?php echo $pesan_tertulis; ?>
					<br/>Gambar pada pesanan :
					<br/><?php echo "<img src='get_gambar.php?id=".$kode_produk."' width='150' height='150'/>" ?>
					<br/>Total harga : <?php echo $total_harga; ?>
					<br/>
					<p>Pembayaran dilakukan dengan mentransfer ke PT.BANK CERITANYA dengan nomor rekening 123.456.789.34 atas nama unch chocolate</p>
					<p>Setelah pembayaran dilakukan, upload foto bukti pembayaran dibawah ini</p>
					<br/>
					<form action="" method="post" enctype="multipart/form-data">
						<table>
							<tr>
								<td>Foto bukti pembayaran</td>
								<td><input type="file" name="image"/></td>
							</tr>
							<tr>
								<td></td>
								<td colspan='2'><input type="submit" name="btn_up_bukti_pembayaran" value="Upload Bukti Pembayaran"/></td>
							</tr>
						</table>
					</form>
				</div>
				<!--SIDEBAR-->
				<div class="col s12 m3">
					<h6>Akun</h6>
					<br/>
					<form action="proses_keluar.php" method="post">
						Halo, <?php echo $_COOKIE['nama_q'];?>
						<br/><input type="submit" value="Logout" name="btn_logout"/>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>