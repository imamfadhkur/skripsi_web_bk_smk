<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["siswa"])) {
    header('Location: /desi/login.php');
    exit();
}

if (isset($_POST["tambah"])) {
    $insert = $con_pdo->prepare("INSERT INTO konsultasi (sender_id, receiver_id, message) VALUES (:sender_id, :receiver_id, :message)");
    $insert->bindValue(':sender_id', $_SESSION['username']);
    $insert->bindValue(':receiver_id', $_POST["receiver_id"]);
    $insert->bindValue(':message', $_POST["message"]);
    $insert->execute();
    header('Location: /desi/siswa/konsultasi.php?pesanSuccess=Berhasil%20menambahkan%20chat');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah konsultasi baru</title>
</head>
<body>
    <?php include "../navbar.php" ?>
    <div class="container mb-5">
        <div class="row">
            <div class="col">
    <h2 class="my-2">Buat Konsultasi Baru</h2>
<form action="tambahKonsultasi.php" method="post">
  <div class="mb-3">
    <label class="form-label">Guru BK</label>
    <select name="receiver_id" class="form-control" required>
      <?php
        $query = mysqli_query($con_mysqli, "SELECT * FROM guru WHERE level = 'admin'");
        while ($row = mysqli_fetch_array($query)) {
          echo '<option value="'.$row['nip'].'">'.$row['nama'].'</option>';
        }
      ?>
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Yang ingin anda konsultasikan</label>
    <input type="text" name="message" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-primary" name="tambah">Submit</button>
</form>
            </div>
        </div>
    </div>
</body>
</html>