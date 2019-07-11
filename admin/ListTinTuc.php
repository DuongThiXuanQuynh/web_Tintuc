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
    <td><table width="967" border="1">
      <tr align="center" valign="middle" bgcolor="#D6D6D6">
        <td colspan="7" bgcolor="#FFFFFF"><p>DANH SÁCH TIN</p></td>
        </tr>
      <tr align="center" valign="middle">
        <td width="82">Ngày</td>
        <td width="83">Tên thể loại<br />
          Tên loại tin</td>
        <td width="83" align="center" valign="middle">idTin</td>
        <td width="443">Nội dung tin</td>
        <td width="84">Số lần xem</td>
        <td width="78">Tin nổi bật<br />
          Ẩn hiện</td>
        <td width="68"><a href="ThemTin.php">Thêm</a></td>
        </tr>
        <?php
		$tin = DanhSachTin();
		while($rowTin = mysqli_fetch_array($tin)){
			ob_start();
		?>
      <tr>
        <td>{Ngay}</td>
        <td>{TenTL}<br />
-{Ten}</td>
        <td height="134" align="center" valign="middle"><p>{idTin}<br />
        </p></td>
        <td><a href="SuaTin.php?idTin={idTin}">{TieuDe}</a><br />
          <img style="float:left; margin-right:5px;" src="../upload/tintuc/{urlHinh}" width="131" height="96" />{TomTat}<br /></td>
        <td align="center" valign="middle">{SoLanXem}</td>
        <td align="center" valign="middle">{TinNoiBat}-{AnHien}</td>
        <td><a href="SuaTin.php?idTin={idTin}">Sửa </a>-
          <a onclick="return confirm('Bạn co chắc là muốn xóa không?')" href="XoaTin.php?idTin={idTin}">Xóa</a></td>
        </tr>
        <?php
			$s = ob_get_clean();
			$s = str_replace("{idTin}",$rowTin["idTin"], $s);
			$s = str_replace("{TieuDe}",$rowTin["TieuDe"], $s);
			$s = str_replace("{TomTat}",$rowTin["TomTat"], $s);
			$s = str_replace("{TenTL}",$rowTin["TenTL"], $s);
			$s = str_replace("{Ten}",$rowTin["Ten"], $s);
			$s = str_replace("{SoLanXem}",$rowTin["SoLanXem"], $s);
			$s = str_replace("{AnHien}",$rowTin["AnHien"], $s);
			$s = str_replace("{TinNoiBat}",$rowTin["TinNoiBat"], $s);
			$s = str_replace("{urlHinh}",$rowTin["urlHinh"], $s);
			$s = str_replace("{Ngay}",$rowTin["Ngay"], $s);
			echo $s;
		}
		?>
    </table></td>
  </tr>
</table>
</body>
</html>