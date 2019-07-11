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
$row_LT = ChiTietLoaiTin($idLT);

if(isset($_POST["btnSua"])){
$Ten = $_POST["Ten"];
	$Ten_KhongDau= ChangeTitle($Ten);
	$ThuTu = $_POST["ThuTu"];
		settype($ThuTu, "int");
	$AnHien = $_POST["AnHien"];
		settype($AnHien,"int");
	$idTL = $_POST["idTL"];
		settype($idTL, "int");
	$qr = "update loaitin set Ten='$Ten',Ten_KhongDau='$Ten_KhongDau',ThuTu='$ThuTu',AnHien='$AnHien',idTL='$idTL' where idLT='$idLT'";
	mysqli_query($con,$qr);
	header("location:ListLoaiTin.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Trang quản trị</title><link rel="stylesheet" type="text/css" href="layout.css"/> 
</head>

<body>
<table width="1000" border="0" align="center">
  <tr>
    <td id="hangTieuDe">TRANG QUẢN TRỊ</td>
  </tr>
  <tr>
    <td height="40" id="hang2"><?php require"menu.php"?></td>
  </tr>
  <tr>
    <td><form id="form1" name="form1" method="post" action="">
      <table width="500" border="1">
        <tr>
          <td colspan="2">SỬA LOẠI TIN</td>
          </tr>
        <tr>
          <td width="59">Ten</td>
          <td width="425"><label for="Ten"></label>
            <input value= "<?php echo $row_LT["Ten"]?>" type="text" name="Ten" id="Ten" /></td>
          </tr>
        <tr>
          <td>ThuTu</td>
          <td><label for="ThuTu"></label>
            <input value= "<?php echo $row_LT["ThuTu"]?>" type="text" name="ThuTu" id="ThuTu" /></td>
          </tr>
        <tr>
          <td>AnHien</td>
          <td><p>
            <label>
              <input <?php if($row_LT["AnHien"]==0) echo "checked='checked'";?> type="radio" name="AnHien" value="0" id="AnHien_0" />
              Ẩn</label>
            <br />
            <label>
              <input <?php if($row_LT["AnHien"]==1) echo "checked='checked'";?> type="radio" name="AnHien" value="1" id="AnHien_1" />
              Hiện</label>
            <br />
          </p></td>
          </tr>
        <tr>
          <td>TenTL</td>
          <td><label for="idTL"></label>
            <select name="idTL" id="idTL">
            <?php
			$TL = DanhSachTheLoai();
			while($row_TL = mysqli_fetch_array($TL)){
			?>
            <option <?php if($row_TL["idTL"]==$row_LT["idTL"]) echo "selected='selected'";?> value="<?php echo $row_TL["idTL"]?>"><?php echo $row_TL["TenTL"] ?></option>
            <?php
			}
			?>
            </select></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="submit" name="btnSua" id="btnSua" value="Sửa" /></td>
          </tr>
      </table>
    </form></td>
  </tr>
</table>
</body>
</html>