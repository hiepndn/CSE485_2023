<?php
include("configs/DBConnection.php");
include("models/Category.php");

class CategoryService {
    public function getAllCategorys() {
        
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();
        $sql = "SELECT * FROM theloai ";
        $stmt = $conn->query($sql);
        $categorys = [];
        while($row = $stmt->fetch()) {
            $category = new Category($row['ma_tloai'], $row['ten_tloai']);
            array_push($categorys, $category);
        }
        return $categorys;
    }

    public function addCategory($ten_tloai) {
        $db = new DBConnection();
        $conn = $db->getConnection();
    
        // Lấy giá trị ma_tloai lớn nhất hiện tại
        $sql_get_max_id = "SELECT MAX(ma_tloai) AS max_id FROM theloai";
        $stmt = $conn->prepare($sql_get_max_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $maxId = $result['max_id'] ?? 0;
    
        // Tạo mã thể loại mới
        $newId = $maxId + 1;
    
        // Sử dụng prepared statement để thêm dữ liệu
        $sql = "INSERT INTO theloai (ma_tloai, ten_tloai) VALUES (:ma_tloai, :ten_tloai)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ma_tloai', $newId);
        $stmt->bindParam(':ten_tloai', $ten_tloai);
    
        // Kiểm tra và trả về kết quả
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    


    // Lấy thể loại theo ID
    public function getCategoryById($id) {
        try {
            $db = new DbConnection();
            $conn = $db->getConnection();

            $sql = "SELECT ma_tloai, ten_tloai FROM theloai WHERE ma_tloai = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Lỗi truy vấn: " . $e->getMessage());
        }
    }

    // Cập nhật thể loại
    public function updateCategory($id, $name) {
        try {
            $db = new DbConnection(); // Kết nối PDO
            $conn = $db->getConnection();

            $sql = "UPDATE theloai SET ten_tloai = :name WHERE ma_tloai = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Lỗi cập nhật: " . $e->getMessage());
        }
    }
    // Kiểm tra xem thể loại có bài viết không
    public function hasArticles($id) {
        $sql_check = "SELECT * FROM baiviet WHERE ma_tloai = ?";
        $stmt = $this->conn->prepare($sql_check);
        stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
}

    // Xóa thể loại
    public function deleteCategory($id) {
        $sql = "DELETE FROM theloai WHERE ma_tloai = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
}
}

?>