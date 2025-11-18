<?php
class DB{

  // Property untuk koneksi ke database mysql
  private $_host = '127.0.0.1';
  private $_dbname = 'ilkoom';
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
  public function runQuery($query, $bindValue = []){
    try {
      $stmt = $this->_pdo->prepare($query);
      $stmt->execute($bindValue);
    }
    catch (PDOException $e){
      die("Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")");
    }
    return $stmt;
  }

  // Method untuk menampilkan hasil query SELECT sebagai fetchAll (object)
  public function getQuery($query,$bindValue = []){
    return $this->runQuery($query,$bindValue)->fetchAll(PDO::FETCH_OBJ);
  }

  // Method untuk menentukan kolom yang akan ditampilkan
  public function select($columnName){
    $this->_columnName = $columnName;
    return $this;
  }

  // Method untuk menentukan urutan hasil tabel (query ORDER BY)
  public function orderBy($columnName, $sortType = 'ASC'){
    $this->_orderBy = "ORDER BY {$columnName} {$sortType}";
    return $this;
  }

  // Method utama untuk mengambil isi tabel
  public function get($tableName, $condition = "", $bindValue = []){
    $query = "SELECT {$this->_columnName} FROM {$tableName} {$condition} {$this->_orderBy}";
    $this->_columnName = "*";
    $this->_orderBy = "";
    return $this->getQuery($query, $bindValue);
  }

  // Method untuk mengambil isi tabel dengan kondisi WHERE
  public function getWhere($tableName, $condition){
    $queryCondition ="WHERE {$condition[0]} {$condition[1]} ? ";
    return $this->get($tableName,$queryCondition,[$condition[2]]);
  }

  // Method untuk mengambil isi tabel dengan kondisi WHERE dan hanya baris pertama saja
  public function getWhereOnce($tableName, $condition){
    $result = $this->getWhere($tableName,$condition);
    if (!empty($result)) {
      return $result[0];
    } else {
      return false;
    }
  }

  // Method untuk mengambil isi tabel dengan pencarian (query LIKE)
  public function getLike($tableName, $columnLike, $search){
    $queryLike = "WHERE {$columnLike} LIKE ?";
    return $this->get($tableName,$queryLike,[$search]);
  }
}
