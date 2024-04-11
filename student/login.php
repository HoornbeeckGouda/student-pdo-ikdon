<?php 
include 'inc/header.php';
if (isset($_SESSION['ingelogd']) && $_SESSION['ingelogd'] === true) {
    session_destroy();
}
?>
    <form action="inloggen.php" method="post">
        <input type="text" id="inlognaam" name="inlognaam" placeholder="Inlognaam   " required>
        <input type="password" id="wachtwoord" name="wachtwoord" placeholder="Wachtwoord" required>
        <input type="submit" name="submit" value="Inloggen">
    </form>
<?php
include 'inc/footer.php';
?>