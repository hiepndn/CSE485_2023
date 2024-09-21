<?php 
    <?php
    include('../config/DBconn.php');
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $category_id = $_POST['txtCatId'];
    
        // Kiểm tra xem ID có hợp lệ hay không
        if (!empty($category_id)) {
            $sql = "DELETE FROM theloai WHERE ma_tloai = ?";
            $stmt = $conn->prepare($sql);
    
            if ($stmt) {
                $stmt->bind_param("i", $category_id);
    
                if ($stmt->execute()) {
                    // Xóa thành công
                    header("Location: ../views/admin/category.php");
                    exit();
                } else {
                    echo "Lỗi khi xóa thể loại: " . $stmt->error;
                }
    
                $stmt->close();
            } else {
                echo "Lỗi chuẩn bị câu lệnh: " . $conn->error;
            }
        } else {
            echo "ID thể loại không hợp lệ.";
        }
    }
    
    $conn->close();
    ?>
?>