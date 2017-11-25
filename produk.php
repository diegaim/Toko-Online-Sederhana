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
			if(!isset($_COOKIE['logged_q']) || $_COOKIE['logged_q'] != 1){
				echo "<script>window.location.href='index.html';</script>";
			}
			
			if(isset($_POST['btn_pesan_produk'])){
				if (isset($_POST['kode_produk']) && isset($_POST['jumlah_produk']) && isset($_POST['alamat_kirim_produk'])){
					include_once "koneksi.php";
					
					$kode = $_POST['kode_produk'];
					$jumlah_pesan = $_POST['jumlah_produk'];
					if(isset($_POST['pesan_pd_produk'])){
						$pesan = $_POST['pesan_pd_produk'];
					}else{
						$pesan = "";
					}
					
					//UPLOAD GAMBAR
					$file = $_FILES['pesan_gambar_pd_produk']['tmp_name'];
					if(isset($file)){
						//$pesan_gambar = $_POST['pesan_gambar_pd_produk'];
						$pesan_gambar_pd_produk = addslashes(file_get_contents($_FILES['pesan_gambar_pd_produk']['tmp_name']));
						$image_size	= getimagesize($_FILES['pesan_gambar_pd_produk']['tmp_name']);
					}else{
						$pesan_gambar_pd_produk = "";
					}
					$alamat = $_POST['alamat_kirim_produk'];
					$user = $_COOKIE['userid_q'];
					//untuk dapetin total harga
					$queri = "SELECT harga_produk FROM produk WHERE kode_produk=$kode";
					$hasil = $mysqli->query($queri);
					while($row=mysqli_fetch_array($hasil)){
						$harga_satuan = $row['harga_produk'];
						$total_harga = $harga_satuan * $jumlah_pesan;
					}
					
					$queri = "INSERT INTO pesanan(kode_produk,jml_pesan,pesan_produk,pesan_gambar_produk,alamat,total_harga,status,user_pelanggan) VALUES('$kode',$jumlah_pesan,'$pesan','$pesan_gambar_pd_produk','$alamat',$total_harga,'Blm dibayar','$user')";
										
					$hasil = $mysqli->query($queri);
					if($hasil){
						//ambil id terakhir insert
						$lastid = mysqli_insert_id($mysqli);
						echo "<script>window.location.href='upload_bukti_pembayaran.php?id=$lastid';</script>";
					}else{
						echo "<h1>Error, gagal menghubungkan ke database</h1>";
					}
				}else{
					echo "akses ditolak";
				}
			}
		?>
		<div class="container">
			<!--HEADER-->
			<div class="row">
				<div class="col s12 z-depth-4 teal lighten-2" style="color:white; ">
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
					<h5>Daftar Produk</h5>
					<table class="striped">
						<tr>
							<td>Kode Produk</td>
							<td>Nama Produk</td>
							<td>Kategori Produk</td>
							<td>Harga Produk</td>
							<td>Gambar Produk</td>
						<?php
							include_once "koneksi.php";
							$queri = "SELECT * FROM produk";
							$hasil = $mysqli->query($queri);
							//$hasil = mysql_query($queri);
							if(mysqli_num_rows($hasil) > 0){
								while($row = mysqli_fetch_array($hasil)){
									echo "<tr>
											<td>".$row['kode_produk']."</td>
											<td>".$row['nama_produk']."</td>
											<td>".$row['kategori_produk']."</td>
											<td>".$row['harga_produk']."</td>
											<td> <img src='get_gambar.php?id=".$row['kode_produk']."' width='150' height='150' class='z-depth-4'/> </td>
										  </tr>";
								}
							}else{
								echo "<tr>
										<td colspan='4'> Tidak ada data</td>
									  </tr>";
							}
						?>
					</table>
					<h5>Pesan Produk :</h5>
					<form action="" method="post" enctype="multipart/form-data">
						<table>
							<tr>
								<td>Kode Produk</td>
								<td><input type="text" name="kode_produk"/></td>
							</tr>
							<tr>
								<td>Jumlah Pesan Produk</td>
								<td><input type="text" name="jumlah_produk"/></td>
							</tr>
							<tr>
								<td>Pesan Pada Produk</td>
								<td><input type="text" name="pesan_pd_produk"/></td>
							</tr>
							<tr>
								<td>Pesan Gambar Pada Produk</td>
								<td><input type="file" name="pesan_gambar_pd_produk"/></td>
							</tr>
							<tr>
								<td>Alamat Kirim</td>
								<td><input type="text" name="alamat_kirim_produk"/></td>
							</tr>
							<tr>
								<td></td>
								<td colspan='2'><a class="waves-effect waves-light btn"><input type="submit" name="btn_pesan_produk" value="Pesan"/></a></td>
							</tr>
						</table>
					</form>
				</div>
				<!--SIDEBAR-->
				<div class="col s12 m3">
					<h6>Akun</h6>
					<br/>
					<form action="proses_keluar.php" method="post">
						Halo, <?php echo $_COOKIE['nama_q']; ?>
						<br/><br/><a class="waves-effect waves-light btn"><input type="submit" value="Logout" name="btn_logout"/></a>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>