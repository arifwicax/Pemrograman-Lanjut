<?php
insert('user',[
  'username' => 'Andi',
  'email' => 'andi@gmail.com',
  'umur' => 15,
  'sekolah' => 'SMA N 7 lumut ijo',
  'alamat' => 'Jl. Perintis no 9'
]);

function insert($namaTabel, $rekaman){
  $dataKeys = array_keys($rekaman);
  $dataValues = array_values($rekaman);
  $placeholder = '('.str_repeat('?,', count($rekaman)-1) . '?)';

  echo "INSERT INTO {$namaTabel} (".implode(', ',$dataKeys).") VALUES {$placeholder}";
  echo "<br>";
  print_r($dataValues);
}
