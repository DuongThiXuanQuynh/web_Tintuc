<div id="slide-left">
			<?php 
				$tinmoinhat_mottin=TinMoiNhat_MotTin();
				$rowtinmoinhat_mottin=mysqli_fetch_array($tinmoinhat_mottin);			
			?>
        	<div id="slideleft-main">
                <img src="upload/tintuc/<?php echo $rowtinmoinhat_mottin['urlHinh']?>"  /><br />
                <h2 class="title"><a href="index.php?p=chitiettin&idTin=<?php echo $rowtinmoinhat_mottin['idTin']?>"><?php echo $rowtinmoinhat_mottin['TieuDe']?></a> </h2>
                <div class="des">
                    <?php echo $rowtinmoinhat_mottin['TomTat']?> 
                </div>
            	<!--<p class="tlq"><a href="#">Hàng trăm chuyến bay bị hủy vì Trung Quốc tập trận</a></p> -->               
        	</div>
            <div id="slideleft-scroll">
            	
              <div class="content_scoller width_common">
            <ul>
            	<?php
                	$NamTinMoi=TinMoiNhat_NamTin();
					while($Row_Namtinmoi=mysqli_fetch_array($NamTinMoi)){
				?>
               <li>
                <div class="title_news">
               		<a href="index.php?p=chitiettin&idTin=<?php echo $Row_Namtinmoi['idTin']?> " class="txt_link"> <?php echo $Row_Namtinmoi['TieuDe']?> </a> 
                </div>
              </li>
              <?php
					}
			  ?>
          
            </ul>
            </div>			
            
			<div id="gocnhin">
                <img alt="" src="http://web_Tintuc/images/logoKhoaPham.png" width="100%"></a>
                <div class="title_news"></div>
            </div>
                
            </div>
</div>

     