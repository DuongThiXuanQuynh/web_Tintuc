<?php

ob_start();
session_start();
if(!isset($_SESSION["idUser"]) && $_SESSION["idGroup"]!=1 ){	
	header("location:../index.php");
}

include "../lb/dbCon.php";
include "../lb/quantri.php";

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
            <li><a href="./"><span class="glyphicon glyphicon-home"></span> Trang chủ</a></li>
            <li><a href="./ListTheLoai.php">Thể loại</a></li>
            <li><a href="./ListLoaiTin.php">Loại tin</a></li>
            <li><a href="./ListTinTuc.php">Tin tức</a></li>
            <li><a href="./ListQuangCao.php">Quảng cáo</a></li>
            <li><a href="./ListBinhLuan.php">Bình luận</a></li>
          </ul>
         </div>
         </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">TIN TỨC</h1>

          <div class="row placeholders"> 
              <a href="./ThemTin.php" class="btn btn-default"> <span class="glyphicon glyphicon-plus"></span>Thêm tài khoản</a> 
              <a href="./Setting.php" class="btn btn-default"> <span class="glyphicon glyphicon-repeat"></span> Reload </a> 
              <a class="btn btn-danger" id="delTin"> <span class="glyphicon glyphicon-trash"></span> Xoá </a> 
           </div>
          <h2 class="sub-header">Danh sách tài khoản</h2>
          <?php
		  	$tk = DanhSachTaiKhoan();
	 	 	if(mysqli_num_rows($tk)){	
	 	 ?>	  
		  
          <div class="table-responsive">
            <table class="table table-striped"id="list">
              <thead>
                <tr align="center">
                  <th width="4%" valign="middle"><input type="checkbox" id="cbxAll"></th>
                  <th width="12%" valign="middle">Tên đăng nhập</th>
                  <th width="10%" valign="middle">Địa chỉ</th>
                  <th width="12%" valign="middle">Điện thoại</th>
                  <th width="18%" valign="middle">Email</th>
                  <th width="15%" valign="middle">Ngày đăng ký</th>
                  <th width="12%" valign="middle">Phân quyền</th>
                  <th width="8%" valign="middle">Active</th>
                  <th width="9%" valign="middle">Tools</th>
                </tr>
              </thead>
              <tbody>
              <?php
			  while($row_tk = mysqli_fetch_array($tk)){
					ob_start();
			  ?>
                
		  <tr>
          	<td align="left" valign="middle"><input type="checkbox" name="idUser" value="{idUser}" class="cbx"></td>
          	<td align="left" valign="middle">{Username}</td>
			<td align="left" valign="middle">{DiaChi}</td>
			<td align="left" valign="middle">{Dienthoai}</td>
			<td align="center" valign="middle">{Email}</td>
			<td align="left" valign="middle">{NgayDangKy}</td>
			<td align="center" valign="middle">{idGroup}</td>
			<td align="center" valign="middle">{Active}</td>
			<td align="left" valign="middle"><a href="SuaTK.php?idUser={idUser}" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-edit"></span></a> 
                  							<a onclick="return confirm('Bạn có chắc là muốn xóa không?')"href="XoaTK.php?idUser={idUser}"class="btn btn-danger btn-sm del-cate-list">
                <span class="glyphicon glyphicon-trash"></span></a></td>
		  </tr>
		  <?php
			$s = ob_get_clean();
			$s = str_replace("{idUser}",$row_tk["idUser"], $s);
			$s = str_replace("{Username}",$row_tk["Username"], $s);
			$s = str_replace("{DiaChi}",$row_tk["DiaChi"], $s);
			$s = str_replace("{Dienthoai}",$row_tk["Dienthoai"], $s);
			$s = str_replace("{Email}",$row_tk["Email"], $s);
			$s = str_replace("{NgayDangKy}",$row_tk["NgayDangKy"], $s);
			$s = str_replace("{idGroup}",$row_tk["idGroup"], $s);
			$s = str_replace("{Active}",$row_tk["Active"], $s);
			echo $s;
		  }
			}
		  ?>
				  </tbody>
				</table>
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
