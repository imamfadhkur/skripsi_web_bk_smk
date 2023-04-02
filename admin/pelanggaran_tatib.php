<a href="tambahPelanggarantatib.php" class="btn btn-primary mt-4"><i class="bi bi-plus-circle"></i> tambah data tata tertib</a>
<table class="table table-striped mt-1">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Jenis Tata Tertib</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include "../koneksi.php";
    $data_kelas = $con_pdo->prepare("SELECT * FROM tata_tertib");
    $data_kelas->execute();
    $count = 0;
    foreach ($data_kelas as $key => $value) {
      $count++;
      ?>
      <tr>
        <th scope="row"><?php echo $count ?></th>
        <td><?php echo $value["jenis_tatib"] ?></td>
        <td><?php echo $value["keterangan"] ?></td>
        <td><?php
        echo '<a class="btn btn-warning badge" href="editPelanggarantatib.php?nama=' . $value["jenis_tatib"] . '"><i class="bi bi-pencil-fill"></i></a>';
        ?><a class="btn btn-danger badge m-1" href="deletePelanggarantatib.php?nama='<?php echo $value["jenis_tatib"] ?>'" onclick="return confirm('yakin ingin dihapus?')"><i class="bi bi-trash-fill"></i></a>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>