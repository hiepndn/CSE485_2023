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
            
            if(!empty($title) && !empty($song) && !empty($sumary) && !empty($maTG) && !empty($maTL) && !empty($ngay)){
                $sql="INSERT INTO baiviet(tieude,ten_bhat,ma_tloai,tomtat,ma_tgia,ngayviet) VALUES(?,?,?,?,?,?)";
                $temp= $conn->prepare($sql);
                if($temp == false){
                    die("lỗi là: ".$conn->error);
                }
                $temp->bind_param("ssisis", $title,$song,$maTL,$sumary,$maTG,$ngay);
                if($temp ->execute()){
                    header('Location: ../views/admin/article.php');
                    exit();
                }
                else{
                    echo "hiep".$temp->error;
                }
                
            }
            else{
                echo "noooooo";
            }

       }
    ?>