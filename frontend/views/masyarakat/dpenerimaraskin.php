<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Masyarakat $model */


$this->params['breadcrumbs'][] = ['label' => 'Masyarakats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$totalJumlah = array_sum(array_column($dataRaskin, 'Jumlah'));
?>
<div class="az-content-body pd-lg-l-40 d-flex flex-column">
          <div class="az-content-breadcrumb">
            <span>Data Penerima Raskin</span>
            <span>Jumlah Penduduk</span>
            <span>View Data</span>
          </div>
          <h2 class="az-content-title">Data Penerima Raskin</h2>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="az-content-label mg-b-5">Penerima Raskin</div>
                  <p class="mg-b-20">Data penerima raskin desa parombean.</p>
            </div>
            <div class="col-md-6">
                <div class="btn-icon-list d-flex justify-content-end"> 
                            <!-- <button class="btn btn-indigo btn-icon"><i class="typcn typcn-folder"></i></button>
                            <button class="btn btn-primary btn-icon"><i class="typcn typcn-calendar-outline"></i></button>
                            <button class="btn btn-success btn-icon"><i class="typcn typcn-document-add"></i></button>
                            <button class="btn btn-info btn-icon"><i class="typcn typcn-arrow-back-outline"></i></button> -->
                          </div>
            </div>
        </div>
          <div class="table-responsive">
          
            <table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Dusun</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataRaskin as $row): ?>
            <tr>
                <td><?= Html::encode($row['NamaDusun']) ?></td>
                <td><?= Html::encode($row['Jumlah']) ?> orang</td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td><strong>JUMLAH</strong></td>
            <td><strong><?= $totalJumlah ?> orang</strong></td>
        </tr>
    </tbody>
</table>
          </div>

          <hr class="mg-y-30">

        </div><!-- az-content-body -->