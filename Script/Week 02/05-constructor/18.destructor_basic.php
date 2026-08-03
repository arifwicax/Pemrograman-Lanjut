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
$perangkat02 = new Perangkat();