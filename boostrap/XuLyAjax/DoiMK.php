<?php
$idUser = $_GET['idUser'];
settype($idUser,"int");

require "../../lb/quantri.php";
require "../../lb/dbCon.php";
$user = ThongTinUser($idUser);
$data_user = mysqli_fetch_array($user);
	$MK_cu = md5($_POST['MK_cu']);
    $MK_moi = trim(htmlspecialchars(addslashes($_POST['MK_moi'])));
    $MK_moi2 = trim(htmlspecialchars(addslashes($_POST['MK_moi2'])));
 
    // Các biến xử lý thông báo
    $show_alert = '<script>$("#DoiMK .alert").removeClass("hidden");</script>';
    $hide_alert = '<script>$("#DoiMK .alert").addClass("hidden");</script>';
    $success = '<script>$("#DoiMK .alert").attr("class", "alert alert-success");</script>';
 
    if ($MK_cu && $MK_moi && $MK_moi2) {
        // Kiểm tra mật khẩu cũ chính xác
        if ($MK_cu != $data_user['Password']) {
            echo $show_alert.'Mật khẩu cũ không chính xác.';
        // Kiểm tra mật khẩu mới    
        } else if (strlen($MK_moi) < 6) {
            echo $show_alert.'Mật khẩu mới quá ngắn.';
        // Kiểm tra mật khẩu mới khớp với mật khẩu mới nhập lại 
        } else if ($MK_moi != $MK_moi2) {
            echo $show_alert.'Mật khẩu mới nhập lại không khớp.';
        } else {
            $MK_moi = md5($MK_moi);
            $sql_DoiMK= "UPDATE users SET Password = '$MK_moi' WHERE idUser = '$idUser'";
            mysqli_query($con,$sql_DoiMK);
            echo $success.'Thay đổi mật khẩu thành công.';
			header("location:profile.php?idUser=".$idUser);	        }
    } else {
        echo $show_alert.'Vui lòng điền đầy đủ thông tin.';
    }
?>