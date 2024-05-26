<?php

namespace app\modules\kholuutru\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\kholuutru\models\LichSuVatTu;

/**
 * LichSuVatTuSearch represents the model behind the search form about `app\modules\kholuutru\models\LichSuVatTu`.
 */
class LichSuVatTuSearch extends LichSuVatTu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_vat_tu', 'so_luong_cu', 'so_luong_moi', 'so_luong', 'nguoi_tao'], 'integer'],
            [['ghi_chu', 'ngay_tao'], 'safe'],
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
        $query = LichSuVatTu::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
		if($cusomSearch != NULL){
			$query->andFilterWhere ( [ 'OR' ,['like', 'ghi_chu', $cusomSearch]] );
 
		} else {
        	$query->andFilterWhere([
            'id' => $this->id,
            'id_vat_tu' => $this->id_vat_tu,
            'so_luong_cu' => $this->so_luong_cu,
            'so_luong_moi' => $this->so_luong_moi,
            'so_luong' => $this->so_luong,
            'nguoi_tao' => $this->nguoi_tao,
            'ngay_tao' => $this->ngay_tao,
        ]);

        $query->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu]);
		}
        return $dataProvider;
    }
}
