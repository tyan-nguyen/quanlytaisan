<?php

namespace app\modules\bophan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\bophan\models\DoiTac;

/**
 * DoiTacSearch represents the model behind the search form about `app\modules\bophan\models\DoiTac`.
 */
class DoiTacSearch extends DoiTac
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_nhom_doi_tac', 'nguoi_tao'], 'integer'],
            [['ma_doi_tac', 'ten_doi_tac', 'dia_chi', 'dien_thoai', 'email', 'tai_khoan_ngan_hang', 'ma_so_thue', 'la_nha_cung_cap', 'la_khach_hang', 'thoi_gian_tao'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
    public function search($params, $cusomSearch=NULL)
    {
        $query = DoiTac::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
		if($cusomSearch != NULL){
			$query->andFilterWhere ( [ 'OR' ,['like', 'ma_doi_tac', $cusomSearch],
            ['like', 'ten_doi_tac', $cusomSearch],
            ['like', 'dia_chi', $cusomSearch],
            ['like', 'dien_thoai', $cusomSearch],
            ['like', 'email', $cusomSearch],
            ['like', 'tai_khoan_ngan_hang', $cusomSearch],
            ['like', 'ma_so_thue', $cusomSearch],
            ['like', 'la_nha_cung_cap', $cusomSearch],
            ['like', 'la_khach_hang', $cusomSearch]] );
 
		} else {
        	$query->andFilterWhere([
            'id' => $this->id,
            'id_nhom_doi_tac' => $this->id_nhom_doi_tac,
            'thoi_gian_tao' => $this->thoi_gian_tao,
            'nguoi_tao' => $this->nguoi_tao,
        ]);

        $query->andFilterWhere(['like', 'ma_doi_tac', $this->ma_doi_tac])
            ->andFilterWhere(['like', 'ten_doi_tac', $this->ten_doi_tac])
            ->andFilterWhere(['like', 'dia_chi', $this->dia_chi])
            ->andFilterWhere(['like', 'dien_thoai', $this->dien_thoai])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'tai_khoan_ngan_hang', $this->tai_khoan_ngan_hang])
            ->andFilterWhere(['like', 'ma_so_thue', $this->ma_so_thue])
            ->andFilterWhere(['like', 'la_nha_cung_cap', $this->la_nha_cung_cap])
            ->andFilterWhere(['like', 'la_khach_hang', $this->la_khach_hang]);
		}
        return $dataProvider;
    }
}
