<?php

ob_start();
session_start();
if(!isset($_SESSION["idUser"]) && $_SESSION["idGroup"]!=1 ){	
	header("location:../index.php");
}

require "../lb/dbCon.php";
require "../lb/quantri.php";

$idTL=$_GET["idTL"];
settype($idTL,"int");
$sqlTL = "delete from theloai where idTL='$idTL'";
$sqlLT = "delete from loaitin where idTL='$idTL'";
$sqlTin = "delete from tin where idTL='$idTL'";
$qrTin=mysqli_query($con,$sqlTin);
if($qrTin==true)
	{
		$qrLT = mysqli_query($con,$sqlLT);
		if($qrLT==true){
			$qrTL = mysqli_query($con,$sqlTL);
			
		}
	}

header("location:ListTheloai.php");
?>