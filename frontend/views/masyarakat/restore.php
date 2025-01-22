<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Restore Data Masyarakat';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="masyarakat-restore">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Silakan unggah file CSV untuk mengembalikan data masyarakat:</p>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Restore', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
