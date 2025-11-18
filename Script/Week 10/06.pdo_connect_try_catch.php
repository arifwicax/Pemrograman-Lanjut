<?php
try {
  $pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "r4has!a");
}
catch (\PDOException $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  $pdo=NULL;
}