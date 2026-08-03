<?php
update('inventaris',
      ['nama_inventaris' => 'Smartphone iPhone XR',
       'biaya_inventaris' => 17999000],
      ['id_inventaris','=',5]);

function update($namaTabel, $rekaman, $syarat){
  $perintahSql = "UPDATE {$namaTabel} SET ";
  foreach ($rekaman as $key => $val){
    $perintahSql .= "$key = ?, " ;
  }
  $perintahSql = substr($perintahSql,0,-2);
  $perintahSql .= " WHERE {$syarat[0]} {$syarat[1]} ?";
  echo $perintahSql;
}
