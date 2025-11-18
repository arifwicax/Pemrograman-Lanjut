<?php
insert('barang',[
  'nama_barang' => 'Cosmos CRJ-8229 - Rice Cooker',
  'jumlah_barang' => 4,
  'harga_barang' => 299000
]);

function insert($tableName, $data){
  $dataKeys = array_keys($data);
  $dataValues = array_values($data);

  print_r($dataKeys);
  echo "<br>";
  print_r($dataValues);
}

// $query = 'INSERT INTO barang (nama_barang, jumlah_barang, harga_barang)
//           VALUES (?,?,?)';
// $arr = ['Cosmos CRJ-8229 - Rice Cooker',4,299000];
