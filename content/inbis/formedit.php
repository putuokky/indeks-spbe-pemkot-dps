<?php

// inisiasi id
if (isset($_GET['id']) && $_GET['id'] != "") {
  $id = $_GET['id'];
} else {
  $id = "";
}

// query edit
if (isset($_POST['update'])) {
  $katinbis   = $_POST['katinbis'];
  $ketinbis   = $_POST['ketinbis'];

  $res = true;

  if ($res) {
    $sql = "UPDATE tb_inbis 
        SET nama_inbis = '$katinbis',
        ket_inbis = '$ketinbis'
        WHERE id_inbis = '$id'";

    if (mysqli_query($conn, $sql)) {
      echo '<script type="text/javascript">
            alert("Data Kategori Inbis Berhasil Diedit");
            window.location.href="t.php?page=inbis";
            </script>';
    } else {
      echo '<script type="text/javascript">
            alert("Data Kategori Inbis Gagal Diedit");
            window.location.href="t.php?page=inbis&act=ubah&id=' . $id . '";";
            </script>';
    }
  }
}

// query menampilkan data dengan id
$sqlUbah = "SELECT * FROM tb_inbis WHERE id_inbis = '$id'";
$resUbah = mysqli_query($conn, $sqlUbah);
$data = mysqli_fetch_assoc($resUbah);
?>

<!-- agar menu sidebar saat di klik active -->
<script type="text/javascript">
  document.getElementById('inbis').classList.add('active');
</script>

<!-- isi konten -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">

    <h1 class="h3 mb-0 text-gray-800"><?php include 'template/title.php'; ?></h1>

  </div>

  <div class="row">

    <div class="col-xl-12 col-lg-12">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Form Ubah <?php include 'template/title.php'; ?></h6>
        </div>
        <div class="card-body">
          <div>
            <form method="post">
              <div class="form-group row">
                <label for="katinbis" class="col-md-2 col-form-label">Kategori Inbis</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="katinbis" id="katinbis" placeholder="Enter Kategori Inbis" autocomplete="off" value="<?= $data['nama_inbis']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="ketinbis" class="col-md-2 col-form-label">Keterangan Inbis</label>
                <div class="col-md-10">
                  <textarea class="form-control" id="ketinbis" name="ketinbis" rows="3" placeholder="Enter Keterangan Inbis"><?= $data['ket_inbis']; ?></textarea>
                </div>
              </div>
              <div class="form-group">
                <a class="btn btn-dark btn-icon-split" title="Kembali" href="?page=inbis">
                  <span class="text">Kembali</span>
                </a>
                <button type="submit" class="btn btn-primary" name="update">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>