<?php
    if(isset($_POST['Submit'])){
        include './php/init.php';
        $user = $_POST['User'];
        $pwd = $_POST['Pwd'];
        $email = $_POST['Email'];
        $surname = $_POST['Surname'];
        $phone = $_POST['Phone'];
        $addr = $_POST['Addr'];
        $time = date("Y/m/d H:i:s");
        $sql = "Select * from member where user = '$user'";
        $obj_query = mysqli_query($conn,$sql);
        // 檢查是否重複
        if(empty(mysqli_fetch_array($obj_query))){
            $insert_member = "Insert into member(`user`,pwd,email,surname,phone,addr,date) 
                            values('$user','$pwd','$email','$surname','$phone','$addr','$time')";
            if(mysqli_query($conn,$insert_member)){
                echo '<script type="text/javascript">';
                echo 'alert("註冊成功!");';
                echo 'window.location.href = "https://fbbot.youcanbemama.com/tworder/login.php";';
                echo '</script>';
                exit;
            }
            
            // header("Location: https://fbbot.youcanbemama.com/tworder/login.php"); 
        }
        else{
            header("Location: https://fbbot.youcanbemama.com/tworder/signup.php"); 
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="bg-img" style="height: 106vh">
        <div class="content">
            <header>註冊</header>
            <form action="" method="POST">
                <div class="field">
                    <span class="fa fa-user"></span>
                    <input type="text" required placeholder="帳號" name="User">
                </div>
                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input type="password" required placeholder="密碼" name="Pwd">
                </div>
                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input type="text" required placeholder="姓名" name="Surname">
                </div>
                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input type="text" required placeholder="電子郵件" name="Email">
                </div>
                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input type="text" required placeholder="電話" name="Phone">
                </div>
                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input type="text" required placeholder="地址" name="Addr">
                </div>
                <br><br>
                <div class="field">
                    <input type="submit" value="送出" name = "Submit">
                </div>
            </form>
            <div class="login">
                來去
                <a href="login.php">登入</a>
                吧!!
            </div>
        </div>
    </div>
</body>
</html>