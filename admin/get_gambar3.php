<?php
	//koneksi ke database
	include_once "koneksi.php";
	 
	//ambil id dari $_GET id
	$id = addslashes($_GET['id']);
	 
	//query ke database
	//$query = mysql_query("SELECT * FROM produk WHERE kode_produk='$id'");
	$query = $mysqli->query("SELECT * FROM pesanan WHERE id_pesan='$id'");
	
	$row = mysqli_fetch_assoc($query);
	$image_db = $row['pesan_gambar_produk'];
	 
	header("Content-type: image/jpeg");
	 
	echo $image_db;
?>