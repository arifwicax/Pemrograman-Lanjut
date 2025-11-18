<?php
  // periksa apakah user sudah login, cek kehadiran session name
  // jika tidak ada, redirect ke login.php
  session_start();
  if (!isset($_SESSION["nama"])) {
     header("Location: login.php");
  }

  // buka koneksi dengan MySQL
  include("connection.php");

  // cek apakah form telah di submit
  if (isset($_POST["submit"])) {
    // form telah disubmit, cek apakah berasal dari edit_mahasiswa.php
    // atau update data dari form_edit.php

    if ($_POST["submit"]=="Edit") {
      //nilai form berasal dari halaman edit_mahasiswa.php

      // ambil nilai nim
      $nim = htmlentities(strip_tags(trim($_POST["nim"])));
      // filter data
      $nim = mysqli_real_escape_string($link,$nim);

      // ambil semua data dari database untuk menjadi nilai awal form
      $query = "SELECT * FROM mahasiswa WHERE nim='$nim'";
      $result = mysqli_query($link, $query);

      if(!$result){
        die ("Query Error: ".mysqli_errno($link).
             " - ".mysqli_error($link));
      }

      // tidak perlu pakai perulangan while, karena hanya ada 1 record
      $data = mysqli_fetch_assoc($result);

      $nama         = $data["nama"];
      $tempat_lahir = $data["tempat_lahir"];
      $fakultas     = $data["fakultas"];
      $jurusan      = $data["jurusan"];
      $ipk          = $data["ipk"];

      // untuk tanggal harus dipecah
      $tgl = substr($data["tanggal_lahir"],8,2);
      $bln = substr($data["tanggal_lahir"],5,2);
      $thn = substr($data["tanggal_lahir"],0,4);

    // bebaskan memory
    mysqli_free_result($result);
    }

    else if ($_POST["submit"]=="Update Data") {
      // nilai form berasal dari halaman form_edit.php
      // ambil semua nilai form
      $nim          = htmlentities(strip_tags(trim($_POST["nim"])));
      $nama         = htmlentities(strip_tags(trim($_POST["nama"])));
      $tempat_lahir = htmlentities(strip_tags(trim($_POST["tempat_lahir"])));
      $fakultas     = htmlentities(strip_tags(trim($_POST["fakultas"])));
      $jurusan      = htmlentities(strip_tags(trim($_POST["jurusan"])));
      $ipk          = htmlentities(strip_tags(trim($_POST["ipk"])));
      $tgl          = htmlentities(strip_tags(trim($_POST["tgl"])));
      $bln          = htmlentities(strip_tags(trim($_POST["bln"])));
      $thn          = htmlentities(strip_tags(trim($_POST["thn"])));
    }

    // proses validasi form
    // siapkan variabel untuk menampung pesan error
    $pesan_error="";

    // cek apakah "nim" sudah diisi atau tidak
    if (empty($nim)) {
      $pesan_error .= "NIM belum diisi <br>";
    }
   // NIM harus angka dengan 8 digit
    elseif (!preg_match("/^[0-9]{8}$/",$nim) ) {
      $pesan_error .= "NIM harus berupa 8 digit angka <br>";
    }

    // cek apakah "nama" sudah diisi atau tidak
    if (empty($nama)) {
      $pesan_error .= "Nama belum diisi <br>";
    }

    // cek apakah "tempat lahir" sudah diisi atau tidak
    if (empty($tempat_lahir)) {
      $pesan_error .= "Tempat lahir belum diisi <br>";
    }

    // cek apakah "jurusan" sudah diisi atau tidak
    if (empty($jurusan)) {
      $pesan_error .= "Jurusan belum diisi <br>";
    }

    // siapkan variabel untuk menggenerate pilihan fakultas
    $select_kedokteran=""; $select_fmipa=""; $select_ekonomi="";
    $select_teknik=""; $select_sastra=""; $select_fasilkom="";

    switch($fakultas) {
     case "Kedokteran" : $select_kedokteran = "selected";  break;
     case "FMIPA"      : $select_fmipa      = "selected";  break;
     case "Ekonomi"    : $select_ekonomi    = "selected";  break;
     case "Teknik"     : $select_teknik     = "selected";  break;
     case "Sastra"     : $select_sastra     = "selected";  break;
     case "FASILKOM"   : $select_mysql      = "selected";  break;
    }


    // IPK harus berupa angka dan tidak boleh negatif
    if (!is_numeric($ipk) OR ($ipk <=0)) {
      $pesan_error .= "IPK harus diisi dengan angka";
    }

    // jika tidak ada error, input ke database
    if (($pesan_error === "") AND ($_POST["submit"]=="Update Data")) {

      // buka koneksi dengan MySQL
      include("connection.php");

      // filter semua data
      $nim          = mysqli_real_escape_string($link,$nim);
      $nama         = mysqli_real_escape_string($link,$nama );
      $tempat_lahir = mysqli_real_escape_string($link,$tempat_lahir);
      $fakultas     = mysqli_real_escape_string($link,$fakultas);
      $jurusan      = mysqli_real_escape_string($link,$jurusan);
      $tgl          = mysqli_real_escape_string($link,$tgl);
      $bln          = mysqli_real_escape_string($link,$bln);
      $thn          = mysqli_real_escape_string($link,$thn);
      $ipk          = (float) $ipk;

      //gabungkan format tanggal agar sesuai dengan date MySQL
      $tgl_lhr = $thn."-".$bln."-".$tgl;

      //buat dan jalankan query UPDATE
      $query  = "UPDATE mahasiswa SET ";
      $query .= "nama = '$nama', tempat_lahir = '$tempat_lahir', ";
      $query .= "tanggal_lahir = '$tgl_lhr', fakultas='$fakultas', ";
      $query .= "jurusan = '$jurusan', ipk=$ipk ";
      $query .= "WHERE nim = '$nim'";

      $result = mysqli_query($link, $query);

      //periksa hasil query
      if($result) {
      // INSERT berhasil, redirect ke tampil_mahasiswa.php + pesan
        $pesan = "Mahasiswa dengan nama = \"<b>$nama</b>\" sudah berhasil di update";
        $pesan = urlencode($pesan);
        header("Location: tampil_mahasiswa.php?pesan={$pesan}");
      }
      else {
      die ("Query gagal dijalankan: ".mysqli_errno($link).
           " - ".mysqli_error($link));
      }
    }
  }
  else {
    // form diakses secara langsung!
    // redirect ke edit_mahasiswa.php
    header("Location: edit_mahasiswa.php");
  }

  // siapkan array untuk nama bulan
  $arr_bln = array( "1"=>"Januari",
                    "2"=>"Februari",
                    "3"=>"Maret",
                    "4"=>"April",
                    "5"=>"Mei",
                    "6"=>"Juni",
                    "7"=>"Juli",
                    "8"=>"Agustus",
                    "9"=>"September",
                    "10"=>"Oktober",
                    "11"=>"Nopember",
                    "12"=>"Desember" );
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Sistem Informasi Mahasiswa</title>
  <link href="style.css" rel="stylesheet" >
  <link rel="icon" href="favicon.png" type="image/png" >
</head>
<body>
<div class="container">
<div id="header">
  <h1 id="logo">Sistem Informasi <span>Institut Teknologi Kalimantan</span></h1>
  <p id="tanggal"><?php echo date("d M Y"); ?></p>
</div>
<hr>
  <nav>
  <ul>
    <li><a href="tampil_mahasiswa.php">Tampil</a></li>
    <li><a href="tambah_mahasiswa.php">Tambah</a>
    <li><a href="edit_mahasiswa.php">Edit</a>
    <li><a href="hapus_mahasiswa.php">Hapus</a></li>
    <li><a href="logout.php">Logout</a>
  </ul>
  </nav>
  <form id="search" action="tampil_mahasiswa.php" method="get">
    <p>
      <label for="nim">Nama : </label>
      <input type="text" name="nama" id="nama" placeholder="search..." >
      <input type="submit" name="submit" value="Search">
    </p>
  </form>
<h2>Edit Data Mahasiswa</h2>
<?php
  // tampilkan error jika ada
  if ($pesan_error !== "") {
      echo "<div class=\"error\">$pesan_error</div>";
  }
?>
<form id="form_mahasiswa" action="form_edit.php" method="post">
<fieldset>
<legend>Mahasiswa Baru</legend>
  <p>
    <label for="nim">NIM : </label>
    <input type="text" name="nim" id="nim" value="<?php echo $nim ?>" readonly>
    (tidak bisa diubah di menu edit)
  </p>
  <p>
    <label for="nama">Nama : </label>
    <input type="text" name="nama" id="nama" value="<?php echo $nama ?>">
  </p>
  <p>
    <label for="tempat_lahir">Tempat Lahir : </label>
    <input type="text" name="tempat_lahir" id="tempat_lahir"
    value="<?php echo $tempat_lahir ?>">
  </p>
  <p>
    <label for="tgl" >Tanggal Lahir : </label>
      <select name="tgl" id="tgl">
        <?php
          for ($i = 1; $i <= 31; $i++) {
            if ($i==$tgl){
              echo "<option value = $i selected>";
            }
            else {
              echo "<option value = $i >";
            }
            echo str_pad($i,2,"0",STR_PAD_LEFT);
            echo "</option>";
          }
        ?>
      </select>
        <select name="bln">
        <?php
        foreach ($arr_bln as $key => $value) {
          if ($key==$bln){
            echo "<option value=\"{$key}\" selected>{$value}</option>";
          }
          else {
            echo "<option value=\"{$key}\">{$value}</option>";
          }
        }
        ?>
      </select>
      <select name="thn">
        <?php
          for ($i = 1990; $i <= 2005; $i++) {
          if ($i==$thn){
              echo "<option value = $i selected>";
            }
            else {
              echo "<option value = $i >";
            }
            echo "$i </option>";
          }
        ?>
      </select>
  </p>
  <p>
    <label for="fakultas" >Fakultas : </label>
      <select name="fakultas" id="fakultas">
        <option value="Kedokteran" <?php echo $select_kedokteran ?>>
        Kedokteran </option>
        <option value="FMIPA" <?php echo $select_fmipa ?>>
        FMIPA</option>
        <option value="Ekonomi" <?php echo $select_ekonomi ?>>
        Ekonomi</option>
        <option value="Teknik" <?php echo $select_teknik ?>>
        Teknik</option>
        <option value="Sastra" <?php echo $select_sastra ?>>
        Sastra</option>
        <option value="FASILKOM" <?php echo $select_fasilkom ?>>
        FASILKOM</option>
      </select>
  </p>
  <p>
    <label for="jurusan">Jurusan : </label>
    <input type="text" name="jurusan" id="jurusan" value="<?php echo $jurusan ?>">
  </p>
  <p >
    <label for="ipk">IPK : </label>
    <input type="text" name="ipk" id="ipk" value="<?php echo $ipk ?>">
    (angka desimal dipisah dengan karakter titik ".")
  </p>

</fieldset>
  <br>
  <p>
    <input type="submit" name="submit" value="Update Data">
  </p>
</form>

</div>

</body>
</html>
<?php
  // tutup koneksi dengan database mysql
  mysqli_close($link);
?>
