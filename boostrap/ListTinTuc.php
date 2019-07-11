<?php
ob_start();
session_start();
if(!isset($_SESSION["idUser"]) && $_SESSION["idGroup"]!=1 ){	
	header("location:../index.php");
}

require "../lb/dbCon.php";
require "../lb/quantri.php";

$limit = 30;
	if(isset($_GET["trang"])){
		$Trang = $_GET["trang"];
	}
	else{
		$Trang = 1;
	}
	settype($Trang,"int");
	$from = ($Trang-1)*$limit;
	$tin = DanhSachTin_PhanTrang($from,$limit);
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
				$('#delTin').click(function() {
					$confirm = confirm('Bạn có chắc chắn muốn xoá các chuyên mục đã chọn không?');
					if ($confirm == true)
					{
						$idTin = [];
				 		
						$('#list input[type="checkbox"]:checkbox:checked').each(function(i) {
							$idTin[i] = $(this).val();
						});
				 		
						if ($idTin.length === 0)
						{
							alert('Vui lòng chọn ít nhất một chuyên mục.');
						}
						else						
						{
							for(i=0;i<=$idTin.length;i++){
								$id=$idTin[i];
								$.ajax({
									url : '../jquery-slider-master/js/XoaTin.php?idTin='+$id,
									type : 'GET',							
									success : function(data) {
										location.reload();
									}, error : function() {
										alert('Đã có lỗi xảy ra, hãy thử lại.');
									}
								});
							}
							alert("Xóa thành công");
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
          <h1 class="page-header">TIN TỨC</h1>

          <div class="row placeholders"> 
              <a href="./ThemTin.php" class="btn btn-default"> <span class="glyphicon glyphicon-plus"></span>Thêm</a> 
              <a href="./ListTinTuc.php" class="btn btn-default"> <span class="glyphicon glyphicon-repeat"></span> Reload </a> 
              <a class="btn btn-danger" id="delTin"> <span class="glyphicon glyphicon-trash"></span> Xoá </a> 
           </div>
          <h2 class="sub-header">Danh sách tin</h2>
          <?php
	 	 	if(mysqli_num_rows($tin)){	
	 	 ?>	  
		  
          <div class="table-responsive">
            <table class="table table-striped"id="list">
              <thead>
                <tr align="center">
                  <th width="4%" valign="middle"><input type="checkbox" id="cbxAll"></th>
                  <th width="7%" valign="middle">Ngày</th>
                  <th width="11%" valign="middle">Tên thể loại</th>
                  <th width="10%" valign="middle">Tên loại tin</th>
                  <th width="7%" valign="middle">idTin</th>
                  <th width="29%" valign="middle">Nội dung</th>
                  <th width="11%" valign="middle">Số lần xem</th>
                  <th width="11%" valign="middle">Tin nổi bật<br />
Ẩn hiện</th>
                  <th width="10%" valign="middle">Tools</th>
                </tr>
              </thead>
              <tbody>
              <?php
			  while($rowTin = mysqli_fetch_array($tin)){
					ob_start();
			  ?>
                
		  <tr>
          	<td align="center" valign="middle"><input type="checkbox" name="idTin[]" value="{idTin}" class="cbx"></td>
          	<td align="left" valign="middle">{Ngay}</td>
			<td align="left" valign="middle">{TenTL}</td>
			<td align="left" valign="middle">{Ten}</td>
			<td align="center" valign="middle">{idTin}</td>
			<td align="left" valign="middle"><p><a href="SuaTin.php?idTin={idTin}">{TieuDe}</a></p>
			  <p><img src="../upload/tintuc/{urlHinh}" alt="" width="131" height="96" style="float:left; margin-right:5px;" />{TomTat}</p></td>
			<td align="center" valign="middle">{SoLanXem}</td>
			<td align="center" valign="middle">{TinNoiBat}-{AnHien}</td>
			<td align="left" valign="middle"><a href="SuaTin.php?idTin={idTin}" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-edit"></span></a> 
                  							<a onclick="return confirm('Bạn có chắc là muốn xóa không?')"href="XoaTin.php?idTin={idTin}"class="btn btn-danger btn-sm del-cate-list">
                <span class="glyphicon glyphicon-trash"></span></a></td>
		  </tr>
		  <?php
			$s = ob_get_clean();
			$s = str_replace("{idTin}",$rowTin["idTin"], $s);
			$s = str_replace("{TieuDe}",$rowTin["TieuDe"], $s);
			$s = str_replace("{TomTat}",$rowTin["TomTat"], $s);
			$s = str_replace("{TenTL}",$rowTin["TenTL"], $s);
			$s = str_replace("{Ten}",$rowTin["Ten"], $s);
			$s = str_replace("{SoLanXem}",$rowTin["SoLanXem"], $s);
			$s = str_replace("{AnHien}",$rowTin["AnHien"], $s);
			$s = str_replace("{TinNoiBat}",$rowTin["TinNoiBat"], $s);
			$s = str_replace("{urlHinh}",$rowTin["urlHinh"], $s);
			$s = str_replace("{Ngay}",$rowTin["Ngay"], $s);
			echo $s;
		  }
		  ?>
				  </tbody>
				</table>
                
                <div class="btn-group" id="PhanTrang">
					<?php
                        $t = DanhSachTin();
                        $TongSoTin = mysqli_num_rows($t);
                        $TongTrang = ceil($TongSoTin/$limit);
						// Nếu trang hiện tại > 1 và tổng trang > 1 thì hiển thị nút prev
						 if ($Trang > 1 && $TongTrang > 1){
							echo '<a class="btn btn-default" href="ListTinTuc.php?trang=' . ($Trang - 1) . '"><span class="glyphicon glyphicon-chevron-left"></span> Prev</a>';
						}
						  
						// In số nút trang
						for ($i = 1; $i <= $TongTrang; $i++){
							// Nếu trùng với trang hiện tại thì active
							if ($i == $Trang){
								echo '<a class="btn btn-default active">' . $i . '</a>';
							// Ngược lại
							} else {
								echo '<a class="btn btn-default" href="ListTinTuc.php?trang=' . $i . '">' . $i . '</a>';
							}
						}
						  
						// Nếu trang hiện tại < tổng số trang > 1 thì hiển thị nút next
							if ($Trang < $TongTrang && $TongTrang > 1){
								echo '<a class="btn btn-default" href="ListTinTuc.php?trang=' . ($Trang + 1) . '">Next <span class="glyphicon glyphicon-chevron-right"></span></a>';
							}
						echo '<br><br><br></div>';
					 }
                else
                {
                    echo '<br><br><div class="alert alert-info">Chưa có tin nào.</div>';
                }
				?>
       			</div>
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
