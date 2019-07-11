<?php
//Quản lý thể loại
function DanhSachTheLoai(){
	include "dbCon.php";
	$qr = "select * from theloai order by idTL desc"; 
	return mysqli_query($con,$qr);	
}

function ChiTietTheLoai($idTL){
	include "dbCon.php";
	$qr = "select * from theloai where idTL='$idTL'";
	$row =  mysqli_query($con,$qr);
	return mysqli_fetch_array($row);
}
//Quản lý loại tin
function DanhSachLoaiTin(){
	include "dbCon.php";	
	$qr = "select * from theloai tl, loaitin lt where tl.idTL=lt.idTL order by idLT desc"; 
	return mysqli_query($con,$qr);	
}
function DanhSachLoaiTinTheoTheLoai($idTL){
	include "dbCon.php";	
	$qr = "select * from loaitin lt where idTL='$idTL' order by idLT desc"; 
	return mysqli_query($con,$qr);	
}
function ChiTietLoaiTin($idLT){
	include "dbCon.php";
	$qr = "select * from loaitin where idLT='$idLT'";
	$row =  mysqli_query($con,$qr);
	return mysqli_fetch_array($row);
}

//Quản lý tin
function DanhSachTin_PhanTrang($from,$limit){
	include "dbCon.php";
	$qr="select * from tin t, theloai tl, loaitin lt where t.idLT=lt.idLT and lt.idTL=tl.idTL order by idTin desc limit $from, $limit";	
	return mysqli_query($con,$qr);
}
function DanhSachTin_ThongKe(){
	include "dbCon.php";
	$qr="select tl.idTL, TenTL, count(DISTINCT t.idLT) as count_LT, count(DISTINCT idTin) as count_tin from tin t, theloai tl, loaitin lt where t.idLT=lt.idLT and lt.idTL=tl.idTL group by tl.idTL order by tl.idTL ";	
	return mysqli_query($con,$qr);
}
function DanhSachTin(){
	include "dbCon.php";
	$qr="select * from tin";	
	return mysqli_query($con,$qr);
}
function ChiTietTin($idTin){
	include "dbCon.php";
	$qr = "select * from tin where idTin='$idTin'";
	$row =  mysqli_query($con,$qr);
	return mysqli_fetch_array($row);
}
//Quản lý quảng cáo
function DanhSachQuangCao(){
	include "dbCon.php";
	$qr="select * from quangcao order by idQC desc ";	
	return mysqli_query($con,$qr);
}
function ChiTietQuangCao($idQC){
	include "dbCon.php";
	$qr = "select * from quangcao where idQC='$idQC'";
	$row =  mysqli_query($con,$qr);
	return mysqli_fetch_array($row);
}
//Quản lý bình luận
function DanhSachBinhLuan(){
	include "dbCon.php";
	$qr="select * from comment order by idCmt desc ";	
	return mysqli_query($con,$qr);
}
function ChiTietBinhLuan($idCmt){
	include "dbCon.php";
	$qr = "select * from comment where idCmt='$idCmt'";
	$row =  mysqli_query($con,$qr);
	return mysqli_fetch_array($row);
}
function ThongTinUser($idUser){
	include "dbCon.php";
	$qr = "select * from users where idUser='$idUser'";
	return mysqli_query($con,$qr);
}
function DanhSachTaiKhoan(){
	include "dbCon.php";
	$qr="select * from users order by idUser desc ";	
	return mysqli_query($con,$qr);
}
function stripUnicode($str){
  if(!$str) return false;
   $unicode = array(
      'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
	  'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ậ|Ẫ',
      'd'=>'đ',
	  'D'=>'Đ',
      'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
	  'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
      'i'=>'í|ì|ỉ|ĩ|ị',
	  'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
      'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
	  'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
      'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
	  'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
      'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
	  'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
   );
foreach($unicode as $khongdau=>$codau){ $arr = explode("|",$codau);
	$str= str_replace($arr,$khongdau,$str);
}
return $str;
}

function changeTitle($str){
	$str= trim($str);
	if($str=="") 
		return "";
	$str = str_replace('"','',$str);
	$str = str_replace("'",'',$str);
	$str  = stripUnicode($str );
	$str = mb_convert_case($str,MB_CASE_TITLE,'utf-8');
	//MB_CASE_UPPER/ MB_CASE_TITLE/ MB_CASE_LOWER
	$str = str_replace(' ','-',$str);
	return $str;
}
?>
