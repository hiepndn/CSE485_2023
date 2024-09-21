<?php 
    include ('../config/DBconn.php');
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $category_id = $_POST["txtCatId"];
        $catgory_name = $_POST["txtCatName"];
        if(!empty($category_id) && !empty($catgory_name)){
            $stmt = $conn->prepare("UPDATE theloai SET ten_tloai = ? WHERE ma_tloai = ?");
        if ($stmt === false) {
            die("Lỗi chuẩn bị câu lệnh: " . $conn->error);
        }
        $stmt->bind_param("si", $category_name, $category_id); 
        if ($stmt->execute()) {
            echo "Cập nhật thể loại thành công!";
        } else {
            echo "Lỗi khi thực thi câu lệnh: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Vui lòng nhập đầy đủ thông tin.";
    }
}
     