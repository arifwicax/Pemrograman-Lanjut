<?php
class Perangkat {
  public $jenis;
  public $jenama;
  public $stok;

  public function __construct($bilangan, $pembagi, $c){
    $this->jenis = $bilangan;
    $this->merek = $pembagi;
    $this->stok = $c;
  }
}

$perangkat01 = new Perangkat("Monitor","NusaTech",20);
$perangkat02 = new Perangkat("Mesin cuci","LenteraTech", 10);

print_r ($perangkat01);
echo "<br>";
print_r ($perangkat02);