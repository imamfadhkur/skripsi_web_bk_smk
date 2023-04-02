<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["admin"])) {
    header('Location: /desi/login.php');
    exit();
}

if (isset($_POST["submitEditSiswa"])) {
  $row = 0;
  if ($_POST["nisnLama"] !== $_POST["nisn"]) {
    $sql = "SELECT * FROM user WHERE user.username = '".$_POST["nisn"]."'";
    $result = mysqli_query($con_mysqli, $sql);
    $row = mysqli_fetch_assoc($result);
  }
  if ($row >= 1) {
    header('Location: /desi/admin/data.php?pesanGagal=Data(nisn)%20yang%20anda%20masukkan%20sudah%20ada,%20silahkan%20masukkan%20data%20lainnya!&runFunction=getDataSiswa');
    exit();
  }
  elseif (isset($_POST["password"])) { 
    $cekJurusan = $con_pdo->prepare("SELECT jurusan FROM kelas WHERE nama = :nama");
    $cekJurusan->execute(array(':nama' => $_POST["kelas_siswa"]));
    foreach ($cekJurusan as $key_j => $value_j) {
      // code ...
    }
    $jurusan = $value_j["jurusan"];
    $pw = hash("sha256", $_POST['password']);
    $update = $con_pdo->prepare("UPDATE user SET username = :username, password = :password WHERE username = :nisnLama");
    $update->bindValue(':nisnLama', $_POST['nisnLama']);
    $update->bindValue(':username', $_POST['nisn']);
    $update->bindValue(':password', $pw);
    $update->execute();
    $update_g = $con_pdo->prepare("UPDATE siswa SET nisn = :nisn, nama = :nama, email = :email, kelas_siswa = :kelas_siswa, jurusan = :jurusan, orang_tua = :orang_tua, alamat = :alamat, kontak = :kontak WHERE nisn = :nisnLama");
    $data = array(
        ':nisnLama' => $_POST["nisnLama"],
        ':nisn' => $_POST["nisn"],
        ':nama' => $_POST["nama"],
        ':email' => $_POST["email"],
        ':kelas_siswa' => $_POST["kelas_siswa"],
        ':jurusan' => $jurusan,
        ':orang_tua' => $_POST["orang_tua"],
        ':alamat' => $_POST["alamat"],
        ':kontak' => $_POST["kontak"]
    );
    $update_g->execute($data);
    header('Location: /desi/admin/data.php?pesanSuccess=Data%20berhasil%20di%20edit&runFunction=getDataSiswa');
    exit();
  }
  else {
    $cekJurusan = $con_pdo->prepare("SELECT jurusan FROM kelas WHERE nama = :nama");
    $cekJurusan->execute(array(':nama' => $_POST["kelas_siswa"]));
    foreach ($cekJurusan as $key_j => $value_j) {
      // code ...
    }
    $jurusan = $value_j["jurusan"];
    $update = $con_pdo->prepare("UPDATE user SET username = :username WHERE username = :nisnLama");
    $update->bindValue(':username', $_POST['nisn']);
    $update->bindValue(':nisnLama', $_POST["nisnLama"]);
    $update->execute();
    $update_g = $con_pdo->prepare("UPDATE siswa SET nisn = :nisn, nama = :nama, email = :email, kelas_siswa = :kelas_siswa, jurusan = :jurusan, orang_tua = :orang_tua, alamat = :alamat, kontak = :kontak WHERE nisn = :nisnLama");
    $data = array(
        ':nisnLama' => $_POST["nisnLama"],
        ':nisn' => $_POST["nisn"],
        ':nama' => $_POST["nama"],
        ':email' => $_POST["email"],
        ':kelas_siswa' => $_POST["kelas_siswa"],
        ':jurusan' => $jurusan,
        ':orang_tua' => $_POST["orang_tua"],
        ':alamat' => $_POST["alamat"],
        ':kontak' => $_POST["kontak"]
    );
    $update_g->execute($data);
    header('Location: /desi/admin/data.php?pesanSuccess=Data%20berhasil%20di%20edit&runFunction=getDataSiswa');
    exit();
  }
}

if ($_GET["nisn"]) {
  $sql = "SELECT * FROM siswa WHERE siswa.nisn = ".$_GET["nisn"];
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
    <title>edit data siswa</title>
</head>
<body>
    <?php include "../navbar.php" ?>
    <div class="container mb-5">
        <div class="row">
            <div class="col">
    <h2 class="my-2">Edit Data Siswa</h2>
<form action="editDataSiswa.php" method="post">
  <div class="mb-3">
    <label class="form-label">NISN</label>
    <input type="hidden" name="nisnLama" class="form-control" value="<?php echo $row["nisn"] ?>" required>
    <input type="number" name="nisn" class="form-control" value="<?php echo $row["nisn"] ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="nama" class="form-control" value="<?php echo $row["nama"] ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" value="<?php echo $row["email"] ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Kelas</label>
    <select name="kelas_siswa" class="form-control" required>
      <?php
        $query = mysqli_query($con_mysqli, "SELECT * FROM kelas");
        while ($row_k = mysqli_fetch_array($query)) {
          ?>
          <option value="<?php echo $row_k['nama'] ?>" <?php echo $row["kelas_siswa"] == $row_k["nama"] ? "selected" : ""; ?>><?php echo $row_k['nama'] ?></option>
          <?php
        }
      ?>
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Nama Orang Tua</label>
    <input type="text" name="orang_tua" class="form-control" value="<?php echo $row["orang_tua"] ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Alamat</label>
    <input type="text" name="alamat" class="form-control" value="<?php echo $row["alamat"] ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Kontak</label>
    <input type="number" name="kontak" class="form-control" value="<?php echo $row["kontak"] ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="password">
    <input type="checkbox" id="show-password" onchange="showPassword()"> Show Password
  </div>
  <button type="submit" class="btn btn-primary" name="submitEditSiswa">Submit</button>
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