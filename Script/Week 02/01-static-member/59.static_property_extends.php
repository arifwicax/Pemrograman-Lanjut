<?php
class Perangkat {
  public static $jumlahPerangkat = 100;
}

class Blender extends Perangkat {
}

echo Blender::$jumlahPerangkat;   // 100