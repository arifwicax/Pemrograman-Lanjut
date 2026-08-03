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
  echo "Terjadi error dalam file <b>".$e->getTrace()[0]["file"]."</b>,
       di baris ke-".$e->getTrace()[0]["line"]." dengan keterangan <b>".
       $e->getMessage()."</b>.";
}
