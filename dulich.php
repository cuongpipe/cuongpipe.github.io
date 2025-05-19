<!DOCTYPE html>

<?php
    include('../app/model/dulichDAO.php');
    $catDAO =  new dulichDAO();
    $result = $catDAO->gettheloai($_GET['idcat']);
    if(mysqli_num_rows($result)> 0)
    {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $nameCat = $row['TenTheLoai'];
    }
    mysqli_free_result($result);
?>



<html lang="vi">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="./css/rightmenu-style.css">
      <link rel="stylesheet" href="./css/reset.css">
      <link rel="stylesheet" href="./css/footer-style.css">
      <link rel="stylesheet" href="./css/dulich.css">
      <link rel="stylesheet" href="./css/header-style.css">
      <script src="https://kit.fontawesome.com/8f5e4d2946.js" crossorigin="anonymous"></script>
      <link rel="icon" href="./images/logo.webp" type="image/x-icon">
      <script src="./scripts/homePage.js"></script>
      <title>
            <?php 
            if(isset($nameCat)) echo $nameCat; else echo "Không tìm thấy" 
        ?>

      </title>
</head>



<?php
    include('../app/views/partials/header.php');
?>

<body>

      <div class="container-theloai-dulich">
            <div class="container-left"></div>
            
            <div class="container-mid">
                  <h1 class="tieude-theloai">
                 <?php if(isset($nameCat)) 
                   echo $nameCat; else echo "404 Không tìm thấy" 
                 ?>

                  </h1>
                  <div class="container-theloai-list">
                   <?php
                    include('../app/model/ctDiaDiemDAO.php');
                    $artilces_per_page = 15;
                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $artDAO = new DiaDiemDAO();
                    $sql = "SELECT * FROM dia_diem WHERE TheLoaiID = ".$_GET['idcat']."
                            LIMIT ".$artilces_per_page." OFFSET ".($current_page - 1) * $artilces_per_page."";
                    $result = $artDAO->getdsDiaDiem($sql);
                    $total_articles = mysqli_num_rows(mysqli_query($artDAO->getConnection(), "SELECT * FROM `dia_diem` WHERE diadiemID = ".$_GET['idcat'].""));
                    $total_pages = ceil($total_articles / $artilces_per_page);

     


                   while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                        // MYSQLI_ASSOC    Mảng kết hợp: dùng tên cột làm key
                    {
                        $filename = '../app/dulich_data/'.$row['DiaDiemID'].'.txt';
                        // $row thì là biến bạn gán từ mysqli_fetch_array(), nó chứa mảng dữ liệu trả về từ cơ sở dữ liệu.
                        $f = fopen($filename, 'r');
                        if($f)
                        {

                        }
                        else{
                            $content = "404 NOT FOUND FILE" . $filename;
                        }
                        if (empty($row['HinhAnh'])) {
                             $row['HinhAnh'] = 'default.jpg';
                             $row['TheLoaiID'] = 'default';
                        }

                        echo'
                        <div class="place-card">
                               <a href="./ctDiaDiemDAO.php?id='.$row['DiaDiemID'].'">
                                 <img src="./images/imgDuLich/'.$row['DiaDiemID'].'/'.$row['HinhAnh'].'" alt="'.$row['HinhAnh'].'">
                                 <div class="place-name"><h3>'.$row['TenDiaDiem'].'</h3></div>
                                 <div class="place-address"><p>'.$row['DiaChi'].'</p></div>
                              </a>
                        </div>
                        ';

                    
                    }
                  
                    mysqli_free_result($result);  

                ?>


                </div>

                <?php
                    require_once('../app/controller/paginationHelper.php');
                    page_navigation($total_pages, $current_page);
                ?>




            </div>
            <div class="container-right">
                  <?php
                include("../app/views/right/homepage.php");
            ?>
            </div>
      </div>
</body>
<?php
        include('../app/views/partials/footer.php');
    ?>

</html>