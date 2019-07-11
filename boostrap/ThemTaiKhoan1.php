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

if(isset($_POST["btnThem"])){
	$Username = $_POST["Username"];
	$HoTen = $_POST["HoTen"];
	$password = $_POST["password"];
	$GioiTinh = $_POST["GioiTinh"];
	$Dienthoai = $_POST["Dienthoai"];
	$NgaySinh = $_POST["NgaySinh"];
	$DiaChi = $_POST["DiaChi"];
	$Email = $_POST["Email"];
	$idGroup = $_POST["idGroup"];
	$Active = $_POST["Active"];
	$qr = "inssert into users(HoTen, Username, Password, DiaChi, Dienthoai, Email, NgayDangKy, idGroup, NgaySinh, GioiTinh, Active) values ('$HoTen', '$Username', $Password,  '$DiaChi', '$Dienthoai','$Email', now(),$idGroup, '$NgaySinh', '$GioiTinh', '$Active'";
	mysqli_query($con,$qr);
	header("location:profile.php?idUser=".$idUser);	
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
          </ul>
          </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Profile</h1>
          <div class="row placeholders"> 
          	  <a href="DoiMatKhau.php" class="btn btn-default"> <span class="glyphicon glyphicon-plus"></span>Thêm</a> 
              <a href="ThemTaiKhoan1.php" class="btn btn-default"> <span class="glyphicon glyphicon-edit"></span>Đổi mật khẩu</a> 
              <a href="./" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span>Trở về</a>
           </div>
		  <div class="panel panel-default">
            	<div class="panel-heading">Thông tin người dùng</div>
            		<div class="panel-body">
            			<form method="POST" onsubmit="#" id="SuaUser">
                			<div class="form-group">
                                <label>Họ tên *</label>
                                <input type="text" class="form-control" id="HoTen" >
                        	</div>
                            <div class="form-group">
                                <label>Tên đăng nhập</label>
                                <input type="text" class="form-control" id="Username">
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="password" class="form-control" id="password" >
                            </div>
                            <div class="form-group">
                                <label>Ngày sinh</label>
                                <input type="date" class="form-control" id="NgaySinh" >
                            </div>
                            <div class="form-group">
                                <label>Giới tính</label>
                                <div class="radio">
                                    <label><input checked="checked" type="radio" name="GioiTinh" value="0" id="GioiTinh_0" />Nữ</label>
                                </div>
                                <div class="radio">
                                    <label><input  type="radio" name="GioiTinh" value="1" id="GioiTinh_1" />Nam</label>
                                </div>                
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="text" class="form-control" id="DiaChi" >
                            </div>
                            <div class="form-group">
                                <label>Điện thoại</label>
                                <input type="text" class="form-control" id="DienThoai" size="10" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" id="Email" >
                            </div>
                            <div class="form-group">
                                <label>Ngày đăng ký</label>
                                <input type="date" class="form-control" id="NgayDangKy" >
                            </div>
                            <div class="form-group">
                                <label>Ngày đăng ký</label>
                                <input type="date" class="form-control" id="NgayDangKy">
                            </div>
                            <div class="form-group">
                                <label>idGroup</label>
                                <div class="radio">
                                    <label><input checked="checked" type="radio" name="idGroup" value="0" id="idGroup_0" />thành viên</label>
                                </div>
                                <div class="radio">
                                    <label><input  type="radio" name="idGroup" value="1" id="idGroup_1" />admin</label>
                                </div> 
                            </div>
                            <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="btnThem" id="btnThem">Lưu thay đổi</button>
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
