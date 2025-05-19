<?php
    include('../app/model/ctDiaDiemDAO.php');
    $catDAO =  new DiaDiemDAO();
    $result = $catDAO->getDiaDiem($_GET['id']);
    if(mysqli_num_rows($result)> 0)
    {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $nameCat = $row['TenDiaDiem'];
    }
    mysqli_free_result($result);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/footer-style.css">
	<link rel="stylesheet" href="./css/header-style.css">
    <link rel="stylesheet" href="./css/article-style.css">
    <link rel="stylesheet" href="./css/rightmenu-style.css">
    <script src="https://kit.fontawesome.com/8f5e4d2946.js" crossorigin="anonymous"></script>
    <script src="./scripts/zoom-img.js"> </script>
      <title>
            <?php 
            if(isset($nameCat)) echo $nameCat; else echo "Không tìm thấy" 
        ?>

      </title>
    
    <link rel="icon" href="./images/logo.webp" type="image/x-icon">
</head>
<?php
        include('../app/views/partials/header.php');

    ?>
<body>

    <div class="container-article">
        <div class="container-left"></div>
        <div class="art-content">
        <?php
            require_once('../app/model/ctDiaDiemDAO.php');
            $artDAO = new DiaDiemDAO();
            $result = $artDAO->getDiaDiem($_GET['id']);

            // kiểm tra trong database có tồn tại bài báo với id đưa vào hay k
            if(mysqli_num_rows($result) > 0)
            {
                $rawData = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // lấy tiêu đề
                echo "<h1> ".$rawData['TenDiaDiem']."</h1>";

                // Đọc tệp và kiểm tra từng dòng
$f = fopen("../app/dulich_data/".$_GET['id'].".txt", 'r') or die("<h1>Không tìm thấy bài báo</h1>");

// Đọc và hiển thị tiêu đề
echo "<h1> ".$rawData['TenDiaDiem']."</h1>";

// Đọc dòng đầu tiên (ví dụ: mô tả ngắn)
echo '<p><b>' . fgets($f) . '</b></p>';

// Duyệt qua tất cả các dòng còn lại trong file
while (!feof($f)) {
    $row = fgets($f);
    $row = trim($row); // Xóa các khoảng trắng thừa

    // Kiểm tra nếu là dấu chỉ định ảnh
    if ($row == "[img]") {
        echo '<img src="./images/imgDuLich/' . $rawData['DiaDiemID'] . '/' . $rawData['HinhAnh'] . '" alt="' . $rawData['HinhAnh'] . '">';
    } else {
        echo '<p>' . $row . '</p>';
    }
}

fclose($f);

            }


        ?>
            </div>
        <div class="container-right">
            <?php
                include("../app/views/right/homepage.php");
            ?>
        </div>

    </div>

    <div class="img-overlay">
        <img src="" alt="Hình ảnh phóng to">
    </div>

</body>
   

<?php
        include('../app/views/partials/footer.php');
    ?>
