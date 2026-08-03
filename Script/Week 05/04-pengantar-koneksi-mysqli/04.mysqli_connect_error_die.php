<?php
$databaseMysqli = new mysqli("localhost", "root", "x");

if ($databaseMysqli->connect_error) {
  die('Koneksi bermasalah (' . $databaseMysqli->connect_errno . ') '
          . $databaseMysqli->connect_error);
}

echo "Jalankan query MySQL...";
