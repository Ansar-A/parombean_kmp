<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Masyarakat;

/**
 * MasyarakatSearch represents the model behind the search form of `common\models\Masyarakat`.
 */
class MasyarakatSearch extends Masyarakat
{
    public $isKmpSearch = false;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_masyarakat', 'get_user'], 'integer'],
            [['nama', 'dusun', 'NIK', 'jk', 'status_keluarga', 'status_sekolah', 'status_pekerjaan', 'agama', 'warga_negara', 'tgl_lahir'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
{
    $query = Masyarakat::find();

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => ['pageSize' => 5],
    ]);

    $this->load($params);

    if (!$this->validate()) {
        return $dataProvider;
    }

    // Gunakan filter SQL seperti biasa
    // $query->andFilterWhere(['like', 'LOWER(nama)', strtolower($this->nama)]);

    // Jika tidak ada input nama, langsung kembalikan dataProvider
    if (!$this->nama) {
        return $dataProvider;
    }

    // Ambil semua data dari query
    $allModels = $query->all();

    // Gunakan KMP untuk memfilter nama berdasarkan input
    $filteredModels = [];
    foreach ($allModels as $model) {
        if ($this->kmpSearch(mb_strtolower($model->nama), mb_strtolower($this->nama))) {
            $filteredModels[] = $model;
        }
    }

    // Set data yang sudah difilter ke dalam dataProvider
    $dataProvider->setModels($filteredModels);
    $dataProvider->setTotalCount(count($filteredModels));

    return $dataProvider;
}

private function kmpSearch($text, $pattern)
{
    $n = strlen($text);
    $m = strlen($pattern);

    // Hitung array LPS
    $lps = $this->computeLPSArray($pattern);

    $i = 0; // Indeks teks
    $j = 0; // Indeks pola

    while ($i < $n) {
        if ($pattern[$j] == $text[$i]) {
            $i++;
            $j++;
        }

        if ($j == $m) {
            return true; // Pola ditemukan
        } elseif ($i < $n && $pattern[$j] != $text[$i]) {
            if ($j != 0) {
                $j = $lps[$j - 1];
            } else {
                $i++;
            }
        }
    }

    return false; // Pola tidak ditemukan
}

private function computeLPSArray($pattern)
{
    $m = strlen($pattern);
    $lps = array_fill(0, $m, 0);

    $length = 0; // Panjang prefix yang cocok
    $i = 1;

    while ($i < $m) {
        if ($pattern[$i] == $pattern[$length]) {
            $length++;
            $lps[$i] = $length;
            $i++;
        } else {
            if ($length != 0) {
                $length = $lps[$length - 1];
            } else {
                $lps[$i] = 0;
                $i++;
            }
        }
    }

    return $lps;
}


}
