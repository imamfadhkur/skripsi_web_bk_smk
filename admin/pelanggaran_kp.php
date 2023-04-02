<a href="tambahPelanggarankp.php" class="btn btn-primary mt-4"><i class="bi bi-plus-circle"></i> tambah data kategori pelanggaran</a>
<table class="table table-striped mt-1">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama Pelanggaran</th>
      <th scope="col">Poin</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include "../koneksi.php";
    $data_kelas = $con_pdo->prepare("SELECT * FROM kategori_pelanggaran");
    $data_kelas->execute();
    $count = 0;
    foreach ($data_kelas as $key => $value) {
      $count++;
      ?>
      <tr>
        <th scope="row"><?php echo $count ?></th>
        <td><?php echo $value["nama_pelanggaran"] ?></td>
        <td><?php echo $value["poin"] ?></td>
        <td><?php
        echo '<a class="btn btn-warning badge" href="editPelanggarankp.php?nama=' . $value["nama_pelanggaran"] . '"><i class="bi bi-pencil-fill"></i></a>';
        ?><a class="btn btn-danger badge m-1" href="deletePelanggarankp.php?nama='<?php echo $value["nama_pelanggaran"] ?>'" onclick="return confirm('yakin ingin dihapus?')"><i class="bi bi-trash-fill"></i></a>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>