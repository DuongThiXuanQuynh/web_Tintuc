<?php
$idLT = rand(1,27);
?>

<div class="box-cat">
	<div class="cat">
    	<div class="main-cat">
        	<a href="#"><?php echo LayTenLoaiTinTheoid($idLT)?></a>
        </div>
       
        <div class="clear"></div>
        <div class="cat-content">
        	<div class="col1">
            	<?php 
					$mottin= TinMoiNhatTheoLoai_MotTin($idLT);
					$Row_mottin=mysqli_fetch_array($mottin);
				?>
            	<div class="news">
                <h3 class="title" ><a href="index.php?p=chitiettin&idTin=<?php echo $Row_mottin['idTin']?>"><?php echo $Row_mottin['TieuDe']?> </a></h3>
                  <img class="images_news" src="upload/tintuc/<?php echo $Row_mottin['urlHinh']?>" align="left" />
                    <div class="des"><?php echo $Row_mottin['TomTat']?></div>
                  
                  
                    <div class="clear"></div>
                   
				</div>
            </div>
            <div class="col2">
            <?php 
					$namtin= TinMoiNhatTheoLoai_NamTin($idLT);
					while($Row_namtin=mysqli_fetch_array($namtin)){
				?>
           <h3 class="tlq"><a href="index.php?p=chitiettin&idTin=<?php echo $Row_namtin['idTin']?>"><?php echo $Row_namtin['TieuDe']?></a></h3>
            <?php
					}
			?>
           
            </div> 
           
        </div>
    
    </div>

</div>
<div class="clear"></div>




