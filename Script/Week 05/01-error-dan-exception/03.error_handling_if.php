<?php
function hitungKebalikan($bilangan){
  if ($bilangan === 0){
    echo "Error: Argument \$bilangan tidak bisa diisi angka 0";
  }
  else {
    return 1/$bilangan;
  }
}

echo hitungKebalikan(2);      echo "<br>";
echo hitungKebalikan(100);    echo "<br>";
echo hitungKebalikan(0);      echo "<br>";
echo hitungKebalikan(-20);    echo "<br>";
