<?php 

$hasil = preg_match("/^[A-Za-z]{6,}$/", "aNto");
var_dump($hasil);   // int(0)  

$hasil = preg_match("/^[A-Za-z]{6,}$/", "aNto99");
var_dump($hasil);   // int(0) 

$hasil = preg_match("/^[A-Za-z]{6,}$/", "aNtoni");
var_dump($hasil);   // int(1) 

$hasil = preg_match("/^[A-Za-z]{6,}$/", "Budiansyah");
var_dump($hasil);   // int(1) 
