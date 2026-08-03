<?php
class Monitor {
  public function cekResolusi(){
    return "Full HD";
  }
}

class Smartphone{
  public function cekOS(){
    return "Android 9.0 (Pie)";
  }
}

class SmartTV extends Monitor, Smartphone{
}

// Parse error: syntax error, unexpected ',', expecting '{'