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
  <tr>
    <td><table width="700" border="1">
      <tr>
        <td colspan="6">DANH SÁCH THỂ LOẠI</td>
        </tr>
      <tr>
        <td>idTL</td>
        <td>TenTL</td>
        <td>TenTL_KhongDau</td>
        <td>ThuTu</td>
        <td>AnHien</td>
        <td><a href="ThemTheLoai.php">Them</a></td>
      </tr>
      <?php
	  $theloai = DanhSachTheLoai();
	  while($rowTL = mysqli_fetch_array($theloai)){
		  ob_start();
	  ?>
      <tr>
        <td>{idTL}</td>
        <td>{TenTL}</td>
        <td>{TenTL_KhongDau}</td>
        <td>{ThuTu}</td>
        <td>{AnHien}</td>
        <td><a href="SuaTheLoai.php?idTL={idTL}">Sua</a> - <a onclick="return confirm('Bạn co chắc là muốn xóa không?')"href="XoaTheLoai.php?idTL={idTL}">Xoa</a></td>
      </tr>
      <?php
	  	$s= ob_get_clean();
		$s = str_replace("{idTL}",$rowTL["idTL"], $s);
		$s = str_replace("{TenTL}",$rowTL["TenTL"], $s);
		$s = str_replace("{TenTL_KhongDau}",$rowTL["TenTL_KhongDau"], $s);
		$s = str_replace("{ThuTu}",$rowTL["ThuTu"], $s);
		$s = str_replace("{AnHien}",$rowTL["AnHien"], $s);
		echo $s;
	  }
	  ?>
    </table></td>
  </tr>
</table>
</body>
</html>