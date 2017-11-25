<?php
	include_once "koneksi.php";

	if (isset($_POST['login_userid']) && isset($_POST['login_pwd'])){
		$userid = $_POST['login_userid'];
		$password = $_POST['login_pwd'];
		
		$queri = "SELECT * FROM penjual where user='$userid' and password='$password'";
		$hasil = $mysqli->query($queri);
		//$hasil = mysql_query($queri);
		if (mysqli_num_rows($hasil) > 0){
			while($row = mysqli_fetch_array($hasil)){
				$nama = $row['nama'];
			}
			setcookie("logged_a",1);
			setcookie("userid_a",$userid);
			setcookie("password_a",$password);
			echo "<script>window.location.href='index_masuk.php';</script>";
		}else{
			echo "<script>alert('UserID atau Kata sandi salah');window.location.href='index.html';</script>";
		}
	}else{
		
	}

?>