<?php
update('barang',
      ['nama_barang' => 'Smartphone iPhone XR',
       'harga_barang' => 17999000],
      ['id_barang','=',5]);

function update($tableName, $data, $condition){
  $dataValues = array_values($data);
  array_push($dataValues,$condition[2]);
  print_r($dataValues);
}
