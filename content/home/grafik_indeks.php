<div class="card shadow mb-4">
  <!-- Card Header -->
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Grafik Nilai Indeks</h6>
  </div>
  <!-- Card Body -->
  <div class="card-body">
    <div id="grafikindeks"></div>

    <?php
    // deklarasi ambil data indeks
    $indeks = "SPBE";
    // $tahun_indeks = 2018;

    // deklarasi ambil nama aspek
    if (isset($_POST['cari'])) {
      $caritahun = $_POST['caritahun'];
      $sqlAspek = "SELECT * FROM tb_aspek a 
                    JOIN tb_domain b ON a.iddomain = b.iddomain 
                    JOIN tb_indeks c ON c.id_indeks = b.id_indeks
                    WHERE a.tahun_aspek LIKE '%$caritahun%' && c.nama_indeks = '" . $indeks . "'";
    } else {
      $sqlAspek = "SELECT * FROM tb_aspek a 
                    JOIN tb_domain b ON a.iddomain = b.iddomain 
                    JOIN tb_indeks c ON c.id_indeks = b.id_indeks
                    WHERE a.tahun_aspek = $thnkmrn && c.nama_indeks = '" . $indeks . "'";
    }
    $resultAspek = mysqli_query($conn, $sqlAspek);
    while ($rowAspek = mysqli_fetch_assoc($resultAspek)) {
      $idAspek = $rowAspek['idaspek'];
      $nama_aspek[] = '"' . $rowAspek['nama_aspek'] . '"';
      $target[] = $rowAspek['target'];
      $nilai_indeks_aspek[] = $rowAspek['nilai_indeks_aspek'];
      $tahun_aspek = $rowAspek['tahun_aspek'];
    }

    ?>

    <script>
      Highcharts.chart('grafikindeks', {

        chart: {
          polar: true,
          type: 'line'
        },

        accessibility: {
          description: ''
        },

        title: {
          text: 'Nilai Indeks Aspek SPBE <?= $tahun_aspek; ?>',
          x: 0
        },

        pane: {
          size: '80%'
        },

        xAxis: {
          categories: [<?= join($nama_aspek, ','); ?>],
          tickmarkPlacement: 'on',
          lineWidth: 0
        },

        yAxis: {
          gridLineInterpolation: 'polygon',
          lineWidth: 0,
          min: 0
        },

        tooltip: {
          shared: true,
          pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.2f}</b><br/>'
        },

        legend: {
          align: 'right',
          verticalAlign: 'middle'
        },

        series: [{
          name: 'Target',
          data: [<?= join($target, ','); ?>],
          pointPlacement: 'on'
        }, {
          name: 'Nilai',
          data: [<?= join($nilai_indeks_aspek, ','); ?>],
          pointPlacement: 'on'
        }],

        responsive: {
          rules: [{
            condition: {
              maxWidth: 500
            },
            chartOptions: {
              legend: {
                align: 'center',
                verticalAlign: 'bottom'
              },
              pane: {
                size: '70%'
              }
            }
          }]
        }

      });
    </script>
  </div>
</div>