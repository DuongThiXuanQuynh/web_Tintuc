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
$idTin = $_GET["idTin"];
settype($idTin,"int");
$rowTin = ChiTietTin($idTin);
?>
<?php
if(isset($_POST["btnSua"])){
	$TieuDe = $_POST["TieuDe"];
	$TieuDe_KhongDau= ChangeTitle($TieuDe);
	$urlHinh = $_POST["urlHinh"];
	$Ngay = date("y-m-d");
	$idUser = $_SESSION["idUser"];
	$TomTat = $_POST["TomTat"];
	$Content = $_POST["Content"];
	$TinNoiBat = $_POST["TinNoiBat"];
		settype($TinNoiBat, "int");
	$AnHien = $_POST["AnHien"];
		settype($AnHien,"int");
	$idTL = $_POST["idTL"];
		settype($idTL,"int");
	$idLT = $_POST["idLT"];
		settype($idLT,"int");
	$qr = "update tin set TieuDe = '$TieuDe',TieuDe_KhongDau = '$TieuDe_KhongDau',TomTat= '$TomTat',urlHinh = '$urlHinh',Ngay = '$Ngay',idUser = '$idUser',Content = '$Content',idLT = '$idLT',idTL = '$idTL',TinNoiBat = '$TinNoiBat',AnHien = '$AnHien' where idTin='$idTin'";
	mysqli_query($con,$qr);
	header("location:ListTinTuc.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Trang quản trị</title><link rel="stylesheet" type="text/css" href="layout.css"/> 
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="../jquery-slider-master/js/jquery-1.9.1.min.js"></script>
<script>
$(document).ready(function(){
	$("#idTL").change(function(){
		var id = $(this).val();
		$.get("../LoaiTinTheoTheLoai.php",{idTL:id},function(data){
			$("#idLT").html(data);
		}); 	
	});
});
</script>
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
    <td><form id="form1" name="form1" method="post" action="">
      <table width="700" border="1">
        <tr align="center">
          <td colspan="2">SỬA TIN</td>
        </tr>
        <tr>
          <td width="98">Thể loại</td>
          <td width="586"><label for="idTL"></label>
            <select name="idTL" id="idTL">
				 <?php
                $TL = DanhSachTheLoai();
                while($row_TL = mysqli_fetch_array($TL)){
                ?>
                <option <?php if($rowTin["idTL"]==$row_TL["idTL"]) echo "selected = 'selected'"?> value="<?php echo $row_TL["idTL"]?>"><?php echo $row_TL["TenTL"] ?></option>
                <?php
                }
                ?>
            </select></td>
        </tr>
        <tr>
          <td>Loại tin</td>
          <td><label for="idLT"></label>
            <select name="idLT" id="idLT">
				<?php
                $LT = DanhSachLoaiTin();
                while($row_LT = mysqli_fetch_array($LT)){
                ?>
                <option <?php if($rowTin["idLT"]==$row_LT["idLT"]) echo "selected = 'selected'"?> value="<?php echo $row_LT["idLT"]?>"><?php echo $row_LT["Ten"] ?></option>
                <?php
                }
                ?>            
            </select></td>
        </tr>
        <tr>
          <td>Tiêu đề</td>
          <td><label for="TieuDe"></label>
            <input value="<?php echo $rowTin["TieuDe"]?>" name="TieuDe" type="text" id="TieuDe" size="45" /></td>
        </tr>
        <tr>
          <td>url Hình</td>
          <td><label for="urlHinh"></label>
            <input value="<?php echo $rowTin["urlHinh"]?>" name="urlHinh" type="text" id="urlHinh" size="45" /></td>
        </tr>
        <tr>
          <td>Tóm tắt </td>
          <td><label for="TomTat"></label>
            <textarea name="TomTat" id="TomTat" cols="45" rows="5"><?php echo $rowTin["TomTat"]?></textarea></td>
        </tr> 
        <tr>
          <td>Nội dung tin</td>
          <td><label for="Content"></label>
            <textarea  name="Content" id="Content" cols="45" rows="5"><?php echo $rowTin["Content"]?></textarea>
            <script type="text/javascript">
				var editor = CKEDITOR.replace( 'Content',{
					uiColor : '#9AB8F3',
					language:'vi',
					skin:'v2',
					filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?Type=Images',
					filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?Type=Flash',
					filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
					filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
								
					toolbar:[
					['Source','-','Save','NewPage','Preview','-','Templates'],
					['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print'],
					['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
					['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
					['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
					['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
					['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
					['Link','Unlink','Anchor'],
					['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
					['Styles','Format','Font','FontSize'],
					['TextColor','BGColor'],
					['Maximize', 'ShowBlocks','-','About']
					]
				});		
</script>
            
            </td>
        </tr>
        <tr>
          <td>Tin nổi bật</td>
          <td><p>
            <label>
              <input <?php if($rowTin["TinNoiBat"]==1) echo "checked='checked'";?> type="radio" name="TinNoiBat" value="1" id="TinNoiBat_0" />
              Nổi bật</label>
            <br />
            <label>
              <input <?php if($rowTin["TinNoiBat"]==0) echo "checked='checked'";?> type="radio" name="TinNoiBat" value="0" id="TinNoiBat_1" />
              Bình thường</label>
            <br />
          </p></td>
        </tr>
        <tr>
          <td>Ẩn hiện</td>
          <td><p>
            <label>
              <input <?php if($rowTin["AnHien"]==0) echo "checked='checked'";?> type="radio" name="AnHien" value="0" id="AnHien_0" />
              Ẩn</label>
            <br />
            <label>
              <input <?php if($rowTin["AnHien"]==1) echo "checked='checked'";?> type="radio" name="AnHien" value="1" id="AnHien_1" />
              Hiện</label>
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