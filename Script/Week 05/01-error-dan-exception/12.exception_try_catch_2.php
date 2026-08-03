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
  echo hitungKebalikan(2)    ."<br>";
  echo hitungKebalikan(100)  ."<br>";
  echo hitungKebalikan(0)    ."<br>";
  echo hitungKebalikan(-20)  ."<br>";
}
catch (Exception $e) {
  echo "Terjadi error di baris ke-".$e->getTrace()[0]["line"].
  " dengan keterangan <b>".$e->getMessage()."</b><br>";
}

echo "Selesai";
