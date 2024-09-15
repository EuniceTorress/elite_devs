<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$e_acc = filter_var($_POST['email_account'], FILTER_SANITIZE_EMAIL);

if (!filter_var($e_acc, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['error1' => 'Invalid email format']);
    exit;
}
$_SESSION['user_email'] = $e_acc;

$random_code = rand(100000, 999999);
$error1 = "success";

include 'sql/connection.php';

$stmt = $conn->prepare("SELECT email FROM user_info WHERE email = ?");
$stmt->bind_param('s', $e_acc);
$stmt->execute();
$e_sql_result = $stmt->get_result();

$stmt = $conn->prepare("SELECT `data`, `status`, `timestamp` FROM web_data WHERE data = ? AND `type` = 'email'");
$stmt->bind_param('s', $e_acc);
$stmt->execute();
$wmail_result = $stmt->get_result();

if ($e_sql_result->num_rows > 0) {
    $error1 = "This account is already linked to an existing account";
    sleep(1);
} else {
    if ($wmail_result->num_rows > 0) {
        $wm = $wmail_result->fetch_assoc();
        $givenDate = new DateTime($wm['timestamp'], new DateTimeZone('Asia/Manila')); 
        $currentDateTime = new DateTime('now', new DateTimeZone('Asia/Manila')); 

        $interval = $currentDateTime->diff($givenDate);

        $minutesPassed = ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;

        if ($wm['status'] >= 5  && $minutesPassed < 15) {
            $error1 = "Email could not be sent due to multiple attempts. Please try again after 15 minutes.";
            sleep(1);
        } else {
            $code_count = $wm['status'];
            try {
                $mail = new PHPMailer(true);

                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'angela.boteros22@gmail.com';
                $mail->Password = 'vyhqbdpvlfopsxvz';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;

                $mail->setFrom('angela.boteros22@gmail.com', "S'tockpile System Admin");
                $mail->addAddress($e_acc);

                $mail->Subject = "VERIFICATION CODE";
                $mail->Body = "Your verification code is: $random_code";

                $mail->send();

                if ($code_count == 5){
                    $code_count = 1;
                }else {
                    if($minutesPassed > 15){
                        $code_count = 0;
                    }
                    $code_count = $code_count + 1;
                }
                $_SESSION['code'] = $random_code;

            } catch (Exception $e) {
                $error1 = "Email could not be sent. Please try again later.";
            }
            
            $stmt = $conn->prepare("CALL InsertOrUpdateData(?, ?)");
            $stmt->bind_param('si', $e_acc, $code_count);
            $stmt->execute();
        }
    } else {
        try {
            $code_count = 0;

            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'angela.boteros22@gmail.com';
            $mail->Password = 'vyhqbdpvlfopsxvz';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('angela.boteros22@gmail.com', "S'tockpile System Admin");
            $mail->addAddress($e_acc);

            $mail->Subject = "VERIFICATION CODE";
            $mail->Body = "Your verification code is: $random_code";

            $mail->send();

            $_SESSION['code'] = $random_code;
            $code_count = $code_count + 1;

        } catch (Exception $e) {
            $error1 = "Email could not be sent. Please try again later.";
            sleep(1);
        }

        $stmt = $conn->prepare("CALL InsertOrUpdateData(?, ?)");
        $stmt->bind_param('si', $e_acc, $code_count);
        $stmt->execute();
    }
}

echo json_encode(['error1' => $error1]);

?>
