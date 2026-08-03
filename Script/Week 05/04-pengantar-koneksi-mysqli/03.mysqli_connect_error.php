<?php
$databaseMysqli = new mysqli("localhost", "root", "root");
echo $databaseMysqli->connect_errno," - ", $databaseMysqli->connect_error;
