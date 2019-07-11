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
$idTin = $_GET["idTin"];
settype($idTin,"int");
$qr = "delete from tin where idTin='$idTin'";
mysqli_query($con,$qr);
header("location:ListTinTuc.php");
?>
