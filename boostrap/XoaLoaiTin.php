<?php

ob_start();
session_start();
if(!isset($_SESSION["idUser"]) && $_SESSION["idGroup"]!=1 ){	
	header("location:../index.php");
}

require "../lb/dbCon.php";
require "../lb/quantri.php";

$idLT = $_GET["idLT"];
settype($idLT,"int");
$sqlLT = "delete from loaitin where idLT='$idLT'";
$sqlTin = "delete from tin where idTL='$idTL'";
$qrTin = mysqli_query($con,$sqlTin);
if($qrTin==true)
	{
		$qrLT = mysqli_query($con,$sqlLT);
	}
header("location:ListLoaiTin.php");

?>
