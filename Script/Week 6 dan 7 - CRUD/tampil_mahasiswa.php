<?php
  // periksa apakah user sudah login, cek kehadiran session name 
  // jika tidak ada, redirect ke login.php
  session_start();
  if (!isset($_SESSION["nama"])) {
     header("Location: login.php");
  }

  // buka koneksi dengan MySQL
     include("connection.php");
  
  // ambil pesan jika ada  
  if (isset($_GET["pesan"])) {
      $pesan = $_GET["pesan"];
  }
     
  // cek apakah form telah di submit
  // berasal dari form pencairan, siapkan query 
  if (isset($_GET["submit"])) {
      
    // ambil nilai nama
    $nama = htmlentities(strip_tags(trim($_GET["nama"])));
    
    // filter untuk $nama untuk mencegah sql injection
    $nama = mysqli_real_escape_string($link,$nama);
    
    // buat query pencarian
    $query  = "SELECT * FROM mahasiswa WHERE nama LIKE '%$nama%' ";
    $query .= "ORDER BY nama ASC";
    
    // buat pesan
    $pesan = "Hasil pencarian untuk nama <b>\"$nama\" </b>:";
  } 
  else {
  // bukan dari form pencairan
  // siapkan query untuk menampilkan seluruh data dari tabel mahasiswa
    $query = "SELECT * FROM mahasiswa ORDER BY nama ASC";
  }
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Sistem Informasi Mahasiswa</title>
  <link href="style.css" rel="stylesheet" >
  <link rel="icon" href="favicon.png" type="image/png" >
  <style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f7f9fc;
    margin: 0;
    padding: 0;
  }

  .container {
    width: 90%;
    max-width: 1000px;
    margin: 30px auto;
    background: #fff;
    padding: 20px 30px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  }

  /* Header */
  #header {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  #logo {
    font-size: 22px;
    color: #333;
    margin: 0;
  }

  #logo span {
    font-size: 16px;
    color: #007bff;
  }

  #tanggal {
    font-size: 14px;
    color: #555;
  }

  hr {
    margin: 15px 0;
  }

  /* Navigation */
  nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    gap: 15px;
  }

  nav ul li {
    display: inline;
  }

  nav ul li a {
    text-decoration: none;
    color: #007bff;
    font-weight: bold;
    padding: 6px 10px;
    border-radius: 4px;
    transition: background 0.3s;
  }

  nav ul li a:hover {
    background: #007bff;
    color: #fff;
  }

  /* Search form */
  #search {
    margin: 20px 0;
  }

  #search label {
    margin-right: 8px;
    font-weight: bold;
    color: #333;
  }

  #search input[type=text] {
    padding: 8px;
    width: 200px;
    border: 1px solid #ccc;
    border-radius: 6px;
  }

  #search input[type=submit] {
    padding: 8px 12px;
    background: #007bff;
    border: none;
    border-radius: 6px;
    color: #fff;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s;
  }

  #search input[type=submit]:hover {
    background: #0056b3;
  }

  /* Pesan */
  .pesan {
    margin: 10px 0;
    padding: 10px;
    background: #e6f7ff;
    border-left: 4px solid #007bff;
    color: #333;
    border-radius: 4px;
  }

  /* Table */
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
  }

  table th, table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
    font-size: 14px;
  }

  table th {
    background: #007bff;
    color: #fff;
  }

  table tr:nth-child(even) {
    background: #f9f9f9;
  }

  table tr:hover {
    background: #eaf3ff;
  }

  /* Footer */
  #footer {
    margin-top: 20px;
    text-align: center;
    font-size: 13px;
    color: #777;
  }
</style>

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
<h2>Data Mahasiswa</h2>
<?php
  // tampilkan pesan jika ada
  if (isset($pesan)) {
      echo "<div class=\"pesan\">$pesan</div>";
  }
?>
 <table border="1">
  <tr>
  <th>NIM</th>
  <th>Nama</th>
  <th>Tempat Lahir</th>
  <th>Tanggal Lahir</th>
  <th>Fakultas</th>
  <th>Jurusan</th>
  <th>IPK</th>
  </tr>
  <?php
  // jalankan query
  $result = mysqli_query($link, $query);
  
  if(!$result){
      die ("Query Error: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }
  
  //buat perulangan untuk element tabel dari data mahasiswa
  while($data = mysqli_fetch_assoc($result))
  { 
    // konversi date MySQL (yyyy-mm-dd) menjadi dd-mm-yyyy
    $tanggal_php = strtotime($data["tanggal_lahir"]);
    $tanggal = date("d - m - Y", $tanggal_php);
    
    echo "<tr>";
    echo "<td>$data[nim]</td>";
    echo "<td>$data[nama]</td>";
    echo "<td>$data[tempat_lahir]</td>";
    echo "<td>$tanggal</td>";
    echo "<td>$data[fakultas]</td>";
    echo "<td>$data[jurusan]</td>";
    echo "<td>$data[ipk]</td>";
    echo "</tr>";
  }
  
  // bebaskan memory 
  mysqli_free_result($result);
  
  // tutup koneksi dengan database mysql
  mysqli_close($link);
  ?>
  </table>
  <div id="footer">
    Copyright © <?php echo date("Y"); ?> Codelearn
  </div>
</div>
</body>
</html>