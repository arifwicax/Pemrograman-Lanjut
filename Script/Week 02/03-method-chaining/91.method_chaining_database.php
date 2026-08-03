<?php

class DisplayDatabase {
  private $perintahSql;

  public function select($column){
    $this->query = "SELECT $column ";
    return $this;
  }
  public function from($table){
    $this->query .= "FROM $table ";
    return $this;
  }
  public function where($syarat){
    $this->query .= "WHERE $syarat";
    return $this;
  }

  public function getQuery(){
    return $this->query;
  }

}

$mahasiswa01 = new DisplayDatabase();
$mahasiswa01->select("nim, nama")->from("mahasiswa")->where("nim='13012012'");
echo $mahasiswa01->getQuery();  
// SELECT nim, nama FROM mahasiswa WHERE nim = '13012012'
