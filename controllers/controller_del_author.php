<?php 
    include '../config/DBconn.php';
    $id = $_GET['id'];
    $sql_check = "SELECT * from baiviet where ma_tgia = " . $id;
    $result = $conn -> query($sql_check);
    if ($result -> num_rows != 0){
        $message_error_constraint = "VUI LÒNG XÓA BÀI VIẾT CÓ MÃ TÁC GIẢ LÀ " . $id . " RỒI MỚI ĐƯỢC XÓA TÁC GIẢ NÀY";
        $redirectUrl_error_constraint = "../views/admin/article.php";
        // JavaScript code hiển thị pop-up
        echo "<script type='text/javascript'>alert('$message_error_constraint');";
        echo " window.location.href = '$redirectUrl_error_constraint';";
        echo "</script>;";
    }
    else{
        $sql = "DELETE from tacgia WHERE ma_tgia = ?";
        $temp = $conn -> prepare($sql);
        if($temp === false){
            $message_error_query = "LỖI QUERRY: ";
            $redirectUrl_error_query = "../views/admin/author.php";
            // JavaScript code hiển thị pop-up
            echo "<script type='text/javascript'>alert('$message_error_query" . $conn -> error . "');";
            echo " window.location.href = '$redirectUrl_error_query';";
            echo "</script>;";
        }

        $temp -> bind_param("i",$id);
        
        if ($temp -> execute()){
            $message_success = "XÓA THÔNG TIN THÀNH CÔNG";
            $redirectUrl_success = "../views/admin/author.php";
            echo "<script type='text/javascript'>alert('$message_success');";
            echo " window.location.href = '$redirectUrl_success';";
            echo "</script>;";
        }
        else{
            $message_error_execute = "LỖI EXECUTE: ";
            $redirectUrl_error_execute = "../views/admin/author.php?id=".$id;
            echo "<script type='text/javascript'>alert('$message_error_execute" . $temp -> error . "');";
            echo " window.location.href = '$redirectUrl_error_execute';";
            echo "</script>;";
        }
        $temp -> close();
    }
?>

