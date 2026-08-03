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

function baz($pembagi){
  return bar($pembagi);
}

echo baz(-10);
