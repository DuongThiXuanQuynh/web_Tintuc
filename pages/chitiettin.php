<?php 
	if(isset($_GET["idTin"])){
		$idTin = $_GET["idTin"];
	}
	else $idTin = 1;
	CapNhatSoLanXemTin($idTin);
	$tin = ChiTietTin($idTin);
	$row_tin = mysqli_fetch_array($tin);
	
	$loi=array();
	$loi["ten"]=$loi["email"]=$loi["nd"]=NULL;
	$ten=$email=$nd=NULL;
	if(isset($_POST["post"])){
		//kt co nhap ten chua
		if(empty($_POST["txtTen"])){
			$loi["ten"]="Xin vui lòng nhập tên";
		}else{
			$ten=$_POST["txtTen"];
		}
		//kt co nhap email chua
		if(empty($_POST["txtEmail"])){
			$loi["email"]="Xin vui lòng nhập email";
		}else{
			$email=$_POST["txtEmail"];
		}
		//ktco nhap  nd chua
		if(empty($_POST["txtND"])){
			$loi["nd"]="Xin vui lòng nhập nội dung";
		}else{
			$nd=$_POST["txtND"];
		}
		if($ten && $email && $nd){
		$binhluan= ThemBinhLuan($ten,$email,$nd,$idTin);
		echo "<script type ='text/javascript'>";
		echo "alert('Bình luận của bạn đã được gửi thành công')";
		echo"</script>";
		}
	}
?>
	
<h1 class="title"><?php echo $row_tin['TieuDe']?></h1>
<div class="des">
	<?php echo $row_tin['TomTat']?>
</div>
<div class="chitiet">
	<?php echo $row_tin['Content']?>
</div>
<div class="clear"></div>
<a class="btn_quantam" id="vne-like-anchor-1000000-3023795" href="#" total-like="21"></a>
<div class="number_count"><span id="like-total-1000000-3023795"><?php echo $row_tin['SoLanXem']?></span></div>
<!--face-->
<div class="left"><div class="fb-like fb_iframe_widget" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true" data-href="http://vnexpress.net/tin-tuc/the-gioi/ukraine-gianh-kiem-soat-nhieu-khu-vuc-gan-hien-truong-mh17-3023795.html" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=&amp;href=http%3A%2F%2Fvnexpress.net%2Ftin-tuc%2Fthe-gioi%2Fukraine-gianh-kiem-soat-nhieu-khu-vuc-gan-hien-truong-mh17-3023795.html&amp;layout=button_count&amp;locale=en_US&amp;sdk=joey&amp;send=false&amp;show_faces=true&amp;width=450"></div></div>
<!--twister-->
<div class="left"></div>
<!--google-->
<div class="left"><div id="___plusone_0" style="text-indent: 0px; margin: 0px; padding: 0px; border-style: none; float: none; line-height: normal; font-size: 1px; vertical-align: baseline; display: inline-block; width: 90px; height: 20px; background: transparent;"></div></div>

<div class="clear"></div>
<?php var_dump($ten, $email,$nd, $idTin)?>
<div id="comment">
	<fieldset>
    <legend>Comment </legend>
    	<form action="index.php?p=chitiettin&idTin=<?php echo $row_tin['idTin']?>" method="post">
        	<table>
  <tr>
    <td>Tên</td>
    <td><input type="text" size="25" name="txtTen" value="<?php echo $loi["ten"]?>"/></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><input type="text" size="25" name="txtEmail" value="<?php echo $loi["email"]?>"/></td>
  </tr>
  <tr>
    <td>Nội dung</td>
    <td><textarea cols="60" rows="5" name="txtND"><?php echo $loi["nd"]?></textarea></td>
  </tr>
  <tr>
  	<td></td>
    <td><input type="submit" name="post" value="Gửi" />
    </td>
    
  </tr>
</table>

        </form>
    </fieldset>
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





