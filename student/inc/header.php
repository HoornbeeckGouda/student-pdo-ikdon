<?php
session_start();
include 'conn/database.php';
$current_page = basename($_SERVER['PHP_SELF']);

if (!in_array($current_page, ['login.php', 'inloggen.php']) && (!isset($_SESSION['ingelogd']) || $_SESSION['ingelogd'] !== true)) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Studenten</title>
    <link rel="stylesheet" type="text/css" href="css/student.css">
</head>
<body>