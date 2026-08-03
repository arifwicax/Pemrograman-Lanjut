<?php
spl_autoload_register(function ($namaClass) {
  $path = "class/{$namaClass}.php";
  if (file_exists($path)) {
    require $path;
  } else {
    die ("File $path tidak tersedia");
  }
});

