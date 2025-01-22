<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
AppAsset::register($this);
$currentController = Yii::$app->controller->id;
$currentAction = Yii::$app->controller->action->id;
$notifikasi = Yii::$app->controller->getNotifikasi();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-90680653-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-90680653-2');
    </script>
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
 
    <?php $this->head() ?>
  
</head>
<body>
<?php $this->beginBody() ?>

<div class="az-header">
      <div class="container">
        <div class="az-header-left">
          <a href="index.html" class="az-logo"><span></span> Parombean</a>
          <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
        </div><!-- az-header-left -->
        <div class="az-header-menu">
          <div class="az-header-menu-header">
            <a href="index.html" class="az-logo"><span></span> azia</a>
            <a href="" class="close">&times;</a>
          </div><!-- az-header-menu-header -->
          
<ul class="nav">
    <!-- Dashboard -->
    <li class="nav-item <?= ($currentController == 'site' && $currentAction == 'index') ? 'active show' : '' ?>">
        <a href="<?= Url::to(['site/index']) ?>" class="nav-link">
            <i class="typcn typcn-chart-area-outline"></i> Dashboard
        </a>
    </li>

    <!-- Data Penduduk -->
    <li class="nav-item <?= ($currentController == 'masyarakat' && $currentAction == 'index') ? 'active show' : '' ?>">
        <a href="<?= Url::to(['masyarakat/index']) ?>" class="nav-link">
            <i class="typcn typcn-chart-bar-outline"></i> Data Penduduk
        </a>
    </li>

    <!-- Tabel Data -->
    <li class="nav-item">
        <a href="#" class="nav-link with-sub">
            <i class="typcn typcn-book"></i> Tabel Data
        </a>
        <div class="az-menu-sub">
            <div class="container">
                <div>
                  <nav class="nav">
                  <a href="<?=Url::to(['masyarakat/jp'])?>" class="nav-link">Jumlah Penduduk</a>
                  <a href="<?=Url::to(['masyarakat/dp'])?>" class="nav-link">Data Pendidikan</a>
                  <a href="<?=Url::to(['masyarakat/dpekerjaan'])?>" class="nav-link">Data Pekerjaan</a>
                  <a href="<?=Url::to(['masyarakat/djeniskelamin'])?>" class="nav-link">Data Jenis Kelamin</a>
                  <a href="<?=Url::to(['masyarakat/dkelompokumur'])?>" class="nav-link">Data Persebaran Umur</a>
                  <a href="<?=Url::to(['masyarakat/dpenerimaraskin'])?>" class="nav-link">Data Penerima Raskin</a>
                  <a href="<?=Url::to(['masyarakat/dpenerimabpjs'])?>" class="nav-link">Data Penerima BPJS</a>
                </nav>
                </div>
            </div><!-- container -->
        </div>
    </li>

       <li class="nav-item <?= ($currentController == 'user' && $currentAction == 'index') ? 'active show' : '' ?>">
        <a href="<?= Url::to(['user/index']) ?>" class="nav-link">
            <i class="typcn typcn-chart-bar-outline"></i> Management User
        </a>
    </li>
     <!-- Contact -->
    <li class="nav-item <?= ($currentController == 'site' && $currentAction == 'contact') ? 'active show' : '' ?>">
        <a href="<?= Url::to(['site/contact']) ?>" class="nav-link">
            <i class="typcn typcn-chart-bar-outline"></i> Contact
        </a>
    </li>

    <li class="nav-item <?= ($currentController == 'site' && $currentAction == 'about') ? 'active show' : '' ?>">
        <a href="<?= Url::to(['site/about']) ?>" class="nav-link">
            <i class="typcn typcn-chart-bar-outline"></i> About
        </a>
    </li>

</ul>
        </div><!-- az-header-menu -->
        <div class="az-header-right">
         
          <div class="dropdown az-header-notification">
            <a href="" class="new"><i class="typcn typcn-bell"></i></a>
            <div class="dropdown-menu">
              <div class="az-dropdown-header mg-b-20 d-sm-none">
                <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
              </div>
              <h6 class="az-notification-title">Notifications</h6>
              <p class="az-notification-text">You have update notification Penduduk</p>

              <div class="az-notification-list">
                <?php if (!empty($notifikasi)): ?>
                    <?php foreach ($notifikasi as $notif): ?>
                        <div class="media new">
                            <!-- Gambar pengguna -->
                            <div class="az-img-user">
                                <img src="<?= Url::to('@web/Azia/img/faces/face2.jpg') ?>" alt="">
                            </div>
                            <!-- Informasi notifikasi -->
                            <div class="media-body">
                                <p><?= Html::encode($notif->nama) ?></p>
                               <span><?= Yii::$app->formatter->asDatetime($notif->updated_at, 'php:d F Y H:i') ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="media">
                        <div class="media-body">
                            <p>Tidak ada notifikasi terbaru.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
              <div class="dropdown-footer"><a href="<?=Url::to(['masyarakat/index'])?>">View All Notifications</a></div>
            </div><!-- dropdown-menu -->
          </div><!-- az-header-notification -->
          <div class="dropdown az-profile-menu">
            <a href="" class="az-img-user"><img src="<?=Url::to('@web/Azia/img/faces/face1.jpg')?>" alt=""></a>
            <div class="dropdown-menu">
              <div class="az-dropdown-header d-sm-none">
                <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
              </div>
              <div class="az-header-profile">
                <div class="az-img-user">
                  <img src="<?=Url::to('@web/Azia/img/faces/face1.jpg')?>" alt="">
                </div><!-- az-img-user -->
                <h6><?=Yii::$app->user->identity->username?></h6>
                <span>Admin</span>
              </div><!-- az-header-profile -->

              <a href="<?=Url::to(['user/index'])?>" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
              <a href="" class="dropdown-item"><i class="typcn typcn-edit"></i> Edit Profile</a>
              <a href="" class="dropdown-item"><i class="typcn typcn-time"></i> Activity Logs</a>
              <a href="" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Account Settings</a>
              <a data-method = "POST" href="<?=Url::to(['logout'])?>" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign Out</a>
            </div><!-- dropdown-menu -->
          </div>
        </div><!-- az-header-right -->
      </div><!-- container -->
    </div><!-- az-header -->

<div class="az-content az-content-dashboard">
        <?= Alert::widget() ?>
        <?= $content ?>
</div>

<div class="az-footer ht-40">
      <div class="container ht-100p pd-t-0-f">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Desa Parombean, 2025</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Sistem Informasi | UIN Alauddin Makassar</span>
      </div><!-- container -->
    </div>
<script>
      $(function(){
        'use strict'

            var plot = $.plot('#flotChart', [{
          data: flotSampleData3,
          color: '#007bff',
          lines: {
            fillColor: { colors: [{ opacity: 0 }, { opacity: 0.2 }]}
          }
        },{
          data: flotSampleData4,
          color: '#560bd0',
          lines: {
            fillColor: { colors: [{ opacity: 0 }, { opacity: 0.2 }]}
          }
        }], {
                series: {
                    shadowSize: 0,
            lines: {
              show: true,
              lineWidth: 2,
              fill: true
            }
                },
          grid: {
            borderWidth: 0,
            labelMargin: 8
          },
                yaxis: {
            show: true,
                    min: 0,
                    max: 100,
            ticks: [[0,''],[20,'20K'],[40,'40K'],[60,'60K'],[80,'80K']],
            tickColor: '#eee'
                },
                xaxis: {
            show: true,
            color: '#fff',
            ticks: [[25,'OCT 21'],[75,'OCT 22'],[100,'OCT 23'],[125,'OCT 24']],
          }
        });

        $.plot('#flotChart1', [{
          data: dashData2,
          color: '#00cccc'
        }], {
                series: {
                    shadowSize: 0,
            lines: {
              show: true,
              lineWidth: 2,
              fill: true,
              fillColor: { colors: [ { opacity: 0.2 }, { opacity: 0.2 } ] }
            }
                },
          grid: {
            borderWidth: 0,
            labelMargin: 0
          },
                yaxis: {
            show: false,
            min: 0,
            max: 35
          },
                xaxis: {
            show: false,
            max: 50
          }
            });

        $.plot('#flotChart2', [{
          data: dashData2,
          color: '#007bff'
        }], {
                series: {
                    shadowSize: 0,
            bars: {
              show: true,
              lineWidth: 0,
              fill: 1,
              barWidth: .5
            }
                },
          grid: {
            borderWidth: 0,
            labelMargin: 0
          },
                yaxis: {
            show: false,
            min: 0,
            max: 35
          },
                xaxis: {
            show: false,
            max: 20
          }
            });


      
        $('.peity-line').peity('line');

        // Bar charts
        $('.peity-bar').peity('bar');

        // Bar charts
        $('.peity-donut').peity('donut');

        var ctx5 = document.getElementById('chartBar5').getContext('2d');
        new Chart(ctx5, {
          type: 'bar',
          data: {
            labels: [0,1,2,3,4,5,6,7],
            datasets: [{
              data: [2, 4, 10, 20, 45, 40, 35, 18],
              backgroundColor: '#560bd0'
            }, {
              data: [3, 6, 15, 35, 50, 45, 35, 25],
              backgroundColor: '#cad0e8'
            }]
          },
          options: {
            maintainAspectRatio: false,
            tooltips: {
              enabled: false
            },
            legend: {
              display: false,
                labels: {
                  display: false
                }
            },
            scales: {
              yAxes: [{
                display: false,
                ticks: {
                  beginAtZero:true,
                  fontSize: 11,
                  max: 80
                }
              }],
              xAxes: [{
                barPercentage: 0.6,
                gridLines: {
                  color: 'rgba(0,0,0,0.08)'
                },
                ticks: {
                  beginAtZero:true,
                  fontSize: 11,
                  display: false
                }
              }]
            }
          }
        });

       
        var datapie = {
          labels: ['Search', 'Email', 'Referral', 'Social', 'Other'],
          datasets: [{
            data: [25,20,30,15,10],
            backgroundColor: ['#6f42c1', '#007bff','#17a2b8','#00cccc','#adb2bd']
          }]
        };

        var optionpie = {
          maintainAspectRatio: false,
          responsive: true,
          legend: {
            display: false,
          },
          animation: {
            animateScale: true,
            animateRotate: true
          }
        };

        // For a doughnut chart
        var ctxpie= document.getElementById('chartDonut');
        var myPieChart6 = new Chart(ctxpie, {
          type: 'doughnut',
          data: datapie,
          options: optionpie
        });

      });
    </script>


<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage();
