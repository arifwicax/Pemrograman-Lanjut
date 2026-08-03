<?php
class DB{

  // Property untuk koneksi ke database mysql
  private $_host = 'localhost'; // Hostname untuk koneksi ke database
  private $_dbname = 'kampus_lanjut'; // Nama basis data yang digunakan
  private $_username = 'root'; // Username untuk koneksi ke database
  private $_password = 'root'; // Password untuk koneksi ke database

  // Property internal dari class DB untuk mengatur koneksi PDO dan instance singleton
  private static $_instance = null; // Variabel statis untuk menyimpan instance singleton
  private $_pdo; // Variabel untuk menyimpan koneksi PDO

  // Constructor untuk pembuatan PDO Object dan mengatur koneksi ke database
  private function __construct(){
    try {
      // Membuat koneksi PDO ke database dengan menggunakan detail koneksi yang telah ditentukan
      $this->_pdo = new PDO('mysql:host='.$this->_host.';dbname='.$this->_dbname,
                             $this->_username, $this->_password);
      // Mengatur atribut PDO untuk menampilkan error secara eksplisit
      $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
      // Menangani error koneksi dengan menampilkan pesan error dan kode error
      die("Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")");
    }
  }

  // Singleton pattern untuk membuat class DB dan mengembalikan instance yang sama
  public static function getInstance(){
    // Jika instance belum ada, maka buat instance baru
    if(!isset(self::$_instance)) {
      self::$_instance = new DB();
    }
    // Mengembalikan instance yang telah dibuat atau yang telah ada
    return self::$_instance;
  }

  // Method dasar untuk menjalankan prepared statement query dengan parameter binding
  public function runQuery($perintahSql, $bindValue = []){
    try {
      // Menyiapkan query dengan parameter binding untuk mencegah SQL injection
      $pernyataan = $this->_pdo->prepare($perintahSql);
      // Menjalankan query dengan parameter yang telah ditentukan
      $pernyataan->execute($bindValue);
    }
    catch (PDOException $e){
      // Menangani error query dengan menampilkan pesan error dan kode error
      die("Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")");
    }
    // Mengembalikan statement yang telah dijalankan untuk digunakan dalam pengolahan data
    return $pernyataan;
  }

}
