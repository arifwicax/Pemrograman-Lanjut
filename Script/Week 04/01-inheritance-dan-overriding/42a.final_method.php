<?php
class Perangkat {
  final public function hello(){
    return "Ini dari Perangkat";
  }
}

class Monitor extends Perangkat {
  public function hello(){
     return "Ini dari Monitor";
   }
 }

// Fatal error: Cannot override final method Perangkat::hello()
