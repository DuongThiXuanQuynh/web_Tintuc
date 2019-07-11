<?php

ob_start();
session_start();
if(!isset($_SESSION["idUser"]) && $_SESSION["idGroup"]!=1 ){	
	header("location:../index.php");
}

require "../lb/dbCon.php";
require "../lb/quantri.php";


$idTin = $_GET["idTin"];
settype($idTin,"int");
$rowTin = ChiTietTin($idTin);

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

	
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/favicon.ico">

    <title>Trang quản trị</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" >
				$(function(){
					$("#TieuDe").blur(function(){
						var TieuDe = $("#TieuDe").val();
						if (TieuDe == ""){
							$('#error').removeClass('hidden');
       						$('#error').html('Vui lòng điền tiêu đề');
						}	
					
					});
				});
						
				$(function(){
					$("#TomTat").blur(function(){
						var TomTat = $("#TomTat").val();
						if (TomTat == ""){
							$('#error').removeClass('hidden');
       						$('#error').html('Vui lòng điền tóm tắt');
						}			
					});
				});
				$(function(){
					$("#urlHinh").blur(function(){
						var urlHinh = $("#urlHinh").val();
						if (urlHinh == ""){
							$('#error').removeClass('hidden');
       						$('#error').html('Vui lòng chọn hình ảnh');
						}			
					});
				});
				$(function(){
					$("#Content").blur(function(){
						var Content = $("#Content").val();
						if (Content == ""){
							$('#error').removeClass('hidden');
       						$('#error').html('Vui lòng điền nội dung tin');
						}			
					});
				});
				
	</script>
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
    <script type="text/javascript">
				function preUpImg() {
			urlHinh = $('#urlHinh').val();
			$('.box-pre-img').html('<p><strong>Ảnh xem trước</strong></p>');
			$('.box-pre-img').removeClass('hidden');
		 
			// Nếu đã chọn ảnh
			if (urlHinh != '')
			{
				$('.box-pre-img').html('<p><strong>Ảnh xem trước</strong></p>');
				$('.box-pre-img').removeClass('hidden');
				$('.box-pre-img').append('<img src="' + URL.createObjectURL(event.target.files[0]) + '" style="border: 1px solid #ddd; width: 50px; height: 50px; margin-right: 5px; margin-bottom: 5px;"/>');
			} 
			// Ngược lại chưa chọn ảnh
			else
			{
				$('.box-pre-img').html('');
				$('.box-pre-img').addClass('hidden');
			}
		}
	</script>

  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Trang quản trị Web Tin tức</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="./">Dashboard</a></li>
            <li><a href="./Setting.php">Settings</a></li>
            <li><a href="./profile.php?idUser=<?php echo $_SESSION['idUser']?>">Profile</a></li>
            <li><a href="./help.php">Help</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="./">Trang chủ</a></li>
            <li><a href="./ListTheLoai.php">Thể loại</a></li>
            <li><a href="./ListLoaiTin.php">Loại tin</a></li>
            <li><a href="./ListTinTuc.php">Tin tức</a></li>
            <li><a href="./ListQuangCao.php">Quảng cáo</a></li>
            <li><a href="./ListBinhLuan.php">Bình luận</a></li>
            <li><a href="./Setting.php">Người dùng</a></li>
          </ul>
          </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <div class="row placeholders">
          	<a href="./ListTinTuc.php" class="btn btn-default">
              	<span class="glyphicon glyphicon-arrow-left"></span>Trở về</a>
          </div>

          <h2 class="sub-header">Thông tin loại tin</h2>
          <div class="table-responsive">
            <p class="form-edit-cate">
            <form method="POST" id="formThem" data-id="#" class="form-cate">
                <div class="form-group">
                    <label>Tên thể loại</label>
                    <label for="idTL"></label>
           			<select class="form-control TL" name="idTL" id="idTL">
					<?php
						$TL = DanhSachTheLoai();
						while($row_TL = mysqli_fetch_array($TL)){
                    ?>
                    <option <?php if($rowTin["idTL"]==$row_TL["idTL"]) echo "selected = 'selected'"?> value="<?php echo $row_TL["idTL"]?>"><?php echo $row_TL["TenTL"] ?></option>
                    <?php
                    }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tên loại tin</label>
                    <label for="idLT"></label>
           			<select class="form-control LT" name="idLT" id="idLT">
					<?php
						$LT = DanhSachLoaiTin();
						while($row_LT = mysqli_fetch_array($LT)){
                    ?>
                    <option <?php if($rowTin["idLT"]==$row_LT["idLT"]) echo "selected = 'selected'"?> value="<?php echo $row_LT["idLT"]?>"><?php echo $row_LT["Ten"] ?></option>
                    <?php
                    }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tiêu đề</label>
                    <input type="text" class="form-control TieuDe" name="TieuDe" id="TieuDe" value="<?php echo $rowTin["TieuDe"]?>">
                </div>
                <div class="form-group">
                    <label>Tóm tắt </label>
                    <textarea class="form-control TomTat" name="TomTat" id="TomTat"><?php echo $rowTin["TomTat"]?></textarea>
                </div>
                <div class="form-group">
                    <label>URL hình</label>
                    <input type="file" class="form-control" accept="image/*" name="urlHinh" id="urlHinh" onchange="preUpImg();" value="<?php echo $rowTin["urlHinh"]?>"/>
                </div>
                <div class="form-group box-pre-img hidden">
                    <p><strong>Ảnh xem trước</strong></p>
                </div>
                <div class="form-group hidden box-progress-bar">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Nội dung </label>
                    <textarea class="form-control Content" name="Content" id="Content"><?php echo $rowTin["Content"]?></textarea>
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
                </div>
                <div class="form-group">
                    <label>Tin nổi bật</label>
                    <div class="radio">
                        <label>
                            <input <?php if($rowTin["TinNoiBat"]==0) echo "checked='checked'";?> type="radio" name="TinNoiBat" value="0" id="TinNoiBat_0" />
              Bình thường</label>
                    </div>
                    <div class="radio">
                        <label>
                            <input <?php if($rowTin["TinNoiBat"]==1) echo "checked='checked'";?> type="radio" name="TinNoiBat" value="1" id="TinNoiBat_1" />
              Nổi bật</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Ẩn hiện</label>
                    <div class="radio">
                        <label>
                            <input <?php if($rowTin["AnHien"]==0) echo "checked='checked'";?> type="radio" name="AnHien" value="0" id="AnHien_0" />
              Ẩn</label>
                    </div>
                    <div class="radio">
                        <label>
                            <input <?php if($rowTin["AnHien"]==1) echo "checked='checked'";?> type="radio" name="AnHien" value="1" id="AnHien_1" checked="checked"/>
              Hiện</label>
                    </div>
                </div>
                                <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="btnSua" id="btnSua">Lưu thay đổi</button>
                                 </div>
                                 <div class="alert alert-danger hidden" id="error"></div>
            </form>
        </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
  </body>
</html>
