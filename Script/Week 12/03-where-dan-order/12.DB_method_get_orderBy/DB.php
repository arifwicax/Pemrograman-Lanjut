<?php
class DB{

  // Property untuk koneksi ke database mysql
  private $_host = '127.0.0.1';
  private $_dbname = 'kampus_lanjut';
  private $_username = 'root';
  private $_password = '';

  // Property internal dari class DB
  private static $_instance = null;
  private $_pdo;
  private $_columnName = "*";
  private $_orderBy = "";

  // Constructor untuk pembuatan PDO Object        
  private function __construct(){
    try {
      $this->_pdo = new PDO('mysql:host='.$this->_host.';dbname='.$this->_dbname, 
                             $this->_username, $this->_password);
      $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
      die("Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")");
    }
  }

  // Singleton pattern untuk membuat class DB     
  public static function getInstance(){
    if(!isset(self::$_instance)) {
      self::$_instance = new DB();
    }
    return self::$_instance;
  }

  // Method dasar untuk menjalankan prepared statement query
  public function runQuery($perintahSql, $bindValue = []){
    try {
      $pernyataan = $this->_pdo->prepare($perintahSql);
      $pernyataan->execute($bindValue);
    } 
    catch (PDOException $e){
      die("Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")");
    }
    return $pernyataan;
  }

  // Method untuk menampilkan hasil query SELECT sebagai fetchAll (object)
  public function getQuery($perintahSql,$bindValue = []){
    return $this->runQuery($perintahSql,$bindValue)->fetchAll(PDO::FETCH_OBJ);
  }

  // Method untuk menentukan kolom yang akan ditampilkan
  public function select($namaKolom){
    $this->_columnName = $namaKolom;
    return $this;
  }

  // Method untuk menentukan urutan hasil tabel (query ORDER BY)
  public function orderBy($namaKolom, $arahUrut = 'ASC'){
    $this->_orderBy = "ORDER BY {$namaKolom} {$arahUrut}";
    return $this;
  }

  // Method utama untuk mengambil isi tabel
  public function get($namaTabel){
    $perintahSql = "SELECT {$this->_columnName} FROM {$namaTabel} {$this->_orderBy}";
    $this->_columnName = "*";
    $this->_orderBy = "";
    return $this->getQuery($perintahSql);
  }
}