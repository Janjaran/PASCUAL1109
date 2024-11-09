<?php 

$host = "localhost";
$user = "root";
$password = "";
$PASCUAL1109 = "PASCUAL1109";
$dsn = "mysql:host={$host};dbname={$PASCUAL1109}";

$pdo = new PDO($dsn, $user, $password);
$conn = new PDO($dsn, $user, $password);
$conn->exec("SET time_zone = '+08:00';");

?>