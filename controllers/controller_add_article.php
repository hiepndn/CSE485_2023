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
        $noidung = $_POST['noidung'];
        $img = $_POST['img'];
        $check_tgia = 0;
        $check_theloai = 0;
            
        if(!empty($title) && !empty($song) && !empty($sumary) && !empty($maTG) && !empty($maTL) && !empty($ngay) && !empty($noidung) && !empty($img)){
            $sql_check_tacgia = "SELECT ma_tgia from tacgia where ma_tgia = " . $maTG;
            $temp_check_tacgia = $conn->query($sql_check_tacgia);
            if($temp_check_tacgia -> num_rows > 0){
                $check_tgia = 1;
            }
            $sql_check_theloai = "SELECT ma_tloai from theloai where ma_tloai = " . $maTL;
            $temp_check_theloai = $conn->query($sql_check_theloai);
            if($temp_check_theloai -> num_rows > 0){    
                $check_theloai = 1;
            }
            
            if($check_tgia == 0 || $check_theloai == 0){
                $message_missing_required = "YÊU CẦU NHẬP MÃ TÁC GIẢ HOẶC MÃ THỂ LOẠI ĐÃ TỒN TẠI";
                $redirectUrl_missing_required = "../views/admin/add_article.php";
                echo "<script type='text/javascript'>alert('$message_missing_required');";
                echo " window.location.href = '$redirectUrl_missing_required';";
                echo "</script>;";
            }
            else{
                $sql="INSERT INTO baiviet(tieude,ten_bhat,ma_tloai,tomtat,noidung,ma_tgia,ngayviet,hinhanh) VALUES(?,?,?,?,?,?,?,?)";
                $temp= $conn->prepare($sql);
                if($temp == false){
                    $message_error_query = "LỖI QUERRY: ";
                    $redirectUrl_error_query = "../views/admin/article.php";
                    // JavaScript code hiển thị pop-up
                    echo "<script type='text/javascript'>alert('$message_error_query" . $conn -> error . "');";
                    echo " window.location.href = '$redirectUrl_error_query';";
                    echo "</script>;";
                }
        
                $temp->bind_param("ssississ", $title,$song,$maTL,$sumary,$noidung,$maTG,$ngay,$img);
        
                if($temp ->execute()){
                    $message_success = "THÊM THÔNG TIN THÀNH CÔNG";
                    $redirectUrl_success = "../views/admin/article.php";
                    echo "<script type='text/javascript'>alert('$message_success');";
                    echo " window.location.href = '$redirectUrl_success';";
                    echo "</script>;";
                }
                else{
                    $message_error_execute = "LỖI EXECUTE: ";
                    $redirectUrl_error_execute = "../views/admin/add_article.php";
                    echo "<script type='text/javascript'>alert('$message_error_execute" . $temp -> error . "');";
                    echo " window.location.href = '$redirectUrl_error_execute';";
                    echo "</script>;";
                }
                $temp -> close();
            }
        }
        else{
            $message_missing_required = "YÊU CẦU NHẬP ĐỦ THÔNG TIN!";
            $redirectUrl_missing_required = "../views/admin/add_article.php";
            echo "<script type='text/javascript'>alert('$message_missing_required');";
            echo " window.location.href = '$redirectUrl_missing_required';";
            echo "</script>;";
        }
    }
?>