<?php
$idUser = $_GET['idUser'];
settype($idUser,"int");
require "../../lb/quantri.php";
require "../../lb/dbCon.php";
// Xử lý các giả trị
    $Username = trim(htmlspecialchars(addslashes($_POST['Username'])));
    $HoTen = trim(htmlspecialchars(addslashes($_POST['HoTen'])));
    $GioiTinh = trim(htmlspecialchars(addslashes($_POST['GioiTinh'])));
    $Dienthoai = trim(htmlspecialchars(addslashes($_POST['DienThoai'])));
    $NgaySinh = trim(htmlspecialchars(addslashes($_POST['NgaySinh'])));
    $DiaChi = trim(htmlspecialchars(addslashes($_POST['DiaChi'])));
    $Email = trim(htmlspecialchars(addslashes($_POST['Email'])));
 
    // Các biến xử lý thông báo
    $show_alert = '<script>$("#formSua .alert").removeClass("hidden");</script>';
    $hide_alert = '<script>$("#formSua .alert").addClass("hidden");</script>';
    $success = '<script>$("#formSua .alert").attr("class", "alert alert-success");</script>';
 
    if ($Username && $Email && $Dienthoai) {
        // Kiểm tra tên hiển thị
        if (strlen($Username) < 3 || strlen($Username) > 50) {
            echo $show_alert.'Tên hiển thị phải nằm trong khoảng từ 3-50 ký tự.';
        // Kiểm tra email   
        } else if (filter_var($Email, FILTER_VALIDATE_EMAIL) === FALSE) {
            echo $show_alert.'Email không hợp lệ.';
        // Kiểm tra số điện thoại
        } else if ($Dienthoai && (strlen($Dienthoai) < 10 || strlen($Dienthoai) > 11 || preg_match('/^[0-9]+$/', $Dienthoai) == false)) {
            echo $show_alert.strlen($Dienthoai) . 'Số điện thoại không hợp lệ.';
        } else {
            $qr = "update users set Username='$Username',HoTen='$HoTen', GioiTinh='$GioiTinh', Dienthoai='$Dienthoai', NgaySinh='$NgaySinh', DiaChi='$DiaChi',Email='$Email' where idUser='$idUser'";
			mysqli_query($con,$qr);
			echo $success.'Cập nhật thông tin thành công.';
			header("location:profile.php?idUser=".$idUser);	
            }
    } else {
        echo $show_alert.'Vui lòng điền đầy đủ thông tin.';
    }
?>