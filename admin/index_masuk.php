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
					<h5>Rangkuman Penjualan</h5>
					<table class="striped">
						<?php
							include_once "koneksi.php";
							$queri = "SELECT * FROM pesanan WHERE status='Menunggu Validasi'";
							$hasil = $mysqli->query($queri);
							$jml_baris = mysqli_num_rows($hasil);
						?>
						<tr>
							<td>Total Pesanan Belum Terkonfirmasi</td>
							<td><?php echo $jml_baris; ?></td>
						</tr>
						<?php
							include_once "koneksi.php";
							$queri = "SELECT * FROM pesanan WHERE NOT status='Menunggu Validasi'";
							$hasil = $mysqli->query($queri);
							$jml_baris = mysqli_num_rows($hasil);
						?>
						<tr>
							<td>Total Pesanan Sudah Terkonfirmasi</td>
							<td><?php echo $jml_baris; ?></td>
						</tr>
						<?php
							$queri = "SELECT * FROM pesanan WHERE status='Blm bayar'";
							$hasil = $mysqli->query($queri);
							$jml_baris = mysqli_num_rows($hasil);
						?>
						<tr>
							<td>Total Pesanan Belum Dibayar</td>
							<td><?php echo $jml_baris; ?></td>
						</tr>
						<?php
							include_once "koneksi.php";
							$queri = "SELECT * FROM pesanan";
							$hasil = $mysqli->query($queri);
							$jml_baris = mysqli_num_rows($hasil);
						?>
						<tr>
							<td>Total Semua Pemesanan</td>
							<td><?php echo $jml_baris; ?></td>
						</tr>
					</table>
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