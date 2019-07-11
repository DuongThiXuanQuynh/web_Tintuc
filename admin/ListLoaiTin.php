<?php

ob_start();
session_start();
if(!isset($_SESSION["idUser"]) && $_SESSION["idGroup"]!=1 ){	
	header("location:../index.php");
}

require "../lb/dbCon.php";
require "../lb/quantri.php";
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
  <tr align="center">
    <td><table width="700" border="1">
      <tr align="center" valign="middle">
        <td colspan="7">DANH SÁCH LOẠI TIN</td>
        </tr>
      <tr align="center" valign="middle">
        <td>idLT</td>
        <td>Tên</td>
        <td>Tên không dấu</td>
        <td>Thứ tự</td>
        <td>Ẩn hiện</td>
        <td>Tên thể loại</td>
        <td><a href="ThemLoaiTin.php">Thêm</a></td>
      </tr>
      <?php
	  $loaitin = DanhSachLoaiTin();
	  while($rowLT = mysqli_fetch_array($loaitin)){
		  ob_start();
	  ?>
      <tr>
        <td>{idLT}</td>
        <td>{Ten}</td>
        <td>{Ten_KhongDau}</td>
        <td>{ThuTu}</td>
        <td>{AnHien}</td>
        <td>{TenTL}</td>
        <td><a href="SuaLoaiTin.php?idLT={idLT}">Sửa</a> - <a onclick="return confirm('Bạn có chắc là muốn xóa không?')" href="XoaLoaiTin.php?idLT={idLT}">Xóa</a></td>
      </tr>
      <?php
	  $s = ob_get_clean();
		$s = str_replace("{idLT}",$rowLT["idLT"], $s);
		$s = str_replace("{Ten}",$rowLT["Ten"], $s);
		$s = str_replace("{Ten_KhongDau}",$rowLT["Ten_KhongDau"], $s);
		$s = str_replace("{ThuTu}",$rowLT["ThuTu"], $s);
		$s = str_replace("{AnHien}",$rowLT["AnHien"], $s);
		$s = str_replace("{TenTL}",$rowLT["TenTL"], $s);
		echo $s;
	  }
	  ?>
    </table></td>
  </tr>
</table>
</body>
</html>