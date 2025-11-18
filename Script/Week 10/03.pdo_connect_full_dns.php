<?php
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=ilkoom;charset=utf8mb4",
              "root", "");
var_dump($pdo);  // object(PDO)#1 (0) { }
