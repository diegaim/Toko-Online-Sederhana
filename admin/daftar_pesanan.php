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
					<h5>Daftar Pesanan Menunggu Konfirmasi</h5>
					<table class="striped">
						<thead>
						  <tr>
							  <th>Id Pesan</th>
							  <th>Kode Produk</th>
							  <th>Jumlah Pesan</th>
							  <th>Pesan</th>
							  <th>Pesan Gambar</th>
							  <th>Total Harga</th>
							  <th>Bukti Transfer</th>
							  <th>Aksi</th>
						  </tr>
						</thead>

						<tbody>
						  <?php
							include_once "koneksi.php";
							
							$user_pelanggan = $_COOKIE['userid_q'];
							$queri = "SELECT * FROM pesanan WHERE status='Menunggu validasi'";
							$hasil = $mysqli->query($queri);
							
							while($row=mysqli_fetch_array($hasil)){
								$status_temp = $row['status'];
								echo "<tr>
										<td>".$row['id_pesan']."</td>
										<td>".$row['kode_produk']."</td>
										<td>".$row['jml_pesan']."</td>
										<td>".$row['pesan_produk']."</td>
										<td> <img src='get_gambar1.php?id=".$row['kode_produk']."' width='150' height='150' class='z-depth-4'/> </td>
										<td>".$row['total_harga']."</td>
										<td> <img src='get_gambar2.php?id=".$row['kode_produk']."' width='150' height='150' class='z-depth-4'/> </td>";
								if ($status_temp == "Menunggu validasi"){
									echo "<td><a href='konfirmasi.php?id=".$row['id_pesan']."' class='waves-effect waves-light btn'/>Konfirmasi</a></td></tr>";
								}else{
									echo"<td></td></tr>";
								}
							}
						  ?>
						</tbody>
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
			<!--PESANAN SUDAH TERKONFIRMASI-->
			<div class="row">
				<!--ARTIKEL-->
				<div class="col s12 m9">
					<h5>Daftar Pesanan Sudah Terkonfirmasi</h5>
					<table class="striped">
						<thead>
						  <tr>
							  <th>Id Pesan</th>
							  <th>Kode Produk</th>
							  <th>Jumlah Pesan</th>
							  <th>Pesan</th>
							  <th>Pesan Gambar</th>
							  <th>Total Harga</th>
							  <th>Bukti Transfer</th>
						  </tr>
						</thead>

						<tbody>
						  <?php
							include_once "koneksi.php";
							
							$user_pelanggan = $_COOKIE['userid_q'];
							$queri = "SELECT * FROM pesanan WHERE NOT status='Menunggu validasi'";
							$hasil = $mysqli->query($queri);
							
							while($row=mysqli_fetch_array($hasil)){
								$status_temp = $row['status'];
								echo "<tr>
										<td>".$row['id_pesan']."</td>
										<td>".$row['kode_produk']."</td>
										<td>".$row['jml_pesan']."</td>
										<td>".$row['pesan_produk']."</td>
										<td> <img src='get_gambar1.php?id=".$row['kode_produk']."' width='150' height='150' class='z-depth-4'/> </td>
										<td>".$row['total_harga']."</td>
										<td> <img src='get_gambar2.php?id=".$row['kode_produk']."' width='150' height='150' class='z-depth-4'/> </td>";
							}
						  ?>
						</tbody>
					</table>
				</div>
			</div>
	</body>
</html>