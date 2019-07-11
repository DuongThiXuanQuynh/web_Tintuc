
<?php
	$quangcao= QuangCao(1);
	while($row_quangcao=mysqli_fetch_array($quangcao)){
?>
<a href="<?php echo $row_quangcao['Url']?>" target="_blank">
<img width="280" src="upload/quangcao/<?php echo $row_quangcao['urlHinh']?>" /></a>
<div style="height:10px"></div>
<?php
	}
?>