<?php

// inisiasi id
if (isset($_GET['id']) && $_GET['id'] != "") {
  $id = $_GET['id'];
} else {
  $id = "";
}

// query edit
if (isset($_POST['update'])) {
  $judul            = $_POST['judul'];
  $klasifikasi      = $_POST['klasifikasi'];
  $katapp           = $_POST['katapp'];
  $infofungsi       = $_POST['infofungsi'];
  $platform         = $_POST['platform'];
  $alamaturl        = $_POST['alamaturl'];
  $opdpengembangapp = $_POST['opdpengembangapp'];
  $opdpengelolaaapp = $_POST['opdpengelolaaapp'];
  $opdpenggunaapp   = $_POST['opdpenggunaapp'];
  $status           = $_POST['status'];
  $thnbuat          = $_POST['thnbuat'];

  $res = true;

  if ($res) {
    $sql = "UPDATE aplikasi 
        SET judul = '$judul',
        klasifikasi_aplikasi = '$klasifikasi',
        kategori_aplikasi = '$katapp',
        infofungsi = '$infofungsi',
        media = '$platform',
        link = '$alamaturl',
        unit_pengembang = '$opdpengembangapp',
        unit = '$opdpengelolaaapp',
        unit_pengguna = '$opdpenggunaapp',
        sts_aktif = '$status',
        thn_pembuatan = '$thnbuat',
        usr = '$_SESSION[userid]',
        dlu = '$datenow2'
        WHERE id_app = '$id'";

    if (mysqli_query($conn, $sql)) {
      echo '<script type="text/javascript">
            alert("Data Aplikasi Berhasil Diedit");
            window.location.href="t.php?page=app";
            </script>';
    } else {
      echo '<script type="text/javascript">
            alert("Data Aplikasi Gagal Diedit");
            window.location.href="t.php?page=app&act=ubah&id=$id";
            </script>';
    }
  }
}

// query menampilkan data dengan id
$sqlUbah = "SELECT * FROM aplikasi WHERE id_app = '$id'";
$resUbah = mysqli_query($conn, $sqlUbah);
$data = mysqli_fetch_assoc($resUbah);
?>

<!-- agar menu sidebar saat di klik active -->
<script type="text/javascript">
  document.getElementById('app').classList.add('active');
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
          <h6 class="m-0 font-weight-bold text-primary">Form Edit <?php include 'template/title.php'; ?></h6>
        </div>
        <div class="card-body">
          <div>
            <form method="post">
              <div class="form-group row">
                <label for="judul" class="col-md-2 col-form-label">Judul</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="judul" id="judul" value="<?= $data['judul']; ?>" placeholder="Enter Judul" autocomplete="off">
                </div>
              </div>
              <div class="form-group row">
                <label for="klasifikasi" class="col-md-2 col-form-label">Sifat Klasifikasi</label>
                <div class="col-md-2">
                  <select class="form-control" id="klasifikasi" name="klasifikasi">
                    <option value="0">-</option>
                    <?php
                    $sqlKlaApp = "SELECT * FROM klasifikasi_aplikasi";
                    $resKlaApp = mysqli_query($conn, $sqlKlaApp);
                    while ($rowKlaApp = mysqli_fetch_assoc($resKlaApp)) {
                      if ($rowKlaApp['id_klasifikasi_app'] == $data['klasifikasi_aplikasi']) : ?>
                        <option value="<?= $rowKlaApp['id_klasifikasi_app']; ?>" selected><?= $rowKlaApp['nama_klasifikasi_app']; ?></option>
                      <?php else : ?>
                        <option value="<?= $rowKlaApp['id_klasifikasi_app']; ?>"><?= $rowKlaApp['nama_klasifikasi_app']; ?></option>
                      <?php endif; ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="katapp" class="col-md-2 col-form-label">Kategori Aplikasi</label>
                <div class="col-md-2">
                  <select class="form-control" id="katapp" name="katapp">
                    <option value="0">-</option>
                    <?php
                    $sqlKatApp = "SELECT * FROM kategori_aplikasi";
                    $resKatApp = mysqli_query($conn, $sqlKatApp);
                    while ($rowKatApp = mysqli_fetch_assoc($resKatApp)) {
                      if ($rowKatApp['id_kat_aplikasi'] == $data['kategori_aplikasi']) : ?>
                        <option value="<?= $rowKatApp['id_kat_aplikasi']; ?>" selected><?= $rowKatApp['kat_aplikasi']; ?></option>
                      <?php else : ?>
                        <option value="<?= $rowKatApp['id_kat_aplikasi']; ?>"><?= $rowKatApp['kat_aplikasi']; ?></option>
                      <?php endif; ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="infofungsi" class="col-md-2 col-form-label">Info / Fungsi</label>
                <div class="col-md-10">
                  <textarea class="form-control" id="infofungsi" name="infofungsi" rows="5" placeholder="Enter Info / Fungsi"><?= $data['infofungsi']; ?></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="platform" class="col-md-2 col-form-label">Platform</label>
                <div class="col-md-2">
                  <select class="form-control" id="platform" name="platform">
                    <option value="0">-</option>
                    <?php
                    $sqlKatMedia = "SELECT * FROM kategori_media";
                    $resKatMedia = mysqli_query($conn, $sqlKatMedia);
                    while ($rowKatMedia = mysqli_fetch_assoc($resKatMedia)) {
                      if ($rowKatMedia['id_media'] == $data['media']) : ?>
                        <option value="<?= $rowKatMedia['id_media']; ?>" selected><?= $rowKatMedia['nama_kat_media']; ?></option>
                      <?php else : ?>
                        <option value="<?= $rowKatMedia['id_media']; ?>"><?= $rowKatMedia['nama_kat_media']; ?></option>
                      <?php endif; ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="alamaturl" class="col-md-2 col-form-label">Alamat URL</label>
                <div class="col-md-10">
                  <textarea class="form-control" id="alamaturl" name="alamaturl" rows="5" placeholder="Enter Alamat URL"><?= $data['link']; ?></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="opdpengembangapp" class="col-md-2 col-form-label">Perangkat Daerah Pengembang Aplikasi</label>
                <div class="col-md-10">
                  <select class="form-control" id="opdpengembangapp" name="opdpengembangapp">
                    <option>-</option>
                    <?php
                    $sqlUnitPengembang = "SELECT * FROM tb_opd WHERE LENGTH(idopd)=6 ORDER BY namaopd ASC";
                    $resUnitPengembang = mysqli_query($conn, $sqlUnitPengembang);
                    while ($rowUnitPengembang = mysqli_fetch_assoc($resUnitPengembang)) {
                      if ($rowUnitPengembang['idopd'] == $data['unit_pengembang']) : ?>
                        <option value="<?= $rowUnitPengembang['idopd']; ?>" selected><?= $rowUnitPengembang['namaopd']; ?></option>
                      <?php else : ?>
                        <option value="<?= $rowUnitPengembang['idopd']; ?>"><?= $rowUnitPengembang['namaopd']; ?></option>
                      <?php endif; ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="opdpengelolaaapp" class="col-md-2 col-form-label">Perangkat Daerah Pengelola Aplikasi</label>
                <div class="col-md-10">
                  <select class="form-control" id="opdpengelolaaapp" name="opdpengelolaaapp">
                    <option>-</option>
                    <?php
                    $sqlUnitPengelola = "SELECT * FROM tb_opd WHERE LENGTH(idopd)=6 ORDER BY namaopd ASC";
                    $resUnitPengelola = mysqli_query($conn, $sqlUnitPengelola);
                    while ($rowUnitPengelola = mysqli_fetch_assoc($resUnitPengelola)) {
                      if ($rowUnitPengelola['idopd'] == $data['unit']) : ?>
                        <option value="<?= $rowUnitPengelola['idopd']; ?>" selected><?= $rowUnitPengelola['namaopd']; ?></option>
                      <?php else : ?>
                        <option value="<?= $rowUnitPengelola['idopd']; ?>"><?= $rowUnitPengelola['namaopd']; ?></option>
                      <?php endif; ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="opdpenggunaapp" class="col-md-2 col-form-label">Perangkat Daerah Pengguna Aplikasi</label>
                <div class="col-md-10">
                  <select class="form-control" id="opdpenggunaapp" name="opdpenggunaapp">
                    <option>-</option>
                    <?php
                    $sqlUnitPengguna = "SELECT * FROM tb_opd WHERE LENGTH(idopd)=6 ORDER BY namaopd ASC";
                    $resUnitPengguna = mysqli_query($conn, $sqlUnitPengguna);
                    while ($rowUnitPengguna = mysqli_fetch_assoc($resUnitPengguna)) {
                      if ($rowUnitPengguna['idopd'] == $data['unit_pengguna']) : ?>
                        <option value="<?= $rowUnitPengguna['idopd']; ?>" selected><?= $rowUnitPengguna['namaopd']; ?></option>
                      <?php else : ?>
                        <option value="<?= $rowUnitPengguna['idopd']; ?>"><?= $rowUnitPengguna['namaopd']; ?></option>
                      <?php endif; ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="status" class="col-md-2 col-form-label">Status</label>
                <div class="col-md-2">
                  <select class="form-control" id="status" name="status">
                    <?php if ($data['sts_aktif'] == 'aktif') { ?>
                      <option>-</option>
                      <option value="aktif" selected>Aktif</option>
                      <option value="naktif">Tidak Aktif</option>
                    <?php } else if ($data['sts_aktif'] == 'naktif') { ?>
                      <option>-</option>
                      <option value="aktif">Aktif</option>
                      <option value="naktif" selected>Tidak Aktif</option>
                    <?php } else { ?>
                      <option>-</option>
                      <option value="aktif">Aktif</option>
                      <option value="naktif">Tidak Aktif</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="thnbuat" class="col-md-2 col-form-label">Tahun Pembuatan</label>
                <div class="col-md-2">
                  <select class="form-control" id="thnbuat" name="thnbuat">
                    <option>-</option>
                    <?php
                    for ($i = $tahun_old; $i <= $thnnow; $i++) {
                      if ($i == $data['thn_pembuatan']) : ?>
                        <option value="<?= $i; ?>" selected><?= $i; ?></option>
                      <?php else : ?>
                        <option value="<?= $i; ?>"><?= $i; ?></option>
                      <?php endif; ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <a class="btn btn-dark btn-icon-split" title="Kembali" href="?page=app">
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