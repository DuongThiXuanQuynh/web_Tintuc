<?php
include "../../lb/dbCon.php";
//if(is_array($_GET["idCmt"])){
//foreach($_GET["idCmt"]as $idCmt){
	$idCmt=$_GET["idCmt"];
	$sqlXoa = "delete from comment where idCmt= '$idCmt'";
	$qr = mysqli_query($con,$sqlXoa);		
				
?>