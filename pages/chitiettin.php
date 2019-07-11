<?php 
	if(isset($_GET["idTin"])){
		$idTin = $_GET["idTin"];
		settype($idTin,"int");
	}
	else $idTin = 1;
	CapNhatSoLanXemTin($idTin);
	$tin = ChiTietTin($idTin);
	$row_tin = mysqli_fetch_array($tin);
	
?>
<head>
<style type="text/css">
<!--
#cmt{padding:5px;background-color: rgba(34,34,34,.05);}
.cmt_content{margin-top: 6px;}
.cmt_submit{border-radius: 2px; background-color: #e32; padding: 8px 12px;font-size: 13px; margin-top: 6px;}
#ndCmt{margin-top:10px}
.ten_cmt{font: bold 14px Roboto;color: #e32;margin-bottom: 3px}
-->
</style>
<script type="text/javascript" src="jquery-slider-master/js/jquery-3.2.1.min.js"></script>
<script>
	$(document).ready(function(){
		$(".cmt_submit").click(function(){
			var t =$("#cmt_name").val();
			var nd =$("#cmt_content").val();
			var id =$("#idtin").val();
			$.post("jquery-slider-master/js/XuLyComment.php",{ten:t,nd:nd,idTin:id},function(data){
				$("#tb").html(data);
				$.post("jquery-slider-master/js/ListCmt.php",function(result){
				$("#kq").html(result);	
				});
			
			});
		});
	});
</script>
</head>
<body>	
<div class="chitiet">
	<?php echo $row_tin['Content']?>
</div><div class="clear"></div>
<a class="btn_quantam" id="vne-like-anchor-1000000-3023795" href="#" total-like="21"></a>
<div class="number_count"><span id="like-total-1000000-3023795"><?php echo $row_tin['SoLanXem']?></span></div>
<!--face-->
<div class="left"><div class="fb-like fb_iframe_widget" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true" data-href="http://vnexpress.net/tin-tuc/the-gioi/ukraine-gianh-kiem-soat-nhieu-khu-vuc-gan-hien-truong-mh17-3023795.html" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=&amp;href=http%3A%2F%2Fvnexpress.net%2Ftin-tuc%2Fthe-gioi%2Fukraine-gianh-kiem-soat-nhieu-khu-vuc-gan-hien-truong-mh17-3023795.html&amp;layout=button_count&amp;locale=en_US&amp;sdk=joey&amp;send=false&amp;show_faces=true&amp;width=450"></div></div>
<!--twister-->
<div class="left"></div>
<!--google-->
<div class="left"><div id="___plusone_0" style="text-indent: 0px; margin: 0px; padding: 0px; border-style: none; float: none; line-height: normal; font-size: 1px; vertical-align: baseline; display: inline-block; width: 90px; height: 20px; background: transparent;"></div></div>

<div class="clear"></div>
<div id="comment">
    	<form id="cmt" action="#" method="post">
        	<table>
            <tr>
                <td><input id="idtin" type="hidden"  value="<?php echo $idTin;?> "/></td>
            </tr>
  <tr>
    <td>Tên</td>
    <td><input id="cmt_name" type="text" size="62" name="txtTen" placeholder="Tên" value="" /></td>
  </tr>
  <tr>
    <td>Nội dung</td>
    <td><textarea id="cmt_content" cols="65" rows="5" placeholder="Viết bình luận của bạn" name="txtND" ></textarea></td>
  </tr>
  <tr>
  	<td></td>
    <td><input class="cmt_submit" type="button" name="post" value="Gửi bình luận" /> </td>
    <div id="tb"></div>
  </tr>
</table>
        </form>
    
</div>
<div id="kq"></div>
<div>
    <?php
	$cmt = DanhSachCmt($idTin);
	while($rowCmt = mysqli_fetch_array($cmt)){
	?>
      <table width="550" border="0">
        <tr>
          <td width="54" rowspan="3"><img src="images/avartar_cmt.jpg" width="50"></td>
          <td style="font: bold 14px ;color: #e32;" id='ten_cmt' width="486"><?php echo $rowCmt["Ten"]?></td>
        </tr>
        <tr>
          <td ><?php echo $rowCmt["NoiDung"]?></td>
        </tr>
        <tr>
          <td><small><?php echo $rowCmt["ThoiGian"]?> <a href="jquery-slider-master/js/XoaCmt.php?idCmt=<?php $rowCmt["idCmt"] ?>&idTin=<?php echo $idTin;?>" id="xoa">Xóa</a></small></td>
        </tr>
      </table>
      
      <?php
	}
	  ?>
    </div>  
<div id="tincungloai">
<div class="clear"></div>
	<ul>
    	<?php
        	$Tincungloai = TinCungLoai($row_tin['idTin'], $row_tin['idLT']);
			while($row_tcl = mysqli_fetch_array($Tincungloai)){
		?>
        <li>       
             <a href="index.php?p=chitiettin&idTin=<?php echo $row_tcl['idTin']?>"><img src="upload/tintuc/<?php echo $row_tcl['urlHinh']?>" alt="<?php echo $row_tcl['TieuDe']?>"></a> <br />
 			 <a class="title" href="index.php?p=chitiettin&idTin=<?php echo $row_tcl['idTin']?>"><?php echo $row_tcl['TieuDe']?></a>
             <span class="no_wrap">   
        </li>
         <?php
			}
		 ?>     
        
    </ul>
</div>
<div class="clear"></div> 

</span>
</body>



