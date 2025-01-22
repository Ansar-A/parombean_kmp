<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\MasyarakatSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="masyarakat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'search-form'],
    ]); ?>

    <div class="input-group">
        <?= $form->field($model, 'nama', [
            'options' => ['class' => 'flex-grow-1'],
        ])->textInput([
            'placeholder' => 'Input nama penduduk...',
            'class' => 'form-control search-input'
        ])->label(false) ?>
        <div class="input-group-append">
            <?= Html::submitButton('<i class="fa fa-search"></i>', [
                'class' => 'btn btn-primary',
                'title' => 'Search'
            ]) ?>
            <?= Html::a('<i class="typcn icon typcn-refresh"></i>', ['index'], [
                'class' => 'btn btn-outline-secondary',
                'title' => 'Reset'
            ]) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<style>
.masyarakat-search {
    margin-top: 20px;
}

.search-form .input-group {
    display: flex;
    align-items: center;
}

.search-input {
    height: 40px;
    border-radius: 6px 0 0 6px;
    padding-left: 15px;
    font-size: 14px;
    border: 1px solid #ced4da;
    transition: all 0.3s ease;
    border-right: none;
}

.search-input:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

.input-group-append .btn {
    height: 40px;
    border-radius: 0 6px 6px 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    padding: 0 15px;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    color: #fff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

.btn-outline-secondary {
    color: #6c757d;
    border-color: #6c757d;
    background-color: transparent;
}

.btn-outline-secondary:hover {
    color: #fff;
    background-color: #6c757d;
    border-color: #545b62;
}
</style>
