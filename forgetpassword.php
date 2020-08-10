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
            <header>忘記密碼</header>
            <form action="" method="POST">
                <div class="field">
                    <span class="fa fa-user"></span>
                    <input type="text" required placeholder="帳號" name="User">
                </div>
                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input type="email" required placeholder="Email" name="Email">
                </div>
                <br><br>
                <div class="field">
                    <input type="submit" value="送出" name="Submit">
                </div>
                <?php
                    use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\Exception;

                    require '../phpmailer/src/Exception.php';
                    require '../phpmailer/src/PHPMailer.php';
                    require '../phpmailer/src/SMTP.php';
                    include '../tworder/php/init.php';
                    if(isset($_POST['Submit'])){
                        $email = $_POST['Email'];
                        $user = $_POST['User'];
                        $select_pwd = "Select * from member where user = '$user' && email = '$email'";
                        $result = mysqli_query($conn, $select_pwd);
                        $row = mysqli_fetch_array($result);
                        $pwd = $row['pwd'];
                        date_default_timezone_set('Asia/Taipei');
                        // $verification_code = PHPMailer::generatePIN(); //Email驗證碼
                        if(empty($pwd)){
                            echo    '<br><div class="signup">
                                        錯誤的帳號or電子郵件
                                    </div>';
                        }
                        else{
                            $mail= new PHPMailer(true);
                            try {
                                //Server settings
                                $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                                $mail->isSMTP();                                      // Set mailer to use SMTP
                                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                                $mail->Username = 'chenyuyou3@gmail.com';                 // SMTP username
                                $mail->Password = 'zzzz1234.';                           // SMTP password
                                $mail->SMTPOptions = array(
                                    'ssl' => array(
                                        'verify_peer' => false,
                                        'verify_peer_name' => false,
                                        'allow_self_signed' => true
                                    )
                                );
                                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                                $mail->Port = 587;                                    // TCP port to connect to
        
                                //Recipients
                                $mail->setFrom('chenyuyou3@gmail.com', '台灣正港通');
                                $mail->addAddress($email, '');     // Add a recipient
                            
                                $mail->isHTML(true);                                  // Set email format to HTML
                                $mail->Subject = '忘記密碼';
                                $mail->Body    = "你好，您遺失的密碼為: $pwd"; // 這邊用網址上的 GET 參數讓他回來網站時
        
        
        
                                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                                ob_start();
                                $mail->send();
                                header("Location: http://127.0.0.1/tworder/forgetpassword.php");
                                ob_end_flush();
                            } catch (Exception $e) {
                                echo 'Message could not be sent.';
                                echo 'Mailer Error: ' . $mail->ErrorInfo;
                            }
                                               
                        }
                    }
                ?>
            </form>
        </div>
    </div>
</body>
</html>