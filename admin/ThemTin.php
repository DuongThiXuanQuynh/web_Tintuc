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
	$TieuDe = $_POST["TieuDe"];
	$TieuDe_KhongDau= ChangeTitle($TieuDe);
	$urlHinh = $_POST["urlHinh"];
	$Ngay = date("y-m-d");
	$idUser = $_SESSION["idUser"];
	$TomTat = $_POST["TomTat"];
	$Content = $_POST["Content"];
	$SoLanXem = 0; 
	$TinNoiBat = $_POST["TinNoiBat"];
		settype($TinNoiBat, "int");
	$AnHien = $_POST["AnHien"];
		settype($AnHien,"int");
	$idTL = $_POST["idTL"];
		settype($idTL,"int");
	$idLT = $_POST["idLT"];
		settype($idLT,"int");
	$qr = "insert into loaitin values(null,'$TieuDe','$TieuDe_KhongDau','$TomTat','$urlHinh','$Ngay','$idUser','$Content','$idLT','$idTL','$SoLanXem','$TinNoiBat','$AnHien')";
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
<script type="text/javascript">
function BrowseServer( startupPath, functionData ){
	var finder = new CKFinder();
	finder.basePath = 'ckfinder/'; //Đường path nơi đặt ckfinder
	finder.startupPath = startupPath; //Đường path hiện sẵn cho user chọn file
	finder.selectActionFunction = SetFileField; // hàm sẽ được gọi khi 1 file được chọn
	finder.selectActionData = functionData; //id của text field cần hiện địa chỉ hình
	//finder.selectThumbnailActionFunction = ShowThumbnails; //hàm sẽ được gọi khi 1 file thumnail được chọn	
	finder.popup(); // Bật cửa sổ CKFinder
} //BrowseServer

function SetFileField( fileUrl, data ){
	document.getElementById( data["selectActionData"] ).value = fileUrl;
}
function ShowThumbnails( fileUrl, data ){	
	var sFileName = this.getSelectedFile().name; // this = CKFinderAPI
	document.getElementById( 'thumbnails' ).innerHTML +=
	'<div class="thumb">' +
	'<img src="' + fileUrl + '" />' +
	'<div class="caption">' +
	'<a href="' + data["fileUrl"] + '" target="_blank">' + sFileName + '</a> (' + data["fileSize"] + 'KB)' +
	'</div>' +
	'</div>';
	document.getElementById( 'preview' ).style.display = "";
	return false; // nếu là true thì ckfinder sẽ tự đóng lại khi 1 file thumnail được chọn
}
</script>
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
          <td colspan="2">THÊM TIN</td>
        </tr>
        <tr>
          <td width="98">Thể loại</td>
          <td width="586"><label for="idTL"></label>
            <select name="idTL" id="idTL">
				 <?php
                $TL = DanhSachTheLoai();
                while($row_TL = mysqli_fetch_array($TL)){
                ?>
                <option value="<?php echo $row_TL["idTL"]?>"><?php echo $row_TL["TenTL"] ?></option>
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
                <option value="<?php echo $row_LT["idLT"]?>"><?php echo $row_LT["Ten"] ?></option>
                <?php
                }
                ?>            
            </select></td>
        </tr>
        <tr>
          <td>Tiêu đề</td>
          <td><label for="TieuDe"></label>
            <input name="TieuDe" type="text" id="TieuDe" size="45" /></td>
        </tr>
        <tr>
          <td>url Hình</td>
          <td><label for="urlHinh"></label>
            <input name="urlHinh" type="text" id="urlHinh" size="45" />
            <input onclick="BrowseServer('images:/','urlHinh')" type="button" name="btnChonFile" id="btnChonFile" value="Chọn hình" /></td>
        </tr>
        <tr>
          <td>Tóm tắt </td>
          <td><label for="TomTat"></label>
            <textarea name="TomTat" id="TomTat" cols="45" rows="5"></textarea></td>
        </tr>
        <tr>
          <td>Nội dung tin</td>
          <td><label for="Content"></label>
            <textarea name="Content" id="Content" cols="45" rows="5"></textarea>
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
              <input type="radio" name="TinNoiBat" value="1" id="TinNoiBat_0" />
              Nổi bật</label>
            <br />
            <label>
              <input type="radio" name="TinNoiBat" value="0" id="TinNoiBat_1" />
              Bình thường</label>
            <br />
          </p></td>
        </tr>
        <tr>
          <td>Ẩn hiện</td>
          <td><p>
            <label>
              <input type="radio" name="AnHien" value="0" id="AnHien_0" />
              Ẩn</label>
            <br />
            <label>
              <input type="radio" name="AnHien" value="1" id="AnHien_1" />
              Hiện</label>
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