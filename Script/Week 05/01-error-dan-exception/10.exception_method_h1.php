<?php
function hitungKebalikan($bilangan){
  if ($bilangan === 0){
    throw new Exception("Argument \$bilangan tidak bisa diisi angka 0");
  }
  else {
    return 1/$bilangan;
  }
}

try {
  echo hitungKebalikan(0);
}
catch (Exception $e) {
  echo "<h1 style='text-align:center'>=== Error ===</h1>";
  echo "<hr>";
  echo "<h2 style='text-align:center'>".$e->getMessage()."</h2>";
  echo "<p style='text-align:center'> Baris ke-".$e->getTrace()[0]["line"].
       ", di dalam ".$e->getTrace()[0]["file"]."</p>";
}
