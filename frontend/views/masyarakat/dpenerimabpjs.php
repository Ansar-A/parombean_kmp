<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Masyarakat $model */


$this->params['breadcrumbs'][] = ['label' => 'Masyarakats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="az-content-body pd-lg-l-40 d-flex flex-column">
          <div class="az-content-breadcrumb">
            <span>Data Penerima BPJS</span>
            <span>Jumlah Penduduk</span>
            <span>View Data</span>
          </div>
          <h2 class="az-content-title">Data Penerima BPJS</h2>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="az-content-label mg-b-5">Penerima BPJS</div>
                  <p class="mg-b-20">Data penerima BPJS desa parombean.</p>
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
            <th>Laki-laki</th>
            <th>Perempuan</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $totalLakiLaki = 0;
        $totalPerempuan = 0;
        $totalKeseluruhan = 0;
        foreach ($dataBPJS as $row): 
            $totalLakiLaki += $row['LakiLaki'];
            $totalPerempuan += $row['Perempuan'];
            $totalKeseluruhan += $row['Total'];
        ?>
            <tr>
                <td><?= Html::encode($row['NamaDusun']) ?></td>
                <td><?= Html::encode($row['LakiLaki']) ?> orang</td>
                <td><?= Html::encode($row['Perempuan']) ?> orang</td>
                <td><?= Html::encode($row['Total']) ?> orang</td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td><strong>JUMLAH</strong></td>
            <td><strong><?= Html::encode($totalLakiLaki) ?> orang</strong></td>
            <td><strong><?= Html::encode($totalPerempuan) ?> orang</strong></td>
            <td><strong><?= Html::encode($totalKeseluruhan) ?> orang</strong></td>
        </tr>
    </tbody>
</table>

          </div>

          <hr class="mg-y-30">

        </div><!-- az-content-body -->