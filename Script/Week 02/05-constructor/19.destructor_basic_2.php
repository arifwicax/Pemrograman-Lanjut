<?php
class Perangkat {

  public function __construct(){
    echo "Constructor dijalankan... <br>";
  }

  public function __destruct(){
    echo "Destructor dijalankan... <br>";
  }

}

$perangkat01 = new Perangkat();
$perangkat01 = null;

echo "Program selesai <br>";