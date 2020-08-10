<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <div class="bg-img">
        <div class="content">
            <header>後台登入</header>
            <form action="" method="POST">
                <?php
                session_id(10);
                session_start();
                if (empty($_SESSION['user'])) {
                    echo    '<div class="field">
                                    <span class="fa fa-user"></span>
                                    <input type="text" required placeholder="帳號" name="User">
                                </div>
                                <div class="field space">
                                    <span class="fa fa-lock"></span>
                                    <input type="password" class="pass-key" required placeholder="密碼" name="Pwd">
                                    <span class="show">SHOW</span>
                                </div>
                                <div class="pass">
                                    <br>
                                </div>
                                <div class="field">
                                    <input type="submit" value="登入" name="Submit">
                                </div>';

                    include './php/init.php';
                    if (isset($_POST['Submit'])) {
                        $acc = $_POST['User'];
                        $pwd = $_POST['Pwd'];
                        $sql = "Select * from admin where user = '$acc' and pwd = '$pwd'";
                        $obj = mysqli_query($conn, $sql);
                        // 如果帳號和密碼正確的話，寫入Session變數，並視情況重導到相關的頁面
                        if ($row = mysqli_fetch_array($obj)) {
                            // 啟動 Session
                            // 登記 Session 變數名稱
                            // 寫入 Session 變數值
                            $_SESSION['user'] = $acc;
                            $_SESSION['uid'] = $row['id'];
                            $_SESSION['login_time'] = date('Y-m-d h:i:s');
                            // 檢查在 $_SESSION 全域變數中，是否有之前設定好的網址重導 Session 變數
                            var_dump($_SESSION);
                            // 重導到相關頁面
                            header("Location: https://fbbot.youcanbemama.com/tworder/index.html");
                        } else {
                            echo    '<br><div class="signup">
                                                    帳號or密碼錯誤
                                        </div>';
                        }
                    }
                } else {
                    echo '<script type="text/javascript">';
                    echo 'alert("已登入，將導向回主頁");';
                    echo 'window.location.href = "https://fbbot.youcanbemama.com/tworder/index.html";';
                    echo '</script>';

                    // echo '<script language="javascript">';
                    // echo 'alert("已登入，將導向回主頁")';
                    // echo '</script>';
                }
                ?>
            </form>
        </div>
    </div>
    <!-- <script>
        function myFunction(){
        if (alert("已登入，將導向回主頁")) {
            header("Location: http://127.0.0.1/tworder/index.php");
        } 
    </script> -->

    <script>
        const pass_field = document.querySelector('.pass-key');
        const showBtn = document.querySelector('.show');
        showBtn.addEventListener('click', function() {
            if (pass_field.type === "password") {
                pass_field.type = "text";
                showBtn.textContent = "HIDE";
                showBtn.style.color = "#3498db";
            } else {
                pass_field.type = "password";
                showBtn.textContent = "SHOW";
                showBtn.style.color = "#222";
            }
        });
    </script>
</body>

</html>