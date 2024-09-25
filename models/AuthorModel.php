<?php
include_once("configs/DBConnection.php");
include_once("models/Author.php");

class AuthorModel {
    private $conn;

    public function __construct() {
        $dbConn = new DBConnection();
        $this->conn = $dbConn->getConnection();
    }

    public function add_author($name, $image) {
        $sql = "INSERT INTO tacgia (ten_tgia, hinh_tgia) VALUES (:name, :image)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':image', $image);
        return $stmt->execute();
    }
    
    public function getAllAuthors() {
        $sql = "SELECT ma_tgia, ten_tgia, hinh_tgia FROM tacgia";
        $stmt = $this->conn->query($sql);
        $authors = [];
        
        while ($row = $stmt->fetch()) {
            $authors[] = new Author($row['ma_tgia'], $row['ten_tgia'], $row['hinh_tgia']);
        }
        
        return $authors;
    }
    public function getAuthorById($id) {
        $sql = "SELECT * FROM tacgia WHERE ma_tgia = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch();
        
        if ($row) {
            return new Author($row['ma_tgia'], $row['ten_tgia'], $row['hinh_tgia']);
        }
        return null; // Trả về null nếu không tìm thấy
    }
    
    public function update_author($id, $name, $image = null) {
        if ($image) {
            $sql = "UPDATE tacgia SET ten_tgia = :name, hinh_tgia = :image WHERE ma_tgia = :id";
        } else {
            $sql = "UPDATE tacgia SET ten_tgia = :name WHERE ma_tgia = :id";
        }
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id', $id);
        
        if ($image) {
            $stmt->bindParam(':image', $image);
        }
        
        return $stmt->execute();
    }
    public function delete_author($author_id) {
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();
    
        $sql = "DELETE FROM tacgia WHERE ma_tgia = :ma_tgia";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ma_tgia', $author_id);
        
        return $stmt->execute();
    }
    
}
?>
