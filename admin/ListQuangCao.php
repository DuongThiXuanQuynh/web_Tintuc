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
    <td height="40" id="hang2"><p>
      <?php require"menu.php"?>
    </p>
    <p>&nbsp; </p></td>
  </tr>
  <tr align="center">
    <td height="40" id="hang6"><table width="853" border="1">
      <tr align="center" valign="middle">
        <td colspan="7">DANH SÁCH QUẢNG CÁO</td>
        </tr>
      <tr align="center" valign="middle">
        <td width="68" align="center">idQC</td>
        <td width="188">Mô tả</td>
        <td width="49">Vị trí</td>
        <td width="162">Url</td>
        <td width="161">Url hình</td>
        <td width="87">Số lần click</td>
        <td width="92"><a href="ThemQuangCao.php">Thêm</a></td>
      </tr>
      <?php
	  $qc = DanhSachQuangCao();
	  while($rowQC = mysqli_fetch_array($qc)){
		  ob_start();
	  ?>
      <tr>
        <td align="center">{idQC}</td>
        <td>{MoTa}</td>
        <td align="center">{vitri}</td>
        <td>{Url}</td>
        <td>{urlHinh}</td>
        <td align="center">{SoLanClick}</td>
        <td align="center"><a href="SuaQuangCao.php?idQC={idQC}">Sửa</a> - <a onclick="return confirm('Bạn có chắc là muốn xóa không?')" href="XoaQuangCao.php?idQC={idQC}">Xóa</a></td>
      </tr>
      <?php
	  	$s = ob_get_clean();
		$s = str_replace("{idQC}",$rowQC["idQC"], $s);
		$s = str_replace("{MoTa}",$rowQC["MoTa"], $s);
		$s = str_replace("{vitri}",$rowQC["vitri"], $s);
		$s = str_replace("{Url}",$rowQC["Url"], $s);
		$s = str_replace("{urlHinh}",$rowQC["urlHinh"], $s);
		$s = str_replace("{SoLanClick}",$rowQC["SoLanClick"], $s);
		echo $s;
	  }
	  ?>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>