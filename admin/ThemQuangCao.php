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
	$ViTri = $_POST["ViTri"];
	$MoTa = $_POST["MoTa"];
	$Url = $_POST["Url"];
	$urlHinh = $_POST["urlHinh"];
	$SoLanClick = 0;
	$qr = "insert into quangcao values(null,'$ViTri','$MoTa','$Url','$urlHinh',$SoLanClick)";
	mysqli_query($con,$qr);
	header("location:ListQuangCao.php");
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
    <td height="40" id="hang2"><p>
      <?php require"menu.php"?>
    </p>
    <p>&nbsp; </p></td>
  </tr>
  <tr align="center">
    <td height="40" id="hang6"><form id="form1" name="form1" method="post" action="">
      <table width="700" border="1">
        <tr align="center">
          <td colspan="2">THÊM QUẢNG CÁO</td>
          </tr>
        <tr>
          <td width="123">Vị trí </td>
          <td width="561"><p>
            <label>
              <input type="radio" name="ViTri" value="1" id="ViTri_0" />
              1- Top phải</label>
            <br />
            <label>
              <input type="radio" name="ViTri" value="2" id="ViTri_1" />
              2- Cuối trang</label>
            <br />
          </p></td>
        </tr>
        <tr>
          <td>Mô tả</td>
          <td><label for="MoTa"></label>
            <input type="text" name="MoTa" id="MoTa" /></td>
        </tr>
        <tr>
          <td>Url</td>
          <td><label for="Url"></label>
            <input type="text" name="Url" id="Url" /></td>
        </tr>
        <tr>
          <td>Url hình</td>
          <td><label for="urlHinh"></label>
            <input type="text" name="urlHinh" id="urlHinh" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="submit" name="btnThem" id="btnThem" value="Thêm" /></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>