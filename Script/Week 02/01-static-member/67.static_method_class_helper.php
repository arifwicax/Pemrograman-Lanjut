<?php
class ProdukHelper {
  public static function cekValidKodeProduk($kodeProduk){
    return preg_match("/^[A-Z]{3}[0-9]{3}$/",$kodeProduk);
  }

  public static function cekValidMerek($merek){
    $semuaMerek=["NusaTech","LenteraTech","CakraDigital","Philips","SagaraElektronik","Sanken"];
    return in_array($merek,$semuaMerek);
  }
}

if (ProdukHelper::cekValidKodeProduk("AAA545")) {
  echo "Merek AAA545 valid <br>";
}

if (ProdukHelper::cekValidKodeProduk("AAa545")) {
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
