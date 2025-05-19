<?php
    // Gọi thư viện đã xây sẵn
    require_once $_SERVER['DOCUMENT_ROOT']. '/BinhDinhNews/app/config/database.php';
    class DiaDiemDAO{
        
        // get connection thông qua lớp Database Connection để tiện lợi hơn
        function getConnection()
        {
            $dbConnect =  new DatabaseConnection();
            return $dbConnect->getConnection();
        }
      
        // lấy dữ liệu bài báo và trả về dạng  ???
        function getdsDiaDiem($query)
        {
            // get connection
            $conn = $this->getConnection();
            // thực hiện query từ chuỗi query tham số
            $kqua = mysqli_query($conn,$query);
            // đóng kết nối
            mysqli_close($conn);

            return $kqua;
        }

        function getDiaDiem($id)
        {
            $conn = $this->getConnection();
            $sql = "SELECT * FROM `dia_diem` WHERE diadiemID = ".$id."";
            $kqua = mysqli_query($conn, $sql);
            mysqli_close($conn);
            return $kqua;
        }        
    }
?>