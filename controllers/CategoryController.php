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
        // Kiểm tra xem có ID trong GET không
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $category = $this->categoryService->getCategoryById($id); // Gọi đúng đối tượng
            
            // Kiểm tra xem thể loại có tồn tại hay không
            if ($category) {
                // Chuyển tới view chỉnh sửa
                include 'views/category/edit_category.php'; // Thay thế đường dẫn cho đúng
            } else {
                // Nếu không tìm thấy thể loại, chuyển hướng về danh sách thể loại
                header("Location: index.php?controller=categor&msg=Thể loại không tồn tại.");
                exit();
            }
        } else {
            // Nếu không có ID, chuyển hướng về danh sách thể loại
            header("Location: index.php?controller=category&msg=ID không hợp lệ.");
            exit();
        }
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
    public function delete($id) {
        if ($this->categoryModel->hasArticles($id)) {
            $message_error_constraint = "VUI LÒNG XÓA BÀI VIẾT CÓ MÃ THỂ LOẠI LÀ " . $id . " RỒI MỚI ĐƯỢC XÓA THỂ LOẠI NÀY";
            $redirectUrl_error_constraint = "../views/admin/article.php";
            echo "<script type='text/javascript'>alert('$message_error_constraint');";
            echo " window.location.href = '$redirectUrl_error_constraint';</script>";
        } else {
            if ($this->categoryModel->deleteCategory($id)) {
                $message_success = "XÓA THÔNG TIN THÀNH CÔNG";
                $redirectUrl_success = "../views/admin/category.php";
                echo "<script type='text/javascript'>alert('$message_success');";
                echo " window.location.href = '$redirectUrl_success';</script>";
            } else {
                $message_error_execute = "LỖI EXECUTE: ";
                $redirectUrl_error_execute = "../views/admin/category.php?id=" . $id;
                echo "<script type='text/javascript'>alert('$message_error_execute');";
                echo " window.location.href = '$redirectUrl_error_execute';</script>";
            }
        }
    }
}
?>