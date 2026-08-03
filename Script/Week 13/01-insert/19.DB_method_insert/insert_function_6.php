<?php
insert('inventaris',[
  'nama_inventaris' => 'Cosmos CRJ-8229 - Rice Cooker',
  'jumlah_inventaris' => 4,
  'biaya_inventaris' => 299000
]);

function insert($namaTabel, $rekaman){
  $dataKeys = array_keys($rekaman);
  $dataValues = array_values($rekaman);

  echo str_repeat('?,', count($rekaman));
}
