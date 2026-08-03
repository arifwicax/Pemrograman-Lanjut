<?php
class Perangkat {
  public static $kursSGD = 11000;
  public const KURSUSD = 15000;
}

Perangkat::$kursSGD = 12000;
echo Perangkat::$kursSGD;   // 12000 

Perangkat::KURSUSD = 16000;  // // Parse error: syntax error, unexpected '='
echo Perangkat::KURSUSD;   
