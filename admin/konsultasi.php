<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["admin"])) {
    header('Location: /desi/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>konsultasi | admin</title>
</head>
<body>
    <?php include "../navbar.php" ?>
    <div class="container mt-5">
      <div class="row">
        <div class="col">
          <h3>Konsultasi siswa</h3>
        </div>
      </div>
    <div class="row">
        <div class="col">
            <div id="my-data" class="me-5">
            <?php
$data = $con_pdo->prepare("SELECT k.*, s.nama nama_siswa FROM konsultasi k JOIN siswa s ON k.sender_id = s.nisn WHERE k.receiver_id = :bk GROUP BY k.sender_id");
$data->bindValue(':bk', $_SESSION["admin"]["nip"]);
$data->execute();
foreach ($data as $key => $value) {
    ?>
    <a href="konsultasi_detail.php?konsultasi=<?php echo $value["id"] ?>" class="text-decoration-none">
    <div class="card w-100 mt-4">
        <div class="card-body">
            <?php echo $value["nama_siswa"] ?>
        </div>
    </div>
    </a>
    <?php
}
?>
            </div>
        </div>
    </div>
    </div>
  <script src="../assets/js/sidebar.js"></script>
</body>
</html>