<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;
$this->title = 'parombean';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="az-signup-wrapper">
      <div class="az-column-signup-left">
        <div>
          <i class="typcn typcn-chart-bar-outline"></i>
          <h1 class="az-logo">Parombean</h1>
          <h5>Sistem Informasi Pencatatan Data Penduduk</h5>
          <p>Efisiensi dan Akurasi dalam Satu Sistem: Sistem Informasi Pencatatan Data Penduduk, Solusi Modern untuk Pengelolaan Data Warga yang Cepat, Aman, Terintegrasi, dan Mudah Diakses di Mana Saja.</p>
          <p>Lihat Profile Desa Parombean</p>
          <a href="http://localhost/kmp/backend/web/" class="btn btn-outline-indigo">Start Now</a>
        </div>
      </div><!-- az-column-signup-left -->
      <div class="az-column-signup">
        <h1 class="az-logo">Create Account Admin</h1>
        <div class="az-signup-header">
          <h2>Get Started</h2>
          <h4>It's free to signup and only takes a minute.</h4>

          <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
          
            <div class="form-group">
              <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            </div><!-- form-group -->
            <div class="form-group">
              <?= $form->field($model, 'email') ?>
            </div><!-- form-group -->
            <div class="form-group">
             <?= $form->field($model, 'password')->passwordInput() ?>
            </div><!-- form-group -->
       
               <div class="form-group">
                    <?= Html::submitButton('Create Account', ['class' => 'btn btn-az-primary btn-block', 'name' => 'login-button']) ?>
                </div> 

                <!-- <div class="row mb-3">
                    <div class="col-sm-4 az-content-breadcrumb pt-4 ">
                        <span>OR</span>
                        <span>Login With</span>
                    </div>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0 pt-3">
                        <button class="btn btn-danger btn-block"><i class="fab fa-google"></i>Google</button>
                    </div>
                   
                </div> -->
            
            
          <?php ActiveForm::end(); ?>
        </div><!-- az-signup-header -->
        <div class="az-signup-footer">
          <p>Already have an account? <a href="<?=Url::to(['login'])?>">Sign In</a></p>
        </div><!-- az-signin-footer -->
      </div><!-- az-column-signup -->
    </div>



