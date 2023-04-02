<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["admin"])) {
    header('Location: /desi/login.php');
    exit();
}

if (isset($_POST["tambah"])) {
  $sql = "SELECT * FROM user WHERE user.username = ".$_POST["nip"];
  $result = mysqli_query($con_mysqli, $sql);
  $row = mysqli_num_rows($result);
  if ($row >= 1) {
    header('Location: /desi/admin/data.php?pesanGagal=Data(nip)%20yang%20anda%20masukkan%20sudah%20ada,%20silahkan%20masukkan%20data%20lainnya!&runFunction=getDataGuru');
    exit();
  }
  else {
    $pw = hash("sha256", $_POST['password']);
    $insert = $con_pdo->prepare("INSERT INTO user (username, password, level) VALUES (:username, :password, :level)");
    $insert->bindValue(':username', $_POST['nip']);
    $insert->bindValue(':password', $pw);
    $insert->bindValue(':level', $_POST["level"]);
    $insert->execute();
    $insert_g = $con_pdo->prepare("INSERT INTO guru (nip, nama, email, level) VALUES (:nip, :nama, :email, :level)");
    $insert_g->bindValue(':nip', $_POST["nip"]);
    $insert_g->bindValue(':nama', $_POST["nama"]);
    $insert_g->bindValue(':email', $_POST["email"]);
    $insert_g->bindValue(':level', $_POST["level"]);
    $insert_g->execute();
    header('Location: /desi/admin/data.php?pesanSuccess=Data%20berhasil%20ditambahkan!&runFunction=getDataGuru');
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
    <title>tambah data guru</title>
</head>
<body>
    <?php include "../navbar.php" ?>
    <div class="container mb-5">
        <div class="row">
            <div class="col">
    <h2 class="my-2">Tambah Data Guru</h2>
<form action="tambahDataGuru.php" method="post">
  <div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="nama" class="form-control">
  </div>
  <div class="mb-3">
    <label class="form-label">NIP</label>
    <input type="number" class="form-control" name="nip">
  </div>
  <div class="mb-3">
    <label class="form-label">email</label>
    <input type="email" class="form-control" name="email" placeholder="example@gmail.com">
  </div>
  <div class="mb-3">
    <label class="form-label">Kategori</label>
    <select name="level" class="form-control">
      <option value="guru" selected>Guru</option>
      <option value="admin">BK (admin)</option>
    </select>
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