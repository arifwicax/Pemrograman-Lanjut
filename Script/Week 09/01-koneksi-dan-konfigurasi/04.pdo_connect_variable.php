<?php
$alamatServer = "127.0.0.1";
$port = "3306";
$db = "kampus_lanjut";
$charset = "utf8mb4";
$akunDatabase = "root";
$sandiDatabase = "";

$dsn = "mysql:host=$alamatServer;port:$port;dbname=$db;charset=$charset";
$databasePdo = new PDO($dsn, $akunDatabase, $sandiDatabase);
