<a href="tambahPelanggaranlp.php" class="btn btn-primary mt-4"><i class="bi bi-plus-circle"></i> tambah data list pelanggaran</a>
<table class="table table-striped mt-1">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">siswa <br> (NISN-Nama Siswa)</th>
      <th scope="col">dilaporkan oleh <br> (NIP-Nama Guru)</th>
      <th scope="col">wali kelas <br> (NIP-Nama Guru)</th>
      <th scope="col">pelanggaran</th>
      <th scope="col">poin</th>
      <th scope="col">keterangan tindakan</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include "../koneksi.php";
    $data_kelas = $con_pdo->prepare("SELECT list_pelanggaran.*, siswa.nama AS nama_siswa FROM list_pelanggaran, siswa WHERE list_pelanggaran.nisn_siswa = siswa.nisn");
    $data_kelas->execute();
    $count = 0;
    foreach ($data_kelas as $key => $value) {
      $count++;
      ?>
      <tr>
        <th scope="row"><?php echo $count ?></th>
        <td scope="col"><?php echo $value["nisn_siswa"] ?>-<?php echo $value["nama_siswa"] ?></td>
        <td scope="col"><?php echo $value["dilaporkan_oleh"] ?>-<?php
        $sql = "SELECT * FROM guru WHERE nip = '".$value["dilaporkan_oleh"]."'";
        $result = mysqli_query($con_mysqli, $sql);
        $row = mysqli_fetch_assoc($result);
        echo $row["nama"];
        ?></td>
        <td scope="col"><?php echo $value["wali_kelas"] ?>-<?php
        $sql = "SELECT * FROM guru WHERE nip = '".$value["wali_kelas"]."'";
        $result = mysqli_query($con_mysqli, $sql);
        $row = mysqli_fetch_assoc($result);
        echo $row["nama"];
        ?></td>
        <td scope="col"><?php echo $value["kategori_pelanggaran"] ?></td>
        <td scope="col"><?php
        $data_kels = $con_pdo->prepare("SELECT * FROM kategori_pelanggaran WHERE nama_pelanggaran = :nama");
        $data_kels->bindValue(':nama',$value["kategori_pelanggaran"]);
        $data_kels->execute();
        foreach ($data_kels as $key => $v) {
          # code...
        }
        echo $v["poin"];
        ?></td>
        <td scope="col"><?php echo $value["keterangan_tindakan"] ?></td>
        <td><?php
        echo '<a title="edit data" class="btn btn-warning badge" href="editPelanggaranlp.php?lp=' . $value["id"] . '"><i class="bi bi-pencil-fill"></i></a>';
        ?><a title="hapus data" class="btn btn-danger badge ms-2" href="deletePelanggaranlp.php?lp='<?php echo $value["id"] ?>'" onclick="return confirm('yakin ingin dihapus?')"><i class="bi bi-trash-fill"></i></a>
        <a class="btn btn-primary badge" href="printPelanggaranlp.php?siswa='<?php echo $value["nisn_siswa"] ?>'" title="cetak surat panggilan untuk <?php echo $value["nama_siswa"] ?>"><i class="bi bi-printer"></i></a>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>