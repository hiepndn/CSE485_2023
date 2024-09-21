<!-- sửa bài viết -->
 <!--thêm bài viết -->
<?php 
        include '../config/DBconn.php';
       if($_SERVER['REQUEST_METHOD']=='POST'){
            $title = $_POST['tieude'];
            $song = $_POST['bhat'];
            $sumary =$_POST['tomtat'];
            $maTG =$_POST['tacgia'];
            $maTL =$_POST['theloai'];
            $ngay =$_POST['ngay'];
            $id =$_POST['bviet'];
            if(!empty($title) && !empty($song) && !empty($sumary) && !empty($maTG) && !empty($maTL) && !empty($ngay)){
                $sql="UPDATE baiviet SET tieude = ?,ten_bhat =?, ma_tloai=?,tomtat =?, ma_tgia= ?, ngayviet=? 
                        WHERE ma_bviet =? ";
                $temp= $conn->prepare($sql);
                if($temp == false){
                    die("lỗi là: ".$conn->error);
                }
                $temp->bind_param("ssisisi", $title,$song,$maTL,$sumary,$maTG,$ngay,$id);
                if($temp ->execute()){
                    header('Location: ../views/admin/article.php');
                    exit();
                }
                else{
                    echo "hiep".$temp->error;
                }
                
            }
            else{
                echo "ko nhập đủ trường dữ liệu";
            }

       }
    ?>
