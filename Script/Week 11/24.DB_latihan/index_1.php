<?php
require 'DB.php';
$DB = DB::getInstance();

// ======================================================
// 01. tambah 2 data ke tabel user

$result = $DB->insert('user',[
  'username' => 'alex',
  'password' => 'alex123',
  'email' => 'alexsaja@yahoo.com'
]);

if($result) {
  echo "Terdapat ".$DB->count()." data yang ditambah";
  // Terdapat 1 data yang ditambah
}

echo "<br>";

$result = $DB->insert('user',[
  'username' => 'rina',
  'password' => '123456',
  'email' => 'rinapunya@gmail.com'
]);

if($result) {
  echo "Terdapat ".$DB->count()." data yang ditambah";
  // Terdapat 1 data yang ditambah
}

echo "<hr>";

// ======================================================
// 02. tampilkan semua isi tabel user
$tabelUser = $DB->get('user');

foreach ($tabelUser as $user) {
  echo "$user->username | $user->password | $user->email <br>";
}

echo "<hr>";

// ======================================================
// 03. ambil kolom username dan email dari tabel user

$DB->select('username, email');
$tabelUser = $DB->get('user');

foreach ($tabelUser as $user) {
  echo "$user->username | $user->email <br>";
}

echo "<hr>";

// ======================================================
// 04. update email untuk user alex

$result = $DB->update('user',['email' => 'alex999@gmail.com'],
                     ['username','=','alex']);

if($result) {
  echo "Terdapat ".$DB->count()." data yang diupdate";
  // Terdapat 1 data yang diupdate
}

echo "<hr>";

// ======================================================
// 05. ambil data user alex
$tabelUser = $DB->getWhereOnce('user',['username','=','alex']);
echo "$user->username | $user->email <br>";

echo "<hr>";

// ======================================================
// 06. hapus user alex
$result = $DB->delete('user',['username','=','alex']);

if($result) {
  echo "Terdapat ".$DB->count()." data yang dihapus";
}
