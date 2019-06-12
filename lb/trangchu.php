<?php
	function TinMoiNhat_MotTin(){
		$con=mysqli_connect("localhost","root","","webtintuc");
		mysqli_set_charset($con, 'UTF8');
		return mysqli_query($con,"select * from tin order by idTin desc limit 0,1  ");	
	}
	
	function TinMoiNhat_NamTin(){
		$con=mysqli_connect("localhost","root","","webtintuc");
		mysqli_set_charset($con, 'UTF8');
		return mysqli_query($con,"select * from tin order by idTin desc limit 1,5  ");	
	}
	function TinXemNhieu(){
		$con=mysqli_connect("localhost","root","","webtintuc");
		mysqli_set_charset($con, 'UTF8');
		return mysqli_query($con,"select * from tin order by SoLanXem desc limit 0,4  ");	
	}
	function TinMoiNhatTheoLoai_MotTin($idLT){
		$con=mysqli_connect("localhost","root","","webtintuc");
		mysqli_set_charset($con, 'UTF8');
		return mysqli_query($con,"select * from tin where idLT= $idLT order by idTin desc limit 0,1  ");	
	}
	
	function TinMoiNhatTheoLoai_NamTin($idLT){
		$con=mysqli_connect("localhost","root","","webtintuc");
		mysqli_set_charset($con, 'UTF8');
		return mysqli_query($con,"select * from tin where idLT= $idLT order by idTin desc limit 1,5  ");	
	}
	function TinMoiNhatTheoLoai_BaTin($idLT){
		$con=mysqli_connect("localhost","root","","webtintuc");
		mysqli_set_charset($con, 'UTF8');
		return mysqli_query($con,"select * from tin where idLT= $idLT order by idTin desc limit 1,3  ");	
	}
	
	function LayTenLoaiTinTheoid($idLT){
		$con=mysqli_connect("localhost","root","","webtintuc");
		mysqli_set_charset($con, 'UTF8');
		$qr="select Ten from LoaiTin where idLT=$idLT";
		$TenLT=mysqli_query($con,$qr);
		$Row_TenLT=mysqli_fetch_array($TenLT);
		return $Row_TenLT['Ten'];
		}
	function QuangCao($Vitri){
		$con=mysqli_connect("localhost","root","","webtintuc");
		mysqli_set_charset($con, 'UTF8');
		$qr="select * from quangcao where vitri = $Vitri";
		return mysqli_query($con,$qr);
			}
	function DanhSachTheLoai(){
		$con=mysqli_connect("localhost","root","","webtintuc");
		mysqli_set_charset($con, 'UTF8');
		$qr="select* from theloai";
		return mysqli_query($con,$qr);
		}
	function DanhSachLoaiTin($idTL){
		$con=mysqli_connect("localhost","root","","webtintuc");
		mysqli_set_charset($con, 'UTF8');
		$qr="select* from loaitin where idTL = $idTL";
		return mysqli_query($con,$qr);
		}
	function TinTheoLoai($idLT){
		$con=mysqli_connect("localhost","root","","webtintuc");
		mysqli_set_charset($con, 'UTF8');
		$qr="select* from tin where idLT = $idLT order by idTin desc";
		return mysqli_query($con,$qr);
		}
	function TinTheoLoai_PhanTrang($idLT,$from, $SoTinMotTrang){
		$con=mysqli_connect("localhost","root","","webtintuc");
		mysqli_set_charset($con, 'UTF8');
		$qr="select* from tin where idLT = $idLT order by idTin desc limit $from, $SoTinMotTrang";
		return mysqli_query($con,$qr);
		}
	function DuongDanTin($idLT){
		$con=mysqli_connect("localhost","root","","webtintuc");
		mysqli_set_charset($con, 'UTF8');
		$qr="select TenTL, Ten from theloai, loaitin where theloai.idTL=loaitin.idTL and idLT=$idLT
";
		return mysqli_query($con,$qr);
		}
	function ChiTietTin($idTin){
		$con=mysqli_connect("localhost","root","","webtintuc");
		mysqli_set_charset($con, 'UTF8');
		$qr="select * from tin where idTin=$idTin";
		return mysqli_query($con,$qr);
		}
	function TinCungLoai($idTin, $idLT){
		$con=mysqli_connect("localhost","root","","webtintuc");
		mysqli_set_charset($con, 'UTF8');
		$qr="select * from tin 
			where idTin <> $idTin and idLT=$idLT 
			order by idTin desc 
			limit 0,3";
		return mysqli_query($con,$qr);
		}
	function CapNhatSoLanXemTin($idTin){
		$con=mysqli_connect("localhost","root","","webtintuc");
		$qr=" update Tin
				set SoLanXem = SoLanXem +1
				where idTin = $idTin";	
		mysqli_query($con, $qr);
	}
	function TimKiem($TuKhoa){
		$con=mysqli_connect("localhost","root","","webtintuc");
		mysqli_set_charset($con, 'UTF8');
		$qr = " select * from tin
		where TieuDe regexp '$TuKhoa'
		order by idTin desc
		";
		return mysqli_query($con, $qr);
	}
	function ThemBinhLuan($ten,$email,$nd,$idTin){
		$con=mysqli_connect("localhost","root","","webtintuc");
		mysqli_set_charset($con, 'UTF8');
		$qr = " INSERT INTO comment(hoten, ThoiGian, email, noidung, idTin) VALUES ('$ten',now(),'$email','$nd','$idTin')
		";
		return mysqli_query($con, $qr);
	}
?>