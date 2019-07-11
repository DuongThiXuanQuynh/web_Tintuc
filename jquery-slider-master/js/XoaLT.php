<?php
include "../../lb/dbCon.php";
	$idLT=$_GET["idLT"];
	$sqlXoa = "delete from loaitin where idLT= '$idLT'";
	$qr = mysqli_query($con,$sqlXoa);		
				
?>