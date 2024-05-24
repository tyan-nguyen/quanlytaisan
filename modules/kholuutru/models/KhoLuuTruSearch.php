<?php

namespace app\modules\kholuutru\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\kholuutru\models\KhoLuuTru;

/**
 * KhoLuuTruSearch represents the model behind the search form about `app\modules\kholuutru\models\KhoLuuTru`.
 */
class KhoLuuTruSearch extends KhoLuuTru
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'loai_kho', 'id_nguoi_quan_ly', 'id_bo_phan_quan_ly', 'gia_tri_toi_da', 'nguoi_tao'], 'integer'],
            [['ma_kho', 'ten_kho', 'dien_thoai', 'email', 'thoi_gian_tao'], 'safe'],
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
        $query = KhoLuuTru::find();

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
			$query->andFilterWhere ( [ 'OR' ,['like', 'ma_kho', $cusomSearch],
            ['like', 'ten_kho', $cusomSearch],
            ['like', 'dien_thoai', $cusomSearch],
            ['like', 'email', $cusomSearch]] );
 
		} else {
        	$query->andFilterWhere([
            'id' => $this->id,
            'loai_kho' => $this->loai_kho,
            'id_nguoi_quan_ly' => $this->id_nguoi_quan_ly,
            'id_bo_phan_quan_ly' => $this->id_bo_phan_quan_ly,
            'gia_tri_toi_da' => $this->gia_tri_toi_da,
            'thoi_gian_tao' => $this->thoi_gian_tao,
            'nguoi_tao' => $this->nguoi_tao,
        ]);

        $query->andFilterWhere(['like', 'ma_kho', $this->ma_kho])
            ->andFilterWhere(['like', 'ten_kho', $this->ten_kho])
            ->andFilterWhere(['like', 'dien_thoai', $this->dien_thoai])
            ->andFilterWhere(['like', 'email', $this->email]);
		}
        return $dataProvider;
    }
}
