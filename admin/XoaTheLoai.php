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
$idTL=$_GET["idTL"];
settype($idTL,"int");
$qr = "delete from theloai where idTL='$idTL'";
mysqli_query($con,$qr);
header("location:ListTheloai.php");
?>