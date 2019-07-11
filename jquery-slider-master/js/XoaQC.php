<?php
include "../../lb/dbCon.php";
	$idQC=$_GET["idQC"];
	$sqlXoa = "delete from quangcao where idQC= '$idQC'";
	$qr = mysqli_query($con,$sqlXoa);		
				
?>