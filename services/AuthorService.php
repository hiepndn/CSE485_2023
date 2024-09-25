<?php
include("configs/DBConnection.php");
include("models/Author.php");
class AuthorService{
    public function getAllAuthors(){
        // 4 bước thực hiện
       $dbConn = new DBConnection();
       $conn = $dbConn->getConnection();

        // B2. Truy vấn
        $sql = "SELECT * FROM baiviet INNER JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia";
        $stmt = $conn->query($sql);

        // B3. Xử lý kết quả
        $authors = [];
        while($row = $stmt->fetch()){
            $author = new Author($row['ma_tgia'],$row['ten_tgia'],  $row['hinh_tgia']);
            array_push($authors,$author);
        }
        $authorModel = new AuthorModel();
        return $authorModel->getAllAuthors();
        // Mảng (danh sách) các đối tượng Article Model

        return $authors;
    }
    public function checkHasArticles($author_id) {
        $dbConn = new DBConnection(); // Khởi tạo đối tượng DBConnection
        $conn = $dbConn->getConnection(); // Lấy kết nối

        $sql = "SELECT * FROM baiviet WHERE ma_tgia = :author_id"; // Sử dụng placeholder
        $stmt = $conn->prepare($sql); // Sử dụng PDO prepare
        $stmt->bindParam(':author_id', $author_id, PDO::PARAM_INT); // Sử dụng bindParam với PDO

        $stmt->execute();
        $result = $stmt->fetchAll(); // Lấy tất cả kết quả

        return count($result) > 0; // Trả về true nếu có bài viết
    }
}
?>