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
            <span>Data Jenis Kelamin</span>
            <span>Jumlah Jenis Kelamin</span>
            <span>View Data</span>
          </div>
          <h2 class="az-content-title">Data Jenis Kelamin</h2>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="az-content-label mg-b-5">Data Jenis Kelamin</div>
                  <p class="mg-b-20">Desa parombean.</p>
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
          
            <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2" class="text-center align-middle">Nama Dusun</th>
                    <th colspan="3" class="text-center">JENIS KELAMIN</th>
                </tr>
                <tr>
                    <th class="text-center">Laki-laki</th>
                    <th class="text-center">Perempuan</th>
                    <th class="text-center">L/P</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $totalLakiLaki = 0;
                $totalPerempuan = 0;
                $grandTotal = 0;

                foreach ($dataJK as $row): 
                    $totalLakiLaki += $row['LakiLaki'];
                    $totalPerempuan += $row['Perempuan'];
                    $grandTotal += $row['Total'];
                ?>
                <tr>
                    <td><?= Html::encode($row['NamaDusun']) ?></td>
                    <td class="text-center"><?= Html::encode($row['LakiLaki']) ?></td>
                    <td class="text-center"><?= Html::encode($row['Perempuan']) ?></td>
                    <td class="text-center"><?= Html::encode($row['Total']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center">JUMLAH</th>
                    <th class="text-center"><?= $totalLakiLaki ?></th>
                    <th class="text-center"><?= $totalPerempuan ?></th>
                    <th class="text-center"><?= $grandTotal ?></th>
                </tr>
            </tfoot>
        </table>

       
          </div>

          <hr class="mg-y-30">

        </div><!-- az-content-body -->