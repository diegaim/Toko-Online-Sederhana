<?php
	if (isset($_POST['nama']) && isset($_POST['userid']) && isset($_POST['password'])){
		include_once "koneksi.php";
		
		$nama = $_POST['nama'];
		$userid = $_POST['userid'];
		$password = $_POST['password'];
		
		if ($nama != "" || $userid != "" || $password != ""){
			if (strlen($nama) >= 30 || strlen($userid) >= 20 || strlen($password) >= 12){
				echo "<script>alert('Ada data yang melebihi batas maksimal, mohon periksa kembali');window.location.href='daftar.html';</script>";
			}else if (strlen($nama) <= 1 || strlen($userid) <= 1 || strlen($password) <= 1){
				echo "<script>alert('Ada data yang diisi kurang dari 8 karakter, mohon perbaiki');window.location.href='daftar.html';</script>";
			}else{
				//Cek apakah username tersedia
				$queri = "SELECT * FROM pelanggan WHERE userid='$userid'";
				$hasil = $mysqli->query($queri);
				//$hasil = mysql_query($queri);
				$jml_baris = mysqli_num_rows($hasil);
				if ($jml_baris == 0){
					$queri = "INSERT INTO pelanggan VALUES('$userid','$nama','$password')";
					$hasil = $mysqli->query($queri);
					//mysql_query($queri);
					echo "<script>alert('Pendaftaran Berhasil, Silahkan Login');window.location.href='index.html';</script>";
				}else{
					echo "<script>alert('UserID telah digunakan, coba lagi dengan UserId yang berbeda');window.location.href='daftar.html';</script>";
				}
			}
		}else{
			echo "<script>alert('Kesalahan, isi formulir dengan benar');window.location.href='daftar.html';</script>";
		}
	}else{
		echo "<script>alert('Kesalahan, isi formulir dengan benar');window.location.href='daftar.html';</script>";
	}
?>