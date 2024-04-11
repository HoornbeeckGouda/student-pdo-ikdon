<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Testen mailen...</title>
</head>
<body>
<?php
//include ('registreren.html');
include 'inc/header.php';
include ('mailen.php');
$klant = 'Klant B';
$email = 'donhaohu0@gmail.com';

$melding='Testmail';
echo '<div id="melding">'.$melding."</div>";
$onderwerp = "Testmail vanuit phpMailer";
$bericht = "Geachte $klant, hierbij uw inloggegevens.";
//mailen...
mailen($email, $klant, $onderwerp, $bericht );
?>
</body>
</html>