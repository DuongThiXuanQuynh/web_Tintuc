<div class="box-cat">
	<div class="cat">
    	<div class="main-cat">
        	<a href="#">Tin xem nhiều</a>
        </div>
       
        <div class="clear"></div>
        <div class="cat-content">
        	<?php
            	$TinXemNhieu=TinXemNhieu();
				while($Row_Tinxemnhieu=mysqli_fetch_array($TinXemNhieu)){
			?>
            <div class="col1">
            	<div class="news">
                  <img class="images_news" src="upload/tintuc/<?php echo $Row_Tinxemnhieu['urlHinh']?>"  />
                    <h3 class="title" ><a href="index.php?p=chitiettin&idTin=<?php echo $Row_Tinxemnhieu['idTin']?>"><?php echo $Row_Tinxemnhieu['TieuDe']?></a><span class="hit"><?php echo $Row_Tinxemnhieu['SoLanXem']?></span></h3>
                    <div class="clear"></div>
				</div>
            </div>
            <?php 
				}
			?>
        
        </div>
    </div>
</div>
<div class="clear"></div>

