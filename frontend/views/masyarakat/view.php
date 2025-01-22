<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Masyarakat $model */

$this->title = $model->id_masyarakat;
$this->params['breadcrumbs'][] = ['label' => 'Masyarakats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="masyarakat-view">
    <div class="row mb-4">
        <div class="col-md-6">
         
           
        </div>
        <div class="col-md-6 text-end">
             <?= Html::a('Delete', ['delete', 'id_masyarakat' => $model->id_masyarakat], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('Close', ['index'], ['class' => 'btn btn-info']) ?>
        </div>
    </div>
<div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'table mg-b-0'],
        'attributes' => [
            // 'get_user',
            'nama',
            'dusun',
            'NIK',
            [
                'attribute' => 'jk', 
                'label' => 'Jenis Kelamin', 
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->jk == 'L') {
                        return '<p>Laki-Laki</p>';
                    } else {
                        return '<p>Perempuan</p>';
                    }
                },
            ],

            
            'status_keluarga',
            'status_sekolah',
            'status_pekerjaan',
            'agama',
            'warga_negara',
            'tgl_lahir',
            'penerima_raskin',
            'penerima_BPJS'
        ],
    ]) ?>
</div>

</div>
