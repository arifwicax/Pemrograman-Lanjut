<?php
// Mendefinisikan class DB untuk mengatur koneksi ke basis data
class DB{

  // Mendefinisikan property untuk koneksi ke basis data mysql
  private $_host = 'localhost'; // Host basis data
  private $_dbname = 'kampus_lanjut'; // Nama basis data
  private $_username = 'root'; // Username basis data
  private $_password = 'root'; // Password basis data

  // Mendefinisikan property internal dari class DB
  private static $_instance = null; // Variabel statis untuk menyimpan instance DB
  private $_pdo; // Variabel untuk menyimpan koneksi PDO

  // Constructor untuk pembuatan PDO Object        
  private function __construct(){
    try {
      // Membuat koneksi PDO ke basis data
      $this->_pdo = new PDO('mysql:host='.$this->_host.';dbname='.$this->_dbname, 
                             $this->_username, $this->_password);
      // Mengatur atribut PDO untuk menampilkan error secara detail
      $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // Menampilkan pesan jika koneksi berhasil dibuat
      echo "Koneksi dibuat <br>";
    } catch (PDOException $e){
      // Menampilkan pesan error jika koneksi gagal dibuat
      die("Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")");
    }
  }

  // Singleton pattern untuk membuat class DB     
  public static function getInstance(){
    // Memeriksa apakah instance DB sudah ada
    if(!isset(self::$_instance)) {
      // Jika belum ada, maka membuat instance baru
      self::$_instance = new DB();
    }
    // Mengembalikan instance DB
    return self::$_instance;
  }

}