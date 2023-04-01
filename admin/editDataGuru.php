<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["admin"])) {
    header('Location: /desi/login.php');
    exit();
}

if (isset($_POST["submitEditGuru"])) {
  $row = 0;
  if ($_POST["nipLama"] !== $_POST["nip"]) {
    $sql = "SELECT * FROM user WHERE user.username = '".$_POST["nip"]."'";
    $result = mysqli_query($con_mysqli, $sql);
    $row = mysqli_fetch_assoc($result);
  }
  if ($row >= 1) {
    header('Location: /desi/admin/data.php?pesanGagal=Data(nip)%20yang%20anda%20masukkan%20sudah%20ada,%20silahkan%20masukkan%20data%20lainnya!&runFunction=getDataGuru');
    exit();
  }
  elseif (isset($_POST["password"])) {  
    $pw = hash("sha256", $_POST['password']);
    $update = $con_pdo->prepare("UPDATE user SET username = :username, password = :password, level = :level WHERE username = :nipLama");
    $update->bindValue(':nipLama', $_POST['nipLama']);
    $update->bindValue(':username', $_POST['nip']);
    $update->bindValue(':password', $pw);
    $update->bindValue(':level', $_POST["level"]);
    $update->execute();
    $update_g = $con_pdo->prepare("UPDATE guru SET nip = :nip, nama = :nama, email = :email, level = :level WHERE nip = :nipLama");
    $update_g->bindValue(':nipLama', $_POST["nipLama"]);
    $update_g->bindValue(':nip', $_POST["nip"]);
    $update_g->bindValue(':nama', $_POST["nama"]);
    $update_g->bindValue(':email', $_POST["email"]);
    $update_g->bindValue(':level', $_POST["level"]);
    $update_g->execute();
    header('Location: /desi/admin/data.php?pesanSuccess=Data%20berhasil%20di%20edit&runFunction=getDataGuru');
    exit();
  }
  else {
    $update = $con_pdo->prepare("UPDATE user SET username = :username, level = :level WHERE username = :nipLama");
    $update->bindValue(':username', $_POST['nip']);
    $update->bindValue(':nipLama', $_POST["nipLama"]);
    $update->bindValue(':level', $_POST["level"]);
    $update->execute();
    $update_g = $con_pdo->prepare("UPDATE guru SET nip = :nip, nama = :nama, email = :email, level = :level WHERE nip = :nipLama");
    $update_g->bindValue(':nipLama', $_POST["nipLama"]);
    $update_g->bindValue(':nip', $_POST["nip"]);
    $update_g->bindValue(':nama', $_POST["nama"]);
    $update_g->bindValue(':email', $_POST["email"]);
    $update_g->bindValue(':level', $_POST["level"]);
    $update_g->execute();
    header('Location: /desi/admin/data.php?pesanSuccess=Data%20berhasil%20di%20edit&runFunction=getDataGuru');
    exit();
  }
}

if ($_GET["nip"]) {
  $sql = "SELECT * FROM guru WHERE guru.nip = ".$_GET["nip"];
  $result = mysqli_query($con_mysqli, $sql);
  $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit data guru</title>
</head>
<body>
    <?php include "../navbar.php" ?>
    <div class="container mb-5">
        <div class="row">
            <div class="col">
    <h2 class="my-2">Edit Data Guru</h2>
<form action="editDataGuru.php" method="post">
  <div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="nama" class="form-control" value="<?php echo $row["nama"] ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">NIP</label>
    <input type="hidden" class="form-control" name="nipLama" value="<?php echo $_GET["nip"] ?>">
    <input type="number" class="form-control" name="nip" value="<?php echo $row["nip"] ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">email</label>
    <input type="email" class="form-control" name="email" placeholder="example@gmail.com" value="<?php echo $row["email"] ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Kategori</label>
    <select name="level" class="form-control">
      <option value="guru" <?php echo $row["level"] == "guru" ? "selected" : ""; ?> >Guru</option>
      <option value="admin" <?php echo $row["level"] == "admin" ? "selected" : ""; ?> >BK</option>
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="password">
    <input type="checkbox" id="show-password" onchange="showPassword()"> Show Password
  </div>
  <button type="submit" class="btn btn-primary" name="submitEditGuru">Submit</button>
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