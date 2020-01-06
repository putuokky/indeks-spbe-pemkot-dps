<?php

// link ke file yang dituju melalui include
if (isset($_GET['act']) && $_GET['act'] == "hapus") {
  include 'delete.php';
} else if (isset($_GET['act']) && $_GET['act'] == "tambah") {
  include 'formtambah.php';
} else if (isset($_GET['act']) && $_GET['act'] == "ubah") {
  include 'formedit.php';
} else if (isset($_GET['act']) && $_GET['act'] == "addjelas") {
  include 'formjelas.php';
} else {
  ?>


  <!-- agar menu sidebar saat di klik active -->
  <script type="text/javascript">
    document.getElementById('indikator').classList.add('active');
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
            <h6 class="m-0 font-weight-bold text-primary">Tabel <?php include 'template/title.php'; ?></h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Domain/Aspek/Indikator</th>
                    <th>Deskripsi</th>
                    <th>Bobot (%)</th>
                    <th>Bobot Aspek (%)</th>
                    <th>TK Final Adj</th>
                    <th>Indeks Akhir</th>
                </thead>
                <tfoot>
                  <tr>
                    <th>Domain/Aspek/Indikator</th>
                    <th>Deskripsi</th>
                    <th>Bobot (%)</th>
                    <th>Bobot Aspek (%)</th>
                    <th>TK Final Adj</th>
                    <th>Indeks Akhir</th>
                  </tr>
                </tfoot>
                <tbody>
                <?php
                  $sqlDomain = "SELECT * FROM tb_domain a 
                        LEFT JOIN tb_indeks b ON b.id_indeks = a.id_indeks 
                        WHERE b.nama_indeks = 'SPBE'
                        ORDER BY a.urutan_domain ASC";
                  $resultDomain = mysqli_query($conn, $sqlDomain);

                  if (mysqli_num_rows($resultDomain) > 0) {
                    // output data of each row
                    while ($rowDomain = mysqli_fetch_assoc($resultDomain)) {
                      $id_domain = $rowDomain['iddomain'];
                      $namadomain = $rowDomain['namadomain'];
                      $urutan_domain = $rowDomain['urutan_domain'];
                      ?>

                      <tr style="background-color:#79e5cb;">
                        <td><?= "Domain ".$urutan_domain; ?></td>
                        <td><?= $namadomain; ?></td>
                        <td>Bobot utk domain</td>
                        <td>bobot aspek utk domain</td>
                        <td>TK Final Adj utk domain</td>
                        <td>Indeks Akhir utk domain</td>
                      </tr>
                      <?php

                      // open aspek
                      $sqlAspek = "SELECT * FROM tb_aspek a 
                            LEFT JOIN tb_domain b ON a.iddomain = b.iddomain 
                            WHERE a.iddomain = '$id_domain'
                            ORDER BY a.urutan_aspek ASC";
                      $resultAspek = mysqli_query($conn, $sqlAspek);

                      if (mysqli_num_rows($resultAspek) > 0) {
                        // output data of each row
                        while ($rowAspek = mysqli_fetch_assoc($resultAspek)) {
                          $id_aspek = $rowAspek['idaspek'];
                          $nama_aspek = $rowAspek['nama_aspek'];
                          $urutan_aspek = $rowAspek['urutan_aspek'];
                          ?>

                          <tr style="background-color:#efefef;">
                            <td><?= "Aspek ".$urutan_aspek; ?></td>
                            <td><?= $nama_aspek; ?></td>
                            <td>
                            <?php
                            $sqlBotAspek = "SELECT SUM(a.bobot_indikator) AS bobot_indi 
                                      FROM tb_indikator a 
                                      LEFT JOIN tb_aspek b ON a.idaspek = b.idaspek 
                                      LEFT JOIN tb_detail_indikator c ON a.idindikator = c.idindikator_detail 
                                      WHERE b.idaspek = '$id_aspek'";
                            $resultBotAspek = mysqli_query($conn, $sqlBotAspek);
                            $rowBotAspek = mysqli_fetch_assoc($resultBotAspek);

                            echo number_format($rowBotAspek['bobot_indi'], 1, ",", ".");
                            ?>
                            </td>
                            <td>bobot aspek utk aspek</td>
                            <td>TK Final Adj utk aspek</td>
                            <td>Indeks Akhir utk aspek</td>
                          </tr>
                          <?php

                          // open indikator
                            $sql = "SELECT * FROM tb_indikator a 
                                  LEFT JOIN tb_aspek b ON a.idaspek = b.idaspek 
                                  LEFT JOIN tb_detail_indikator c ON a.idindikator = c.idindikator_detail
                                  WHERE b.idaspek = '$id_aspek'";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                              // output data of each row
                              while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['idindikator'];
                                $namaindikator = $row['namaindikator'];
                                $indikator = $row['indikator'];
                                $penjelasanindikator = $row['penjelasanindikator'];
                                $bobot_indikator = $row['bobot_indikator'];
                                $nama_aspek = $row['nama_aspek'];
                                $penjelasan_indikator_list = $row['penjelasan_indikator_list'];
                                $penjelasan_indikator_level = $row['penjelasan_indikator_level'];
                                $penjelasan_indikator_tambahan = $row['penjelasan_indikator_tambahan'];
                                ?>

                              <tr>
                                <td><?= "Indikator ".$indikator; ?></td>
                                <td><?= $namaindikator; ?></td>
                                <td><?= number_format($bobot_indikator, 1, ",", "."); ?></td>
                                <td>bobot aspek</td>
                                <td>final</td>
                                <td>indek akhir</td>
                              </tr>
                          <?php
                              }
                            }
                            // end indikator

                        }
                      }
                      // end aspek    
                                        
                    }
                  }
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