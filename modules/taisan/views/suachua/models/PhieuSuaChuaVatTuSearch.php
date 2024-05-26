<?php

namespace app\modules\suachua\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\suachua\models\PhieuSuaChuaVatTu;

/**
 * PhieuSuaChuaVatTuSearch represents the model behind the search form about `app\modules\suachua\models\PhieuSuaChuaVatTu`.
 */
class PhieuSuaChuaVatTuSearch extends PhieuSuaChuaVatTu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_phieu_sua_chua', 'id_vat_tu', 'so_luong', 'nguoi_tao', 'nguoi_cap_nhat'], 'integer'],
            [['ghi_chu', 'don_vi_tinh', 'ngay_tao', 'ngay_cap_nhat'], 'safe'],
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
        $query = PhieuSuaChuaVatTu::find();

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
			$query->andFilterWhere ( [ 'OR' ,['like', 'ghi_chu', $cusomSearch],
            ['like', 'don_vi_tinh', $cusomSearch]] );
 
		} else {
        	$query->andFilterWhere([
            'id' => $this->id,
            'id_phieu_sua_chua' => $this->id_phieu_sua_chua,
            'id_vat_tu' => $this->id_vat_tu,
            'so_luong' => $this->so_luong,
            'ngay_tao' => $this->ngay_tao,
            'nguoi_tao' => $this->nguoi_tao,
            'ngay_cap_nhat' => $this->ngay_cap_nhat,
            'nguoi_cap_nhat' => $this->nguoi_cap_nhat,
        ]);

        $query->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu])
            ->andFilterWhere(['like', 'don_vi_tinh', $this->don_vi_tinh]);
		}
        return $dataProvider;
    }
}
