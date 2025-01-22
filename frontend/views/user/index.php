<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var frontend\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
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
              <!-- <div class="col-md-6 text-end mt-2">
                  <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
              </div> -->
          </div>
          
          <div class="table-responsive">
           
             <?= GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table mg-b-0'],
                'summary' => false,
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'header' => "No"
                    ],

                    // 'id',
                    'username',
                    // 'auth_key',
                    // 'password_hash',
                    // 'password_reset_token',
                    'email:email',
                   [
                        'attribute' => 'status',
                        'value' => function($model) {
                            return $model->status == 10 
                                ? '<span class="label label-success">Aktif</span>' 
                                : '<span class="label label-danger">Non Aktif</span>';
                        },
                        'format' => 'raw', // This allows HTML rendering
                    ],
                    //'created_at',
                    //'updated_at',
                    //'verification_token',
                    [

                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center',
                        'style' => 'max-width:170px;'],
                        'class' => '\yii\grid\ActionColumn',
                        'template' => '{update} {delete}',
                        'header' => 'Action',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('', ['view', 'id' => $model->id], [
                                    'class' => 'btn btn-outline-primary icon ion-md-eye',
                                ]);
                            },
                           'update' => function ($url, $model) {
                                return Html::a('', ['update', 'id' => $model->id], [
                                    'class' => 'btn btn-outline-success typcn typcn-edit',
                                ]);
                            },
                            'delete' => function ($url, $model) {

                                return Html::a('', ['delete', 'id' => $model->id], [
                                    'class' => 'btn btn-outline-danger typcn typcn-document-delete',

                                    'data' => [
                                        'confirm' => 'Apakah Anda yakin ingin menghapus item ini?',
                                        'method' => 'post',
                                    ],
                                ]);
                            },
                        ],
                    ],
                ],
            ]); ?>
           
          </div><!-- table-responsive -->

          <div class="ht-40"></div>

        </div><!-- az-content-body -->
      </div>
