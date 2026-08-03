<?php
insert('inventaris',[
  'nama_inventaris' => 'Cosmos CRJ-8229 - Rice Cooker',
  'jumlah_inventaris' => 4,
  'biaya_inventaris' => 299000
]);

function insert($namaTabel, $rekaman){
  $dataKeys = array_keys($rekaman);
  $dataValues = array_values($rekaman);

  print_r($dataKeys);
  echo "<br>";
  print_r($dataValues);
}

// $perintahSql = 'INSERT INTO inventaris (nama_inventaris, jumlah_inventaris, biaya_inventaris)
//           VALUES (?,?,?)';
// $arr = ['Cosmos CRJ-8229 - Rice Cooker',4,299000];
