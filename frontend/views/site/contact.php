<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
  <div class="az-content-body">
    <div class="az-dashboard-one-title">
    
    
     
            <div class="card-body">
                <div class="row">
                    <div class="az-content-breadcrumb">
            <span>Dashboard</span>
            <span>Contact</span>
           
          </div>

                    <h1><?= Html::encode($this->title) ?></h1>
        <p>
        If you have other questions, please fill out the following form to contact us. Thank you.
    </p>
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <div class="row">
                    <div class="col-lg-6">
                         <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model, 'email') ?>
                    </div>
                </div>
               
                
                <?= $form->field($model, 'subject') ?>
                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

               

                <div class="form-group">
                     <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
            </div>

    
</div>
</div>
</div>
