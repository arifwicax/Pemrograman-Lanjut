<?php
class NolException extends Exception{
  public function pesanKesalahan(){
    return "Argument tidak bisa diisi angka 0, di baris "
            .$this->getTrace()[0]["line"] ." <br>";
  }
}

class NegatifException extends Exception{
  public function pesanKesalahan(){
    return "Argument tidak bisa diisi angka negatif, di baris "
           .$this->getTrace()[0]["line"] ." <br>";
  }
}

function hitungKebalikan($bilangan){
  if ($bilangan === 0){
    throw new NolException();
  }
  else if ($bilangan < 0){
    throw new NegatifException();
  }
  else {
    return 1/$bilangan;
  }
}

try {
  echo hitungKebalikan(0);
}
catch (NolException $e) {
  echo $e->pesanKesalahan();
}
catch (NegatifException $e) {
  echo $e->pesanKesalahan();
}

try {
  echo hitungKebalikan(-20);
}
catch (NolException $e) {
  echo $e->pesanKesalahan();
}
catch (NegatifException $e) {
  echo $e->pesanKesalahan();
}
