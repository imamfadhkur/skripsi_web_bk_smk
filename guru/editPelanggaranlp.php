<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["guru"])) {
    header('Location: /desi/login.php');
    exit();
}

if (isset($_POST["edit"])) {
    $update = $con_pdo->prepare("UPDATE list_pelanggaran SET nisn_siswa = :nisn_siswa, dilaporkan_oleh = :dilaporkan_oleh, wali_kelas = :wali_kelas, kategori_pelanggaran = :kategori_pelanggaran, keterangan_tindakan = :keterangan_tindakan WHERE id = :id");
    $data_in = array(
      'id' => $_POST["namaLama"],
      'nisn_siswa' => $_POST["nisn_siswa"], 
      'dilaporkan_oleh' => $_POST["dilaporkan_oleh"], 
      'wali_kelas' => $_POST["wali_kelas"], 
      'kategori_pelanggaran' => $_POST["kategori_pelanggaran"],	
      'keterangan_tindakan' => $_POST["keterangan_tindakan"]
    );
    $update->execute($data_in);
    header('Location: /desi/guru/pelanggaran.php?pesanSuccess=Data%20berhasil%20di%20edit&runFunction=getPelanggaranlp');
    exit();
  }

if ($_GET["lp"]) {
  $stmt = $con_pdo->prepare("SELECT * FROM list_pelanggaran WHERE id = :id");
  $stmt->bindValue(":id", $_GET['lp']);
  $stmt->execute();
  foreach ($stmt as $key => $value) {
    # code...
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit data list pelanggaran</title>
</head>
<body>
    <?php include "../navbar.php" ?>
    <div class="container mb-5">
        <div class="row">
            <div class="col">
    <h2 class="my-2">Edit Data List Pelanggaran</h2>
<form action="editPelanggaranlp.php" method="post">
  <input type="hidden" name="namaLama" value="<?php echo $_GET["lp"] ?>">
  <!-- // nisn_siswa, dilaporkan_oleh, wali_kelas, kategori_pelanggaran,	keterangan_tindakan -->
  <div class="mb-3">
    <label class="form-label">Siswa (NISN-nama)</label>
    <select name="nisn_siswa" class="form-control" required>
      <?php
        $query = mysqli_query($con_mysqli, "SELECT * FROM siswa");
        while ($rows = mysqli_fetch_array($query)) {?>
        <option value="<?php echo $rows['nisn'] ?>" <?php echo $rows["nisn"] == $value["nisn_siswa"] ? "selected" : ""; ?>><?php echo $rows['nisn'].'-'.$rows['nama'] ?></option>
        <?php
        }
      ?>
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Dilaporkan Oleh (NIP-guru)</label>
    <select name="dilaporkan_oleh" class="form-control" required>
      <?php
        $query = mysqli_query($con_mysqli, "SELECT * FROM guru");
        while ($rows = mysqli_fetch_array($query)) {?>
        <option value="<?php echo $rows['nip'] ?>" <?php echo $rows["nip"] == $value["dilaporkan_oleh"] ? "selected" : ""; ?>><?php echo $rows['nip'].'-'.$rows['nama'] ?></option>
        <?php
        }
      ?>
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Wali Kelas (NIP-guru)</label>
    <select name="wali_kelas" class="form-control" required>
    <?php
        $query = mysqli_query($con_mysqli, "SELECT * FROM guru");
        while ($rows = mysqli_fetch_array($query)) {?>
        <option value="<?php echo $rows['nip'] ?>" <?php echo $rows["nip"] == $value["wali_kelas"] ? "selected" : ""; ?>><?php echo $rows['nip'].'-'.$rows['nama'] ?></option>
        <?php
        }
      ?>
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Kategori Pelanggaran</label>
    <select name="kategori_pelanggaran" class="form-control" required>
    <?php
        $query = mysqli_query($con_mysqli, "SELECT * FROM kategori_pelanggaran");
        while ($rows = mysqli_fetch_array($query)) {?>
        <option value="<?php echo $rows['nama_pelanggaran'] ?>" <?php echo $rows["nama_pelanggaran"] == $value["kategori_pelanggaran"] ? "selected" : ""; ?>><?php echo $rows['nama_pelanggaran'] ?></option>
        <?php
        }
      ?>
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Keterangan Tindakan</label>
    <input type="text" name="keterangan_tindakan" class="form-control" value="<?php echo $value["keterangan_tindakan"] ?>" required>
  </div>
  <button type="submit" class="btn btn-primary" name="edit">Submit</button>
</form>
            </div>
        </div>
    </div>
</body>
</html>