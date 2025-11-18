<?php
$foo = [
  'nama_barang' => 'Cosmos CRJ-8229 - Rice Cooker',
  'jumlah_barang' => 4,
  'harga_barang' => 299000
];

$dataKeys = array_keys($foo);
$dataValues = array_values($foo);

print_r($dataKeys);
echo "<br>";
print_r($dataValues);
