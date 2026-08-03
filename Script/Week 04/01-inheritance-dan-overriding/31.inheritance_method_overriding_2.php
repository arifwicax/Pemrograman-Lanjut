<?php
class Perangkat {
  public function hello(){
    return "Ini dari Perangkat";
  }
}

class Monitor extends Perangkat {
  public function hello(){
    return "Ini dari Monitor";
  }

  public function helloProduk(){
    return parent::hello();
  }
}

$perangkat01 = new Monitor();
echo $perangkat01->helloProduk();     // Ini dari Perangkat