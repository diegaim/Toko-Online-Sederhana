<!DOCTYPE html>
<html>
	</head>
		<title>Unch Chocolate</title>
		<link href="css/materialize.css" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="js/materialize.js"></script>
	</head>
	<body>
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
					<a href="index.html">Halaman Utama</a>
				</div>
				<div class="col s12 m2">
					<a href="produk2.php">Lihat Produk</a>
				</div>
			</div>
			
			<!--GARIS AJA-->
			<div class="row">
				<hr/>
			</div>
			
			<!--ARTIKEL DAN SIDE BAR-->
			<div class="row">
				<!--ARTIKEL-->
				<div class="col s12 m12">
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
				</div>
			</div>
		</div>
	</body>
</html>