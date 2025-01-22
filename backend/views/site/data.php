<?php

/** @var yii\web\View $this */
use yii\helpers\Url;
use yii\helpers\Html;
$this->title = 'parombean';

$totalJumlah = array_sum(array_column($dataRaskin, 'Jumlah'));

?>
<section id="list-topics" class="list-topics">
            <div class="container text-center">
                <div class="single-explore-item">
<div class="az-content-body pd-lg-l-40 d-flex flex-column" style="margin:20px;">
		  <hr>
          <h2 class="az-content-title text-left">Jumlah Penduduk</h2>
          <hr>
          <div class="table-responsive">
            <table class="table mg-b-0">
            <thead>
                <tr>
                    <th>Nama Dusun</th>
                    <th>Laki-laki</th>
                    <th>Perempuan</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataJiwa as $row): ?>
                    <tr>
                        <td><?= Html::encode($row['NamaDusun']) ?></td>
                        <td><?= Html::encode($row['LakiLaki']) ?></td>
                        <td><?= Html::encode($row['Perempuan']) ?></td>
                        <td><?= Html::encode($row['Total']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
          </div>

          <hr class="mg-y-30">

         



        </div><!-- az-content-body -->
    </div>
</div>
</section>



<section id="list-topics" class="list-topics">
            <div class="container text-center">
                <div class="single-explore-item">
<div class="az-content-body pd-lg-l-40 d-flex flex-column" style="margin:20px;">
 <hr>
          <h2 class="az-content-title text-left">Jumlah Kepala Keluarga</h2>
          <hr>

          <div class="table-responsive">
           <table class="table mg-b-0">
                <thead>
                    <tr>
                        <th>Nama Dusun</th>
                        <th>Laki-laki</th>
                        <th>Perempuan</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataKK as $row): ?>
                        <tr>
                            <td><?= Html::encode($row['NamaDusun']) ?></td>
                            <td><?= Html::encode($row['LakiLaki']) ?></td>
                            <td><?= Html::encode($row['Perempuan']) ?></td>
                            <td><?= Html::encode($row['Total']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
          </div>
          <hr class="mg-y-30">
      </div>
  </div>
</div>
</section>

<section id="list-topics" class="list-topics">
            <div class="container text-center">
                <div class="single-explore-item">
<div class="az-content-body pd-lg-l-40 d-flex flex-column" style="margin:20px;">
 		  <hr>
          <h2 class="az-content-title text-left">Jumlah Pendidikan</h2>
          <hr>

          <div class="table-responsive">
           
            <table class="table mg-b-0">
		    <thead>
		        <tr>
		            <th>Jenjang Pendidikan</th>
		            <th>Laki-laki</th>
		            <th>Perempuan</th>
		            <th>Total</th>
		        </tr>
		    </thead>
		    <tbody>
		        <?php foreach ($dataPendidikan as $row): ?>
		            <tr>
		                <td><?= Html::encode($row['JenjangPendidikan']) ?></td>
		                <td><?= Html::encode($row['LakiLaki']) ?></td>
		                <td><?= Html::encode($row['Perempuan']) ?></td>
		                <td><?= Html::encode($row['LakiLaki'] + $row['Perempuan']) ?></td>
		            </tr>
		        <?php endforeach; ?>
		    </tbody>
		</table>
		          </div>
          <hr class="mg-y-30">
      </div>
  </div>
</div>
</section>

<section id="list-topics" class="list-topics">
            <div class="container text-center">
                <div class="single-explore-item">
<div class="az-content-body pd-lg-l-40 d-flex flex-column" style="margin:20px;">
 		  <hr>
          <h2 class="az-content-title text-left">Jumlah Pekerjaan</h2>
          <hr>

          <div class="table-responsive">
           
            <table class="table mg-b-0">
			    <thead>
			        <tr>
			            <th>Pekerjaan</th>
			            <th>Laki-laki</th>
			            <th>Perempuan</th>
			            <th>Total</th>
			        </tr>
			    </thead>
			    <tbody>
			        <?php foreach ($dataPekerjaan as $row): ?>
			            <tr>
			                <td><?= Html::encode($row['Pekerjaan']) ?></td>
			                <td><?= Html::encode($row['LakiLaki']) ?></td>
			                <td><?= Html::encode($row['Perempuan']) ?></td>
			                <td><?= Html::encode($row['LakiLaki'] + $row['Perempuan']) ?></td>
			            </tr>
			        <?php endforeach; ?>
			    </tbody>
			</table>
		          </div>
          <hr class="mg-y-30">
      </div>
  </div>
</div>
</section>

<section id="list-topics" class="list-topics">
            <div class="container text-center">
                <div class="single-explore-item">
<div class="az-content-body pd-lg-l-40 d-flex flex-column" style="margin:20px;">
          <hr>
          <h2 class="az-content-title text-left">Jenis Kelamin</h2>
          <hr>

          <div class="table-responsive">
           
             <table class="table mg-b-0">
            <thead>
                <tr>
                    <th rowspan="2" class="text-center align-middle">Nama Dusun</th>
                    <th colspan="3" class="text-center">JENIS KELAMIN</th>
                </tr>
                <tr>
                    <th class="text-center">Laki-laki</th>
                    <th class="text-center">Perempuan</th>
                    <th class="text-center">L/P</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $totalLakiLaki = 0;
                $totalPerempuan = 0;
                $grandTotal = 0;

                foreach ($dataJK as $row): 
                    $totalLakiLaki += $row['LakiLaki'];
                    $totalPerempuan += $row['Perempuan'];
                    $grandTotal += $row['Total'];
                ?>
                <tr>
                    <td><?= Html::encode($row['NamaDusun']) ?></td>
                    <td class="text-center"><?= Html::encode($row['LakiLaki']) ?></td>
                    <td class="text-center"><?= Html::encode($row['Perempuan']) ?></td>
                    <td class="text-center"><?= Html::encode($row['Total']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center">JUMLAH</th>
                    <th class="text-center"><?= $totalLakiLaki ?></th>
                    <th class="text-center"><?= $totalPerempuan ?></th>
                    <th class="text-center"><?= $grandTotal ?></th>
                </tr>
            </tfoot>
        </table>
                  </div>
          <hr class="mg-y-30">
      </div>
  </div>
</div>
</section>

<section id="list-topics" class="list-topics">
            <div class="container text-center">
                <div class="single-explore-item">
<div class="az-content-body pd-lg-l-40 d-flex flex-column" style="margin:20px;">
          <hr>
          <h2 class="az-content-title text-left">Kelompok Umur</h2>
          <hr>

          <div class="table-responsive">
           
            <table class="table mg-b-0">
    <thead>
        <tr>
            <th rowspan="2" class="text-center align-middle">Umur / Tahun</th>
            <th colspan="2" class="text-center">JK</th>
            <th rowspan="2" class="text-center align-middle">L/P</th>
        </tr>
        <tr>
            <th class="text-center">L</th>
            <th class="text-center">P</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $totalLakiLaki = 0;
        $totalPerempuan = 0;
        $grandTotal = 0;

        foreach ($dataKU as $row): 
            $totalLakiLaki += $row['LakiLaki'];
            $totalPerempuan += $row['Perempuan'];
            $grandTotal += $row['Total'];
        ?>
        <tr>
            <td class="text-center"><?= Html::encode($row['Umur']) ?></td>
            <td class="text-center"><?= Html::encode($row['LakiLaki']) ?></td>
            <td class="text-center"><?= Html::encode($row['Perempuan']) ?></td>
            <td class="text-center"><?= Html::encode($row['Total']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th class="text-center">JUMLAH</th>
            <th class="text-center"><?= $totalLakiLaki ?></th>
            <th class="text-center"><?= $totalPerempuan ?></th>
            <th class="text-center"><?= $grandTotal ?></th>
        </tr>
    </tfoot>
</table>
                  </div>
          <hr class="mg-y-30">
      </div>
  </div>
</div>
</section>

<section id="list-topics" class="list-topics">
            <div class="container text-center">
                <div class="single-explore-item">
<div class="az-content-body pd-lg-l-40 d-flex flex-column" style="margin:20px;">
          <hr>
          <h2 class="az-content-title text-left">Data Penerima Raskin</h2>
          <hr>

          <div class="table-responsive">
           
            <table class="table mg-b-0">
    <thead>
        <tr>
            <th>Nama Dusun</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataRaskin as $row): ?>
            <tr>
                <td><?= Html::encode($row['NamaDusun']) ?></td>
                <td><?= Html::encode($row['Jumlah']) ?> orang</td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td><strong>JUMLAH</strong></td>
            <td><strong><?= $totalJumlah ?> orang</strong></td>
        </tr>
    </tbody>
</table>
                  </div>
          <hr class="mg-y-30">
      </div>
  </div>
</div>
</section>

<section id="list-topics" class="list-topics">
            <div class="container text-center">
                <div class="single-explore-item">
<div class="az-content-body pd-lg-l-40 d-flex flex-column" style="margin:20px;">
          <hr>
          <h2 class="az-content-title text-left">Data Penerima BPJS</h2>
          <hr>

          <div class="table-responsive">
           
            <table class="table mg-b-0">
    <thead>
        <tr>
            <th>Nama Dusun</th>
            <th>Laki-laki</th>
            <th>Perempuan</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $totalLakiLaki = 0;
        $totalPerempuan = 0;
        $totalKeseluruhan = 0;
        foreach ($dataBPJS as $row): 
            $totalLakiLaki += $row['LakiLaki'];
            $totalPerempuan += $row['Perempuan'];
            $totalKeseluruhan += $row['Total'];
        ?>
            <tr>
                <td><?= Html::encode($row['NamaDusun']) ?></td>
                <td><?= Html::encode($row['LakiLaki']) ?> orang</td>
                <td><?= Html::encode($row['Perempuan']) ?> orang</td>
                <td><?= Html::encode($row['Total']) ?> orang</td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td><strong>JUMLAH</strong></td>
            <td><strong><?= Html::encode($totalLakiLaki) ?> orang</strong></td>
            <td><strong><?= Html::encode($totalPerempuan) ?> orang</strong></td>
            <td><strong><?= Html::encode($totalKeseluruhan) ?> orang</strong></td>
        </tr>
    </tbody>
</table>
                  </div>
          <hr class="mg-y-30">
      </div>
  </div>
</div>
</section>




