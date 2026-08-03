<?php 

$hasil = filter_var('test@', FILTER_VALIDATE_EMAIL);
var_dump($hasil);   // bool(false) 

$hasil = filter_var('test@co', FILTER_VALIDATE_EMAIL);
var_dump($hasil);   // bool(false) 

$hasil = filter_var('test@co.id$$', FILTER_VALIDATE_EMAIL);
var_dump($hasil);   // bool(false) 

$hasil = filter_var('test@co.id', FILTER_VALIDATE_EMAIL);
var_dump($hasil);   // test@co.id

$hasil = filter_var('test_4j4@hoho.id', FILTER_VALIDATE_EMAIL);
var_dump($hasil);   // test_4j4@hoho.id

$hasil = filter_var('a@a.a', FILTER_VALIDATE_EMAIL);
var_dump($hasil);   // a@a.a