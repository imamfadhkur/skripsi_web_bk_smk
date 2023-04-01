<a href="tambahDataJurusan.php" class="btn btn-primary mt-4"><i class="bi bi-plus-circle"></i> tambah data jurusan</a>
<table class="table table-striped mt-1">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama Jurusan</th>
      <th scope="col">Singkatan</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include "../koneksi.php";
    $data_jurusan = $con_pdo->prepare("SELECT * FROM jurusan");
    $data_jurusan->execute();
    $count = 0;
    foreach ($data_jurusan as $key => $value) {
      $count++;
      ?>
      <tr>
        <th scope="row"><?php echo $count ?></th>
        <td><?php echo $value["nama"] ?></td>
        <td><?php echo $value["singkatan"] ?></td>
        <td><?php
        echo '<a class="btn btn-warning badge" href="editDataJurusan.php?singkatan=' . $value["singkatan"] . '"><i class="bi bi-pencil-fill"></i></a>';
        ?><a class="btn btn-danger badge m-1" href="deleteDataJurusan.php?singkatan='<?php echo $value["singkatan"] ?>'" onclick="return confirm('yakin ingin dihapus?')"><i class="bi bi-trash-fill"></i></a>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>