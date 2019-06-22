<?php
	$con=mysqli_connect("localhost","root","","webtintuc");

	$ten=$_POST["ten"];
	$email=$_POST["email"];
	$nd=$_POST["nd"];
	$idTin=$_POST["idTin"];
	$qr = "INSERT INTO comment(hoten, ThoiGian, email, noidung, idTin) VALUES ('$ten',now(),'$email','$nd','$idTin')
		";
		mysqli_query($con, $qr);
		
		var_dump($ten, $email,$nd, $idTin);
		echo $ten;
	/*echo"<li>";
		echo"<img src='../../images/avartar.png' width='48' height='48'/>";
		echo"<div>";
			echo"<b>$ten</b><small>".date('dd/mm/yyyy')."</small>";
			echo"<p> $nd</p>";
			echo"<a href='#'>reply</a>";
		echo"</div>";
	
	echo"</li>";*/	
?>