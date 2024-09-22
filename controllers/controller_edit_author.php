<!--file controll edit tác giả -->

<?php 
    include '../config/DBconn.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $author_name = $_POST['txtAuthorName'];
        $authorImg = $_POST['imgAuthor'];
        $id = $_POST['txtAuthorId'];
        if (!empty($author_name) && !empty($authorImg)){
            $sql = "UPDATE tacgia SET ten_tgia = ?, hinh_tgia = ? where ma_tgia = ?";
            $temp = $conn -> prepare($sql);
            if ($temp === false){
                $message_error_query = "LỖI QUERRY: ";
                $redirectUrl_error_query = "../views/admin/author.php";
                // JavaScript code hiển thị pop-up
                echo "<script type='text/javascript'>alert('$message_error_query" . $conn -> error . "');";
                echo " window.location.href = '$redirectUrl_error_query';";
                echo "</script>;";
            }

            $temp->bind_param("ssi",$author_name,$authorImg,$id);
            
            if ($temp -> execute()){
                $message_success = "CHỈNH SỬA THÔNG TIN THÀNH CÔNG";
                $redirectUrl_success = "../views/admin/author.php";
                echo "<script type='text/javascript'>alert('$message_success');";
                echo " window.location.href = '$redirectUrl_success';";
                echo "</script>;";
            }
            else{
                $message_error_execute = "LỖI EXECUTE: ";
                $redirectUrl_error_execute = "../views/admin/edit_author.php?id=".$id;
                echo "<script type='text/javascript'>alert('$message_error_execute" . $temp -> error . "');";
                echo " window.location.href = '$redirectUrl_error_execute';";
                echo "</script>;";
            }
            $temp -> close();
        }
        else{
            $message_missing_required = "YÊU CẦU NHẬP ĐỦ THÔNG TIN!";
            $redirectUrl_missing_required = "../views/admin/edit_author.php?id=".$id;
            echo "<script type='text/javascript'>alert('$message_missing_required');";
            echo " window.location.href = '$redirectUrl_missing_required';";
            echo "</script>;";
        } 
    }
?>