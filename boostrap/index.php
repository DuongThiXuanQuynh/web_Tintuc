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
            <li><a href="./Setting.php">Người dùng</a></li>
          </ul>
         </div>
         </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Dashboard</h1>
		  <!-- Dashboard bài viết -->
            <h3>Thể loại</h3>
            <div class="row">
              <?php
             
                // Lấy tổng số thể loại
                $TL = DanhSachTheLoai();
                $count_TL = mysqli_num_rows($TL);
             
                echo
                '
                  <div class="col-md-4">
                    <div class="alert alert-info">
                      <h1>' . $count_TL . '</h1>
                      <p>thể loại</p>
                    </div>
                  </div>
                ';
                ?>
              <div class="col-md-4">
                 <div class="alert alert-success">
                      <?php
                      // Lấy tổng thể loại hiển thị
                      $LT= DanhSachLoaiTin();
						$count_LT = mysqli_num_rows($LT);
						echo
							  '<h1>' . $count_LT . '</h1>
							  <p>loại tin </p>
							</div>
						  </div>
						';
                      ?>
              <div class="col-md-4">
                 <div class="alert alert-warning">
                      <?php
                      // Lấy tổng thể loại ẩn
                      $Tin = DanhSachTin();
						$count_Tin = mysqli_num_rows($Tin);
						echo
						'<h1>' . $count_Tin . '</h1>
							  <p>bài viết </p>
							</div>
						  </div>
						';
					  ?>
            </div>
         <h2 class="sub-header">Thống kê</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>idTL</th>
                  <th>Tên thể loại</th>
                  <th>Số lượng loại tin</th>
                  <th>Số lượng bài viết</th>
                </tr>
              </thead>
              <?php
			$ThongKe = DanhSachTin_ThongKe();
			while($row_tk = mysqli_fetch_row($ThongKe)){
				ob_start();
			?>
              <tbody>
                <tr>
                  <td>{idTL}</td>
                  <td>{TenTL}</td>
                  <td>{count_LT}</td>
                  <td>{count_Tin}</td>
                </tr>
                
               </tbody>
               <?php
			    $s= ob_get_clean();
				$s = str_replace("{idTL}",$row_tk["0"], $s);
				$s = str_replace("{TenTL}",$row_tk["1"], $s);
				$s = str_replace("{count_LT}",$row_tk["2"], $s);
				$s = str_replace("{count_Tin}",$row_tk["3"], $s);
				echo $s;
			}
               ?>
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
