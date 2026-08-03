<?php
update('inventaris',
      ['nama_inventaris' => 'Smartphone iPhone XR',
       'biaya_inventaris' => 17999000],
      ['id_inventaris','=',5]);

function update($namaTabel, $rekaman, $syarat){
  $dataValues = array_values($rekaman);
  array_push($dataValues,$syarat[2]); //array_push() berguna untuk menambah 1 nilai baru ke dalam sebuah array. Nilai baru ini akan berada di posisi paling akhir:
  print_r($dataValues);
}
