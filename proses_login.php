<?php
	include_once "koneksi.php";

	if (isset($_POST['login_userid']) && isset($_POST['login_pwd'])){
		$userid = $_POST['login_userid'];
		$password = $_POST['login_pwd'];
		
		$queri = "SELECT * FROM pelanggan where userid='$userid' and password='$password'";
		$hasil = $mysqli->query($queri);
		//$hasil = mysql_query($queri);
		if (mysqli_num_rows($hasil) > 0){
			while($row = mysqli_fetch_array($hasil)){
				$nama = $row['nama'];
			}
			setcookie("logged_q",1);
			setcookie("nama_q",$nama);
			setcookie("userid_q",$userid);
			setcookie("password_q",$password);
			echo "<script>window.location.href='index_masuk.php';</script>";
		}else{
			echo "<script>alert('UserID atau Kata sandi salah');window.location.href='index.html';</script>";
		}
	}else{
		
	}
?>