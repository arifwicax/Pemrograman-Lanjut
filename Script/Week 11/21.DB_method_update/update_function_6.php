<?php
update('user',[
       'username' => 'Andi',
       'email' => 'andi@gmail.com',
       'umur' => 15,
       'sekolah' => 'SMA N 7 lumut ijo',
       'alamat' => 'Jl. Perintis no 9'],
      ['id_user','=',85]);

function update($tableName, $data, $condition){
  $query = "UPDATE {$tableName} SET ";
  foreach ($data as $key => $val){
    $query .= "$key = ?, " ;
  }
  $query = substr($query,0,-2);
  $query .= " WHERE {$condition[0]} {$condition[1]} ?";

  $dataValues = array_values($data);
  array_push($dataValues,$condition[2]);

  echo $query;
  echo "<pre>";
  print_r($dataValues);
  echo "<pre>";
}
