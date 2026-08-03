<?php
// Mendefinisikan class DB untuk mengatur basis data
class DB{

  // Mendefinisikan property untuk koneksi ke database mysql
  private $_host = 'localhost'; // Alamat IP untuk koneksi ke basis data
  private $_dbname = 'kampus_lanjut'; // Nama basis data yang akan digunakan
  private $_username = 'root'; // Username untuk koneksi ke basis data
  private $_password = 'root'; // Password untuk koneksi ke basis data

  // Mendefinisikan property internal dari class DB untuk menyimpan koneksi PDO
  private $_pdo;

  // Constructor untuk pembuatan PDO Object dan mengatur koneksi ke basis data
  public function __construct(){
    try {
      // Membuat koneksi ke basis data menggunakan PDO
      $this->_pdo = new PDO('mysql:host='.$this->_host.';dbname='.$this->_dbname,
                             $this->_username, $this->_password);
      // Mengatur atribut PDO untuk menampilkan error secara detail
      $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
      // Menangani error yang terjadi saat koneksi atau query ke basis data
      die("Koneksi / Query bermasalah: ".$e->getMessage().
          " (".$e->getCode().")");
    }
  }

}
