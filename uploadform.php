<?php
include './php/init.php';
session_start();
if (isset($_POST['Logout'])) {
  // 如果帳號和密碼正確的話，寫入Session變數，並視情況重導到相關的頁面
  // var_dump($_SESSION);
  session_destroy();
  header("Location: https://fbbot.youcanbemama.com/tworder/login.php");
}
if(isset($_POST['Login'])){
  header('Location: https://fbbot.youcanbemama.com/tworder/login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link href="./assets/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">
    <title>Document</title>
</head>

<style>
    #sticky-footer {
        flex-shrink: none;
    }

    #upload {
        opacity: 0;
    }

    #upload-label {
        position: absolute;
        top: 50%;
        left: 1rem;
        transform: translateY(-50%);
    }

    .image-area {
        border: 2px dashed rgba(255, 255, 255, 0.7);
        padding: 1rem;
        position: relative;
    }

    .image-area::before {
        content: '預覽圖';
        color: #FFF;
        font-weight: bold;
        text-transform: uppercase;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 0.8rem;
        z-index: 1;
    }

    .image-area::after {
        transform: translate(-50%, -50%);
    }

    .image-area img {
        z-index: 2;
        position: relative;
    }
</style>

<body style="background-color: #D0D0D0; ">
    <div>
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <!-- Brand -->
            <a class="navbar-brand" href="./index.php">訂單網</a>

            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <form action="" method="POST">
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link" href="./table.php">金額查詢</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./table2.php">訂單查詢</a></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./uploadform.php">新增訂單</a>
                        </li>
                        <?php
                            if (empty($_SESSION['user'])) {
                                echo '<li class="nav-item">
                                    <input type="submit" class="btn btn-outline-light" name="Login" value="登入"></input>
                                </li>';
                                    } else {
                                        echo '<li class="nav-item">
                                    <input type="submit" class="btn btn-outline-light" name="Logout" value="登出"></input>
                                </li>';
                            }
                        ?>
                    </ul>
                </div>
            </form>
        </nav>
    </div>

    <form action="" method="POST" enctype="multipart/form-data">
        <br><br>
        <div class="input-group mb-3">
            <!-- <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">可拖曳圖片 or 選擇圖片 →</span>
            </div> -->
            <div class="row py-4" style="margin-left: 39%;">
                <div class="col-lg-6 ">

                    <!-- Upload image input-->
                    <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                        <input id="upload" type="file" onchange="readURL(this);" class="form-control border-0" name='upfile'>
                        <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose file</label>
                        <div class="input-group-append">
                            <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                        </div>
                    </div>

                    <!-- Uploaded image area-->
                    <p class=" text-black text-center">上傳的圖片將會在下方顯示</p>
                    <div class="image-area"><img id="imageResult" src="#" alt="" class="img-fluid shadow-sm mx-auto d-block"></div>

                </div>
            </div>
        </div>
        <br>
        <!-- <div class="custom-file col-md-6"> -->
        <!-- <input type="file" name="upfile" accept="image/*"> -->
        <!-- <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="upfile" accept="image/*"> -->
        <!-- <label class="custom-file-label" for="inputGroupFile01"></label> -->
        <!-- </div> -->
        </div>
        <div class="form-group col-md-6" style="margin-left: 400px;">
            <label for="inputcolor4">顏色</label>
            <input type="text" class="form-control" id="inputcolor4" placeholder="color" name="Color">
        </div>
        <div class="form-group col-md-6" style="margin-left: 400px;">
            <label for="inputSize4">尺寸</label>
            <input type="size" class="form-control" id="inputSize4" placeholder="size" name="Size">
        </div>
        <div class="form-group col-md-6" style="margin-left: 400px;">
            <label for="inputNum">數量</label>
            <input type="text" class="form-control" id="inputNum" placeholder="number" name="Qat">
        </div>
        <div class="form-group col-md-6" style="margin-left: 400px;">
            <label for="inputPrice">單價</label>
            <input type="text" class="form-control" id="inputPrice" placeholder="Price" name="Price">
        </div><br><br>
        <button type="submit" class="btn btn-primary" style="margin-left: 686px;" name="Submit">送出</button>
    </form>
    <br>
    <?php
    include './php/init.php';
    if (isset($_POST['Submit'])) {
        if(!empty($_SESSION['uid'])){
            $userid = $_SESSION['uid'];
            $color = $_POST['Color'];
            if(empty($color)){
                echo '<script language="javascript">';
                echo 'alert("請輸入顏色")';
                echo '</script>';
                exit();
            }
            $size = $_POST['Size'];
            if(empty($size)){
                echo '<script language="javascript">';
                echo 'alert("請輸入尺寸")';
                echo '</script>';
                exit();
            }
            $qat = $_POST['Qat'];
            if(empty($qat)){
                echo '<script language="javascript">';
                echo 'alert("請輸入數量")';
                echo '</script>';
                exit();
            }
            $price = $_POST['Price'];
            if(empty($price) || $price <= 0){
                echo '<script language="javascript">';
                echo 'alert("請輸入正確價格")';
                echo '</script>';
                exit();
            }
            $date = date("Y-m-d");
            $total = $qat * $price;
            $NowTime = date("Y/m/d H:i:s");
            $tmp_time = strtotime($NowTime);
            $imgname = $_FILES['upfile']['name'];
            $imgtype = $_FILES['upfile']['type'];
            $file = $_FILES['upfile']['tmp_name'];
            $exten = substr(strrchr($_FILES['upfile']['name'], "."), 1);
            $dest = './assets/images/' . $tmp_time . '.' . $exten;
            if ($_FILES['upfile']['error'] === UPLOAD_ERR_OK) {
                if (move_uploaded_file($file, $dest)) {
                    $insert_order = "Insert into 
                                            `order`(userid, color, size, qat, price, sum, `status`, imgname, imgtype, imgpic, original_name,date)
                                            values('$userid','$color','$size','$qat','$price','$total','處理中','" . $tmp_time . '.' . $exten . "','$imgtype','$dest','$imgname','$date')";
                    mysqli_query($conn, $insert_order);
                    echo '<script language="javascript">';
                    echo 'alert("新增成功")';
                    echo '</script>';
                }
            }
        }
        else{
            echo '<script language="javascript">';
            echo 'alert("請先登入會員")';
            echo '</script>';
}
        
    }
    ?>
    <!-- Footer -->
    <footer id="sticky-footer" class="py-3 bg-dark text-white-50">
        <div class="container text-center">
            <small style="color: white;">Copyright &copy; Your Website</small>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imageResult')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function() {
            $('#upload').on('change', function() {
                readURL(input);
            });
        });

        /*  ==========================================
            SHOW UPLOADED IMAGE NAME
        * ========================================== */
        var input = document.getElementById('upload');
        var infoArea = document.getElementById('upload-label');

        input.addEventListener('change', showFileName);

        function showFileName(event) {
            var input = event.srcElement;
            var fileName = input.files[0].name;
            infoArea.textContent = 'File name: ' + fileName;
        }
    </script>

</body>

</html>