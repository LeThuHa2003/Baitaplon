<?php
    session_start();
    $email = $_POST['email'];

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'mail/Exception.php';
    require 'mail/PHPMailer.php';
    require 'mail/SMTP.php';
    
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'haxom2003@gmail.com';                     // SMTP username
        $mail->Password   = 'fevlnhynjdkmotcr';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    
        //Recipients
        $mail->setFrom('haxom2003@gmail.com', 'Admin Co mem');
        $mail->addAddress($email);     // Add a recipient

        $code = substr(str_shuffle('1234567890QWERTYUIOPASDFGHJKLZXCVBNM'),0,6);
        $_SESSION['code'] = $code;
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Password Reset';
        // $mail->Body    = 'To reset your password click <a href="http://localhost/Baitaplon/Login/dmk.php?code='.$code.'">here </a>. </br>Reset your password in a day.';
        $mail->Body    = 'Your password reset code is '.$code.'. </br>Reset your password in a day.';
        include "connect_db.php";

        if($conn->connect_error) {
            die('Could not connect to the database.');
        }

        $verifyQuery = $conn->query("SELECT * FROM ThanhVien WHERE Email = '$email'");

        if($verifyQuery->num_rows) {
            $codeQuery = $conn->query("UPDATE ThanhVien SET Code = '$code' WHERE Email = '$email'");
                
            $mail->send();
            // echo 'Message has been sent, check your email';
            header("Location: Forgot_password.php?success=Message has been sent, please check your email!");
        }
        $conn->close();
    
    } catch (Exception $e) {
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        header("Location: Forgot_password.php?error=Message could not be sent. Mailer Error: {$mail->ErrorInfo}!");
    }    
?>
