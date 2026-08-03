<?php
update('user',[
       'username' => 'Andi',
       'email' => 'andi@gmail.com',
       'umur' => 15,
       'sekolah' => 'SMA N 7 lumut ijo',
       'alamat' => 'Jl. Perintis no 9'],
      ['id_user','=',85]);

function update($namaTabel, $rekaman, $syarat){
  $perintahSql = "UPDATE {$namaTabel} SET ";
  foreach ($rekaman as $key => $val){
    $perintahSql .= "$key = ?, " ;
  }
  $perintahSql = substr($perintahSql,0,-2);
  $perintahSql .= " WHERE {$syarat[0]} {$syarat[1]} ?";

  $dataValues = array_values($rekaman);
  array_push($dataValues,$syarat[2]);

  echo $perintahSql;
  echo "<pre>";
  print_r($dataValues);
  echo "<pre>";
}
