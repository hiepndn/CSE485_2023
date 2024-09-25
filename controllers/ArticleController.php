<?php
include("services/ArticleService.php");
class ArticleController{
    // Hàm xử lý hành động index
    public function index(){
        // Nhiệm vụ 1: Tương tác với Services/Models
        $articelService = new ArticleService();
        $articles = $articelService->getAllArticles();
        // Nhiệm vụ 2: Tương tác với View
        include("views/article/index.php");
    }

    public function create(){
        include("views/article/add_article.php");
    }

    public function add(){
        $title = $_POST['tieude'];
        $song = $_POST['bhat'];
        $sumary = $_POST['tomtat'];
        $maTG = $_POST['tacgia'];
        $maTL = $_POST['theloai'];
        $ngay = $_POST['ngay'];
        $noidung = $_POST['noidung'];
        $img = $_POST['img'];
        // Nhiệm vụ 1: Tương tác với Services/Models
        $articelService = new ArticleService();
        if ($articelService -> checkMaTgia($maTG) == null || $articelService -> checkMaTloai($maTL) == null){
            header("Location: index.php?controller=article&action=create&msg=Yêu cầu nhập mã tác giả hoặc mã thể loại tồn tại trong hệ thống");
        }
        else{
            $articelService->addArticle($title, $song, $sumary, $maTG, $maTL, $ngay, $noidung, $img);
            header("Location: index.php?controller=article");
        }
    }

    public function edit(){
        $id=$_GET['id'];
        $articelService = new ArticleService();
        $row = $articelService->viewEditBviet($id);
        include("views/article/edit_article.php");
    }

    public function edited(){
        $id=$_POST['bviet'];
        $title = $_POST['tieude'];
        $song = $_POST['bhat'];
        $sumary = $_POST['tomtat'];
        $maTG = $_POST['tacgia'];
        $maTL = $_POST['theloai'];
        $ngay = $_POST['ngay'];
        $noidung = $_POST['noidung'];
        $img = $_POST['img'];
        $articelService = new ArticleService();
        if ($articelService -> checkMaTgia($maTG) == null || $articelService -> checkMaTloai($maTL) == null){
            header('Location: index.php?controller=article&action=edit&id='.$id.'&msg=Yêu cầu nhập mã tác giả hoặc mã thể loại tồn tại trong hệ thống');
        }
        else{
            $articelService->addArticle($title, $song, $sumary, $maTG, $maTL, $ngay, $noidung, $img,$id);
            header("Location: index.php?controller=article");
        }
    }
}