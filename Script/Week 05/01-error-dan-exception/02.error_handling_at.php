<?php
function hitungKebalikan($bilangan){
  return 1/$bilangan;
}

echo hitungKebalikan(2);      echo "<br>";
echo hitungKebalikan(100);    echo "<br>";
echo @hitungKebalikan(0);     echo "<br>";
echo hitungKebalikan(-20);    echo "<br>";