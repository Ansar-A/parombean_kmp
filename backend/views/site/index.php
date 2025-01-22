<?php

/** @var yii\web\View $this */
use common\models\Masyarakat;
use yii\helpers\Url;
$this->title = 'parombean';

$jml_penduduk = Masyarakat::find()->count();
$jml_pendidikan = Masyarakat::find()
    ->select('status_sekolah')
    ->distinct()
    ->count();
$jml_pekerjaan = Masyarakat::find()
    ->select('status_pekerjaan')
    ->distinct()
    ->count();


?>


<section id="home" class="" style="
    background-image: url('<?=Url::to('@web/listrace/assets/images/explore/medium.jpg')?>');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh;">
            <div class="container">

                <div class="welcome-hero-txt">
                    <h2>Desa Parombean </h2>
                    <p>
                        Kecamatan Curio, Enrekang, Sulawesi Selatan.
                    </p>
                </div>
                <div class="welcome-hero-serch-box">
                    <div class="welcome-hero-form">
                        <div class="single-welcome-hero-form">
                            <h3>about:</h3> &nbsp;
                            <p class="mt-1"> Desa Wisata Parombean</p>
                            <div class="welcome-hero-form-icon">
                                <i class="flaticon-list-with-dots"></i>
                            </div>
                        </div>
                        <div class="single-welcome-hero-form">
                            <h3>provinsi:</h3> &nbsp;
                            <p class="mt-1">Sulawesi Selatan</p>
                            <div class="welcome-hero-form-icon">
                                <i class="flaticon-gps-fixed-indicator"></i>
                            </div>
                        </div>
                    </div>
                    <div class="welcome-hero-serch" >
                        <button style="width:300px" class="welcome-hero-btn" onclick="window.location.href='<?=Url::to(['site/profile'])?>'">
                             Profile Parombean  <i data-feather="search"></i> 
                        </button>
                    </div>
                </div>
            </div>

        </section>
        

        <section id="list-topics" class="list-topics">
            <div class="container text-center">
                <div class="list-topics-content">
                    <ul>
                        <li>
                            <div class="single-list-topics-content">
                                <div class="single-list-topics-icon">
                                    <i class="flaticon-restaurant"></i>
                                </div>
                                <h2><a href="<?=Url::to(['site/data'])?>">Jumlah Penduduk</a></h2>
                                <p><?php echo $jml_penduduk ?> listings</p>
                            </div>
                        </li>
                        <li>
                            <div class="single-list-topics-content">
                                <div class="single-list-topics-icon">
                                    <i class="flaticon-travel"></i>
                                </div>
                                <h2><a href="<?=Url::to(['site/data'])?>">Data Pendidikan</a></h2>
                                <p><?php echo $jml_pendidikan ?> listings</p>
                            </div>
                        </li>
                        <li>
                            <div class="single-list-topics-content">
                                <div class="single-list-topics-icon">
                                    <i class="flaticon-building"></i>
                                </div>
                                <h2><a href="<?=Url::to(['site/data'])?>">Data Pekerjaan</a></h2>
                                <p><?php echo $jml_pekerjaan ?> listings</p>
                            </div>
                        </li>
                        <li>
                            <div class="single-list-topics-content">
                                <div class="single-list-topics-icon">
                                    <i class="flaticon-pills"></i>
                                </div>
                                <h2><a href="<?=Url::to(['site/data'])?>">Jenis Kelamin</a></h2>
                                <p><?php
                            $results = Masyarakat::find()
                                ->select(['jk', 'COUNT(*) AS total'])
                                ->groupBy('jk')
                                ->asArray()
                                ->all();

                            $totalL = 0;
                            $totalP = 0;

                            foreach ($results as $result) {
                                if ($result['jk'] === 'L') {
                                    $totalL = $result['total'];
                                } elseif ($result['jk'] === 'P') {
                                    $totalP = $result['total'];
                                }
                            }
                            echo "Laki-Laki: $totalL, Perempuan: $totalP";                            ?>
                            </p>
                            </div>
                        </li>
                        <li>
                            <div class="single-list-topics-content">
                                <div class="single-list-topics-icon">
                                    <i class="flaticon-transport"></i>
                                </div>
                                <h2><a href="<?=Url::to(['site/data'])?>">Data Kelompok Umur</a></h2>
                                <p>cek now</p>
                            </div>
                        </li>
                        <li>
                            <div class="single-list-topics-content">
                                <div class="single-list-topics-icon">
                                    <i class="flaticon-transport"></i>
                                </div>
                                <h2><a href="<?=Url::to(['site/data'])?>">Data Penerima Raskin</a></h2>
                                <p>cek now</p>
                            </div>
                        </li>
                        <li>
                            <div class="single-list-topics-content">
                                <div class="single-list-topics-icon">
                                    <i class="flaticon-transport"></i>
                                </div>
                                <h2><a href="<?=Url::to(['site/data'])?>">Data Penerima BPJS</a></h2>
                                <p>cek now</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!--/.container-->

        </section><!--/.list-topics-->
        <section id="works" class="works">
            <div class="container">
                <div class="section-header">
                    <h2>how it works</h2>
                    <p>Learn More about how our website works</p>
                </div><!--/.section-header-->
                <div class="works-content">
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="single-how-works">
                                <div class="single-how-works-icon">
                                    <i class="flaticon-lightbulb-idea"></i>
                                </div>
                                <h2><a href="#">choose <span> what to</span> do</a></h2>
                                <p>
                                    Profile desa Parombean
                                </p>
                                <button class="welcome-hero-btn how-work-btn" onclick="window.location.href='#'">
                                    read more
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="single-how-works">
                                <div class="single-how-works-icon">
                                    <i class="flaticon-networking"></i>
                                </div>
                                <h2><a href="#">find <span> what you want</span></a></h2>
                                <p>
                                    Data penduduk desa Parombean, kec. Curio, kab. Enrekang.
                                </p>
                                <button class="welcome-hero-btn how-work-btn" onclick="window.location.href='#'">
                                    read more
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="single-how-works">
                                <div class="single-how-works-icon">
                                    <i class="flaticon-location-on-road"></i>
                                </div>
                                <h2><a href="#">explore <span> Data</span></a></h2>
                                <p>
                                    view spesifik data penduduk.
                                </p>
                                <button class="welcome-hero-btn how-work-btn" onclick="window.location.href='#'">
                                    read more
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.container-->
        
        </section><!--/.works-->
        