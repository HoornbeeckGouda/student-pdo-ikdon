<?php
//STAP 1 - Initialisatie
define('HOST', 'localhost');
define('DATABASE', 'student');
define('USER', 'webuser');
define('PASSWORD','7q06DXjDr1Z3reXK');

//gebruik geen root!!!
//STAP 2 | connection db
try {
    $dbconn = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE . ";charset=utf8mb4", USER, PASSWORD);
    $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}

?>