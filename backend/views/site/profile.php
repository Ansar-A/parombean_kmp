<?php

/** @var yii\web\View $this */
use yii\helpers\Url;
$this->title = 'parombean';
// Menambahkan CSS langsung di file PHP
$css = <<<CSS
.single-explore-img {
    width: 100%; /* Atau ukuran tertentu */
    height: 300px; /* Tinggi yang diinginkan */
    overflow: hidden; /* Sembunyikan bagian gambar yang keluar */
}

.single-explore-img img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Gambar memenuhi div */
    display: block; /* Menghilangkan jarak kosong di bawah gambar */
}

CSS;

$this->registerCss($css);
?>

        <!--welcome-hero end -->

        <!--list-topics start -->

        <section id="list-topics" class="list-topics">
            <div class="container text-center">
                <div class="single-explore-item">
                    <div class="single-explore-img">
                    <img src="<?=Url::to('@web/listrace/assets/images/explore/medium.jpg')?>" alt="Explore image">
                    <div class="single-explore-img-info">
                        <button style="width:180px;" onclick="window.location.href='#'">Desa Parombean</button>
                        <div class="single-explore-image-icon-box">
                            <ul>
                                <li>
                                    <div class="single-explore-image-icon">
                                        <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-explore-image-icon">
                                        <i class="fa fa-bookmark-o" aria-hidden="true"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                    <div class="single-explore-txt bg-theme-1">
                        <h2><a href="#">Desa Parombean</a></h2>
                        <p class="explore-rating-price">
                            <!-- <span class="explore-rating"> </span> -->
                            <span>Kode PUM: 7316082004</span> 
                            <span class="explore-price-box">
                                Desa/Kelurahan: Parombean
                            </span>
                            <span>
                                Kecamatan: Curio
                            </span>
                            <span class="explore-price-box">
                                Kabupaten: Enrekang
                            </span>
                            <span>
                                Provinsi: Sulawesi Selatan
                            </span>
                        </p>
                        <div class="explore-person">
                            <div class="row">
                                <div class="col-sm-12">
                                    <style>
                                        table {
                                            border-collapse: collapse;
                                            width: 100%;
                                            margin: 20px 0;
                                            font-size: 12px;
                                            text-align: left;
                                        }
                                        table, th, td {
                                            border: 1px solid #000;
                                        }
                                        th, td {
                                            padding: 8px;
                                        }
                                        th {
                                            background-color: #f4f4f4;
                                            text-align: center;
                                        }
                                        .section-title {
                                            font-weight: bold;
                                            text-align: left;
                                            background-color: #f0f0f0;
                                        }
                                    </style>
                                    <table>
                                        <tr>
                                            <th class="section-title" colspan="2">Informasi Luas dan Koordinat</th>
                                        </tr>
                                        <tr>
                                            <td>Luas (Ha)</td>
                                            <td>2005 Ha</td>
                                        </tr>
                                        <tr>
                                            <td>Koordinat Bujur</td>
                                            <td>119.964397</td>
                                        </tr>
                                        <tr>
                                            <td>Koordinat Lintang</td>
                                            <td>-3.314365</td>
                                        </tr>
                                        <tr>
                                            <td>Ketinggian DPL (M)</td>
                                            <td>570</td>
                                        </tr>
                                        <tr>
                                            <td>Terluar di Kecamatan</td>
                                            <td>Ya</td>
                                        </tr>
                                        <tr>
                                            <td>Terluar di Kabupaten/Kota</td>
                                            <td>Ya</td>
                                        </tr>
                                        <tr>
                                            <td>Terluar di Provinsi</td>
                                            <td>Tidak</td>
                                        </tr>
                                        <tr>
                                            <td>Terluar di Indonesia</td>
                                            <td>Tidak</td>
                                        </tr>
                                    </table>

                                    <!-- Bagian Batas-Batas -->
                                    <table>
                                        <tr>
                                            <th class="section-title" colspan="3">Batas-Batas Wilayah</th>
                                        </tr>
                                        <tr>
                                            <th>Batas</th>
                                            <th>Desa/Kelurahan</th>
                                            <th>Kecamatan</th>
                                        </tr>
                                        <tr>
                                            <td>Sebelah Utara</td>
                                            <td>Lembang Uluway Barat</td>
                                            <td>Mengkendek, Kab. Tana Toraja</td>
                                        </tr>
                                        <tr>
                                            <td>Sebelah Selatan</td>
                                            <td>Desa Sanglepongan</td>
                                            <td>Curio, Kab. Enrekang</td>
                                        </tr>
                                        <tr>
                                            <td>Sebelah Timur</td>
                                            <td>Lembang Uluway Timur</td>
                                            <td>Mengkendek, Kab. Tana Toraja</td>
                                        </tr>
                                        <tr>
                                            <td>Sebelah Barat</td>
                                            <td>Desa Curio</td>
                                            <td>Curio, Kab. Enrekang</td>
                                        </tr>
                                    </table>

                                    <!-- Bagian Informasi Pengisi -->
                                    <table>
                                        <tr>
                                            <th class="section-title" colspan="2">Informasi Pengisi</th>
                                        </tr>
                                        <tr>
                                            <td>Nama Pengisi</td>
                                            <td>QALBUDDIN, S. Ak</td>
                                        </tr>
                                        <tr>
                                            <td>Pekerjaan</td>
                                            <td>APARAT DESA PAROMBEAN</td>
                                        </tr>
                                        <tr>
                                            <td>Jabatan</td>
                                            <td>KASI PEMERINTAHAN</td>
                                        </tr>
                                    </table>

                                    <!-- Bagian Sumber Data -->
                                    <table>
                                        <tr>
                                            <th class="section-title" colspan="2">Sumber Data yang Digunakan</th>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                1. KK<br>
                                                2. Data Penduduk Desa Parombean<br>
                                                3. Sumber Lainnya
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="explore-open-close-part">
                            <div class="row">
                                <div class="col-sm-5">
                                    <span class="text-dark">Kepala Desa Parombean</span>
                                    <p class="mt-5">ABDURRAHMAN ZAID R, S. Kom</p>
                                </div>
                                <div class="col-sm-7">
                                    <div class="explore-map-icon">
                                        <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg></a>
                                        <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg></a>
                                        <!-- <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.container-->
        </section><!--/.list-topics-->

        <section id="works" class="works">
            <div class="container">
                <div class="section-header mt-5">
                    <h2>VISI & MISI</h2>
                    <p>Learn More about how our website works</p>
                </div><!--/.section-header-->
                <div class="works-content text-center" style="margin-top: 20px;">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="single-how-works">
                                <div class="single-how-works-icon">
                                    <i class="flaticon-lightbulb-idea"></i>
                                </div>
                                <h2><a href="#">VISI</a></h2>
                                <p>
                                    Membantu masyarakat dalam administrasi data kependudukan secara efektif dan efisien.
                                </p>
                                <button class="welcome-hero-btn how-work-btn" onclick="window.location.href='#'">
                                    read more
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="single-how-works">
                                <div class="single-how-works-icon">
                                    <i class="flaticon-networking"></i>
                                </div>
                                <h2><a href="#">MISI</span></a></h2>
                                <p>
                                    Menjadi media atau sarana terintegrasi guna kepentingan masyarakat desa parombean.
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
        <section id="maps" class="works">
            <div class="container">
                <div class="section-header mt-0">
                    <h2>MAPS</h2>
                    <p>Desa Parombean, Kec. Curio, Kab. Enrekang</p>
                </div><!--/.section-header-->
                <div class="works-content text-center" style="margin-top: 20px;">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                         
                                <!-- MAPS -->
                                <div id="map" style="width: 100%; height: 500px;"></div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Google Maps API -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfNMR6zlDp3YGFd6353QdPA8vx0HjjIhs&callback=initMap" async defer></script>

        <script>
            function initMap() {
                // Lokasi default (contoh: Jakarta)
                const location = { lat: -3.2993517088001876, lng: 119.96513550858445 };
                 
                // Inisialisasi peta
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 10,
                    center: location,
                });

                // Tambahkan marker
                new google.maps.Marker({
                    position: location,
                    map: map,
                    title: "Desa Parombean",
                });
            }
        </script>
