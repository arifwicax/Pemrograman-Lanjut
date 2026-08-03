<?php
class Perangkat {
  private static $jumlahPerangkat = 100;
  
  public static function cekProduk(){
    return "Total Perangkat ada ".self::$jumlahPerangkat;
  }
}

class Blender extends Perangkat {
  public function cekBlender(){
    return self::cekProduk(). ', termasuk 3 jenis Blender <br>';
  }
}

class HairDryer extends Perangkat {
  public function cekHairDryer(){
    return parent::cekProduk(). ', termasuk 5 jenis Hair Dryer <br>';
  }
}

class Mixer extends Perangkat {
  public function cekMixer(){
    return Perangkat::cekProduk(). ', termasuk 2 jenis Mixer <br>';
  }
}

$perangkat01 = new Blender();
echo $perangkat01->cekBlender();

$perangkat02 = new HairDryer();
echo $perangkat02->cekHairDryer();

$perangkat03 = new Mixer();
echo $perangkat03->cekMixer();