<?php
try {
  $databaseMysqli = new mysqli("localhost", "root", "root");

  if ($databaseMysqli->connect_error) {
    throw new Exception('Koneksi bermasalah (' . $databaseMysqli->connect_errno . ') '
            . $databaseMysqli->connect_error);
  }
  echo "Jalankan query MySQL...";
}
catch (Exception $e) {
  echo $e->getMessage();
}

