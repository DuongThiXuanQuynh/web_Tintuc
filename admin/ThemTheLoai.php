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
if(isset($_POST["btnThem"])){
	$TenTL = $_POST["TenTL"];
	$TenTL_KhongDau= ChangeTitle($TenTL);
	$ThuTu = $_POST["ThuTu"];
		settype($ThuTu, "int");
	$AnHien = $_POST["AnHien"];
		settype($AnHien,"int");
	$qr = "insert into theloai values(null,'$TenTL','$TenTL_KhongDau','$ThuTu','$AnHien')";
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
      <table width="700" border="1">
        <tr>
          <td colspan="2">THÊM THỂ LOẠI</td>
        </tr>
        <tr>
          <td width="80">TenTL</td>
          <td width="604"><label for="TenTL2"></label>
            <input type="text" name="TenTL" id="TenTL2" /></td>
        </tr>
        <tr>
          <td>ThuTu</td>
          <td><label for="ThuTu"></label>
            <input type="text" name="ThuTu" id="ThuTu" /></td>
        </tr>
        <tr>
          <td>AnHien</td>
          <td><p>
            <label>
              <input type="radio" name="AnHien" value="1" id="AnHien_0" />
              Hiện</label>
            <br />
            <label>
              <input type="radio" name="AnHien" value="0" id="AnHien_1" />
              Ẩn</label>
            <br />
          </p></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="submit" name="btnThem" id="btnThem" value="Thêm" /></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
</body>
</html>