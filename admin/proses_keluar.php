<?php
	setcookie("logged_a",0);
	unset($_COOKIE["nama_a"]);
	unset($_COOKIE["userid_a"]);
	unset($_COOKIE["password_a"]);
	echo "<script>window.location.href='index.html';</script>"
?>