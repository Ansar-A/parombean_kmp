<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/** @var yii\web\View $this */
/** @var common\models\Masyarakat $model */


$this->params['breadcrumbs'][] = ['label' => 'Masyarakats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="az-content-body pd-lg-l-40 d-flex flex-column">
          <div class="az-content-breadcrumb">
            <span>Data Penduduk</span>
            <span>Jumlah Penduduk</span>
            <span>View Data</span>
          </div>
          <h2 class="az-content-title">Jumlah Penduduk</h2>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="az-content-label mg-b-5">Jumlah Jiwa</div>
                  <p class="mg-b-20">Data jumlah jiwa penduduk desa parombean</p>
            </div>
            <div class="col-md-6">
               
                <div class="btn-icon-list d-flex justify-content-end"> 
                           <!--  <button class="btn btn-indigo btn-icon"><i class="typcn typcn-folder"></i></button>
                            <button class="btn btn-primary btn-icon"><i class="typcn typcn-calendar-outline"></i></button>
                            <button class="btn btn-success btn-icon"><i class="typcn typcn-document-add"></i></button>
                             -->                            
                            <!--  <a href="<?=Url::to(['masyarakat/index'])?>"class="btn btn-info btn-icon"><i class="typcn typcn-arrow-back-outline"></i></a>
                </div> -->
            </div>
        </div>
          <div class="table-responsive">
            <table class="table mg-b-0">
            <thead>
                <tr>
                    <th>Nama Dusun</th>
                    <th>Laki-laki</th>
                    <th>Perempuan</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataJiwa as $row): ?>
                    <tr>
                        <td><?= Html::encode($row['NamaDusun']) ?></td>
                        <td><?= Html::encode($row['LakiLaki']) ?></td>
                        <td><?= Html::encode($row['Perempuan']) ?></td>
                        <td><?= Html::encode($row['Total']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
          </div>
          <hr class="mg-y-30">
          <div class="az-content-label mg-b-5">Jumlah Kepala Keluarga</div>
          <p class="mg-b-20">Data jumlah kepala keluarga desa parombean</p>
          <div class="table-responsive">
           <table class="table mg-b-0">
                <thead>
                    <tr>
                        <th>Nama Dusun</th>
                        <th>Laki-laki</th>
                        <th>Perempuan</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataKK as $row): ?>
                        <tr>
                            <td><?= Html::encode($row['NamaDusun']) ?></td>
                            <td><?= Html::encode($row['LakiLaki']) ?></td>
                            <td><?= Html::encode($row['Perempuan']) ?></td>
                            <td><?= Html::encode($row['Total']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
          </div>



        </div><!-- az-content-body -->