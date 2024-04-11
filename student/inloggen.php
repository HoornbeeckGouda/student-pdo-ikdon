<?php
include 'inc/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inlognaam = isset($_POST['inlognaam']) ? $_POST['inlognaam'] : '';
    $wachtwoord = isset($_POST['wachtwoord']) ? $_POST['wachtwoord'] : '';

    $stmt = $dbconn->prepare("SELECT gebruiker.id, gebruiker.inlognaam, gebruiker.wachtwoord, rol.naam FROM gebruiker
    INNER JOIN rol ON gebruiker.rol_id=rol.id
    WHERE inlognaam = :inlognaam");
    $stmt->bindParam(':inlognaam', $inlognaam);

    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($wachtwoord, $user['wachtwoord'])) {
            $_SESSION['inlognaam'] = $inlognaam;
            $_SESSION['wachtwoord'] = $wachtwoord;
            $_SESSION['rol'] = $user['naam'];
            $_SESSION['ingelogd'] = true;
            header('refresh: 1; url=studenten.php');
            exit;
        } else {
            echo 'Helaas, uw inlognaam en/of wachtwoord corresponderen niet met onze gegevens. U wordt doorgestuurd...<br>';
            session_destroy();
            session_unset();
            header('refresh: 5; url=login.php');
            exit;
        }
    }
}
?>