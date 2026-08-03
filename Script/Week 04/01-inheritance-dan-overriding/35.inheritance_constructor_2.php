<?php
class Perangkat {
  public $jenis;
  public $jenama;
  public $stok;

  public function __construct($jenis, $jenama, $stok){
    $this->jenis = $jenis;
    $this->merek = $jenama;
    $this->stok = $stok;
  }
}

class Monitor extends Perangkat {
}

$perangkat01 = new Monitor("Monitor","NusaTech",20);

echo "<pre>";
print_r ($perangkat01);
echo "</pre>";