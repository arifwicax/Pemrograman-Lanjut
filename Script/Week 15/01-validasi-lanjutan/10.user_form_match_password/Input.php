<?php
class Input{

  public static function get($elemen) {
    if (isset($_POST[$elemen])) {
      return trim($_POST[$elemen]);
    } 
    else if (isset($_GET[$elemen])) {
      return trim($_GET[$elemen]);
    }
    return '';
  }

  public static function runSanitize($nilai,$sanitizeType){
    switch($sanitizeType) {
      case 'string':
        $nilaiSanitasi = filter_var($nilai, FILTER_SANITIZE_SPECIAL_CHARS);
      break;
      case 'int':
        $nilaiSanitasi = filter_var($nilai, FILTER_SANITIZE_NUMBER_INT);
      break;
      case 'float':
        $nilaiSanitasi = filter_var($nilai, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
      break;
      case 'email':
        $nilaiSanitasi = filter_var($nilai, FILTER_SANITIZE_EMAIL);
      break;
      case 'url':
        $nilaiSanitasi = filter_var($nilai, FILTER_SANITIZE_URL);
      break;
    }
    return $nilaiSanitasi;
  }


}