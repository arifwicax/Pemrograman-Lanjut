<?php

include("connection.php");

if(isset($_POST['submit'])){

        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";

    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['no_tlp'];
    $password = $_POST['password'];

    $query = "INSERT INTO tb_crud (nama, email, no_telp, password) VALUES ";
    $query .= "('$nama', '$email', '$telepon', '$password')";
    $result = mysqli_query($link, $query);
    if(!$result){
        die ("Query Error : ".mysqli_errno($link).
        " - ".mysqli_error($link));
    }
    else{
        // echo "Tabel 'tb_crud' berhasil ditambah..";
        header('Location: tampil.php');
    }

}


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="container">

        <form action="tambah.php" method="POST">
            <div class="mb-3">
                <label for="exampleInputNama1" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" id="exampleInputNama1"
                placeholder="Enter Your Name">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                placeholder="Enter Your Email">
            </div>
            <div class="mb-3">
                <label for="exampleInputTlp1" class="form-label">Nomor Telepon</label>
                <input type="text" name="no_tlp" class="form-control" id="exampleInputTlp1"
                placeholder="Enter Your Number Telepon">
            </div>
            <div class="mb-3">
                <label for="exampleInputPass1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPass1"
                placeholder="Enter Your Password">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</body>

</html>