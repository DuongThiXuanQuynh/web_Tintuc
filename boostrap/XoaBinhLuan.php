<?php

ob_start();
session_start();
if(!isset($_SESSION["idUser"]) && $_SESSION["idGroup"]!=1 ){	
	header("location:../index.php");
}

require "../lb/dbCon.php";
require "../lb/quantri.php";

$idCmt=$_GET["idCmt"];
settype($idCmt,"int");
$qr = "delete from comment where idCmt='$idCmt'";
mysqli_query($con,$qr);
header("location:ListBinhLuan.php");
?>