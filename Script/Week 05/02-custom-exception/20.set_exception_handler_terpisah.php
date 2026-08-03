<?php
class NolException extends Exception{}
class NegatifException extends Exception{}

set_exception_handler('tampilkanError');

function tampilkanError($e) {
  echo "Terjadi error di baris ke-".$e->getTrace()[0]["line"].
       " dengan keterangan <b>".$e->getMessage()."</b><br>";
}

function hitungKebalikan($bilangan){
  if ($bilangan === 0){
    throw new NolException("Argument tidak bisa diisi angka 0");
  }
  else if ($bilangan < 0){
    throw new NegatifException("Argument tidak bisa diisi angka negatif");
  }
  else if (!is_numeric($bilangan)){
    throw new Exception('Argument yang diinput bukan angka');
  }
  else {
    return 1/$bilangan;
  }
}

try {
  echo hitungKebalikan('X');
}
catch (NolException $e) {
  echo $e->getMessage();
}
