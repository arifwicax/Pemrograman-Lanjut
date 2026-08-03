<?php
class Input{

  public static function get($elemen) { //sungsang
    if (isset($_POST[$elemen])) {
      return trim($_POST[$elemen]);
    } 
    else if (isset($_GET[$elemen])) {
      return trim($_GET[$elemen]);
    }
    return '';
  }

}
