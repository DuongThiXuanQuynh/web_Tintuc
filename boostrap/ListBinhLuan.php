<?php
ob_start();
session_start();
if(!isset($_SESSION["idUser"]) && $_SESSION["idGroup"]!=1 ){	
	header("location:../index.php");
}

require "../lb/dbCon.php";
require "../lb/quantri.php";

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
					// Checkbox all
					$("#cbxAll").change(function() {						
						$(".cbx").prop('checked', $(this).prop("checked"));
						});
				});
				// Xoá nhiều chuyên mục cùng lúc
				$(function(){
				$('#delBL').click(function() {
					$confirm = confirm('Bạn có chắc chắn muốn xoá các chuyên mục đã chọn không?');
					if ($confirm == true)
					{
						$idCmt = [];
				 		
						$('#list input[type="checkbox"]:checkbox:checked').each(function(i) {
							$idCmt[i] = $(this).val();
						});
				 		
						if ($idCmt.length === 0)
						{
							alert('Vui lòng chọn ít nhất một chuyên mục.');
						}
						else						
						{
							for(i=0;i<=$idCmt.length;i++){
								$id=$idCmt[i];
								$.ajax({
									url : '../jquery-slider-master/js/XoaBL.php?idCmt='+$id,
									type : 'GET',							
									success : function(data) {
										location.reload();
									}, error : function() {
										alert('Đã có lỗi xảy ra, hãy thử lại.');
									}
								});
							}
							alert("Xóa thành công "+$dem+" bình luận");
						}
					}
					else
					{
						return false;
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
          <h1 class="page-header">BÌNH LUẬN</h1>

          <div class="row placeholders">
                <a href="./ListBinhLuan.php" class="btn btn-default">
                    <span class="glyphicon glyphicon-repeat"></span> Reload
                </a>   
               <a class="btn btn-danger" id="delBL" >
                    <span class="glyphicon glyphicon-trash"></span> Xoá
                </a> 
          </div>
          <div id="kq"> </div>
          <h2 class="sub-header">Danh sách bình luận</h2>
          <?php
			$bl = DanhSachBinhLuan();
	  		if(mysqli_num_rows($bl)){	
	  ?>	  
		  
          <div class="table-responsive">
            <table class="table table-striped List" id="list">
              <thead>
                <tr align="center">
                  <th width="6%" valign="middle"><input type="checkbox" id="cbxAll" name="cbxall" class="cbxall"></th>
                  <th width="11%" align="center" valign="middle">Thời gian</th>
                  <th width="10%" align="center" valign="middle">idTin</th>
                  <th width="9%" valign="middle">idCmt</th>
                  <th width="9%" align="center" valign="middle">Tên</th>
                  <th width="30%" align="center" valign="middle">Nội dung</th>
                  <th width="12%" align="center" valign="middle">Tools</th>
                </tr>
              </thead>
              <tbody>
              <?php
			  while($rowBL= mysqli_fetch_array($bl)){
		  			ob_start();
			  ?>
                
		  <tr>
          	<td valign="middle"><input type="checkbox" name="idCmt[]" class="cbx" value="{idCmt}" id="cbx"></td>
          	<td align="left" valign="middle">{ThoiGian}</td>
			<td align="left" valign="middle">{idTin}</td>
			<td align="left" valign="middle">{idCmt}</td>
			<td align="left" valign="middle">{Ten}</td>
			<td align="left" valign="middle">{NoiDung}</td>
			<td align="left" valign="middle"><a onclick="return confirm('Bạn co chắc là muốn xóa không?')"href="XoaBinhLuan.php?idCmt={idCmt}" class="btn btn-danger btn-sm del-cate-list">
            <span class="glyphicon glyphicon-trash"></span>
            </a></td>
		  </tr>
		  <?php
			$s = ob_get_clean();
			$s = str_replace("{ThoiGian}",$rowBL["ThoiGian"], $s);
			$s = str_replace("{idTin}",$rowBL["idTin"], $s);
			$s = str_replace("{idCmt}",$rowBL["idCmt"], $s);
			$s = str_replace("{Ten}",$rowBL["Ten"], $s);
			$s = str_replace("{NoiDung}",$rowBL["NoiDung"], $s);
			echo $s;
		  }
		  ?>
				  </tbody>
				</table>
                <?php }
                else
                {
                    echo '<br><br><div class="alert alert-info">Chưa có bình luận nào.</div>';
                }
				?>
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
