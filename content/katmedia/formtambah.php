<?php
// query tambah
if (isset($_POST['input'])) {
  $katemedia = $_POST['katemedia'];

  $res = true;

  if ($res) {
    $sql = "INSERT INTO kategori_media (nama_kat_media)
      VALUES ('$katemedia')";

    if (mysqli_query($conn, $sql)) {
      echo '<script type="text/javascript">
            alert("Data Kategori Media Berhasil Ditambah");
            window.location.href="t.php?page=katmedia";
            </script>';
    } else {
      echo '<script type="text/javascript">
            alert("Data Kategori Media Gagal Ditambah");
            window.location.href="t.php?page=katmedia&act=tambah";
            </script>';
    }
  }
}
?>

<!-- agar menu sidebar saat di klik active -->
<script type="text/javascript">
  document.getElementById('katmedia').classList.add('active');
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
          <h6 class="m-0 font-weight-bold text-primary">Form Tambah <?php include 'template/title.php'; ?></h6>
        </div>
        <div class="card-body">
          <div>
            <form method="post">
              <div class="form-group row">
                <label for="katemedia" class="col-md-2 col-form-label">Kategori Media</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="katemedia" id="katemedia" placeholder="Enter Kategori Media" autocomplete="off">
                </div>
              </div>
              <div class="form-group">
                <a class="btn btn-dark btn-icon-split" title="Kembali" href="?page=katmedia">
                  <span class="text">Kembali</span>
                </a>
                <button type="submit" class="btn btn-primary" name="input">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>