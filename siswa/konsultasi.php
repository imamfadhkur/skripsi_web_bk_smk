<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["siswa"])) {
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
    <title>konsultasi | siswa</title>
</head>
<body>
    <?php include "../navbar.php" ?>
    <div class="container mt-5">
      <div class="row">
        <div class="col">
          <h3>Konsultasi saya</h3>
          <br>
          <a href="tambahKonsultasi.php" class="btn btn-primary"><i class="bi bi-plus-circle"></i> konsultasi baru</a>
          <?php 
        if (isset($_GET["pesanSuccess"])) {
            echo '<div class="p-3 mt-3 text-primary-emphasis bg-success-subtle border border-success-subtle rounded-3">';
            echo $_GET["pesanSuccess"];
            echo '</div>';
        }
        elseif (isset($_GET["pesanGagal"])) {
            echo '<div class="p-3 mt-3 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-3">';
            echo $_GET["pesanGagal"];
            echo '</div>';
        }
        ?>
        </div>
      </div>
    <div class="row">
        <div class="col">
            <div id="my-data" class="me-5">
            <?php
$data = $con_pdo->prepare("SELECT * FROM konsultasi WHERE sender_id = :sender_id GROUP BY receiver_id");
$data->bindValue(':sender_id', $_SESSION['username']);
$data->execute();
foreach ($data as $key => $value) {
    ?>
    <a href="konsultasi_detail.php?konsultasi=<?php echo $value["id"] ?>" class="text-decoration-none">
    <div class="card w-100 mt-4">
        <div class="card-body">
            <?php
            $nama_guru = $con_pdo->prepare("SELECT * FROM guru WHERE nip = :nip");
            $nama_guru->execute(array('nip' => $value['receiver_id']));
            foreach ($nama_guru as $key_g => $value_g) {
                echo $value_g['nama'];
            }
            ?>
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