<?php
class Perangkat {
  var $jenama;

  public function hello(){
    return "Ini adalah Perangkat";
  }
}

$perangkat01 = new Perangkat();
$perangkat01->merek = "MerapiKomputasi";

echo $perangkat01->merek;         // MerapiKomputasi
echo "<br>";
echo $perangkat01->hello();       // Ini adalah Perangkat
