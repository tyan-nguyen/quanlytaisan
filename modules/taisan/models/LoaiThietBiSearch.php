<?php

namespace app\modules\taisan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\taisan\models\LoaiThietBi;

/**
 * LoaiThietBiSearch represents the model behind the search form about `app\modules\taisan\models\LoaiThietBi`.
 */
class LoaiThietBiSearch extends LoaiThietBi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'truc_thuoc', 'nguoi_tao'], 'integer'],
            [['ma_loai', 'ten_loai', 'don_vi_tinh', 'loai_thiet_bi', 'ghi_chu', 'thoi_gian_tao'], 'safe'],
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
        $query = LoaiThietBi::find();

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
            $query->andFilterWhere ( [ 'OR' ,                
                ['like', 'ma_loai', $cusomSearch],
                ['like', 'ten_loai', $cusomSearch],
                ['like', 'don_vi_tinh', $cusomSearch],
                ['like', 'loai_thiet_bi', $cusomSearch],
                ['like', 'ghi_chu', $cusomSearch]
            ]);
            
        } else {
            $query->andFilterWhere([
                'id' => $this->id,
                'truc_thuoc' => $this->truc_thuoc,
                'thoi_gian_tao' => $this->thoi_gian_tao,
                'nguoi_tao' => $this->nguoi_tao,
            ]);
    
            $query->andFilterWhere(['like', 'ma_loai', $this->ma_loai])
                ->andFilterWhere(['like', 'ten_loai', $this->ten_loai])
                ->andFilterWhere(['like', 'don_vi_tinh', $this->don_vi_tinh])
                ->andFilterWhere(['like', 'loai_thiet_bi', $this->loai_thiet_bi])
                ->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu]);
        }
        return $dataProvider;
    }
}
