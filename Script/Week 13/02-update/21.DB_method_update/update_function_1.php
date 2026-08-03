<?php
update('inventaris',
      ['nama_inventaris' => 'Smartphone iPhone XR',
       'biaya_inventaris' => 17999000],
      ['id_inventaris','=',5]);

function update($namaTabel, $rekaman, $syarat){
  $perintahSql = "UPDATE {$namaTabel} SET ";
  foreach ($rekaman as $key => $val){  //data as key = hanya mengakses nilainya 
    $perintahSql .= "$key = ?, " ;        //data as key = value mengakses kuncinya /indeknya
  }
  echo $perintahSql;
}
