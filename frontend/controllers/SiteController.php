<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Masyarakat;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii\helpers\ArrayHelper;

use Mpdf\Mpdf;
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
                'only' => ['logout', 'signup', 'index'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index', 'contact'],
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
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
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
    
    public function actionExportPdf()
    {
        // Fetch data from the database
        $data = Masyarakat::find()->asArray()->all();

        // Initialize MPDF
        $mpdf = new Mpdf();

        // Prepare HTML content (you can customize this based on your Word document layout)
        $html = '<h1 style="text-align: center;">Profil Desa Parombean</h1>';
        $html .= '<table border="1" cellspacing="0" cellpadding="5" style="width: 100%; border-collapse: collapse; font-size: 12px;">';
        $html .= '<thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Dusun</th>
                        <th>NIK</th>
                        <th>Jenis Kelamin</th>
                        <th>Status Keluarga</th>
                        <th>Status Sekolah</th>
                        <th>Status Pekerjaan</th>
                        <th>Agama</th>
                        <th>Warga Negara</th>
                        <th>Tanggal Lahir</th>
                        <th>Penerima Raskin</th>
                        <th>Penerima BPJS</th>
                    </tr>
                  </thead>';
        $html .= '<tbody>';
         $no = 1;
        foreach ($data as $item) {
            $html .= '<tr>
                        <td>' . $no++ . '</td> 
                        <td>' . $item['nama'] . '</td>
                        <td>' . $item['dusun'] . '</td>
                        <td>' . $item['NIK'] . '</td>
                        <td>' . $item['jk'] . '</td>
                        <td>' . $item['status_keluarga'] . '</td>
                        <td>' . $item['status_sekolah'] . '</td>
                        <td>' . $item['status_pekerjaan'] . '</td>
                        <td>' . $item['agama'] . '</td>
                        <td>' . $item['warga_negara'] . '</td>
                        <td>' . $item['tgl_lahir'] . '</td>
                        <td>' . $item['penerima_raskin'] . '</td>
                        <td>' . $item['penerima_BPJS'] . '</td>
                      </tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';

        // Write the HTML to PDF
        $mpdf->WriteHTML($html);

        // Set the filename
        $filename = 'Profil_Desa_Parombeian_' . date('Y-m-d') . '.pdf';

        // Output the PDF for download
        $mpdf->Output($filename, \Mpdf\Output\Destination::DOWNLOAD);
        exit;
    }
    
    public function actionExportExcel()
    {
        // Fetch data from the database
        $data = Masyarakat::find()->asArray()->all();

        // Create a new Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Set the header
        $header = [
            'ID', 'Nama', 'Dusun', 'NIK', 'Jenis Kelamin', 'Status Keluarga',
            'Status Sekolah', 'Status Pekerjaan', 'Agama', 'Warga Negara',
            'Tanggal Lahir', 'Penerima Raskin', 'Penerima BPJS'
        ];
        $sheet->fromArray($header, null, 'A1');
        
        // Populate data
        $row = 2; // Start from row 2 (row 1 is the header)
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item['id_masyarakat']);
            $sheet->setCellValue('B' . $row, $item['nama']);
            $sheet->setCellValue('C' . $row, $item['dusun']);
            $sheet->setCellValue('D' . $row, $item['NIK']);
            $sheet->setCellValue('E' . $row, $item['jk']);
            $sheet->setCellValue('F' . $row, $item['status_keluarga']);
            $sheet->setCellValue('G' . $row, $item['status_sekolah']);
            $sheet->setCellValue('H' . $row, $item['status_pekerjaan']);
            $sheet->setCellValue('I' . $row, $item['agama']);
            $sheet->setCellValue('J' . $row, $item['warga_negara']);
            $sheet->setCellValue('K' . $row, $item['tgl_lahir']);
            $sheet->setCellValue('L' . $row, $item['penerima_raskin']);
            $sheet->setCellValue('M' . $row, $item['penerima_BPJS']);
            $row++;
        }

        // Set the filename
        $filename = 'Profil_Desa_Parombeian_' . date('Y-m-d') . '.xlsx';

        // Prepare for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Write the file to the output
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function getNotifikasi()
    {
        // Mengambil data notifikasi terbaru
        return Masyarakat::find()
            ->orderBy(['updated_at' => SORT_DESC])
            ->limit(5)
            ->all();
    }
    public function actionIndex()
    {

        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout = 'main_new';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

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
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $this->layout = 'main_side';
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        $this->layout = 'main_side';
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $this->layout = 'main_new';
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $this->layout = 'main_new';
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        $this->layout = 'main_new';
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        $this->layout = 'main_new';
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $this->layout = 'main_new';
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
