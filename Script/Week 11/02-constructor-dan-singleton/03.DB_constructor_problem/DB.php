<?php
class DB{

  // Property untuk koneksi ke database mysql
  private $_host = 'localhost';
  private $_dbname = 'kampus_lanjut';
  private $_username = 'root';
  private $_password = 'root';

  // Property internal dari class DB
  private $_pdo;

  // Constructor untuk pembuatan PDO Object        
  public function __construct(){
    try {
      $this->_pdo = new PDO('mysql:host='.$this->_host.';dbname='.$this->_dbname, 
                             $this->_username, $this->_password);
      $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Koneksi dibuat <br>";
    } catch (PDOException $e){
      die("Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")");
    }
  }

}