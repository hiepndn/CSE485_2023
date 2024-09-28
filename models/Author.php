<?php
class Author{
    // Thuộc tính

    private $maTacgia;
    private $tenTacgia;
    private $hinhTacgia;


    public function __construct($maTacgia,$tenTacgia,$hinhTacgia){
        $this->maTacgia = $maTacgia;
        $this->tenTacgia = $tenTacgia;
        $this->hinhTacgia = $hinhTacgia;
        
    }

    // Setter và Getter
    public function getMaTacgia(){
        return $this->maTacgia;
    }

    public function setMaTacgia($maTacgia){
        return $this->maTacgia = $maTacgia;
    }

    public function getTenTgia(){
        return $this->tenTacgia;
    }

    public function setTenTgia($tenTacgia){
        return $this->tenTacgia = $tenTacgia;
    }

    public function getHinhTgia()
    {
        return $this->hinhTacgia;
    }

    public function setHinhTgia($hinhTacgia){
        return $this->hinhTacgia = $hinhTacgia;
    }

}