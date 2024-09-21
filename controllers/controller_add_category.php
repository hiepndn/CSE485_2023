<!--file controll thể loại -->
<?php  
        include '../config/DBconn.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $category_name = $_POST['txtCatName'];
            if (!empty($category_name)) {
                $stmt = $conn->prepare("INSERT INTO theloai (ten_tloai) VALUES (?)");
                if ($stmt === false) {
                    die("Lỗi trong quá trình chuẩn bị câu lệnh: " . $conn->error);
                }
                $stmt->bind_param("s", $category_name);
                if ($stmt->execute()) {
                    header('Location: ../views/admin/category.php');
                    exit();
                } else {
                    echo "Lỗi khi thực thi câu lệnh: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Vui lòng nhập tên thể loại.";
            }
        }
        
    ?>

