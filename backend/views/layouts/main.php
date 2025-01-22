<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;
AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="shortcut icon" type="image/icon" href="listrace/assets/logo/favicon.png"/>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<header id="header-top" class="header-top">
            <ul>
                <li class="head-responsive-right pull-right">
                    <div class="header-top-right">
                        <ul>
                            <li class="header-top-contact">
                                <span><i class="fa fa-phone"> 085241064466</i></span>
                            </li>
                            <li class="header-top-contact">
                                <a href="http://localhost/kmp/frontend/web/site/login">sign in</a>
                            </li>
                            <li class="header-top-contact">
                                <a href="http://localhost/kmp/frontend/web/site/signup">register</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
                    
        </header>
<div  class="">
            <div class="container">
                <div class="footer-menu">
                    <div class="row">
                        <div class="col-sm-3">
                             <div class="navbar-header">
                                <a class="navbar-brand" href="index.html"><span>Desa Parombean</span></a>
                            </div><!--/.navbar-header-->
                        </div>
                        <div class="col-sm-9">
                            <ul class="footer-menu-item">
                                <li class="scroll"><a href="<?=Url::to(['site/index'])?>">Home</a></li>
                                <li class="scroll"><a href="<?=Url::to(['site/profile'])?>">Profile Desa</a></li>
                                <li class="scroll"><a href="<?=Url::to(['site/struktur'])?>">Struktur Organisasi</a></li>
                                
                                <li class="scroll"><a href="<?=Url::to(['site/data'])?>">review data</a></li>
                                <!-- <li class="scroll"><a href="#contact">contact</a></li> -->
                                
                            </ul><!--/.nav -->
                        </div>
                   </div>
                </div>
               
            </div><!--/.container-->

            <div id="scroll-Top">
                <div class="return-to-top">
                    <i class="fa fa-angle-up " id="scroll-top" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back to Top" aria-hidden="true"></i>
                </div>
                
            </div><!--/.scroll-Top-->
            
        </div>

        <?= Alert::widget() ?>
        <?= $content ?>

<footer id="footer"  class="footer">
            <div class="container">
                <div class="hm-footer-copyright">
                    <div class="row">
                        <div class="col-sm-5">
                            <p>
                                &copy;desa parombean. 2025
                            </p><!--/p-->
                        </div>
                        <div class="col-sm-7">
                            <div class="footer-social">
                                <span><i class="fa fa-phone"> 085241064466</i></span>
                                <a href="#"><i class="fa fa-facebook"></i></a>  
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    
                </div><!--/.hm-footer-copyright-->
            </div><!--/.container-->

            <div id="scroll-Top">
                <div class="return-to-top">
                    <i class="fa fa-angle-up " id="scroll-top" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back to Top" aria-hidden="true"></i>
                </div>
                
            </div><!--/.scroll-Top-->
            
        </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
