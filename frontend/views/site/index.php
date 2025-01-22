<?php
use yii\helpers\Html;
/** @var yii\web\View $this */
use common\models\Masyarakat;
use yii\helpers\Url;
$this->title = 'My Yii Application';
$this->registerJs("
  $(function() {
                                // Initialize the Peity bar chart
    $('.peity-bar').peity('bar');
    });
    ");

$dataMasyarakat = Masyarakat::find()
        ->limit(5) // Batasi hasil hanya 10 data
        ->all();

$dusunData = Masyarakat::find()
->select(['dusun', 'COUNT(*) AS total'])
->groupBy('dusun')
->asArray()
->all();

$labels = array_column($dusunData, 'dusun');
$totals = array_column($dusunData, 'total');

$labelsJs = json_encode($labels); // Konversi labels ke JSON
$totalsJs = json_encode($totals); // Konversi data ke JSON



$totalLakiLaki = Masyarakat::find()
->where(['jk' => 'L'])
->count();
$totalPerempuan = Masyarakat::find()
->where(['jk' => 'P'])
->count();

$totalKeseluruhan = $totalLakiLaki + $totalPerempuan;


$data = Yii::$app->db->createCommand("
  SELECT status_keluarga, COUNT(*) as jumlah
  FROM masyarakat
  GROUP BY status_keluarga
  ")->queryAll();

$labels = array_column($data, 'status_keluarga'); // Ambil label
$values = array_column($data, 'jumlah'); // Ambil jumlah

$datasekolah = Yii::$app->db->createCommand("
  SELECT status_sekolah, COUNT(*) as jumlah
  FROM masyarakat
  GROUP BY status_sekolah
  ")->queryAll();

$totalsekolah = array_sum(array_column($data, 'jumlah'));


$totalPenerimaRaskin = Yii::$app->db->createCommand('
    SELECT COUNT(*) 
    FROM masyarakat 
    WHERE penerima_raskin = :value
')
->bindValue(':value', 'Ya')
->queryScalar();
$totalPenerimaBPJS = Yii::$app->db->createCommand('
    SELECT COUNT(*) 
    FROM masyarakat 
    WHERE penerima_BPJS = :value
')
->bindValue(':value', 'Ya')
->queryScalar();

?>
<div class="container">
  <div class="az-content-body">
    <div class="az-dashboard-one-title">
      <div>
        <h2 class="az-dashboard-title">Hi, welcome back <?=Yii::$app->user->identity->username?>!</h2>
        <p class="az-dashboard-text">Sistem Informasi Pencatatan Data Penduduk Desa Parombean</p>
      </div>
      <div class="az-content-header-right">
        
        <div class="media">
          <div class="media-body">
            <label>Backup & Restore</label>
            <h6>Data Penduduk</h6>
          </div><!-- media-body -->
        </div><!-- media -->
        <?= Html::a(' Backup Data', ['backup'], ['class' => 'btn btn-primary typcn typcn-folder']) ?>
        <?= Html::a(' Restore Data', ['restore'], ['class' => 'btn btn-info typcn typcn-arrow-back-outline']) ?>
      </div>
    </div><!-- az-dashboard-one-title -->

    <div class="az-dashboard-nav"> 
      <nav class="nav ">
        <!-- <a class="nav-link active" data-toggle="tab" href="#dash">Jumlah Penduduk</a> -->
              <!-- <a class="nav-link" data-toggle="tab" href="#aud">Audiences</a>
              <a class="nav-link" data-toggle="tab" href="#demo">Demographics</a>
              <a class="nav-link" data-toggle="tab" href="#">More</a> -->
            </nav>

            <nav class="nav">
              <a class="nav-link" href="<?= \yii\helpers\Url::to(['site/export-excel']) ?>">
                <i class="far fa-save"></i> Save Excel
              </a>
              <a class="nav-link" href="<?= \yii\helpers\Url::to(['site/export-pdf']) ?>">
                <i class="far fa-file-pdf"></i> Export to PDF
              </a>
<!-- 
              <a class="nav-link" href="#"><i class="far fa-envelope"></i>Send to Email</a> -->
              <a class="nav-link" href="#"><i class="fas fa-ellipsis-h"></i></a>
            </nav>
          </div>


          <div class="tab-content mb-4">
           <div class="tab-pane fade show active" id="dash" role="tabpanel">
            <div class="row row-sm mg-b-20">
              <div class="col-lg-7 ht-lg-100p">
                <div class="card card-dashboard-one">
                  <div class="card-header">
                    <div>
                      <h6 class="card-title">Grafik Data Penduduk Desa Parombean</h6>
                      <p class="card-text">Jumlah jiwa berdasarkan dusun.</p>
                    </div>
                    <div class="btn-group">
                      <div class="btn btn-az-light date-display">
                          Today, <?= date('d F Y') ?>
                      </div>
                      </div>
                  </div><!-- card-header -->
                  <div class="card-body">
                    <div class="ms-2 me-3">
                      <canvas id="myChart"></canvas>
                    </div>
                    <?php
                    $this->registerJs("
                      var ctx = document.getElementById('myChart').getContext('2d');

                      var labels = $labelsJs; // Nama-nama dusun
                      var totals = $totalsJs; // Data total per dusun

                      var backgroundColors = [
                      'rgba(54, 162, 235, 0.2)', // Biru
                      'rgba(255, 206, 86, 0.2)', // Kuning
                      'rgba(75, 192, 192, 0.2)', // Hijau muda
                      'rgba(153, 102, 255, 0.2)', // Ungu
                      'rgba(255, 159, 64, 0.2)', // Oranye
                      'rgba(60, 179, 113, 0.2)', // Hijau
                      'rgba(244, 164, 96, 0.2)'  // Cokelat muda
                      ];
                      var borderColors = [
                      'rgba(54, 162, 235, 1)', // Biru
                      'rgba(255, 206, 86, 1)', // Kuning
                      'rgba(75, 192, 192, 1)', // Hijau muda
                      'rgba(153, 102, 255, 1)', // Ungu
                      'rgba(255, 159, 64, 1)', // Oranye
                      'rgba(60, 179, 113, 1)', // Hijau
                      'rgba(244, 164, 96, 1)'  // Cokelat muda
                      ];

                      var datasets = [{
                        label: 'Total Data', // Label utama
                        data: totals, // Data total per dusun
                        backgroundColor: backgroundColors.slice(0, totals.length), // Warna sesuai jumlah data
                        borderColor: borderColors.slice(0, totals.length), // Border sesuai jumlah data
                        borderWidth: 1
                        }];

                        var myChart = new Chart(ctx, {
                          type: 'bar',
                          data: {
                            labels: labels, // Nama-nama dusun pada sumbu X
                            datasets: datasets // Dataset untuk setiap dusun
                            },
                            options: {
                              plugins: {
                                legend: {
                                  display: true, // Legend tetap ditampilkan jika dibutuhkan
                                  },
                                  tooltip: {
                                    callbacks: {
                                      label: function(context) {
                                        var label = labels[context.dataIndex] || ''; // Nama dusun
                                        var value = context.raw; // Nilai data
                                        return label + ': ' + value; // Tooltip menampilkan nama dusun dan nilai total
                                      }
                                    }
                                  }
                                  },
                                  scales: {
                                    y: {
                                      beginAtZero: true, 
                                      ticks: {
                                        stepSize: 1, 
                                        precision: 0, 
                                        callback: function(value) {
                                          return value.toString();
                                        }
                                        },
                                        min: 0, 
                                        suggestedMax: Math.ceil(Math.max(...totals)) + 1 
                                      }
                                    }
                                  }
                                  });

                                  ");
                                  ?>
                                </div>
                              </div><!-- card -->
                            </div><!-- col -->
                            <div class="col-lg-5 mg-t-20 mg-lg-t-0">
                              <div class="row row-sm">
                                <div class="col-sm-6">
                                  <div class="card card-dashboard-two mb-4">
                                    <div class="card-header">
                                      <h6> <?php echo $totalLakiLaki ?> 
                                      <i class="icon ion-md-trending-up tx-success"></i> <small>Laki-Laki</small></h6>
                                      <p>Total</p>
                                    </div><!-- card-header -->

                                  </div><!-- card -->
                                </div><!-- col -->
                                <div class="col-sm-6">
                                  <div class="card card-dashboard-two">
                                    <div class="card-header">
                                      <h6><?php echo $totalPerempuan ?> <i class="icon ion-md-trending-up tx-success"></i> <small>Perempuan</small></h6>
                                      <p>Total</p>
                                    </div><!-- card-header -->
                                  </div><!-- card -->
                                </div><!-- col -->
                                <div class="col-sm-12 mg-t-20">
                                  <div class="card card-dashboard-three">
                            
                                    <div class="chart mg-t-10 w-100 h-100">
                                      <canvas id="chartBar5"></canvas>
                                    </div>
                             

                                  <?php
                                  $totalLakiLaki = Masyarakat::find()
                                  ->where(['jk' => 'L'])
                                  ->count();

                                  $totalPerempuan = Masyarakat::find()
                                  ->where(['jk' => 'P'])
                                  ->count();

                    // Membuat data untuk digunakan di Chart.js
                                  $chartData = json_encode([
                        'labels' => ['Jenis Kelamin'], // Label pada sumbu X
                        'datasets' => [
                          [
                            'label' => 'Laki-Laki',
                                'data' => [$totalLakiLaki], // Data jumlah laki-laki
                                'borderColor' => 'rgb(75, 192, 192)',
                                'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                                'borderWidth' => 1
                              ],
                              [
                                'label' => 'Perempuan',
                                'data' => [$totalPerempuan], // Data jumlah perempuan
                                'borderColor' => 'rgb(153, 102, 255)',
                                'backgroundColor' => 'rgba(153, 102, 255, 0.2)',
                                'borderWidth' => 1
                              ]
                            ]
                          ]);

                    // Registrasi script JavaScript untuk Chart.js
                                  $this->registerJs("
                                    $(function() {
                                      var ctx = document.getElementById('chartBar5').getContext('2d');
                                      var chartBar5 = new Chart(ctx, {
                                        type: 'bar',
                                        data: $chartData,
                                        options: {
                                          responsive: true,
                                          scales: {
                                            y: {

                                              beginAtZero: true, // Mulai dari 0
                                              ticks: {
                                                stepSize: 1, // Langkah bilangan bulat
                                                callback: function(value) {
                                                  return Number.isInteger(value) ? value : ''; // Hanya tampilkan bilangan bulat
                                                }
                                                },
                                                min: 0, // Pastikan nilai minimum adalah 0
                                                suggestedMax: Math.ceil(Math.max(...totals)) + 1 
                                              }
                                            }
                                          }
                                          });
                                          });
                                          ");
                                          ?>

                                        </div>
                                      </div><!-- row -->
                                    </div><!--col -->
                                  </div>
                                </div>

                                <div class="tab-pane fade show active" id="aud" role="tabpanel">
                                  <div class="row row-sm mg-b-20">
                                    <div class="col-lg-4">
                                      <div class="card card-dashboard-pageviews">
                                        <div class="card-header">
                                          <h6 class="card-title">Short Page</h6>
                                          <p class="card-text">Akses halaman dengan cepat.</p>
                                        </div><!-- card-header -->
                                        <div class="card-body">
                                          <div class="az-list-item">
                                            <div>
                                              <h6>Jumlah Penduduk</h6>
                                              <span>/Tabel Data/Jumlah Penduduk/Halaman Data</span>
                                            </div>
                                            <div>
                                              <h6 class="tx-primary mt-2"><a href="<?=Url::to(['masyarakat/jp'])?>" class="btn btn-info btn-outline-light btn-icon"><i class="typcn typcn-arrow-right"></i></a></h6>
                                          </div>
                                          </div><!-- list-group-item -->
                                          <div class="az-list-item">
                                            <div>
                                              <h6>Data Pendidikan</h6>
                                              <span>/Tabel Data/Data Pendidikan/Halaman Data</span>
                                            </div>
                                            <div>
                                              <h6 class="tx-primary mt-2"><a href="<?=Url::to(['masyarakat/dp'])?>" class="btn btn-info btn-outline-light btn-icon"><i class="typcn typcn-arrow-right"></i></a></h6>
                                          </div>
                                          </div><!-- list-group-item -->
                                          <div class="az-list-item">
                                            <div>
                                              <h6>Data Pekerjaan</h6>
                                              <span>/Tabel Data/Data Pekerjaan/Halaman Data</span>
                                            </div>
                                            <div>
                                              <h6 class="tx-primary mt-2"><a href="<?=Url::to(['masyarakat/dpekerjaan'])?>" class="btn btn-info btn-outline-light btn-icon"><i class="typcn typcn-arrow-right"></i></a></h6>
                                          </div>
                                          </div><!-- list-group-item -->
                                          <div class="az-list-item">
                                            <div>
                                              <h6>Data Jenis Kelamin</h6>
                                              <span>/Tabel Data/Jenis Kelamin/Halaman Data</span>
                                            </div>
                                            <div>
                                              <h6 class="tx-primary mt-2"><a href="<?=Url::to(['masyarakat/djeniskelamin'])?>" class="btn btn-info btn-outline-light btn-icon"><i class="typcn typcn-arrow-right"></i></a></h6>
                                          </div>
                                          </div><!-- list-group-item -->
                                          <div class="az-list-item d-flex justify-content-end">
                                            <a href="<?=Url::to(['masyarakat/jp'])?>" class="text-primary" title="View more details">more...</a>
                                        </div>


                                        </div><!-- card-body -->
                                      </div><!-- card -->

                                    </div><!-- col -->
                                    <div class="col-lg-8 mg-t-20 mg-lg-t-0">
                                      <div class="card card-dashboard-four">
                                        <div class="card-header">
                                          <h6 class="card-title">Status Penduduk</h6>
                                          <p class="card-text">Berdasarkan kepala keluarga & data pekerjaan.</p>
                                        </div><!-- card-header -->
                                        
                                        <div class="card-body row">
                                          <div class="col-md-6 d-flex align-items-center">
                                            <div class="chart">
                                              <canvas id="chartDonut" width="300" height="261"></canvas>
                                            </div>
                                            <?php
                                            $this->registerJs("
                                              $(function() {
                                                var ctx = document.getElementById('chartDonut').getContext('2d');
                                                var chartDonut = new Chart(ctx, {
                                                  type: 'doughnut',  // Specifies that the chart type is 'doughnut'
                                                  data: {
                                                    labels: " . json_encode($labels) . ",  // Labels dari controller
                                                    datasets: [{
                                                      label: 'Status Keluarga',
                                                      data: " . json_encode($values) . ",  // Data jumlah dari controller
                                                      backgroundColor: ['#FF5733', '#33A1FF', '#FFEB33', '#33FF57', '#FF33A1'],  // Tambahkan warna sesuai kebutuhan
                                                      borderWidth: 1
                                                      }]
                                                      },
                                                      options: {
                                                        responsive: true,
                                                        plugins: {
                                                          legend: {
                                                            position: 'top'
                                                            },
                                                            tooltip: {
                                                              callbacks: {
                                                                label: function(tooltipItem) {
                                                                  return tooltipItem.label + ': ' + tooltipItem.raw;
                                                                }
                                                              }
                                                            }
                                                          }
                                                        }
                                                        });
                                                        });
                                                        ");
                                                        ?>
                                                      </div>
                                                      <div class="col-md-6 col-lg-5 mg-lg-l-auto mg-t-20 mg-md-t-0">
                          <?php foreach ($datasekolah as $item): ?>
                            <?php
                            $percentage = ($item['jumlah'] / $totalsekolah) * 100; // Hitung persentase
                            $colorClass = ''; // Tentukan warna berdasarkan kategori
                            
                            // Menentukan warna berdasarkan status_sekolah
                            switch ($item['status_sekolah']) {
                                case 'SD': 
                                    $colorClass = 'bg-purple'; 
                                    break;
                                case 'SMP': 
                                    $colorClass = 'bg-primary'; 
                                    break;
                                case 'SMA': 
                                    $colorClass = 'bg-info'; 
                                    break;
                                case 'Social': 
                                    $colorClass = 'bg-teal'; 
                                    break;
                                default: 
                                    $colorClass = 'bg-gray-500'; 
                                    break;
                            }
                            ?>
                            <div class="az-traffic-detail-item">
                                <div>
                                    <span><?= htmlspecialchars($item['status_sekolah']) ?></span>
                                    <span>Total <?= number_format($item['jumlah']) ?></span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar <?= $colorClass ?> wd-<?= round($percentage) ?>p" 
                                         style="width: <?= round($percentage) ?>%;" 
                                         role="progressbar" 
                                         aria-valuenow="<?= round($percentage) ?>" 
                                         aria-valuemin="0" 
                                         aria-valuemax="1000">
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                     </div><!-- col -->

                   </div><!-- card-body -->
                 </div><!-- card-dashboard-four -->
               </div><!-- col -->
             </div>
           </div>
           <div class="tab-pane fade show active" id="demo" role="tabpanel">
            <div class="row row-sm mg-b-20 mg-lg-b-0">
              <div class="col-lg-5 col-xl-4">
                <div class="row row-sm">
                  <div class="col-md-6 col-lg-12 mg-b-20 mg-md-b-0 mg-lg-b-20">
                    <div class="card card-dashboard-five">
                      <div class="card-header">
                        <h6 class="card-title">Data Penerima Raskin & BPJS</h6>
                        <span class="card-text">Jumlah total data penerima raskin dan & BPJS Desa Parombean.</span>
                      </div><!-- card-header -->
                      <div class="card-body row row-sm">
                        <div class="col-6 d-sm-flex align-items-center">
                          <div class="card-chart bg-primary">
                            <span class="peity-bar" data-peity='{"fill": ["#fff"], "width": 20, "height": 20 }'>6,4,7,5,7</span>
                          </div>

                          <div>
                            <label>Penerima Raskin</label>
                            <h4><?php echo $totalPenerimaRaskin?></h4>
                          </div>
                        </div><!-- col -->
                        <div class="col-6 d-sm-flex align-items-center">
                          <div class="card-chart bg-purple">
                            <span class="peity-bar" data-peity='{"fill": ["#fff"], "width": 20, "height": 20 }'>6,4,7,5,7</span>
                          </div>
                          <div>
                            <label>Penerima BPJS</label>
                            <h4><?php echo $totalPenerimaBPJS?></h4>
                          </div>
                        </div><!-- col -->
                      </div><!-- card-body -->
                    </div><!-- card-dashboard-five -->
                  </div><!-- col -->
                 
                </div><!-- row -->
              </div><!-- col-lg-3 -->
              <div class="col-lg-7 col-xl-8 mg-t-20 mg-lg-t-0">
                <div class="card card-table-one">
                  <div class="row">
                    <div class="col-md-6">
                      <h6 class="card-title">List Data Penduduk</h6>
                  <p class="az-content-text mg-b-20">Desa Parombean</p>
                    </div>
                    <div class="col-md-6">
                                        <div class="az-list-item d-flex justify-content-end">
                                            <a href="<?=Url::to(['masyarakat/index'])?>" class="text-primary" title="View more details">more...</a>
                                        </div>
                    </div>
                  </div>
                  
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                          <tr>
                              
                              <!-- <th class="wd-10p">Photo</th> -->
                              <th>Nama</th>
                              <th class="text-center">NIK</th>
                              <th class="text-center">Dusun</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php foreach ($dataMasyarakat as $masyarakat): ?>
                          <tr>
                              <!-- <td><i class="flag-icon flag-icon-us flag-icon-squared"></i></td> -->
                              <td><?= htmlspecialchars($masyarakat->nama) ?></td>
                              <td class="text-center"><?= htmlspecialchars($masyarakat->NIK) ?></td>
                              <td class="text-left"><?= htmlspecialchars($masyarakat->dusun) ?></td>
                          </tr>
                          <?php endforeach; ?>
                      </tbody>
                  </table>


                  </div><!-- table-responsive -->
                </div><!-- card -->
              </div><!-- col-lg -->

            </div>
          </div>
        </div>

      </div>
    </div>


