<?php
class ProdukHelper {
  public static function cekValidSKU($sku){
    return preg_match("/^[A-Z]{3}[0-9]{3}$/",$sku);
  }

  public static function cekValidMerek($jenama){
    $semuaMerek=["NusaTech","LenteraTech","CakraDigital","Philips","SagaraElektronik","Sanken"];
    return in_array($jenama,$semuaMerek);
  }
}

if (ProdukHelper::cekValidSKU("AAA545")) {
  echo "Merek AAA545 valid <br>";
}

if (ProdukHelper::cekValidSKU("AAa545")) {
  echo "Merek AAa545 valid <br>";
}

if (ProdukHelper::cekValidMerek("SagaraElektronik")) {
  echo "Merek SagaraElektronik tersedia <br>";
}

if (ProdukHelper::cekValidMerek("NusaTech")) {
  echo "Merek NusaTech tersedia <br>";
}

if (ProdukHelper::cekValidMerek("MerapiKomputasi")) {
  echo "Merek MerapiKomputasi tersedia <br>";
}
