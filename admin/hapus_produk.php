<?php
	include_once "koneksi.php";
	
	$kode = $_GET['kode_produk'];
	$queri = "DELETE FROM produk WHERE kode_produk='$kode'";
	$mysqli->query($queri);
	//mysql_query($queri);
	echo "<script>alert('Data berhasil dihapus');window.location.href='produk.php';</script>"
?>