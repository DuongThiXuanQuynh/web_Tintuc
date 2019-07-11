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
				$('#delQC').click(function() {
					$confirm = confirm('Bạn có chắc chắn muốn xoá các chuyên mục đã chọn không?');
					if ($confirm == true)
					{
						$idQC = [];
				 		
						$('#list input[type="checkbox"]:checkbox:checked').each(function(i) {
							$idQC[i] = $(this).val();
						});
				 		
						if ($idQC.length === 0)
						{
							alert('Vui lòng chọn ít nhất một chuyên mục.');
						}
						else						
						{
							$dem=0;
							for(i=0;i<=$idQC.length;i++){
								$id=$idQC[i];
								$.ajax({
									url : '../jquery-slider-master/js/XoaQC.php?idQC='+$id,
									type : 'GET',							
									success : function(data) {
										location.reload();
									}, error : function() {
										alert('Đã có lỗi xảy ra, hãy thử lại.');
									}
								});
								$dem++;
							}
							alert("Đã xóa "+$dem+" quảng cáo");
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
          <h1 class="page-header">QUẢNG CÁO</h1>

          <div class="row placeholders"> 
              <a href="./ThemQuangCao.php" class="btn btn-default"> <span class="glyphicon glyphicon-plus"></span>Thêm</a> 
              <a href="./ListQuangCao.php" class="btn btn-default"> <span class="glyphicon glyphicon-repeat"></span> Reload </a> 
              <a class="btn btn-danger" id="delQC"> <span class="glyphicon glyphicon-trash"></span> Xoá </a> 
           </div>
          <h2 class="sub-header">Danh sách quảng cáo</h2>
          <?php
			$qc = DanhSachQuangCao();
	  		if(mysqli_num_rows($qc)){	
	  ?>	  
		  
          <div class="table-responsive">
            <table class="table table-striped" id="list">
              <thead>
                <tr align="center">
                  <th width="4%" valign="middle"><input type="checkbox" id="cbxAll"></th>
                  <th width="7%" align="center" valign="middle">idQC</th>
                  <th width="11%" align="center" valign="middle">Mô tả</th>
                  <th width="10%" align="center" valign="middle">Vị trí</th>
                  <th width="7%" align="center" valign="middle">URL</th>
                  <th width="29%" align="center" valign="middle">url Hình</th>
                  <th width="11%" align="center" valign="middle">Số lần click</th>
                  <th width="10%" align="center" valign="middle">Tools</th>
                </tr>
              </thead>
              <tbody>
              <?php
			  while($rowQC = mysqli_fetch_array($qc)){
		  			ob_start();
			  ?>
                
		  <tr>
          	<td valign="middle"><input type="checkbox" name="idQC[]" value="{idQC}" class="cbx"></td>
          	<td align="left" valign="middle">{idQC}</td>
			<td align="left" valign="middle">{MoTa}</td>
			<td align="left" valign="middle">{vitri}</td>
			<td align="left" valign="middle">{Url}</td>
			<td align="left" valign="middle">{urlHinh}</td>
			<td align="center" valign="middle">{SoLanClick}</td>
			<td align="left" valign="middle"><a href="SuaQuangCao.php?idQC={idQC}" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-edit"></span></a> 
                         <a onclick="return confirm('Bạn co chắc là muốn xóa không?')"href="XoaQuangCao.php?idQC={idQC}"class="btn btn-danger btn-sm del-cate-list">
                		<span class="glyphicon glyphicon-trash"></span></a></td>
		  </tr>
		  <?php
			$s = ob_get_clean();
			$s = str_replace("{idQC}",$rowQC["idQC"], $s);
			$s = str_replace("{MoTa}",$rowQC["MoTa"], $s);
			$s = str_replace("{vitri}",$rowQC["vitri"], $s);
			$s = str_replace("{Url}",$rowQC["Url"], $s);
			$s = str_replace("{urlHinh}",$rowQC["urlHinh"], $s);
			$s = str_replace("{SoLanClick}",$rowQC["SoLanClick"], $s);
			echo $s;
		  }
		  ?>
				  </tbody>
				</table>
                <?php }
                else
                {
                    echo '<br><br><div class="alert alert-info">Chưa có quảng cáo nào.</div>';
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
