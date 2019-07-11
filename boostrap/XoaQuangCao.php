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
$idQC = $_GET["idQC"];
settype($idQC,"int");
$qr = "delete from quangcao where idQC='$idQC'";
mysqli_query($con,$qr);
header("location:ListQuangCao.php");
?>