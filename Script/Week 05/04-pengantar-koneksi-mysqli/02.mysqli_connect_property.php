<?php
$databaseMysqli = new mysqli("localhost", "root", "root");

echo $databaseMysqli->affected_rows;  echo "<br>";
echo $databaseMysqli->client_info;    echo "<br>";
echo $databaseMysqli->connect_errno;  echo "<br>";
echo $databaseMysqli->server_info;    echo "<br>";
