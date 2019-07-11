<?php
include "../../lb/dbCon.php";
$idCmt=$_GET["idCmt"];
$idTin=$_GET["idTin"];
$sql = "DELETE FROM comment WHERE idCmt='$idCmt'";

$qr = mysqli_query($con, $sql);
if($qr==true){
	header("location:../../index.php?p=chitiettin&idTin='$idTin'");
}

?>