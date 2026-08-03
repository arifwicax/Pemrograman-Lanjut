<?php
require 'Input.php';
require 'Validate.php';

$error = [];

if (!empty($_POST)) {

  $validate = new Validate($_POST);

  $namaAkun = $validate->setRules('username','Username', [
    'sanitize' => 'string',
    'required' => true,
    'min_char' => 4,
  ]);

  $kataSandi = $validate->setRules('password','Password',[
    'sanitize' => 'string',
    'required' => true,
    'min_char' => 6,
  ]);

  $ulangi_password = $validate->setRules('ulangi_password','Ulangi password',[
    'sanitize' => 'string',
    'required' => true,
    'min_char' => 6,
  ]);

  $surel = $validate->setRules('email','Email',[
    'sanitize' => 'string',
    'required' => true,
  ]);


  if($validate->passed()) {
    echo "Lolos Validasi!";
  } else {
    $error = $validate->getError();
  }

}

?>
<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <title>Validation Class</title>
  </head>
  <style>
    .container {
      margin: 20px auto;
      width: 500px;
    }
    form > div {
      margin: 15px 0;
    }
    label {
      display:inline-block;
      width:130px;
    }
  </style>
  <body>
    <div class="container">
    <h2>Tambah User</h2>
    <div class="pesan-error">
      <ul>
        <?php
          foreach ($error as $nilai) {
            echo "<li>$nilai</li>";
          }
        ?>
      </ul>
    </div>
      <form method="post">
        <div>
          <label for="username">Username</label>
          <input type="text" name="username" value="<?php if (isset($namaAkun)) { echo $namaAkun; } ?>">
        </div>
        <div>
          <label for="password">Password</label>
          <input type="password" name="password">
        </div>
        <div>
          <label for="ulangi_password">Ulangi Password</label>
          <input type="password" name="ulangi_password">
        </div>
        <div>
          <label for="email">Email</label>
          <input type="text" name="email" value="<?php if (isset($surel)) { echo $surel; } ?>">
        </div>
        <div>
          <input type="submit" value="Submit">
        </div>
      </form>
    </div>
  </body>
</html>
