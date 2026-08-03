<?php
class Perangkat {
  public const KURSUSD = 15000;
}

$perangkat01 = new Perangkat(); 
echo $perangkat01->KURSUSD;   // Notice: Undefined property: Perangkat::$KURSUSD