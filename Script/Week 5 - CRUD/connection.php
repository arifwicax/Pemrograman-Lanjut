<?php

$dbhost = "localhost";
$dbuser = "admin";
$dbpass = "admin";
$dbname = "crud";
$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!$link){
    die ("koneksi dengan database gagal : ".mysqli_connect_errno().
    " - ".mysqli_connect_error());
}


?>