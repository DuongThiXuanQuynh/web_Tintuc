<?php

ob_start();
session_start();
if(!isset($_SESSION["idUser"]) && $_SESSION["idGroup"]!=1 ){	
	header("location:../index.php");
}

require "../lb/dbCon.php";
require "../lb/quantri.php";
?>

<?php
$idLT = $_GET["idLT"];
settype($idLT,"int");
$qr = "delete from loaitin where idLT='$idLT'";
mysqli_query($con,$qr);
header("location:ListLoaiTin.php");

?>
