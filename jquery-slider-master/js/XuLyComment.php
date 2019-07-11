<?php
	//$con=mysqli_connect("localhost","root","","webtintuc");
	include "../../lb/dbCon.php";
	$idTin = isset($_POST['idTin']) ? $_POST['idTin'] : "";
	$nd = isset($_POST['nd']) ? $_POST['nd'] : "";
	$ten = isset($_POST['ten']) ? $_POST['ten'] : "";
	$qr = "INSERT INTO comment(Ten, ThoiGian, NoiDung, idTin) VALUES ('" . $ten . "',now(),'" . $nd . "','" . $idTin . "')";
	$q = mysqli_query($con, $qr);
	if($q==true){
		echo "sucessfull!";
		
	}else
		echo "Fail.Try again!";
?>