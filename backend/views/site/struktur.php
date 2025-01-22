<?php

/** @var yii\web\View $this */
use yii\helpers\Url;
$this->title = 'parombean';
?>

<section id="list-topics" class="list-topics">
            <div class="container text-center">
                <div class="single-explore-item">
                    <div class="single-explore-img">
                        <img src="<?=Url::to('@web/listrace/assets/images/explore/struktur.png')?>" alt="explore image">
                        <div class="single-explore-img-info">
                            <button style="width:300px;" onclick="window.location.href='#'">Struktur Organisasi Pemerintah Desa Parombean</button>
                            <div class="single-explore-image-icon-box">
                                <ul>
                                    <li>
                                        <div class="single-explore-image-icon">
                                            <i class="fa fa-arrows-alt"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-explore-image-icon">
                                            <i class="fa fa-bookmark-o"></i>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>