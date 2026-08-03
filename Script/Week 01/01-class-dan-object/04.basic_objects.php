<?php
class Perangkat {
  
}

$monitor  = new Perangkat();
$mesinCuci = new Perangkat();
$speaker   = new Perangkat();

var_dump($monitor);    //  object(Perangkat)#1 (0) { }
echo "<br>";
var_dump($mesinCuci);   //  object(Perangkat)#2 (0) { }
echo "<br>";
var_dump($speaker);     //  object(Perangkat)#3 (0) { } 