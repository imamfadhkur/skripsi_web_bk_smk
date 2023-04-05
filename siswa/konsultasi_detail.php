<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["siswa"])) {
    header('Location: /desi/login.php');
    exit();
}

if (isset($_POST["submit_tanggapan"])) {
  $insert = $con_pdo->prepare("INSERT INTO konsultasi (sender_id, receiver_id, message) VALUES (:sender_id, :receiver_id, :message)");
    $data_insert = array(
      "sender_id" => $_SESSION["username"],
      "receiver_id" => $_POST['receiver_id'],
      "message" => $_POST["message"]
   );
    $insert->execute($data_insert);
    header('Location: /desi/siswa/konsultasi_detail.php?konsultasi='.$_GET['konsultasi']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>konsultasi | siswa</title>
</head>
<body>
    <?php include "../navbar.php" ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <?php

$data_chat = array();
$data_key = array();

$data_konsul = $con_pdo->prepare("SELECT * FROM konsultasi WHERE konsultasi.id = :id_chat");
$data_konsul->bindValue(':id_chat', $_GET["konsultasi"]);
$data_konsul->execute();
foreach ($data_konsul as $key => $value) {
  # code...
}
$data_konsul = $con_pdo->prepare("SELECT * FROM konsultasi WHERE sender_id = :sender_id AND receiver_id = :receiver_id");
$data_konsul->bindValue(':sender_id', $value["sender_id"]);
$data_konsul->bindValue(':receiver_id', $value["receiver_id"]);
$data_konsul->execute();
foreach ($data_konsul as $key => $value) {
    $sql = "SELECT nama FROM siswa WHERE siswa.nisn = ".$value['sender_id'];
    $result = mysqli_query($con_mysqli, $sql);
    $row_nama = mysqli_fetch_assoc($result);
    $data_chat[$value['created_at']] = array(
        'id' => $value['sender_id'],
        'nama' => $row_nama['nama'],
        'identifier' => 'siswa',
        'isi_pesan' => $value['message'],
        'waktu' => $value['created_at']
    );
    array_push($data_key, $value['created_at']);
}

$data_tanggapan = $con_pdo->prepare("SELECT * FROM tanggapan WHERE tanggapan.id_konsultasi = :id_chat");
$data_tanggapan->bindValue(':id_chat', $_GET["konsultasi"]);
$data_tanggapan->execute();
if ($data_tanggapan->rowCount()) {
foreach ($data_tanggapan as $key => $value) {
    $sql = "SELECT nama FROM guru WHERE guru.nip = ".$value['pemberi_tanggapan'];
    $result = mysqli_query($con_mysqli, $sql);
    $row_nama = mysqli_fetch_assoc($result);
    $data_chat[$value['created_at']] = array(
        'id' => $value['pemberi_tanggapan'],
        'nama' => $row_nama['nama'],
        'identifier' => 'admin',
        'isi_pesan' => $value['isi_tanggapan'],
        'waktu' => $value['created_at']
    );
    array_push($data_key, $value['created_at']);
}
}

function cmp($a, $b) {
    $t1 = strtotime($a);
    $t2 = strtotime($b);
    return $t1 - $t2;
}
        usort($data_key, "cmp");
        ?>
<div class="card mb-5">
  <ul class="list-group list-group-flush">
    <?php
    foreach ($data_key as $key => $value) {
        ?>
    <li class="list-group-item">
      <div class="d-flex <?php echo $data_chat[$value]['identifier'] == 'siswa' ? "justify-content-end ms-5" : "me-5" ?>">
      <?php 
      if ($data_chat[$value]['identifier'] == 'siswa') {
        ?>
        <div class="ms-5">
            <h6 class="mb-0"><?php echo $data_chat[$value]['nama'] ?></h6>
            <p class="mb-0"><?php echo $data_chat[$value]['isi_pesan'] ?></p>
        </div>
        <div class="flex-shrink-0 ms-3">
          <img src="../assets/img/avatar-chat-guru.png" alt="User" class="rounded-circle" width="50" height="50">
        </div>
        <?php
      }
      else {
        $receiver_id = $data_chat[$value]['id'];
        ?>
        <div class="flex-shrink-0">
          <img src="../assets/img/avatar-chat-siswa.png" alt="User" class="rounded-circle" width="50" height="50">
        </div>
        <div class="me-5">
          <h6 class="mb-0"><?php echo $data_chat[$value]['nama'] ?></h6>
          <p class="mb-0"><?php echo $data_chat[$value]['isi_pesan'] ?></p>
        </div>
        <?php
      }
      ?>
      </div>
    </li>
    <?php
    }
    ?>
  </ul>
  <div class="card-footer">
    <form action="konsultasi_detail.php?konsultasi=<?php echo $_GET['konsultasi'] ?>" method="post">
      <div class="input-group">
        <input type="hidden" class="form-control" name="receiver_id" value="<?php echo $receiver_id ?>">
        <input type="text" class="form-control" name="message" placeholder="Type a message">
        <button type="submit" name="submit_tanggapan" class="btn btn-primary">Send</button>
      </div>
    </form>
  </div>
</div>
            </div>
        </div>
    </div>
</body>
</html>