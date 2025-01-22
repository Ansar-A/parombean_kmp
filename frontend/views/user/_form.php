<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="container" style="height: 500px;">
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">
          <div class="az-content-breadcrumb">
            <span>Dashboard</span>
            <span>Operator</span>
            <span>Data Operator</span>
          </div>
          <h2 class="az-content-title">Manage Data User</h2>
          <div class="row mb-4">
              <div class="col-md-6">
                  <div class="az-content-label mg-b-5">Data Operator</div>
                    <p class="mg-b-20">Update data status user untuk mengaktifkan/menonaktifkan akun.</p>
              </div>
              <div class="col-md-6 text-end mt-2">
                  <?= Html::a('Back', ['index'], ['class' => 'btn btn-info']) ?>
              </div>
          </div>
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-10">
            <?= $form->field($model, 'status')->dropDownList([10=>'Aktif', 9=>'Non Aktif']) ?>
        </div>
        <div class="col-md-2">
             <div class="form-group" style="padding-top: 28px;">
        <?= Html::submitButton('Save Status', ['class' => 'btn btn-success w-100']) ?>
    </div>
        </div>
    </div>
    

   

    <?php ActiveForm::end(); ?>

</div>
</div>

