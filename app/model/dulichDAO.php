<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/BinhDinhNews/app/config/database.php';
    class dulichDAO{
        function getConnection()
        {
            $dbConnect =  new DatabaseConnection();
            return $dbConnect->getConnection();
        }
        function getalltheloai()
        {
            $conn = $this->getConnection();
            $sql = "SELECT * FROM `theloai_dulich`";
            $kqua = mysqli_query($conn, $sql);
            mysqli_close($conn);
            return $kqua;
        }
        function gettheloai($id){
            $conn = $this->getConnection();
            $sql = "SELECT * FROM `theloai_dulich` WHERE TheLoaiID = ".$id."";
            $kqua = mysqli_query($conn, $sql);
            mysqli_close($conn);
            return $kqua;
        }
    }
    

?>