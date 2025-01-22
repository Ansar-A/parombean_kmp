<?php

use common\models\Masyarakat;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\bootstrap5\Modal;
use yii\bootstrap5\Alert;
/** @var yii\web\View $this */
/** @var frontend\models\MasyarakatSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$notifikasi = \common\models\Masyarakat::find()
    ->orderBy(['updated_at' => SORT_DESC])
    ->limit(10)
    ->all();
$totalLakiLaki = Masyarakat::find()
        ->where(['jk' => 'L'])
        ->count();
$totalPerempuan = Masyarakat::find()
        ->where(['jk' => 'P'])
        ->count();

$totalKeseluruhan = $totalLakiLaki + $totalPerempuan;
$this->title = 'Masyarakats';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCss("
  .pagination-sm .page-link {
      font-size: 14px;
      padding: 4px 8px;
      margin: 0 2px;
      border-radius: 3px;
  }

  .pagination-sm .active .page-link {
      background-color: #007bff;
      color: #fff;
      border-color: #007bff;
  }

  .pagination-sm .page-link:hover {
      background-color: #0056b3;
      color: #fff;
  }


");
$this->registerJs("
                            $(function() {
                                // Initialize the Peity bar chart
                                $('.peity-bar').peity('bar');
                            });
                        ");

$this->registerJs("
  // Tampilkan indikator KMP jika isKmpSearch bernilai true
    // if ({$searchModel->isKmpSearch}) {
    //     document.getElementById('kmp-indicator').style.display = 'block';
    // }

  // Tombol modal untuk 'view'
    $(document).on('click', '.btn-outline-primary', function(event) {
    event.preventDefault();
    var url = $(this).data('url'); // URL dari data-url
    $.get(url, function(data) {
        console.log(data); // Log respons
        $('#modalContent').html(data); // Isi modal dengan respons
        $('#viewModal').modal('show'); // Tampilkan modal
    }).fail(function(xhr, status, error) {
        console.error('Error:', error); // Log error
        console.error('Status:', status);
        console.error('Response:', xhr.responseText); // Lihat respons error
    });
});

// Tombol modal untuk 'update'
$(document).on('click', '.btn-outline-success', function(event) {
    event.preventDefault();
    var url = $(this).data('url');  // Ambil URL untuk update
    $.get(url, function(data) {
        $('#modalContentUpdate').html(data);  // Isi modal dengan form update
        $('#updateModal').modal('show');  // Tampilkan modal
    }).fail(function(xhr, status, error) {
        console.error('Error:', error);
        console.error('Status:', status);
        console.error('Response:', xhr.responseText);
    });
});

// Tombol modal untuk 'create'
 // Menangani klik tombol 'Create' untuk membuka modal
  $('#createButton').on('click', function() {
      var url = $(this).attr('value'); // URL form create

      // Lakukan request GET untuk mengambil form create
      $.get(url, function(data) {
          $('#modalContentCreate').html(data);  // Isi modal dengan form create
          $('#createModal').modal('show');  // Tampilkan modal
      }).fail(function(xhr, status, error) {
          console.error('Error:', error);
          console.error('Status:', status);
          console.error('Response:', xhr.responseText);
      });
  });

");
?>

<div class="container">
    

        <div class="az-content-left az-content-left-components">
          <div class="component-item">
            <label>Short Page</label>
            <nav class="nav flex-column">
              <a href="<?=Url::to(['masyarakat/jp'])?>" class="nav-link">Jumlah Penduduk</a>
              <a href="<?=Url::to(['masyarakat/dp'])?>" class="nav-link">Data Pendidikan</a>
              <a href="<?=Url::to(['masyarakat/dpekerjaan'])?>" class="nav-link">Data Pekerjaan</a>
              <a href="<?=Url::to(['masyarakat/djeniskelamin'])?>" class="nav-link">Data Jenis Kelamin</a>
              <a href="<?=Url::to(['masyarakat/dkelompokumur'])?>" class="nav-link">Data Persebaran Umur</a>
              <a href="<?=Url::to(['masyarakat/dpenerimaraskin'])?>" class="nav-link">Data Penerima Raskin</a>
              <a href="<?=Url::to(['masyarakat/dpenerimabpjs'])?>" class="nav-link">Data Penerima BPJS</a>
            </nav>
            
            <label>Home</label>
            <nav class="nav flex-column">
              <a href="<?=Url::to(['site/index'])?>" class="nav-link">Dashboard</a>
              <a href="<?=Url::to(['user/index'])?>" class="nav-link">Management User</a>
            </nav>
          </div><!-- component-item -->
        </div><!-- az-content-left -->


        <div class="az-content-body pd-lg-l-40 d-flex flex-column">
         <?php // Menampilkan notifikasi sukses
          if (Yii::$app->session->hasFlash('success')) {
              echo Alert::widget([
                  'options' => ['class' => 'alert-success'], // Class untuk notifikasi sukses
                  'body' => Yii::$app->session->getFlash('success'), // Isi pesan
              ]);
          }

          // Menampilkan notifikasi error
          if (Yii::$app->session->hasFlash('error')) {
              echo Alert::widget([
                  'options' => ['class' => 'alert-danger'], // Class untuk notifikasi error
                  'body' => Yii::$app->session->getFlash('error'), // Isi pesan
              ]);
          }
          ?>
          <script>
            setTimeout(function() {
                let alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => alert.remove());
            }, 3000); // 3000ms = 3 detik
        </script>

          <div class="az-content-breadcrumb mb-4">
            <span>Dashboard</span>
            <span>Data Penduduk</span>
            <span>View Data</span>
          </div>
        <div class="row">
          <div class="col-lg-5">
                  <div class="az-content-label mg-b-5">Data Penduduk Desa Parombean</div>
                <p class="mg-b-20">Backup dan restore data penduduk secara berkala.</p>
              </div>
              <div class="col-lg-7 text-end">
                <?= Html::button(' Tambah Penduduk', [
                    'value' => Url::to(['masyarakat/create']),  // URL untuk form create
                    'class' => 'btn btn-success typcn icon typcn-plus-outline',
                    'id' => 'createButton'
                ]) ?>
                   
                   <?= Html::a(' Backup', ['backup'], ['class' => 'btn btn-primary typcn typcn-folder']) ?>
                    <?= Html::a(' Restore', ['restore'], ['class' => 'btn btn-info typcn typcn-arrow-back-outline']) ?>
              </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card card-dashboard-five">
                    <div class="card-header">
                      <h6 class="card-title">Sessions</h6>
                      <span class="card-text"> Total keseluruhan data penduduk berdasarkan jenis kelamin.</span>
                    </div><!-- card-header -->
                    <div class="card-body row row-sm">
                      <div class="col-4 d-sm-flex align-items-center">
                        <div class="mg-b-10 mg-sm-b-0 mg-sm-r-10">
                          <span class="peity-donut" data-peity="{ &quot;fill&quot;: [&quot;#007bff&quot;, &quot;#cad0e8&quot;],  &quot;innerRadius&quot;: 14, &quot;radius&quot;: 20 }" style="display: none;">4/7</span><svg class="peity" height="40" width="40"><path d="M 20 0 A 20 20 0 1 1 11.322325217648839 38.01937735804839 L 13.925627652354187 32.61356415063387 A 14 14 0 1 0 20 6" data-value="4" fill="#007bff"></path><path d="M 11.322325217648839 38.01937735804839 A 20 20 0 0 1 19.999999999999996 0 L 19.999999999999996 6 A 14 14 0 0 0 13.925627652354187 32.61356415063387" data-value="3" fill="#cad0e8"></path></svg>
                        </div>
                        <div>
                          <label>Total Laki-Laki</label>
                          <h4><?php echo $totalLakiLaki?></h4>
                        </div>
                      </div><!-- col -->
                      <div class="col-4 d-sm-flex align-items-center">
                        <div class="mg-b-10 mg-sm-b-0 mg-sm-r-10">
                          <span class="peity-donut" data-peity="{ &quot;fill&quot;: [&quot;#007bff&quot;, &quot;#cad0e8&quot;],  &quot;innerRadius&quot;: 14, &quot;radius&quot;: 20 }" style="display: none;">2/7</span><svg class="peity" height="40" width="40"><path d="M 20 0 A 20 20 0 0 1 39.498558243636474 24.450418679126287 L 33.64899077054553 23.1152930753884 A 14 14 0 0 0 20 6" data-value="2" fill="#007bff"></path><path d="M 39.498558243636474 24.450418679126287 A 20 20 0 1 1 19.999999999999996 0 L 19.999999999999996 6 A 14 14 0 1 0 33.64899077054553 23.1152930753884" data-value="5" fill="#cad0e8"></path></svg>
                        </div>
                        <div>
                          <label>Total Perempuan</label>
                          <h4><?php echo $totalPerempuan?></h4>
                        </div>
                      </div>
                      <div class="col-4 d-sm-flex align-items-center">
                        <div class="mg-b-10 mg-sm-b-0 mg-sm-r-10">
                          <span class="peity-donut" data-peity="{ &quot;fill&quot;: [&quot;#00cccc&quot;, &quot;#cad0e8&quot;],  &quot;innerRadius&quot;: 14, &quot;radius&quot;: 20 }" style="display: none;">2/7</span><svg class="peity" height="40" width="40"><path d="M 20 0 A 20 20 0 0 1 39.498558243636474 24.450418679126287 L 33.64899077054553 23.1152930753884 A 14 14 0 0 0 20 6" data-value="2" fill="#00cccc"></path><path d="M 39.498558243636474 24.450418679126287 A 20 20 0 1 1 19.999999999999996 0 L 19.999999999999996 6 A 14 14 0 1 0 33.64899077054553 23.1152930753884" data-value="5" fill="#cad0e8"></path></svg>
                        </div>
                        <div>
                          <label>Total Keseluruhan</label>
                          <h4><?php echo $totalKeseluruhan?></h4>
                        </div>
                      </div><!-- col -->
                    </div><!-- card-body -->

                  </div>
            </div>
           
          </div>
                  
               
          <?php echo $this->render('_search', ['model' => $searchModel]); ?>

          <div class="table-responsive pt-4">
              <?= GridView::widget([
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'tableOptions' => ['class'=>'table table-bordered mg-b-0'],
            'columns' => [
            [
              'class' => 'yii\grid\SerialColumn',
              'header' => 'No',
              'contentOptions' => [
                'class' => "text-center",
              ],
              'headerOptions' => [
                'class' => "text-center",
              ],
            ],
            [
              'attribute' => 'nama',
              'headerOptions' => ['class' => 'text-center'],
              'contentOptions' => ['class' => 'text-center'],
            ],
            [
              'attribute' => 'NIK',
              'headerOptions' => ['class' => 'text-center'],
              'contentOptions' => ['class' => 'text-center'],
            ],
            [
              'attribute' => 'dusun',
              'headerOptions' => ['class' => 'text-center'],
              'contentOptions' => ['class' => 'text-center'],
            ],
            
            [

                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center',
                        'style' => 'max-width:170px;'],
                        'class' => '\yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete}',
                        'header' => 'Action',
                        'buttons' => [

                            // 'view' => function ($url, $model) {
                            //     return Html::a('', ['view', 'id_masyarakat' => $model->id_masyarakat], [
                            //         'class' => 'btn btn-outline-primary icon ion-md-eye',
                            //     ]);
                            // },
                          'view' => function ($url, $model) {
                                return Html::a('', ['view', 'id_masyarakat' => $model->id_masyarakat], [
                                    'class' => 'btn btn-outline-primary icon ion-md-eye',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#viewModal',
                                    'data-id' => $model->id_masyarakat,
                                    'data-url' => Url::to(['view', 'id_masyarakat' => $model->id_masyarakat]),
                                ]);
                            },

                           'update' => function ($url, $model) {
                                return Html::a('', ['update', 'id_masyarakat' => $model->id_masyarakat], [
                                    'class' => 'btn btn-outline-success typcn typcn-edit',
                                    'data-url' => Url::to(['update', 'id_masyarakat' => $model->id_masyarakat]),  
                                    'data-toggle' => 'modal',
                                    'data-target' => '#updateModal',
                                    'data-id' => $model->id_masyarakat,
                                ]);
                            },


                            'delete' => function ($url, $model) {

                                return Html::a('', ['delete', 'id_masyarakat' => $model->id_masyarakat], [
                                    'class' => 'btn btn-outline-danger typcn typcn-document-delete',

                                    'data' => [
                                        'confirm' => 'Apakah Anda yakin ingin menghapus item ini?',
                                        'method' => 'post',
                                    ],
                                ]);
                            },
                        ],
                    ],

        ],
        'summary' => '<p>Menampilkan <b>{begin}-{end}</b> dari total <b>{totalCount}</b> data.</p>',
        'layout' => "{summary}\n{items}\n<div class='text-center pt-4'>{pager}</div>",
        'pager' => [
            'options' => ['class' => 'pagination pagination-sm justify-content-center'],
            'linkOptions' => ['class' => 'page-link'],
            'activePageCssClass' => 'active',
            'disabledPageCssClass' => 'disabled',
            'prevPageLabel' => '&laquo;',
            'nextPageLabel' => '&raquo;',
        ],

    ]);

  //View
  Modal::begin([
      'title' => '<h5>Detail Data</h5>',
      'id' => 'viewModal',
      'size' => Modal::SIZE_LARGE,
  ]);
  echo '<div id="modalContent"></div>';
  Modal::end();

  //Update
  Modal::begin([
      'title' => '<h5>Update Data Masyarakat</h5>',
      'id' => 'updateModal',
      'size' => Modal::SIZE_LARGE,
  ]);

  echo '<div id="modalContentUpdate"></div>'; 

  Modal::end();


   //Create
 Modal::begin([
    'title' => '<h5>Create Data Masyarakat</h5>',
    'id' => 'createModal',
    'size' => Modal::SIZE_LARGE,
]);

echo '<div id="modalContentCreate"></div>'; // Ini akan diisi dengan form create


Modal::end();

 ?>
            
          </div>

          <div class="ht-40"></div>

       
        </div><!-- az-content-body -->
      </div>

