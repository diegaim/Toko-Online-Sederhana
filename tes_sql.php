<?php
	$mysqli = new mysqli("localhost", "root", "", "test");
	$result = $mysqli->query("SELECT * FROM inventory");
	//$row = $result->fetch_assoc();
	while($row = mysqli_fetch_array($result)){
		echo $row['barang_id'];
	}
?>