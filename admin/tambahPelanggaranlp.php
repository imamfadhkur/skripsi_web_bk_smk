<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["admin"])) {
    header('Location: /desi/login.php');
    exit();
}

if (isset($_POST["tambah"])) {
    $insert = $con_pdo->prepare("INSERT INTO list_pelanggaran (nisn_siswa, dilaporkan_oleh, wali_kelas, kategori_pelanggaran,	keterangan_tindakan) VALUES (:nisn_siswa, :dilaporkan_oleh, :wali_kelas, :kategori_pelanggaran,	:keterangan_tindakan)");
    $data_insert = array(
      "nisn_siswa" => $_POST["nisn_siswa"],
      "dilaporkan_oleh" => $_POST["dilaporkan_oleh"],
      "wali_kelas" => $_POST["wali_kelas"],
      "kategori_pelanggaran" => $_POST["kategori_pelanggaran"],
      "keterangan_tindakan" => $_POST["keterangan_tindakan"]
   );
    $insert->execute($data_insert);
    header('Location: /desi/admin/pelanggaran.php?pesanSuccess=Data%20berhasil%20ditambahkan!&runFunction=getPelanggaranlp');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah data list pelanggaran</title>
</head>
<body>
    <?php include "../navbar.php" ?>
    <div class="container mb-5">
        <div class="row">
            <div class="col">
    <h2 class="my-2">Tambah Data List Pelanggaran</h2>
<form action="tambahPelanggaranlp.php" method="post">
  <div class="mb-3">
    <label class="form-label">Siswa (NISN-nama)</label>
    <select name="nisn_siswa" class="form-control" required>
      <?php
        $query = mysqli_query($con_mysqli, "SELECT * FROM siswa");
        while ($row = mysqli_fetch_array($query)) {
          echo '<option value="'.$row['nisn'].'">'.$row['nisn'].'-'.$row['nama'].'</option>';
        }
      ?>
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Dilaporkan Oleh (NIP-guru)</label>
    <select name="dilaporkan_oleh" class="form-control" required>
      <?php
        $query = mysqli_query($con_mysqli, "SELECT * FROM guru");
        while ($row = mysqli_fetch_array($query)) {
          echo '<option value="'.$row['nip'].'">'.$row['nip'].'-'.$row['nama'].'</option>';
        }
      ?>
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Wali Kelas (NIP-guru)</label>
    <select name="wali_kelas" class="form-control" required>
      <?php
        $query = mysqli_query($con_mysqli, "SELECT * FROM guru");
        while ($row = mysqli_fetch_array($query)) {
          echo '<option value="'.$row['nip'].'">'.$row['nip'].'-'.$row['nama'].'</option>';
        }
      ?>
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Kategori Pelanggaran</label>
    <select name="kategori_pelanggaran" class="form-control" required>
      <?php
        $query = mysqli_query($con_mysqli, "SELECT * FROM kategori_pelanggaran");
        while ($row = mysqli_fetch_array($query)) {
          echo '<option value="'.$row['nama_pelanggaran'].'">'.$row['nama_pelanggaran'].'</option>';
        }
      ?>
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Keterangan Tindakan</label>
    <input type="text" name="keterangan_tindakan" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-primary" name="tambah">Submit</button>
</form>
            </div>
        </div>
    </div>
</body>
</html>