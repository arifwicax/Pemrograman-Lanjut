<?php
class NolException extends Exception{}
class NegatifException extends Exception{}

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
  echo "Argument tidak bisa diisi angka 0 <br>";
}
catch (NegatifException $e) {
  echo "Argument tidak bisa diisi angka negatif <br>";
}

try {
  echo hitungKebalikan(-20);
}
catch (NolException $e) {
  echo "Argument tidak bisa diisi angka 0 <br>";
}
catch (NegatifException $e) {
  echo "Argument tidak bisa diisi angka negatif <br>";
}
