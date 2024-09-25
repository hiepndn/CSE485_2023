<?php
include("services/AuthorService.php");
include("models/AuthorModel.php");

class AuthorController {
    private $authorService;

    public function __construct() {
        $this->authorService = new AuthorService();
    }

    public function index() {
        $authors = $this->authorService->getAllAuthors();
        include("views/author/index.php");
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $author_name = $_POST['txtAuthorName'];
            $authorImg = $_FILES['imgAuthor']['name'];

            // Di chuyển file đến thư mục uploads
            $authorModel = new AuthorModel();
            if ($authorModel->add_author($author_name, $authorImg)) {
                header("Location: index.php?controller=author&action=index");
            } else {
                $msg = "Thêm tác giả không thành công";
                include("views/author/add_author.php");
            }
        } else {
            include("views/author/add_author.php");
        }
    }
    public function edit() {
    $authorModel = new AuthorModel();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Process the form submission
        $author_id = $_POST['txtAuthorId'];
        $author_name = $_POST['txtAuthorName'];
        $authorImg = $_FILES['imgAuthor']['name'];
        $targetDir = "uploads/";

        // Handle image upload
        if (!empty($authorImg)) {
            move_uploaded_file($_FILES['imgAuthor']['tmp_name'], $targetDir . $authorImg);
            $result = $authorModel->update_author($author_id, $author_name, $authorImg);
        } else {
            // If no new image is uploaded, just update the name
            $result = $authorModel->update_author($author_id, $author_name);
        }

        if ($result) {
            header("Location: index.php?controller=author&action=index");
            exit();
        } else {
            $msg = "Cập nhật tác giả không thành công";
        }
    } else {
        // Show the edit form
        $author_id = $_GET['id'];
        $author = $authorModel->getAuthorById($author_id);
        include("views/author/edit_author.php");
    }
}
public function delete() {
    $authorModel = new AuthorModel();
    
    if (isset($_GET['id'])) {
        $author_id = $_GET['id'];
        $result = $authorModel->delete_author($author_id);
        
        if ($result) {
            header("Location: index.php?controller=author&action=index&msg=" . urlencode("Xóa tác giả thành công"));
        } else {
            header("Location: index.php?controller=author&action=index&msg=" . urlencode("Xóa tác giả không thành công"));
        }
        exit();
    } else {
        header("Location: index.php?controller=author&action=index&msg=" . urlencode("Không tìm thấy ID tác giả"));
        exit();
    }
}

}
?>
