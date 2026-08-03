<?php
class Input {
  
  // Mendapatkan data dari $_POST atau $_GET
  public static function get($elemen) {
    if (isset($_POST[$elemen])) {
      return trim($_POST[$elemen]);
    } elseif (isset($_GET[$elemen])) {
      return trim($_GET[$elemen]);
    }
    return null; // Mengembalikan null jika tidak ada data
  }

  // Membersihkan nilai berdasarkan tipe sanitasi yang diberikan
  public static function runSanitize($nilai, $sanitizeType) {
    $nilaiSanitasi = null;

    switch ($sanitizeType) {
      case 'string':
        $nilaiSanitasi = filter_var($nilai, FILTER_SANITIZE_SPECIAL_CHARS);
        break;
      case 'int':
        $nilaiSanitasi = filter_var($nilai, FILTER_SANITIZE_NUMBER_INT);
        break;
      case 'float':
        $nilaiSanitasi = filter_var($nilai, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        break;
      case 'email':
        $nilaiSanitasi = filter_var($nilai, FILTER_SANITIZE_EMAIL);
        break;
      case 'url':
        $nilaiSanitasi = filter_var($nilai, FILTER_SANITIZE_URL);
        break;
      default:
        throw new InvalidArgumentException("Sanitization type '$sanitizeType' not supported.");
    }

    return $nilaiSanitasi;
  }

  // Membuat elemen <option> dari array
  public static function generateOption($arr, $selectedValue = "") {
    $arrOption = [];

    foreach ($arr as $key => $nilai) {
      $selected = ($nilai == $selectedValue) ? ' selected' : '';
      $arrOption[] = "<option value=\"$nilai\"$selected>$nilai</option>";
    }

    return implode("\n", $arrOption); // Gabungkan dengan newline untuk output lebih rapi
  }
}
