<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Masyarakat;
/** @var yii\web\View $this */
/** @var common\models\Masyarakat $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="masyarakat-form">
<div class="card card-dashboard-five">
                    <div class="card-header">
                      <h6 class="card-title">Tambah Data Penduduk</h6>
                      <span class="card-text">Desa Parombean</span>
                    </div><!-- card-header -->
                    <div class="card-body row row-sm">
    <?php $form = ActiveForm::begin([
        'id' => 'createForm',
            'action' => ['masyarakat/create'],
            'method' => 'post',
            'enableAjaxValidation' => true, // Mengaktifkan validasi AJAX
            'validationUrl' => ['validate'], // Action untuk validasi AJAX
    ]); ?>

   

    <div class="row mb-4">
        <div class="col-md-6">
            <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
             <?= $form->field($model, 'dusun')->dropDownList(
                Masyarakat::getDusunOptions(), 
                ['prompt' => 'Pilih Dusun']
            ) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'NIK')->textInput(['maxlength' => true, 'type' => 'number'])->label('NIK') ?>
        </div>
         <div class="col-md-6">
             <?= $form->field($model, 'jk')->dropDownList([ 'L' => 'Laki-Laki', 'P' => 'Perempuan', ], ['prompt' => 'Pilih...'])->label('Jenis Kelamin') ?>
        </div>
         <div class="col-md-6">
             <?= $form->field($model, 'status_keluarga')->dropDownList([ 'KepalaKeluarga' => 'Kepala Keluarga', 'Suami' => 'Suami', 'Istri' => 'Istri', 'Anak' => 'Anak', 'Menantu' => 'Menantu', 'Cucu' => 'Cucu', 'Orangtua' => 'Orangtua', 'Mertua' => 'Mertua', ], ['prompt' => 'Pilih...']) ?>
        </div>
         <div class="col-md-6">
            <?= $form->field($model, 'status_sekolah')->dropDownList([ 'TidakSekolah' => 'Tidak Sekolah', 'BelumSekolah' => 'Belum Sekolah', 'TK/PAUD' => 'TK/PAUD', 'SD/SEDERAJAT' => 'SD/SEDERAJAT', 'SMP/SEDERAJAT' => 'SMP/SEDERAJAT', 'SMA/SEDERAJAT' => 'SMA/SEDERAJAT', 'DI/DII/DIII' => 'DI/DII/DIII', 'DIV/S1' => 'DIV/S1', 'S2' => 'S2', ], ['prompt' => 'Pilih...']) ?>
        </div>
         <div class="col-md-6">
            <?= $form->field($model, 'status_pekerjaan')->dropDownList([ 'BELUM/TIDAKBEKERJA' => 'BELUM/TIDAKBEKERJA', 'PELAJAR/MAHASISWA' => 'PELAJAR/MAHASISWA', 'MENGURUSRUMAHTANGGA' => 'IRT', 'PETANI/PEKEBUN' => 'PETANI/PEKEBUN', 'WIRASWASTA' => 'WIRASWASTA', 'KARYAWANSWASTA/HONORER' => 'KARYAWANSWASTA/HONORER', 'P3K' => 'P3K', 'PNS' => 'PNS', 'PENSIUNAN' => 'PENSIUNAN', ], ['prompt' => 'Pilih...']) ?>
        </div>
         <div class="col-md-6">
            <?= $form->field($model, 'agama')->dropDownList([ 'Islam' => 'Islam', 'KristenProtestan' => 'Kristen Protestan', 'KristenKatolik' => 'Kristen Katolik', 'Hindu' => 'Hindu', 'Buddha' => 'Buddha', 'Konghucu' => 'Konghucu', ], ['prompt' => 'Pilih...']) ?>
        </div>
         <div class="col-md-6">
             <?= $form->field($model, 'warga_negara')->dropDownList([ 'Indonesia' => 'Indonesia', ]) ?>
        </div>
         <div class="col-md-6">
            <?= $form->field($model, 'tgl_lahir')->textInput(['type'=>'date']) ?>
        </div>

        <div class="col-md-6">
    <?= $form->field($model, 'penerima_raskin')->radioList(['Ya' => 'Ya', 'Tidak' => 'Tidak'], [
        'checked' => $model->penerima_raskin === 'Tidak',
        'options' => [
            'Ya' => ['label' => '<i class="fas fa-check"></i> Ya'],
            'Tidak' => ['label' => '<i class="fas fa-times"></i> Tidak'],
        ],
    ])->label('Penerima Raskin') ?>
</div>

<div class="col-md-6">
    <?= $form->field($model, 'penerima_BPJS')->radioList(['Ya' => 'Ya', 'Tidak' => 'Tidak'], [
        'checked' => $model->penerima_BPJS === 'Tidak',
        'options' => [
            'Ya' => ['label' => '<i class="fas fa-check"></i> Ya'],
            'Tidak' => ['label' => '<i class="fas fa-times"></i> Tidak'],
        ],
    ])->label('Penerima BPJS') ?>
</div>

    </div>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?> 
        <?= Html::a('Close', ['index'], ['class' => 'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>
</div>
