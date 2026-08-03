<?php
function hitungKebalikan($bilangan){
  if ($bilangan === 0){
    throw new Exception('Argument tidak bisa diisi angka 0');
  }
  else {
    return 1/$bilangan;
  }
}

function bar($pembagi){
  return hitungKebalikan($pembagi);
}

try {
  echo bar(0); 
}
catch (Exception $e) {
  echo "Terjadi error di baris ke-".$e->getTrace()[0]["line"].
  " dengan keterangan <b>".$e->getMessage()."</b><br>";

  echo "<pre>";
  print_r( $e->getTrace() );
  echo "</pre>";
}
