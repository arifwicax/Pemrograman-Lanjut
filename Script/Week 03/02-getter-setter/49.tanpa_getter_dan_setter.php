<?php
class Perangkat {
  public $jenama;
  public $stok;
}

$perangkat01 = new Perangkat();
$perangkat01->merek = "BorneoSistem";    
$perangkat01->stok = 10;  

echo $perangkat01->merek;      // BorneoSistem
echo "<br>";
echo $perangkat01->stok;       // 10