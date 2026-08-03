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

echo "Sebelum try... <br>";

try {
  echo hitungKebalikan(-10)."<br>";
}
catch (Exception $e) {
  echo "Terjadi error di baris ke-".$e->getTrace()[0]["line"].
  " dengan keterangan <b>".$e->getMessage()."</b><br>";
}
finally {
  echo "Di dalam finally... <br>";
}

echo "Setelah try... <br>";
