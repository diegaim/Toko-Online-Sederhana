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
			
			include_once "koneksi.php";
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
					<h5>Validasi Permintaan</h5>
					 <table>
						  <?php
							$id = $_GET['id'];
							$hasil = $mysqli->query("SELECT * FROM pesanan WHERE id_pesan='$id'");
							echo $mysqli->error;
							while($row=mysqli_fetch_array($hasil)){
								echo "<tr>
										<td>Kode Produk</td>
										<td>".$row['kode_produk']."</td>
									  </tr>
									  <tr>
										<td>Jumlah pemesanan</td>
										<td>".$row['jml_pesan']."</td>
									  </tr>
									  <tr>
										<td>Pesan Produk</td>
										<td>".$row['pesan_produk']."</td>
									  </tr>
									  <tr>
									   <td>Pesan Gambar</td>
									   <td><img src='get_gambar3.php?id=".$id."' width='500' height='500'/></td>
									  </tr>
									  <tr> 
									   <td>Total Harga</td>
									   <td>".$row['total_harga']."</td>
									  </tr>
									  <tr>
										<td>Bukti Pembayaran</td>
										<td><img src='get_gambar4.php?id=".$row['kode_produk']."' width='500' height='500'/> </td>
									  </tr>
									  <tr>
										<td>Tindakan</td>
										<td><a class='waves-effect waves-light btn' href='proses_konfirmasi.php?id=".$id."&aksi=setuju'>Setujui</a> &nbsp &nbsp &nbsp &nbsp &nbsp <a class='waves-effect waves-light btn' href='proses_konfirmasi.php?id=".$id."&aksi=tolak'>Tolak</a></td>
									  </tr>";
							}
						  ?>
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