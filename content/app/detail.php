<?php

// inisiasi id
if (isset($_GET['id']) && $_GET['id'] != "") {
  $id = $_GET['id'];
} else {
  $id = "";
}

// query tampil id
$sqlTampil = "SELECT * FROM aplikasi WHERE id_app = '$id'";
$resTampil = mysqli_query($conn, $sqlTampil);
$data = mysqli_fetch_assoc($resTampil);
$idx = $data['id_app'];

// link ke file yang dituju melalui include
if (isset($_GET['aksi']) && $_GET['aksi'] == "") {
  include '';
} else if (isset($_GET['aksi']) && $_GET['aksi'] == "tambahdetail") {
  include 'formtambahdetail.php';
} else if (isset($_GET['aksi']) && $_GET['aksi'] == "") {
  include '';
} else {
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

        <a class="btn btn-primary btn-icon-split h3 mb-4" title="Tambah" href="?page=app&act=detail&id=<?= $idx; ?>&aksi=tambahdetail">
          <span class="icon">
            <i class="fas fa-fw fa-plus"></i>
          </span>
          <span class="text">Tambah</span>
        </a>

        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Detail <?php include 'template/title.php'; ?></h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Action</th>
                    <th>Version</th>
                    <th>Integrasi</th>
                    <th>Tahun Pengembangan</th>
                    <th>Bahasa Pemrograman</th>
                    <th>Database</th>
                    <th>Vendor</th>
                    <th>Kontak</th>
                    <th>User/DLU</th>
                </thead>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Action</th>
                    <th>Version</th>
                    <th>Integrasi</th>
                    <th>Tahun Pengembangan</th>
                    <th>Bahasa Pemrograman</th>
                    <th>Database</th>
                    <th>Vendor</th>
                    <th>Kontak</th>
                    <th>User/DLU</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  if ($_SESSION['groupuser'] == 1 && $_SESSION['grupindeks'] == 0) {
                    $sql = "SELECT a.id_detail_aplikasi,a.id_aplikasi,a.input,a.output,a.version,a.db,a.pemrograman,a.pemrograman,a.integrasi,a.thn_pengembangan,a.cpu_server,a.ram_server,a.harddisk_server,a.os_server,a.bp_server,a.web_server,a.database_server,a.bplain_server,a.judul_spk,a.nilai_spk,a.sumberdana_spk,a.vendor,a.kontak_vendor,a.usr,a.dlu,b.judul,b.unit,c.nama_kat_database 
                    FROM detail_aplikasi a 
                    LEFT JOIN aplikasi b ON b.id_app = a.id_aplikasi 
                    LEFT JOIN kategori_database c ON c.id_kat_database = a.db";
                  } else {
                    $sql = "SELECT a.id_detail_aplikasi,a.id_aplikasi,a.input,a.output,a.version,a.db,a.pemrograman,a.pemrograman,a.integrasi,a.thn_pengembangan,a.cpu_server,a.ram_server,a.harddisk_server,a.os_server,a.bp_server,a.web_server,a.database_server,a.bplain_server,a.judul_spk,a.nilai_spk,a.sumberdana_spk,a.vendor,a.kontak_vendor,a.usr,a.dlu,b.judul,b.unit,c.nama_kat_database 
                    FROM detail_aplikasi a 
                    LEFT JOIN aplikasi b ON b.id_app = a.id_aplikasi 
                    LEFT JOIN kategori_database c ON c.id_kat_database = a.db
                  WHERE b.unit = $_SESSION[opd]";
                  }

                  $sql = $sql . " ORDER BY a.id_detail_aplikasi DESC";

                  $result = mysqli_query($conn, $sql);

                  if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    // output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                      $id = $row['id_detail_aplikasi'];
                  ?>

                      <tr>
                        <td><?= $no; ?></td>
                        <td>
                          <!-- <a class="btn btn-dark btn-sm" title="Info" href="?page=app&act=info&id=<?= $id; ?>"><i class="fas fa-fw fa-info"></i></a> -->
                          <a class="btn btn-warning btn-sm" title="Edit" href="?page=app&act=ubah&id=<?= $id; ?>"><i class="fas fa-fw fa-edit"></i></a>
                          <a class="btn btn-danger btn-sm" title="Hapus" href="" data-toggle="modal" data-target="#modalHapus-<?= $id; ?>"><i class="fas fa-fw fa-trash-alt"></i></a>

                          <!-- Modal Hapus -->
                          <?php include 'modal_hapus.php'; ?>
                          <!-- Modal Hapus -->

                        </td>
                        <td><?= $row['version']; ?></td>
                        <td><?= $row['integrasi']; ?></td>
                        <td><?= $row['thn_pengembangan']; ?></td>
                        <td><?= $row['pemrograman']; ?></td>
                        <td><?= $row['nama_kat_database']; ?></td>
                        <td><?= $row['vendor']; ?></td>
                        <td><?= $row['kontak_vendor']; ?></td>
                        <td><?= $row['usr']; ?><br><?= $row['dlu']; ?></td>
                      </tr>
                  <?php
                      $no++;
                    }
                  }
                  mysqli_close($conn);
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

<?php } ?>