<?php
    session_start();
    // $email = $_POST['email'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $subject = "Question about Co Mem";
    $message = $_POST['message'];

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
        $mail->setFrom($email, 'Customer');
        $mail->addAddress('haxom2003@gmail.com');     // Add a recipient

        
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        // $mail->Body    = 'To reset your password click <a href="http://localhost/Baitaplon/Login/dmk.php?code='.$code.'">here </a>. </br>Reset your password in a day.';
        // $mail->Body    = 'Your password reset code is '.$code.'. </br>Reset your password in a day.';
        $mail->Body       = 'Message: '.$message;
        include "connect_db.php";

        if($conn->connect_error) {
            die('Could not connect to the database.');
        }
        $insert_query = "INSERT INTO LienHe(HoTenKH,SDT,Email,NoiDungCauHoi) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("ssss", $name, $phone, $email, $message);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $mail->send();
            header("Location: Lien_he.php?success=Bạn đã gửi câu hỏi thành công!");
        }
        $conn->close();
    
    } catch (Exception $e) {
        header("Location: Lien_he.php?error=Message could not be sent. Mailer Error: {$mail->ErrorInfo}!");
    }    
?>
