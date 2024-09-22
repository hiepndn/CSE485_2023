<!-- sửa bài viết -->
 <!--thêm bài viết -->
<?php 
    include '../config/DBconn.php';
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $title = $_POST['tieude'];
        $song = $_POST['bhat'];
        $sumary = $_POST['tomtat'];
        $maTG = $_POST['tacgia'];
        $maTL = $_POST['theloai'];
        $ngay = $_POST['ngay'];
        $id = $_POST['bviet'];
        $img = $_POST['img'];
        $noidung = $_POST['noidung'];
        if(!empty($title) && !empty($song) && !empty($sumary) && !empty($maTG) && !empty($maTL) && !empty($ngay) && !empty($img) && !empty($noidung)){
            $sql="UPDATE baiviet SET tieude=?, ten_bhat=?, ma_tloai=?, tomtat=?, noidung=?, ma_tgia=?, ngayviet=?, hinhanh=?  
                  WHERE ma_bviet=? ";
            $temp= $conn->prepare($sql);
            if($temp == false){
                $message_error_query = "LỖI QUERRY: ";
                $redirectUrl_error_query = "../views/admin/article.php";
                // JavaScript code hiển thị pop-up
                echo "<script type='text/javascript'>alert('$message_error_query" . $conn -> error . "');";
                echo " window.location.href = '$redirectUrl_error_query';";
                echo "</script>;";
            }

            $temp->bind_param("ssississi", $title,$song,$maTL,$sumary,$noidung,$maTG,$ngay,$img,$id);

            if($temp ->execute()){
                $message_success = "CHỈNH SỬA THÔNG TIN THÀNH CÔNG";
                $redirectUrl_success = "../views/admin/article.php";
                echo "<script type='text/javascript'>alert('$message_success');";
                echo " window.location.href = '$redirectUrl_success';";
                echo "</script>;";
            }
            else{
                $message_error_execute = "LỖI EXECUTE: ";
                $redirectUrl_error_execute = "../views/admin/edit_article.php?id=".$id;
                echo "<script type='text/javascript'>alert('$message_error_execute" . $temp -> error . "');";
                echo " window.location.href = '$redirectUrl_error_execute';";
                echo "</script>;";
            }  
        }
        else{
            $message_missing_required = "YÊU CẦU NHẬP ĐỦ THÔNG TIN!";
            $redirectUrl_missing_required = "../views/admin/edit_article.php?id=".$id;
            echo "<script type='text/javascript'>alert('$message_missing_required');";
            echo " window.location.href = '$redirectUrl_missing_required';";
            echo "</script>;";
        }
    }
?>
