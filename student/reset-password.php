<?php
include 'Classes/Token.php';
include 'Classes/Gebruiker.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $wachtwoord = $_POST['wachtwoord'];
    $token = $_POST['token'];

    $tokenObj = new Token($dbconn);
    $email = $tokenObj->getEmailFromToken($token);

    if ($email) {
        $gebruiker = new Gebruiker($dbconn);
        $gebruiker->resetPassword($email, $wachtwoord);
        $tokenObj->nullifyToken($email);
        echo "Wachtwoord gewijzigd";
    } else {
        echo "Invalid token";
    }
} else {
    $token = $_GET['token'] ?? '';

}
?>

<h1>Reset Password</h1>

<form method="post" action="">
    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
    <label for="wachtwoord">New password</label>
    <input type="wachtwoord" id="wachtwoord" name="wachtwoord">
    <button>Send</button>
</form>

</body>
</html>