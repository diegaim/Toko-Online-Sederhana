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
			
			if(isset($_POST['btn_up_bukti_pembayaran'])){
				include_once "koneksi.php";
				
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
						$mysqli->query("UPDATE pesanan SET bukti_pembayaran='$image' WHERE id_pesan=$id_pesan");
						echo "<script>alert('Pesanan berhasil, mohon tunggu sampai admin mengkonfirmasi pembelian anda');window.location.href='pesanan_saya.php';</script>";
					}
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
					<h5>Pesanan Saya</h2>
					<table class="striped">
						<thead>
						  <tr>
							  <th>Id Pesan</th>
							  <th>Kode Produk</th>
							  <th>Jumlah Pesan</th>
							  <th>Pesan</th>
							  <th>Pesan Gambar</th>
							  <th>Total Harga</th>
							  <th>Status Pemesanan</th>
							  <th>Aksi</th>
						  </tr>
						</thead>

						<tbody>
						  <?php
							include_once "koneksi.php";
							
							$user_pelanggan = $_COOKIE['userid_q'];
							$queri = "SELECT * FROM pesanan WHERE user_pelanggan='$user_pelanggan'";
							$hasil = $mysqli->query($queri);
							
							while($row=mysqli_fetch_array($hasil)){
								$status_temp = $row['status'];
								echo "<tr>
										<td>".$row['id_pesan']."</td>
										<td>".$row['kode_produk']."</td>
										<td>".$row['jml_pesan']."</td>
										<td>".$row['pesan_produk']."</td>
										<td> <img src='get_gambar.php?id=".$row['kode_produk']."' width='150' height='150' class='z-depth-4'/> </td>
										<td>".$row['total_harga']."</td>
										<td>".$status_temp."</td>";
								if ($status_temp == "Blm dibayar"){
									echo "<td><a href='upload_bukti_pembayaran.php?id=".$row['id_pesan']."&update=1'/>Upload bukti pembayaran</a></td></tr>";
								}else{
									echo"<td>-</td></tr>";
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
						Halo, <?php echo $_COOKIE['nama_q'];?>
						<br/><br/><a class="waves-effect waves-light btn"><input type="submit" value="Logout" name="btn_logout"/></a>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>