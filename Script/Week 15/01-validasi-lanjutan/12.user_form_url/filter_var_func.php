<?php 

$hasil = filter_var('kelasprogram', FILTER_VALIDATE_URL);
var_dump($hasil);   // bool(false) 

$hasil = filter_var('kelasprogram.id', FILTER_VALIDATE_URL);
var_dump($hasil);   // bool(false) 

$hasil = filter_var('www.kelasprogram.id', FILTER_VALIDATE_URL);
var_dump($hasil);   // bool(false) 

$hasil = filter_var('http://kelasprogram.id', FILTER_VALIDATE_URL);
var_dump($hasil);   // http://kelasprogram.id

$hasil = filter_var('https://www.kelasprogram.id', FILTER_VALIDATE_URL);
var_dump($hasil);   // https://www.kelasprogram.id

$hasil = filter_var('https://www.kelasprogram.id?s=php&u=admin', FILTER_VALIDATE_URL);
var_dump($hasil);   // 'https://www.kelasprogram.id?s=php&u=admin'
