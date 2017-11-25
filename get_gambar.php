<?php
	//koneksi ke database
	include_once "koneksi.php";
	 
	//ambil id dari $_GET id
	$id = addslashes($_GET['id']);
	 
	//query ke database
	$query = $mysqli->query("SELECT * FROM produk WHERE kode_produk='$id'");
	$row = mysqli_fetch_assoc($query);
	$image_db = $row['gambar_produk'];
	 
	header("Content-type: image/jpeg");
	 
	echo $image_db;
?>