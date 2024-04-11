<?php
include 'Classes/Token.php';
include 'mailen.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $secretKey = "";

    // Recaptcha response verifieren
    $verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaResponse");
    $responseData = json_decode($verifyResponse);

    if (!$responseData->success) {
        $_SESSION['error'] = "reCAPTCHA verification failed";
        header('Location: ../login.php');
        exit;
    }
}

$email = $_POST['email'];
$token = new Token($dbconn);
$affectedRows = $token->setToken($email);

if ($affectedRows > 0) {
    $onderwerp = "Password Reset";
    $tokenValue = $token->getValue(); 
    $bericht = <<<END

    Click <a href="http://localhost/student-pdo-ikdon/student/reset-password.php?token=$tokenValue">here</a> 
    to reset your password.

    END;
    $mail = mailen($email, $onderwerp, $bericht);

}
