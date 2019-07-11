<?php
include "lb/dbCon.php";
include "lb/quantri.php";
?>
<?php
$idTL = $_GET["idTL"]; 
settype($idTL,"int");
$LT = DanhSachLoaiTinTheoTheLoai($idTL);
while($rowLT = mysqli_fetch_array($LT)){
?>
	<option value="<?php echo $rowLT["idLT"];?>"><?php echo $rowLT["Ten"];?> </option>
<?php
}
?>