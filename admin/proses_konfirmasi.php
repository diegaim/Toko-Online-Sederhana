<?php
	include "koneksi.php";
	$id = $_GET['id'];
	$aksi = $_GET['aksi'];
	
	if($aksi == "setuju"){
		$queri = "UPDATE pesanan SET status='Dikirim' WHERE id_pesan='$id'";
		$hasil = $mysqli->query($queri);
		echo "<script>alert('Pesanan berhasil disetujui');window.location.href='daftar_pesanan.php';</script>";
	}else{
		$queri = "UPDATE pesanan SET status='Ditolak' WHERE id_pesan='$id'";
		$hasil = $mysqli->query($queri);
		echo "<script>alert('Pesanan gagal disetujui');window.location.href='daftar_pesanan.php';</script>";
	}
?>