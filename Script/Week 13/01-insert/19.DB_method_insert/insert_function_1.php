<?php
$hitungKebalikan = [
  'nama_inventaris' => 'Cosmos CRJ-8229 - Rice Cooker',
  'jumlah_inventaris' => 4,
  'biaya_inventaris' => 299000
];

$dataKeys = array_keys($hitungKebalikan);
$dataValues = array_values($hitungKebalikan);

print_r($dataKeys);
echo "<br>";
print_r($dataValues);
