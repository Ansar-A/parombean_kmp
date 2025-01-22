<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "masyarakat".
 *
 * @property int $id_masyarakat
 * @property int $get_user
 * @property string $nama
 * @property string $dusun
 * @property string $NIK
 * @property string $jk
 * @property string $status_keluarga
 * @property string $status_sekolah
 * @property string $status_pekerjaan
 * @property string $agama
 * @property string $warga_negara
 * @property string $tgl_lahir
 *
 * @property User $getUser
 */
class Masyarakat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'masyarakat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['get_user', 'nama', 'dusun', 'NIK', 'jk', 'status_keluarga', 'status_sekolah', 'status_pekerjaan', 'agama', 'warga_negara', 'tgl_lahir', 'penerima_raskin', 'penerima_BPJS'], 'required'],
            [['get_user'], 'integer'],
            [['dusun', 'jk', 'status_keluarga', 'status_sekolah', 'status_pekerjaan', 'agama', 'warga_negara'], 'string'],
            [['tgl_lahir'], 'safe'],
            [['nama'], 'string', 'max' => 100],
            [['NIK'], 'string', 'max' => 16],
            [['NIK'], 'unique', 'message' => 'NIK sudah terdaftar'],  
            [['penerima_raskin', 'penerima_BPJS'], 'in', 'range' => ['Ya', 'Tidak']],
            [['penerima_raskin', 'penerima_BPJS'], 'default', 'value' => 'Tidak'],
            [['get_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['get_user' => 'id']],
        ];
    }

    public static function getDusunOptions()
    {
        return [
            'BATUPIAK' => 'BATUPIAK',
            'LIBA' => 'LIBA',
            'BAU' => 'BAU',
            'TO COLLO' => 'TO COLLO',
            'BUNTULIMBONG' => 'BUNTULIMBONG',
            'LE TOBARA' => 'LE TOBARA',
            'SARANG' => 'SARANG',
            'BUNGAMENDOE' => 'BUNGAMENDOE',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_masyarakat' => 'Id Masyarakat',
            'get_user' => 'Get User',
            'nama' => 'Nama',
            'dusun' => 'Dusun',
            'NIK' => 'Nik',
            'jk' => 'Jk',
            'status_keluarga' => 'Status Keluarga',
            'status_sekolah' => 'Status Sekolah',
            'status_pekerjaan' => 'Status Pekerjaan',
            'agama' => 'Agama',
            'warga_negara' => 'Warga Negara',
            'tgl_lahir' => 'Tgl Lahir',
            'penerima_raskin' => 'Penerima Raskin',
            'penerima_BPJS' => 'Penerima BPJS',
        ];
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->updated_at = date('Y-m-d H:i:s');
            $this->action_type = $insert ? 'created' : 'updated';
            return true;
        }
        return false;
    }
   
    /**
     * Gets query for [[GetUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGetUser()
    {
        return $this->hasOne(User::class, ['id' => 'get_user']);
    }
    public static function getDataPenerimaRaskin()
    {
        $query = (new \yii\db\Query())
            ->select([
                'NamaDusun' => 'dusun',
                'Jumlah' => 'SUM(CASE WHEN penerima_raskin = "Ya" THEN 1 ELSE 0 END)'
            ])
            ->from('masyarakat')
            ->groupBy('dusun')
            ->orderBy('dusun')
            ->all();

        return $query;
    }
    public static function getDataPenerimaBPJS()
    {
        $query = (new \yii\db\Query())
            ->select([
                'NamaDusun' => 'dusun',
                'LakiLaki' => 'SUM(CASE WHEN penerima_BPJS = "Ya" AND jk = "L" THEN 1 ELSE 0 END)',
                'Perempuan' => 'SUM(CASE WHEN penerima_BPJS = "Ya" AND jk = "P" THEN 1 ELSE 0 END)',
                'Total' => 'SUM(CASE WHEN penerima_BPJS = "Ya" THEN 1 ELSE 0 END)'
            ])
            ->from('masyarakat')
            ->groupBy('dusun')
            ->orderBy('dusun')
            ->all();

        return $query;
    }


    public static function getJenisKelamin(){
         $query = (new \yii\db\Query())
        ->select([
            'NamaDusun' => 'dusun',
            'LakiLaki' => 'SUM(CASE WHEN jk = "L" THEN 1 ELSE 0 END)',
            'Perempuan' => 'SUM(CASE WHEN jk = "P" THEN 1 ELSE 0 END)',
            'Total' => 'COUNT(*)'
        ])
        ->from('masyarakat')
        ->groupBy('dusun')
        ->all();

    return $query;
    }
    public static function getDataKelompokUmur()
    {
        $query = (new \yii\db\Query())
            ->select([
                'Umur' => 'FLOOR(DATEDIFF(CURDATE(), tgl_lahir) / 365)',
                'LakiLaki' => 'SUM(CASE WHEN jk = "L" THEN 1 ELSE 0 END)',
                'Perempuan' => 'SUM(CASE WHEN jk = "P" THEN 1 ELSE 0 END)',
                'Total' => 'COUNT(*)',
            ])
            ->from('masyarakat')
            ->groupBy(['Umur'])
            ->orderBy(['Umur' => SORT_ASC])
            ->all();

        return $query;
    }

   

    public static function getJumlahJiwa()
    {
        $query = (new \yii\db\Query())
            ->select([
                'dusun AS NamaDusun',
                'SUM(CASE WHEN jk = "L" THEN 1 ELSE 0 END) AS LakiLaki',
                'SUM(CASE WHEN jk = "P" THEN 1 ELSE 0 END) AS Perempuan',
                'COUNT(*) AS Total',
            ])
            ->from('masyarakat')
            ->groupBy('dusun')
            ->union(
                (new \yii\db\Query())
                    ->select([
                        'NamaDusun' => new \yii\db\Expression("'JUMLAH'"),
                        'LakiLaki' => 'SUM(CASE WHEN jk = "L" THEN 1 ELSE 0 END)',
                        'Perempuan' => 'SUM(CASE WHEN jk = "P" THEN 1 ELSE 0 END)',
                        'Total' => 'COUNT(*)',
                    ])
                    ->from('masyarakat')
            )
            ->all();

        return $query;
    }
    public static function getJumlahKepalaKeluarga()
    {
        $query = (new \yii\db\Query())
            ->select([
                'dusun AS NamaDusun',
                'SUM(CASE WHEN jk = "L" AND status_keluarga = "KepalaKeluarga" THEN 1 ELSE 0 END) AS LakiLaki',
                'SUM(CASE WHEN jk = "P" AND status_keluarga = "KepalaKeluarga" THEN 1 ELSE 0 END) AS Perempuan',
                'COUNT(CASE WHEN status_keluarga = "KepalaKeluarga" THEN 1 ELSE NULL END) AS Total',
            ])
            ->from('masyarakat')
            ->groupBy('dusun')
            ->union(
                (new \yii\db\Query())
                    ->select([
                        'NamaDusun' => new \yii\db\Expression("'JUMLAH'"),
                        'LakiLaki' => 'SUM(CASE WHEN jk = "L" AND status_keluarga = "KepalaKeluarga" THEN 1 ELSE 0 END)',
                        'Perempuan' => 'SUM(CASE WHEN jk = "P" AND status_keluarga = "KepalaKeluarga" THEN 1 ELSE 0 END)',
                        'Total' => 'COUNT(CASE WHEN status_keluarga = "KepalaKeluarga" THEN 1 ELSE NULL END)',
                    ])
                    ->from('masyarakat')
            )
            ->all();

        return $query;
    }

    public static function getDataPendidikan()
    {
        return (new \yii\db\Query())
            ->select([
                'status_sekolah AS JenjangPendidikan',
                'SUM(CASE WHEN jk = "L" THEN 1 ELSE 0 END) AS LakiLaki',
                'SUM(CASE WHEN jk = "P" THEN 1 ELSE 0 END) AS Perempuan',
            ])
            ->from('masyarakat')
            ->groupBy('status_sekolah')
            ->all();
    }
    public static function getDataPekerjaan()
    {
        return (new \yii\db\Query())
            ->select([
                'status_pekerjaan AS Pekerjaan',
                'SUM(CASE WHEN jk = "L" THEN 1 ELSE 0 END) AS LakiLaki',
                'SUM(CASE WHEN jk = "P" THEN 1 ELSE 0 END) AS Perempuan',
            ])
            ->from('masyarakat')
            ->groupBy('status_pekerjaan')
            ->all();
    }




}
