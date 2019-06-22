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
$idTL = $_GET["idTL"]; settype($idTL,"int");
$row_TL = ChiTietTheLoai($idTL);
?>
<?php 
if(isset($_POST["btnSua"])){
$TenTL = $_POST["TenTL"];
	$TenTL_KhongDau= ChangeTitle($TenTL);
	$ThuTu = $_POST["ThuTu"];
		settype($ThuTu, "int");
	$AnHien = $_POST["AnHien"];
		settype($AnHien,"int");
	$qr = "update theloai set TenTL='$TenTL',TenTL_KhongDau='$TenTL_KhongDau',ThuTu='$ThuTu',AnHien='$AnHien' where idTL='$idTL'";
	mysqli_query($con,$qr);
	header("location:ListTheLoai.php");
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
      <table width="236" border="1">
        <tr>
          <td colspan="2">SỬA THỂ LOẠI</td>
          </tr>
        <tr>
          <td width="80">TenTL</td>
          <td width="144"><label for="TenTL"></label>
            <input type="text" value="<?php echo $row_TL["TenTL"]?>" name="TenTL" id="TenTL" /></td>
        </tr>
        <tr>
          <td>ThuTu</td>
          <td><label for="ThuTu"></label>
            <input type="text" value="<?php echo $row_TL["ThuTu"]?>"  name="ThuTu" id="ThuTu" /></td>
        </tr>
        <tr>
          <td>AnHien</td>
          <td><p>
            <label>
              <input <?php if($row_TL["AnHien"]==1) echo "checked='checked'"?> type="radio" name="AnHien" value="1" id="AnHien_0" />
              Hiện</label>
            <br />
            <label>
              <input <?php if($row_TL["AnHien"]==0) echo "checked='checked'"?> type="radio" name="AnHien" value="0" id="AnHien_1" />
              Ẩn</label>
            <br />
          </p></td>
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