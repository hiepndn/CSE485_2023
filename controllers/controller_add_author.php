<!--file controll add tác giả -->
<?php  
        include '../config/DBconn.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $author_name = $_POST['txtAuthorName'];
            $authorImg = $_POST['imgAuthor'];
            if (!empty($author_name) && !empty($authorImg)){
                $sql = "INSERT INTO tacgia (ten_tgia, hinh_tgia) VALUES (?,?)";
                $temp = $conn -> prepare($sql);
                if ($temp === false){
                    error_log("lỗi rồi" . $conn -> error);
                    die ("lỗi lòi");
                }
                $temp->bind_param("ss",$author_name,$authorImg);
                if ($temp -> execute()){
                    header('Location: ../views/admin/author.php');
                    exit();
                }
                else{
                    echo "lỗi rồi má " . $temp->error;
                }
                $temp -> close();
            }
            else{
                echo "nhập đủ trường đi bà già" ;
            } 
        }
?>