<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

// deze functie stuurt e-mails via je mailaccount...
function mailen($mailTo, $onderwerp, $bericht) {
    $mail = new PHPMailer();

    //Verbinden met je mail account (<leerlingnummer>@<leerlingnummer>.hbcdeveloper.nl)
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPAutoTLS = false;
    $mail->SMTPSecure = 'tls';
    //$mail->SMTPSecure = 'ssl';
	//Debuginformatie aanzetten… zet deze inproductie uit…
    //$mail->SMTPDebug = \PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;
    //$mail->Host = 'mail.<leerlingnummer>.hbcdeveloper.nl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;

    //Identificeer jezelf bij je mailaccount
    $mail ->Username = '';
    $mail ->Password = '';

    //E-mail opstellen...
    $mail ->isHTML(true);
// ook voor het mailadres staat een h!!!
    $mail->setFrom("", "Naam");
    $mail->Subject = $onderwerp;
    $mail->CharSet ='UTF-8';

    $bericht = "<body style=\"font-family: Verdana, Verdana, Geneva, sans-serif; 
                    font-size: 14px; color: #000;\">" . $bericht . "</body>";
    $mail -> addAddress($mailTo);
    //$mail ->addAddress('bkd@hoornbeeck.nl', "Dick")
    $mail -> Body = $bericht;
    //stuur de mail...
    if ($mail->Send()) {
        echo "<script>alert('Mail is verstuurd');</script>";
    }
    else {
        echo 'Mailer Error: '.$mail->ErrorInfo;
        echo "<script>alert('Mail kon niet verstuurden worden...');</script>";
    }
    return $mail;
}
?>
</body>
</html>