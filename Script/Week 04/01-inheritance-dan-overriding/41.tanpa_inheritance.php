<?php
class Monitor {
  public $jenis;
  public $jenama;
  public $stok;
  public $ukuranLayar;

  public function __construct($jenis, $jenama, $stok, $ukuranLayar){
    $this->jenis = $jenis;
    $this->merek = $jenama;
    $this->stok = $stok;
    $this->ukuranLayar = $ukuranLayar;
  }
}

$perangkat01 = new Monitor("Monitor","NusaTech",20,32);

echo "<pre>";
print_r ($perangkat01);
echo "</pre>";