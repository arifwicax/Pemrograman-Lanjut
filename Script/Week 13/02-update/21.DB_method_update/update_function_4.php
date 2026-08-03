<?php
update('inventaris',
      ['nama_inventaris' => 'Smartphone iPhone XR',
       'biaya_inventaris' => 17999000],
      ['id_inventaris','=',5]);

function update($namaTabel, $rekaman, $syarat){
  print_r($rekaman);
  echo "<br>";
  print_r($syarat);
}
