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
			if(!isset($_COOKIE['logged_a']) || $_COOKIE['logged_a'] != 1){
				echo "<script>window.location.href='index.html';</script>";
			}
			
			if(isset($_POST['btn_tambah_produk'])){
				include_once "koneksi.php";
				
				$nama = $_POST['nama_produk'];
				$kategori = $_POST['kategori_produk'];
				$harga = $_POST['harga_produk'];
				
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
						/*if(!$insert = mysql_query("INSERT INTO produk VALUES(null, '$nama', $harga, '$image')")){
							echo 'Gagal upload gambar';*/
						if(!$insert = $mysqli->query("INSERT INTO produk VALUES(null, '$nama','$kategori', $harga, '$image')")){
							echo 	'Gagal upload gambar';
						}else{
							//ambil id terakhir insert
							$lastid = mysqli_insert_id($mysqli);
							//echo 'Gambar berhasil di upload.<p>Gambar anda:</p><img src="get.php?id='.$lastid.'">';
							
						}
					}
				}
			}
		?>
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
					<a href="produk.php">Produk</a>
				</div>
				<div class="col s12 m2">
					<a href="daftar_pesanan.php">Pesanan Pelanggan</a>
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
						<thead>
							<tr>
								<td>Kode Produk</td>
								<td>Nama Produk</td>
								<td>Kategori_produk</td>
								<td>Harga Produk</td>
								<td>Gambar Produk</td>
								<td>Aksi</td>
							</tr>
						</thead>
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
											<td> <a href='hapus_produk.php?kode_produk=".$row['kode_produk']."' class='waves-effect waves-light btn'> Hapus</a></td>
										  </tr>";
								}
							}else{
								echo "<tr>
										<td colspan='5'> Tidak ada data</td>
									  </tr>";
							}
						?>
					</table>
					<br/>
					<h5>Tambahkan produk :</h5>
					<form action="" method="post" enctype="multipart/form-data">
						<table>
							<tr>
								<td>Nama Produk</td>
								<td><input type="text" name="nama_produk"/></td>
							</tr>
							<tr>
								<td>Kategori Produk</td>
								<td><input type="text" name="kategori_produk"/></td>
							</tr>
							<tr>
								<td>Harga Produk</td>
								<td><input type="text" name="harga_produk"/></td>
							</tr>
							<tr>
								<td>Gambar Produk</td>
								<td><input type="file" name="image"/></td>
							</tr>
							<tr>
								<td></td>
								<td colspan='2'><a class="waves-effect waves-light btn"><input type="submit" name="btn_tambah_produk" value="Tambah Produk"/></a></td>
							</tr>
						</table>
					</form>
				</div>
				<!--SIDEBAR-->
				<div class="col s12 m3">
					<h6>Akun</h6>
					<br/>
					<form action="proses_keluar.php" method="post">
						Halo, <?php echo $_COOKIE['userid_a']; ?>
						<br/><br/><a class="waves-effect waves-light btn"><input type="submit" value="Logout" name="btn_logout"/></a>
					</form>
				</div>
			</div>
	</body>
</html>