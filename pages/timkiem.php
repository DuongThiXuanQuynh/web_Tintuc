<?php
	$TuKhoa = $_GET["q"];
	$tintheoloai = TimKiem($TuKhoa);
	$kq = mysqli_num_rows($tintheoloai);
	if($kq>0){
		echo $kq." kết quả trả về với từ khóa <b>".$TuKhoa."</b>";
	
	while($row_tintheoloai = mysqli_fetch_array($tintheoloai)){
?>
<div class="box-cat">
	<div class="cat1">
    	
        <div class="clear"></div>
        <div class="cat-content">
        	<div class="col0 col1">
            	<div class="news">
                    <h3 class="title" ><a href="index.php?p=chitiettin&idTin=<?php echo $row_tintheoloai['idTin']?>"><?php echo $row_tintheoloai['TieuDe']?> </a></h3>
                    <img class="images_news" src="upload/tintuc/<?php echo $row_tintheoloai['urlHinh']?>" align="left" />
                    <div class="des"><?php echo $row_tintheoloai['TomTat']?> </div>
                    <div class="clear"></div>
                   
				</div>
            </div>
            
        </div>
    </div>
</div>
<div class="clear"></div>
<!-- box cat-->
<?php
	}
	}
	else {
                echo "Không tìm thấy kết quả!";
            }
?>