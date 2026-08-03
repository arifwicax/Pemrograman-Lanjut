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
}

$perangkat01 = new Monitor();
echo $perangkat01->hello();
