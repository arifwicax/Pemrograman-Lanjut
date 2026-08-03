<?php
class Perangkat {  }

interface SmartElectronic{
  public function cekOS();
}

trait LowWatt{
  public function efisiensi(){
    return "Konsumsi daya 0.8";
  }
}

class Monitor extends Perangkat implements SmartElectronic{
  use LowWatt;
  public function cekOS(){
    return "Android 9.0 (Pie)";
  }
}

$perangkat01 = new Monitor();

echo var_dump($perangkat01 instanceof Perangkat)."<br>";
echo var_dump($perangkat01 instanceof Monitor)."<br>";
echo var_dump($perangkat01 instanceof SmartElectronic)."<br>";
echo var_dump($perangkat01 instanceof LowWatt)."<br>";
echo var_dump($perangkat01 instanceof Smartphone)."<br>";
