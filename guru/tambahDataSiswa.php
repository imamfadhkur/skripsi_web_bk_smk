<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["guru"])) {
    header('Location: /desi/login.php');
    exit();
}

if (isset($_POST["tambah"])) {
  $stmt = $con_pdo->prepare("SELECT * FROM siswa WHERE nisn = :nisn");
  $stmt->bindValue(':nisn', $_POST["nisn"]);
  $stmt->execute();
  $row = $stmt->rowCount();
  if ($row >= 1) {
    header('Location: /desi/guru/data.php?pesanGagal=Data%20siswa%20yang%20anda%20masukkan%20sudah%20ada,%20silahkan%20masukkan%20data%20lainnya!&runFunction=getDataSiswa');
    exit();
  }
  else {
    $cekJurusan = $con_pdo->prepare("SELECT jurusan FROM kelas WHERE nama = :nama");
    $cekJurusan->execute(array(':nama' => $_POST["kelas_siswa"]));
    foreach ($cekJurusan as $key_j => $value_j) {
      // code ...
    }
    $jurusan = $value_j["jurusan"];
    $pw = hash("sha256", $_POST['password']);
    $insert = $con_pdo->prepare("INSERT INTO user (username, password, level) VALUES (:username, :password, :level)");
    $insert->bindValue(':username', $_POST['nisn']);
    $insert->bindValue(':password', $pw);
    $insert->bindValue(':level', "siswa");
    $insert->execute();
    $insert = $con_pdo->prepare("INSERT INTO siswa (nisn, nama, email, kelas_siswa, jurusan, orang_tua, alamat, kontak) VALUES (:nisn, :nama, :email, :kelas_siswa, :jurusan, :orang_tua, :alamat, :kontak)");
    $data = array(
        ':nisn' => $_POST["nisn"],
        ':nama' => $_POST["nama"],
        ':email' => $_POST["email"],
        ':kelas_siswa' => $_POST["kelas_siswa"],
        ':jurusan' => $jurusan,
        ':orang_tua' => $_POST["orang_tua"],
        ':alamat' => $_POST["alamat"],
        ':kontak' => $_POST["kontak"]
    );
    $insert->execute($data);
    header('Location: /desi/guru/data.php?pesanSuccess=Data%20berhasil%20ditambahkan!&runFunction=getDataSiswa');
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah data siswa</title>
</head>
<body>
    <?php include "../navbar.php" ?>
    <div class="container mb-5">
        <div class="row">
            <div class="col">
    <h2 class="my-2">Tambah Data Siswa</h2>
<form action="tambahDataSiswa.php" method="post">
  <div class="mb-3">
    <label class="form-label">NISN</label>
    <input type="number" name="nisn" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="nama" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Kelas</label>
    <select name="kelas_siswa" class="form-control" required>
      <?php
        $query = mysqli_query($con_mysqli, "SELECT * FROM kelas");
        while ($row = mysqli_fetch_array($query)) {
          echo '<option value="'.$row['nama'].'">'.$row['nama'].'</option>';
        }
      ?>
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Nama Orang Tua</label>
    <input type="text" name="orang_tua" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Alamat</label>
    <input type="text" name="alamat" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Kontak</label>
    <input type="number" name="kontak" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="password">
    <input type="checkbox" id="show-password" onchange="showPassword()"> Show Password
  </div>
  <button type="submit" class="btn btn-primary" name="tambah">Submit</button>
</form>
            </div>
        </div>
    </div>

<script>
function showPassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

</body>
</html>