<?php
include("services/CategoryService.php");

class CategoryController {

    public function index() {
        // Nhiệm vụ 1: Tương tác với Services/Models
        $categoryService = new CategoryService();
        $categorys = $categoryService->getAllCategorys();
        // Nhiệm vụ 2: Tương tác với View
        include("views/category/index.php");
    }

    public function create() {
        // Nhiệm vụ 1: Tương tác với Services/Models
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $categoryService = new CategoryService();
            $category = $categoryService->addCategory( $_POST['txtCatName'] );
            if ($category) {
                header("Location: index.php?controller=category");
                exit();
            } else {
                $error = "Lỗi.";
            }
        }
        // Nhiệm vụ 2: Tương tác với View
        include("views/category/add_category.php");
    }



    public function __construct() {
        $this->categoryService = new CategoryService(); // Khởi tạo đối tượng CategoryService
    }

    // Phương thức edit để hiển thị form chỉnh sửa thể loại
    public function edit() {
            $id = $_GET['id'];
            $category = $this->categoryService->getCategoryById($id); // Gọi đúng đối tượng
            include 'views/category/edit_category.php'; 

        }

    // Cập nhật thông tin thể loại
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['txtCatId'];
            $name = $_POST['txtCatName'];

            // Sử dụng đối tượng categoryService đã khởi tạo
            $result = $this->categoryService->updateCategory($id, $name);

            if ($result) {
                header("Location: index.php?controller=category&action=index"); // Chuyển hướng sau khi cập nhật thành công
                exit();
            } else {
                echo "Cập nhật thể loại thất bại.";
            }
        } else {
            echo "Phương thức không hợp lệ.";
        }
    }
    //xoa

     public function delete() {
        // Kiểm tra nếu thể loại có bài viết trước khi xóa
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        if ($this->categoryService->hasArticles($id)) {
            $message_error_constraint = "VUI LÒNG XÓA BÀI VIẾT CÓ MÃ THỂ LOẠI " . $id . " RỒI MỚI ĐƯỢC XÓA THỂ LOẠI NÀY";
            echo "<script type='text/javascript'>alert('$message_error_constraint');";
            echo "window.location.href = 'index.php?controller=category&action=index';</script>";
        } else {
            if ($this->categoryService->deleteCategory($id)) {
                $message_success = "XÓA THÔNG TIN THÀNH CÔNG";
                echo "<script type='text/javascript'>alert('$message_success');";
                echo "window.location.href = 'index.php?controller=category&action=index';</script>";
            } else {
                echo "Lỗi khi xóa thể loại.";
            }
        }
    }
}
    
}
?>