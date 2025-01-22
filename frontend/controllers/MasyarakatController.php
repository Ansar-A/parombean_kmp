<?php

namespace frontend\controllers;
use Yii;
use common\models\Masyarakat;
use frontend\models\MasyarakatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * MasyarakatController implements the CRUD actions for Masyarakat model.
 */
class MasyarakatController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Masyarakat models.
     *
     * @return string
     */
    public function actionDpenerimabpjs()
    {
        $this->layout = 'main_side';
        $dataBPJS = Masyarakat::getDataPenerimaBPJS();

        return $this->render('dpenerimabpjs', [
            'dataBPJS' => $dataBPJS,
           
        ]);
    }
    public function actionDpenerimaraskin()
    {
        $this->layout = 'main_side';
        $dataRaskin = Masyarakat::getDataPenerimaRaskin();

        return $this->render('dpenerimaraskin', [
            'dataRaskin' => $dataRaskin,
           
        ]);
    }
    public function actionDkelompokumur()
    {
        $this->layout = 'main_side';
        $dataKU = Masyarakat::getDataKelompokUmur();

        return $this->render('dkelompokumur', [
            'dataKU' => $dataKU,
           
        ]);
    }

    public function actionDjeniskelamin()
    {
        $this->layout = 'main_side';
        $dataJK = Masyarakat::getJenisKelamin();

        return $this->render('djeniskelamin', [
            'dataJK' => $dataJK,
           
        ]);
    }
    public function actionDpekerjaan()
    {
        $this->layout = 'main_side';
        $dataPekerjaan = Masyarakat::getDataPekerjaan();
        return $this->render('dpekerjaan', [
            'dataPekerjaan' => $dataPekerjaan,
        ]);
    }

    public function actionDp()
    {
        $this->layout = 'main_side';
        $dataPendidikan = Masyarakat::getDataPendidikan();
        return $this->render('dp', [
            'dataPendidikan' => $dataPendidikan,
        ]);
    }

    public function actionJp()
    {
        $this->layout = 'main_side';
        $dataJiwa = Masyarakat::getJumlahJiwa();
        $dataKK = Masyarakat::getJumlahKepalaKeluarga();

        return $this->render('jp', [
            'dataJiwa' => $dataJiwa,
            'dataKK' => $dataKK,
        ]);
    }

    public function actionIndex()
    {
        
        $searchModel = new MasyarakatSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Masyarakat model.
     * @param int $id_masyarakat Id Masyarakat
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
   public function actionView($id_masyarakat)
    {
        Yii::info("Aksi view dipanggil dengan ID: $id_masyarakat", __METHOD__);

        $model = Masyarakat::findOne($id_masyarakat);
        if (!$model) {
            throw new NotFoundHttpException("Data tidak ditemukan.");
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                'model' => $model,
            ]);
        }

        // return $this->render('view', [
        //     'model' => $model,
        // ]);
    }

    public function getNotifikasi()
    {
        // Mengambil data notifikasi terbaru
        return Masyarakat::find()
            ->orderBy(['updated_at' => SORT_DESC])
            ->limit(5)
            ->all();
    }

    /**
     * Creates a new Masyarakat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Masyarakat();
        $model->get_user = Yii::$app->user->identity->id;
        if ($this->request->isPost) {
            // if ($model->save()) {
            //     return json_encode(['success' => true]);
            // } else {
            //     return json_encode([
            //         'success' => false,
            //         'message' => $model->getFirstError('NIK'),
            //     ]);
            // }

            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index', 'id_masyarakat' => $model->id_masyarakat]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }
    public function actionValidate()
    {
        $model = new Masyarakat();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }
    }


    /**
     * Updates an existing Masyarakat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_masyarakat Id Masyarakat
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */


public function actionUpdate($id_masyarakat)
{
    $model = Masyarakat::findOne($id_masyarakat);
    $model->get_user = Yii::$app->user->identity->id;
    if ($model === null) {
        // Handle jika model tidak ditemukan
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(['index']);
    }

    return $this->renderAjax('update', [
        'model' => $model,
    ]);
}



    /**
     * Deletes an existing Masyarakat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_masyarakat Id Masyarakat
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_masyarakat)
    {
        // Temukan model berdasarkan ID
        $model = $this->findModel($id_masyarakat);
        $model->delete();
        // if ($model->delete()) {
        //     Yii::$app->session->setFlash('success', 'Data berhasil dihapus.');
        // } else {
        //     Yii::$app->session->setFlash('error', 'Data gagal dihapus.');
        // }

        // Redirect ke index setelah penghapusan
        return $this->redirect(['index']);
    }


    /**
     * Finds the Masyarakat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_masyarakat Id Masyarakat
     * @return Masyarakat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_masyarakat)
    {
        if (($model = Masyarakat::findOne(['id_masyarakat' => $id_masyarakat])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionBackup()
{
    $models = Masyarakat::find()->all();
    $filename = 'masyarakat_backup_' . date('Y-m-d_H-i-s') . '.csv';

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment;filename="' . $filename . '"');

    $output = fopen('php://output', 'w');

    // Tulis header kolom
    fputcsv($output, [
        'ID Masyarakat', 
        'ID Operator', 
        'Nama', 
        'Dusun', 
        'NIK', 
        'jk', 
        'status_keluarga',
        'status_sekolah',
        'status_pekerjaan',
        'agama',
        'warga_negara',
        'tgl_lahir',
        'penerima_raskin',
        'penerima_BPJS'
        ]); // Ganti dengan kolom tabel Anda

    // Tulis data dari tabel masyarakat
    foreach ($models as $model) {
        fputcsv($output, [
            $model->id_masyarakat,
            $model->get_user,
            $model->nama,
            $model->dusun,
            $model->NIK,
            $model->jk,
            $model->status_keluarga,
            $model->status_sekolah,
            $model->status_pekerjaan,
            $model->agama,
            $model->warga_negara,
            $model->tgl_lahir,
            $model->penerima_raskin,
            $model->penerima_BPJS,
        ]);
    }

    fclose($output);
    exit;
}

public function actionRestore()
{
    $model = new \yii\base\DynamicModel(['file']);
    $model->addRule(['file'], 'file', ['extensions' => 'csv', 'maxSize' => 1024 * 1024]);

    if (Yii::$app->request->isPost) {
        $file = UploadedFile::getInstance($model, 'file');
        if ($model->validate() && $file) {
            $filePath = 'uploads/' . $file->name;
            $file->saveAs($filePath);

            if (($handle = fopen($filePath, 'r')) !== false) {
                // Lewati header CSV
                fgetcsv($handle, 1000, ',');

                while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                    $masyarakat = new Masyarakat();
                    $masyarakat->id_masyarakat = $data[0];
                    $masyarakat->get_user = $data[1];
                    $masyarakat->nama = $data[2];
                    $masyarakat->dusun = $data[3];
                    $masyarakat->NIK = $data[4];
                    $masyarakat->jk = $data[5];
                    $masyarakat->status_keluarga = $data[6];
                    $masyarakat->status_sekolah = $data[7];
                    $masyarakat->status_pekerjaan = $data[8];
                    $masyarakat->agama = $data[9];
                    $masyarakat->warga_negara = $data[10];
                    $masyarakat->tgl_lahir = $data[11];
                    $masyarakat->penerima_raskin = $data[12];
                    $masyarakat->penerima_BPJS = $data[13];


                    // Simpan model, atau update jika sudah ada
                    if (!$masyarakat->save()) {
                        Yii::$app->session->setFlash('error', 'Gagal menyimpan data dari CSV.');
                        return $this->redirect(['index']);
                    }
                }
                fclose($handle);
                unlink($filePath); // Hapus file setelah proses
                Yii::$app->session->setFlash('success', 'Data berhasil di-restore dari file CSV.');
                return $this->redirect(['index']);
            }
        }
    }

    return $this->render('restore', ['model' => $model]);
}


}
