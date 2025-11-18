<?php
$host = "127.0.0.1";
$port = "3306";
$db = "ilkoom";
$charset = "utf8mb4";
$user = "root";
$pass = "";

$dsn = "mysql:host=$host;port:$port;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass);
