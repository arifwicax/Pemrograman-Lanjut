<?php
class Validate{
  private $_errors = array();
  private $_formMethod = null;

  public function __construct($formMethod){
    $this->_formMethod = $formMethod;
  }

  public function setRules($elemen, $labelField, $rules){
    $nilaiForm = $this->_formMethod[$elemen];

    // jalankan proses sanitize untuk setiap item (jika disyaratkan)
    if (array_key_exists('sanitize',$rules)) {
      $nilaiForm = Input::runSanitize($nilaiForm,$rules['sanitize']);
    }

    foreach ($rules as $rule => $nilaiAturan) {

      switch($rule) {

        case 'required':
          if ($nilaiAturan === TRUE && empty($nilaiForm)) {
            $this->_errors[$elemen] = "$labelField tidak boleh kosong";
          }
        break;

        case 'min_char' :
          if (strlen($nilaiForm) < $nilaiAturan) {
            $this->_errors[$elemen] = "$labelField minimal $nilaiAturan karakter";
          }
        break;
        
        case 'max_char' :
          if (strlen($nilaiForm) > $nilaiAturan) {
            $this->_errors[$elemen] = "$labelField maksimal $nilaiAturan karakter";
          }
        break;

        case 'numeric' :
          if ($nilaiAturan === TRUE && !is_numeric($nilaiForm)) {
            $this->_errors[$elemen] = "$labelField harus diisi angka";
          }
        break;

        case 'min_value' :
          if ($nilaiForm < $nilaiAturan) {
            $this->_errors[$elemen] = "$labelField minimal $nilaiAturan";
          }
        break;

        case 'max_value' :
          if ($nilaiForm > $nilaiAturan) {
            $this->_errors[$elemen] = "$labelField maksimal $nilaiAturan";
          }
        break;
      }

      // cek jika sudah ada error di item yang sama, langsung keluar dari looping
      if (!empty($this->_errors[$elemen])) {
        break;
      }  

    }
    // kembalikan nilai yang sudah lewat proses sanitize
    return $nilaiForm;
  }

  public function getError(){
    return $this->_errors;
  }
  
  public function passed(){
    return empty($this->_errors) ? true : false;
  }

}