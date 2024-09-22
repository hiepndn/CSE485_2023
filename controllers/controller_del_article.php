<?php
    include '../config/DBconn.php';

    $id = $_GET['id'];
    
    $sql = "DELETE from baiviet WHERE ma_bviet = ?";
    $temp = $conn -> prepare($sql);
    if($temp === false){
        $message_error_query = "LỖI QUERRY: ";
        $redirectUrl_error_query = "../views/admin/article.php";
        // JavaScript code hiển thị pop-up
        echo "<script type='text/javascript'>alert('$message_error_query" . $conn -> error . "');";
        echo " window.location.href = '$redirectUrl_error_query';";
        echo "</script>;";
    }

    $temp -> bind_param("i",$id);

    if ($temp -> execute()){
        $message_success = "XÓA THÔNG TIN THÀNH CÔNG";
        $redirectUrl_success = "../views/admin/article.php";
        echo "<script type='text/javascript'>alert('$message_success');";
        echo " window.location.href = '$redirectUrl_success';";
        echo "</script>;";
    }
    else{
        $message_error_execute = "LỖI EXECUTE: ";
        $redirectUrl_error_execute = "../views/admin/article.php?id=".$id;
        echo "<script type='text/javascript'>alert('$message_error_execute" . $temp -> error . "');";
        echo " window.location.href = '$redirectUrl_error_execute';";
        echo "</script>;";
    }
    $temp -> close();        
?>