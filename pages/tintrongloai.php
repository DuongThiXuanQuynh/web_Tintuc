<?php
	$idLT = $_GET["idLT"];
	settype($idLT,"int");
?>
<?php
	$duongdan = DuongDanTin($idLT);
	$row_dd = mysqli_fetch_array($duongdan);
?>
<div>
	<b>Trang chủ</b>>> <?php echo $row_dd['TenTL'] ?> >><?php echo $row_dd['Ten'] ?>
</div>
<?php
	$SoTinMotTrang=6;
	if(isset($_GET["sotrang"])){
		$SoTrang = $_GET["sotrang"];
	}
	else{
		$SoTrang = 1;
	}
	settype($SoTrang,"int");
	$from = ($SoTrang-1)*$SoTinMotTrang;
	$tintheoloai = TinTheoLoai_PhanTrang($idLT,$from, $SoTinMotTrang);
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
?>
<hr/>
<div id="phantrang">
<?php
	$t = TinTheoLoai($idLT);
	$TongSoTin = mysqli_num_rows($t);
	$TongTrang = ceil($TongSoTin/$SoTinMotTrang);
	for($i=1; $i<=$TongTrang; $i++){
?>
	<a href="index.php?p=tintrongloai&idLT=<?php echo $idLT?>&sotrang=<?php echo $i?>"><?php echo $i?></a>
<?php
	}
?>
</div>





