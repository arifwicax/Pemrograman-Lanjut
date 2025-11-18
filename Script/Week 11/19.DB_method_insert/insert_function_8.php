<?php
insert('barang',[
  'nama_barang' => 'Cosmos CRJ-8229 - Rice Cooker',
  'jumlah_barang' => 4,
  'harga_barang' => 299000
]);

function insert($tableName, $data){
  $dataKeys = array_keys($data);
  $dataValues = array_values($data);
  $placeholder = '('.str_repeat('?,', count($data)-1) . '?)';

  echo "INSERT INTO {$tableName} (".implode(', ',$dataKeys).")
        VALUES {$placeholder}";
}
