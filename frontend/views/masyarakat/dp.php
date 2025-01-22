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
            <span>Data Pendidikan</span>
            <span>Jumlah Pendidikan</span>
            <span>View Data</span>
          </div>
          <h2 class="az-content-title">Data Pendidikan</h2>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="az-content-label mg-b-5">Pendidikan</div>
                  <p class="mg-b-20">Total data pendidikan desa parombean.</p>
            </div>
            <div class="col-md-6">
               
                <div class="btn-icon-list d-flex justify-content-end"> 
                           <!--  <button class="btn btn-indigo btn-icon"><i class="typcn typcn-folder"></i></button>
                            <button class="btn btn-primary btn-icon"><i class="typcn typcn-calendar-outline"></i></button>
                            <button class="btn btn-success btn-icon"><i class="typcn typcn-document-add"></i></button>
                            <button class="btn btn-info btn-icon"><i class="typcn typcn-arrow-back-outline"></i></button> -->
                          </div>
            </div>
        </div>
          <div class="table-responsive">
           
            <table class="table mg-b-0">
    <thead>
        <tr>
            <th>Jenjang Pendidikan</th>
            <th>Laki-laki</th>
            <th>Perempuan</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataPendidikan as $row): ?>
            <tr>
                <td><?= Html::encode($row['JenjangPendidikan']) ?></td>
                <td><?= Html::encode($row['LakiLaki']) ?></td>
                <td><?= Html::encode($row['Perempuan']) ?></td>
                <td><?= Html::encode($row['LakiLaki'] + $row['Perempuan']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
          </div>

          <hr class="mg-y-30">

        </div><!-- az-content-body -->