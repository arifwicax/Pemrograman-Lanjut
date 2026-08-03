<?php
final class Perangkat {
  public function hello(){
    return "Ini dari Perangkat";
  }
}

class Monitor extends Perangkat {
 }

// Fatal error: Class Monitor may not inherit from final class (Perangkat) 
