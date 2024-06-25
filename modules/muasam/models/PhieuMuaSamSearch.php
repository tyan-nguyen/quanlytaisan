<?php

namespace app\modules\muasam\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\muasam\models\PhieuMuaSam;

/**
 * PhieuMuaSamSearch represents the model behind the search form about `app\modules\muasam\models\PhieuMuaSam`.
 */
class PhieuMuaSamSearch extends PhieuMuaSam
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_nguoi_duyet', 'nguoi_tao', 'nguoi_cap_nhat'], 'integer'],
            [['ngay_yeu_cau', 'trang_thai', 'ghi_chu', 'ngay_tao', 'ngay_cap_nhat'], 'safe'],
            [['tong_phi'], 'number'],
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
        $query = PhieuMuaSam::find();

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
			$query->andFilterWhere ( [ 'OR' ,['like', 'trang_thai', $cusomSearch],
            ['like', 'ghi_chu', $cusomSearch]] );
 
		} else {
        	$query->andFilterWhere([
            'id' => $this->id,
            'ngay_yeu_cau' => $this->ngay_yeu_cau,
            'id_nguoi_duyet' => $this->id_nguoi_duyet,
            'tong_phi' => $this->tong_phi,
            'nguoi_tao' => $this->nguoi_tao,
            'ngay_tao' => $this->ngay_tao,
            'nguoi_cap_nhat' => $this->nguoi_cap_nhat,
            'ngay_cap_nhat' => $this->ngay_cap_nhat,
        ]);

        $query->andFilterWhere(['like', 'trang_thai', $this->trang_thai])
            ->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu]);
		}
        return $dataProvider;
    }
}
