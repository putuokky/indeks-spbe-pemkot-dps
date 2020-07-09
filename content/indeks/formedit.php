<?php

// inisiasi id
if (isset($_GET['id']) && $_GET['id'] != "") {
  $id = $_GET['id'];
} else {
  $id = "";
}

// query edit
if (isset($_POST['update'])) {
  $namaindeks   = $_POST['namaindeks'];
  $nilaindeks   = $_POST['nilaindeks'];
  $nilaindeks   = str_replace(",", ".", $nilaindeks);
  $tahun        = $_POST['tahun'];
  $urutanindeks = $_POST['urutanindeks'];
  $katindeks    = $_POST['katindeks'];

  $res = true;

  if ($res) {
    $sql = "UPDATE tb_indeks 
        SET nama_indeks = '$namaindeks',
        tahun_indeks = '$tahun',
        urutan_indeks = '$urutanindeks',
        nilai_indeks = '$nilaindeks',
        user_katindex = '$katindeks'
        WHERE id_indeks = '$id'";

    if (mysqli_query($conn, $sql)) {
      echo '<script type="text/javascript">
            alert("Data Indeks Berhasil Diedit");
            window.location.href="t.php?page=indeks";
            </script>';
    } else {
      echo '<script type="text/javascript">
            alert("Data Indeks Gagal Diedit");
            window.location.href="t.php?page=indeks&act=ubah&id=$id";
            </script>';
    }
  }
}

// query menampilkan data dengan id
$sqlUbah = "SELECT * FROM tb_indeks WHERE id_indeks = '$id'";
$resUbah = mysqli_query($conn, $sqlUbah);
$data = mysqli_fetch_assoc($resUbah);

?>

<!-- agar menu sidebar saat di klik active -->
<script type="text/javascript">
  document.getElementById('indeks').classList.add('active');
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
                <label for="namaindeks" class="col-md-2 col-form-label">Nama Indeks</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="namaindeks" id="namaindeks" placeholder="Enter Nama Indeks" autocomplete="off" value="<?= $data['nama_indeks']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="nilaindeks" class="col-md-2 col-form-label">Nilai Indeks</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="nilaindeks" id="nilaindeks" placeholder="Enter Nilai Indeks" autocomplete="off" value="<?= number_format($data['nilai_indeks'], 2, ",", "."); ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="tahun" class="col-md-2 col-form-label">Tahun</label>
                <div class="col-md-10">
                  <select class="form-control" id="tahun" name="tahun">
                    <option value="0">-</option>
                    <?php
                    $thnnow = date('Y');
                    for ($i = 2010; $i <= $thnnow; $i++) {
                      if ($data['tahun_indeks'] == $i) { ?>
                        <option value="<?= $i; ?>" selected><?= $i; ?></option>
                      <?php } else { ?>
                        <option value="<?= $i; ?>"><?= $i; ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="urutanindeks" class="col-md-2 col-form-label">Urutan</label>
                <div class="col-md-2">
                  <input type="text" class="form-control" name="urutanindeks" id="urutanindeks" placeholder="Enter Urutan" autocomplete="off" value="<?= $data['urutan_indeks']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="katindeks" class="col-md-2 col-form-label">Kategori Indeks</label>
                <div class="col-md-2">
                  <select class="form-control" id="katindeks" name="katindeks">
                    <option value="0">-</option>
                    <?php
                    if ($_SESSION['grupindeks'] == 1) {
                      $sqlKatindeks = "SELECT * FROM tbl_user_katindex
                      WHERE id_user_katindex = $_SESSION[grupindeks]";
                    } else if ($_SESSION['grupindeks'] == 2) {
                      $sqlKatindeks = "SELECT * FROM tbl_user_katindex
                      WHERE id_user_katindex = $_SESSION[grupindeks]";
                    } else {
                      $sqlKatindeks = "SELECT * FROM tbl_user_katindex";
                    }
                    $resKatindeks = mysqli_query($conn, $sqlKatindeks);
                    while ($rowKatindeks = mysqli_fetch_assoc($resKatindeks)) {
                      if ($data['user_katindex'] == $rowKatindeks['id_user_katindex']) { ?>
                        <option value="<?= $rowKatindeks['id_user_katindex']; ?>" selected><?= $rowKatindeks['user_katindex']; ?></option>
                      <?php } else { ?>
                        <option value="<?= $rowKatindeks['id_user_katindex']; ?>"><?= $rowKatindeks['user_katindex']; ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <a class="btn btn-dark btn-icon-split" title="Kembali" href="?page=indeks">
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