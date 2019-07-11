<?php
include "../../lb/dbCon.php";
	$idTL=$_GET["idTL"];
	$sqlXoa = "delete from theloai where idTL= '$idTL'";
	$qr = mysqli_query($con,$sqlXoa);		
				
?>