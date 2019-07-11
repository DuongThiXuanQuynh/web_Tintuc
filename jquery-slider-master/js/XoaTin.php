<?php
include "../../lb/dbCon.php";
	$idTin=$_GET["idTin"];
	$sqlXoa = "delete from tin where idTin= '$idTin'";
	$qr = mysqli_query($con,$sqlXoa);		
				
?>