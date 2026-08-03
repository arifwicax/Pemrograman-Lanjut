<?php
class Perangkat {
  public $jenis;
  public $jenama;
  public $stok;
}

$perangkat01 = new Perangkat();
$perangkat01->jenis = "Monitor";
$perangkat01->merek = "NusaTech";
$perangkat01->stok = 20;

$perangkat02 = new Perangkat();
$perangkat02->jenis = "Mesin cuci";
$perangkat02->merek = "LenteraTech";
$perangkat02->stok = 10;

print_r ($perangkat01);
echo "<br>";
print_r ($perangkat02);