<?php
function hitungKebalikan($bilangan){
  if ($bilangan === 0){
    throw new Exception("Argument \$bilangan tidak bisa diisi angka 0",99);
  }
  else {
    return 1/$bilangan;
  }
}

try {
  echo hitungKebalikan(0);
}
catch (Exception $e) {
  echo $e->getMessage()       ."<br>";
  echo $e->getCode()          ."<br>";
  echo $e->getFile()          ."<br>";
  echo $e->getLine()          ."<br>";
  echo $e->getTraceAsString() ."<br>";

  echo "<pre>";
  print_r( $e->getTrace() );
  echo "</pre>";
}
