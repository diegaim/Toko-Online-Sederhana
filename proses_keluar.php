<?php
	setcookie("logged_q",0);
	unset($_COOKIE['logged']);
	unset($_COOKIE['nama_q']);
	unset($_COOKIE['userid_q']);
	unset($_COOKIE['password_q']);
	echo "<script>window.location.href='index.html';</script>";
?>