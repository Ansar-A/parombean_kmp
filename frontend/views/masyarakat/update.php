<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Masyarakat $model */

$this->title = 'Update Masyarakat: ' . $model->id_masyarakat;
$this->params['breadcrumbs'][] = ['label' => 'Masyarakats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_masyarakat, 'url' => ['view', 'id_masyarakat' => $model->id_masyarakat]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="masyarakat-update">

    <?= $this->render('form_update', [
        'model' => $model,
    ]) ?>

</div>
