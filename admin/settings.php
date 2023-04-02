<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["admin"])) {
    header('Location: /desi/login.php');
    exit();
}
$data = $con_pdo->prepare("SELECT * FROM settings");
$data->execute();
foreach ($data as $key => $value) {
    # code...
}

if (isset($_POST["edit"])) {
    $update = $con_pdo->prepare("UPDATE settings SET nama_website = :nama_website, total_poin = :total_poin WHERE id = :id");
    $update->bindValue(':id', $_POST['id']);
    $update->bindValue(':nama_website', $_POST['nama_website']);
    $update->bindValue(':total_poin', $_POST['total_poin']);
    $update->execute();
    header('Location: /desi/admin/settings.php?pesanSuccess=Data%20berhasil%20di%20edit!');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>settings | admin</title>
</head>
<body>
    <?php include "../navbar.php" ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-10">
                <?php
                if (isset($_GET["pesanSuccess"])) {
                    echo '<div class="p-3 mt-3 text-primary-emphasis bg-success-subtle border border-success-subtle rounded-3">';
                    echo $_GET["pesanSuccess"];
                    echo '</div>';
                }
                ?>
<form action="settings.php" method="post">
  <div class="mb-3">
    <label class="form-label">Nama Website</label>
    <input type="hidden" name="id" class="form-control" value="<?php echo $value["id"] ?>">
    <input type="text" name="nama_website" class="form-control" value="<?php echo $value["nama_website"] ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Maks. Total Poin Pelanggaran</label>
    <input type="number" name="total_poin" class="form-control" value="<?php echo $value["total_poin"] ?>">
  </div>
  <button type="submit" class="btn btn-primary" name="edit">Submit</button>
</form>
            </div>
        </div>
    </div>
</body>
</html>