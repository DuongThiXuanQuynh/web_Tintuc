<?php

ob_start();
session_start();
if(!isset($_SESSION["idUser"]) && $_SESSION["idGroup"]!=1 ){	
	header("location:../index.php");
}

require "../lb/dbCon.php";
require "../lb/quantri.php";
$idLT = $_GET["idLT"];
settype($idLT,"int");
$row_LT = ChiTietLoaiTin($idLT);

if(isset($_POST["btnSua"])){
$Ten = $_POST["Ten"];
	$Ten_KhongDau= ChangeTitle($Ten);
	$ThuTu = $_POST["ThuTu"];
		settype($ThuTu, "int");
	$AnHien = $_POST["AnHien"];
		settype($AnHien,"int");
	$idTL = $_POST["idTL"];
		settype($idTL, "int");
	$qr = "update loaitin set Ten='$Ten',Ten_KhongDau='$Ten_KhongDau',ThuTu='$ThuTu',AnHien='$AnHien',idTL='$idTL' where idLT='$idLT'";
	mysqli_query($con,$qr);
	header("location:ListLoaiTin.php");
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
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" >
				$(function(){
					$("#idTL").blur(function(){
						var AnHien = $('#formThem input[name="idTL"]:select:selected').val();
						if (AnHien == ""){
							$('#formThem .alert').removeClass('hidden');
       						$('#formThem .alert').html('Vui lòng chọn thể loại');
						}			
					});
				});
				$(function(){
					$("#Ten").blur(function(){
						var Ten = $("#Ten").val();
						if (Ten == ""){
							//alert("Vui lòng nhập tên thể loại");
							$('#formThem .alert').removeClass('hidden');
       						$('#formThem .alert').html('Vui lòng điền tên loại tin');
						}			
					});
				});
				$(function(){
					$("#ThuTu").blur(function(){
						var ThuTu = $("#ThuTu").val();
						if (ThuTu == ""){
							$('#formThem .alert').removeClass('hidden');
       						$('#formThem .alert').html('Vui lòng điền thứ tự');
						}			
					});
				});
				$(function(){
					$("#AnHien").blur(function(){
						var AnHien = $('#formThem input[name="AnHien"]:radio:checked').val();
						if (AnHien == ""){
							$('#formThem .alert').removeClass('hidden');
       						$('#formThem .alert').html('Vui lòng chọn ẩn hiện');
						}			
					});
				});
				
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
            <li><a href="./profile.php">Profile</a></li>
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
          </ul>
           </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <div class="row placeholders">
          	<a href="./ListLoaiTin.php" class="btn btn-default">
              	<span class="glyphicon glyphicon-arrow-left"></span>Trở về</a>
          </div>

          <h2 class="sub-header">Thông tin loại tin</h2>
          <div class="table-responsive">
            <p class="form-edit-cate">
            <form method="POST" id="formThem" data-id="'.$row_TL["TenTL"].'" class="form-cate">
                <div class="form-group">
                    <label>Tên thể loại</label>
                    <label for="idTL"></label>
           			<select class="form-control title" name="idTL" id="idTL">
					<?php
						$TL = DanhSachTheLoai();
						while($row_TL = mysqli_fetch_array($TL)){
                    ?>
                    <option <?php if($row_TL["idTL"]==$row_LT["idTL"]) echo "selected='selected'";?> value="<?php echo $row_TL["idTL"]?>"><?php echo $row_TL["TenTL"] ?></option>
                    <?php
                    }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" class="form-control title" name="Ten" id="Ten" value= "<?php echo $row_LT["Ten"]?>">
                </div>
                <div class="form-group">
                    <label>Thứ tự </label>
                    <input type="text" class="form-control slug" name="ThuTu" id="ThuTu" value= "<?php echo $row_LT["ThuTu"]?>">
                </div>
                <div class="form-group">
                    <label>Ẩn hiện</label>
                    <div class="radio">
                        <label>
                            <input <?php if($row_LT["AnHien"]==1) echo "checked='checked'";?> type="radio" name="AnHien" value="1" id="AnHien_0" />
              Hiện</label>
                    </div>
                    <div class="radio">
                        <label>
                            <input <?php if($row_LT["AnHien"]==0) echo "checked='checked'";?> type="radio" name="AnHien" value="0" id="AnHien_1" />
              Ẩn</label>
                    </div>
                </div>
                                <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="btnSua" id="btnSua">Lưu thay đổi</button>
                                 </div>
                                 <div class="alert alert-danger hidden"></div>
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
