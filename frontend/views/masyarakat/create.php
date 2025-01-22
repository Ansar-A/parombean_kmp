<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Masyarakat $model */

$this->title = 'Create Masyarakat';
$this->params['breadcrumbs'][] = ['label' => 'Masyarakats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="masyarakat-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
