<?php
update('barang',
      ['nama_barang' => 'Smartphone iPhone XR',
       'harga_barang' => 17999000],
      ['id_barang','=',5]);

function update($tableName, $data, $condition){
  $query = "UPDATE {$tableName} SET ";
  foreach ($data as $key => $val){
    $query .= "$key = ?, " ;
  }
  $query = substr($query,0,-2);
  $query .= " WHERE {$condition[0]} {$condition[1]} ?";
  echo $query;
}
