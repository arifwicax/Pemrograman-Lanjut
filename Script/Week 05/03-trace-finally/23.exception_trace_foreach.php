<?php
function hitungKebalikan($bilangan){
  if ($bilangan === 0){
    throw new Exception('Argument tidak bisa diisi angka 0');
  }
  else if ($bilangan < 0){
    throw new Exception("Argument \$bilangan tidak bisa diisi angka negatif");
  }
  else {
    return 1/$bilangan;
  }
}

function bar($pembagi){
  return hitungKebalikan($pembagi);
}

try {
  echo bar(-10);
}
catch (Exception $e) {
  echo "Error: <b>".$e->getMessage()."</b><br>";

  echo "<br>Trace error: <br>";

  foreach ($e->getTrace() as $nilai) {
    echo "Baris ke-".$nilai["line"];
    echo ", error di function ".$nilai["function"];
    echo ", dengan argument ".$nilai["args"][0]."<br>";
  }
}
