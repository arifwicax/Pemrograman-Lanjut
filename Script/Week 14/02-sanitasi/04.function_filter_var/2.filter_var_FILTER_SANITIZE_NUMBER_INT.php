<?php

echo filter_var(12, FILTER_SANITIZE_NUMBER_INT)."<br>";
//12

echo filter_var(12.45, FILTER_SANITIZE_NUMBER_INT)."<br>";
//1245

echo filter_var("KelasKode", FILTER_SANITIZE_NUMBER_INT)."<br>";
//

echo filter_var("99FooBar9", FILTER_SANITIZE_NUMBER_INT)."<br>";
//999
