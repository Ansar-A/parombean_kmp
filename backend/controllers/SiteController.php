<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use common\models\Masyarakat;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'index', 'profile', 'struktur', 'data'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionProfile()
    {
        return $this->render('profile');
    }
    public function actionStruktur()
    {
        return $this->render('struktur');
    }
    public function actionData()
    {
        $dataPekerjaan = Masyarakat::getDataPekerjaan();
        $dataPendidikan = Masyarakat::getDataPendidikan();
        $dataJiwa = Masyarakat::getJumlahJiwa();
        $dataKK = Masyarakat::getJumlahKepalaKeluarga();
        $dataJK = Masyarakat::getJenisKelamin();
        $dataKU = Masyarakat::getDataKelompokUmur();
        $dataRaskin = Masyarakat::getDataPenerimaRaskin();
        $dataBPJS = Masyarakat::getDataPenerimaBPJS();

        return $this->render('data', [
            'dataJiwa' => $dataJiwa,
            'dataKK' => $dataKK,
            'dataPendidikan' => $dataPendidikan,
            'dataPekerjaan' => $dataPekerjaan,
            'dataJK' => $dataJK,
            'dataKU' => $dataKU,
            'dataRaskin' => $dataRaskin,
            'dataBPJS' => $dataBPJS,
        ]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
