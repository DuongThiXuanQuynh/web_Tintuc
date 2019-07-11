<?php

ob_start();
session_start();
if(!isset($_SESSION["idUser"]) && $_SESSION["idGroup"]!=1 ){	
	header("location:../index.php");
}

include "../lb/dbCon.php";
include "../lb/quantri.php";

$idUser = $_GET['idUser'];
settype($idUser,"int");
$user = ThongTinUser($idUser);
$row_user = mysqli_fetch_array($user);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../assets/ico/favicon.ico">

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
			$("#btnSua").click(function(){
				$("#formSua button").html('Đang tải...');
				$HoTen = $("#HoTen").val();
				$Username = $("#Username").val();
				$GioiTinh = $("#GioiTinh input:radio:checked").val();
				$DienThoai = $("#DienThoai ").val();
				$Email = $("#Email").val();
				$DiaChi = $("#DiaChi").val();
				$NgaySinh = $("#NgaySinh").val();	
				alert($HoTen);
				alert($Username);
				alert($GioiTinh);
				alert($DienThoai);
				alert($Email);
				alert($DiaChi);
				alert($NgaySinh);
				if($Username && $Email && $DienThoai){
					$.ajax({
							url :'XuLyAjax/FormSuaAjax.php?idUser=<?php echo $_SESSION['idUser']?>',
							type : 'POST',
							data : {
								HoTen : $HoTen,
								Username : $Username,
								GioiTinh : $GioiTinh,
								DienThoai : $DienThoai,
								Email : $Email,
								DiaChi : $DiaChi,
								NgaySinh : $NgaySinh,
							}, success : function(data) {
								$('#formSua .alert').removeClass('hidden');
								$('#formSua .alert').html(data);
							}, error : function() {
								$('#formSua .alert').removeClass('hidden');
								$('#formSua .alert').html('Đã có lỗi xảy ra, vui lòng thử lại.');
							}
						});
					$('#formSua button').html('Lưu thay đổi');
				} else {
					$('#formSua button').html('Lưu thay đổi');
					$('#formSua .alert').removeClass('hidden');
					$('#formSua .alert').html('Vui lòng điền đầy đủ thông tin.');
				
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
            <li class="active"><a href="./">Trang chủ</a></li>
            <li><a href="./ListTheLoai.php">Thể loại</a></li>
            <li><a href="./ListLoaiTin.php">Loại tin</a></li>
            <li><a href="./ListTinTuc.php">Tin tức</a></li>
            <li><a href="./ListQuangCao.php">Quảng cáo</a></li>
            <li><a href="./ListBinhLuan.php">Bình luận</a></li>
            <li><a href="./Setting.php">Người dùng</a></li>
          </ul>
          </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Profile</h1>
          <div class="row placeholders"> 
          	  <a href="ThemTaiKhoan1.php" class="btn btn-default"> <span class="glyphicon glyphicon-plus"></span>Thêm</a> 
              <a href="DoiMatKhau.php" class="btn btn-default"> <span class="glyphicon glyphicon-edit"></span>Đổi mật khẩu</a> 
              <a href="./" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span>Trở về</a>
           </div>
		  <div class="panel panel-default">
            	<div class="panel-heading">Thông tin người dùng</div>
            		<div class="panel-body">
            			<form method="POST" onsubmit="return false;" id="formSua">
                			<div class="form-group">
                                <label>Họ tên *</label>
                                <input type="text" class="form-control" id="HoTen" value="<?php echo $row_user['HoTen'] ?>">
                        	</div>
                            <div class="form-group">
                                <label>Tên đăng nhập</label>
                                <input type="text" class="form-control" id="Username" value="<?php echo $row_user['Username'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Ngày sinh</label>
                                <input type="date" class="form-control" id="NgaySinh" value="<?php echo $row_user['NgaySinh'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Giới tính</label>
                                <div class="radio">
                                    <label><input <?php if($row_user['GioiTinh']==0) echo 'checked="checked"'?> type="radio" name="GioiTinh" value="0" id="GioiTinh_0" />Nữ</label>
                                </div>
                                <div class="radio">
                                    <label><input <?php if($row_user['GioiTinh']==1) echo 'checked="checked"'?> type="radio" name="GioiTinh" value="1" id="GioiTinh_1" />Nam</label>
                                </div>                
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="text" class="form-control" id="DiaChi" value="<?php echo $row_user['DiaChi'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Điện thoại</label>
                                <input type="text" class="form-control" id="DienThoai" size="10" value="<?php echo $row_user['Dienthoai'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" id="Email" value="<?php echo $row_user['Email'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Ngày đăng ký</label>
                                <input type="date" class="form-control" id="NgayDangKy"  disabled="disabled" value="<?php echo $row_user['NgayDangKy'] ?>">
                            </div>
                            <div class="form-group">
                                <label>idGroup </label>
                                <div class="radio"  disabled="disabled" >
                                    <label><input <?php if($row_user['idGroup']==0) echo 'checked="checked"'?> type="radio" name="idGroup" value="0" id="idGroup_0" />thành viên</label>
                                </div>
                                <div class="radio">
                                    <label><input <?php if($row_user['idGroup']==1) echo 'checked="checked"'?> type="radio" name="idGroup" value="1" id="idGroup_1" />admin</label>
                                </div> 
                            </div>
                            <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="btnSua" id="btnSua">Lưu thay đổi</button>
                            </div>
                            <div class="alert alert-danger hidden"></div>
            			</form>
                    </div>
                </div>
				';
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
