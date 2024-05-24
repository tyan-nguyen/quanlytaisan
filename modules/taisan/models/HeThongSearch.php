<?php

namespace app\modules\taisan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\taisan\models\HeThong;

/**
 * HeThongSearch represents the model behind the search form about `app\modules\taisan\models\HeThong`.
 */
class HeThongSearch extends HeThong
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'truc_thuoc', 'nguoi_tao'], 'integer'],
            [['ma_he_thong', 'ten_he_thong', 'mo_ta', 'thoi_gian_tao'], 'safe'],
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
        $query = HeThong::find();

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
			$query->andFilterWhere ( [ 'OR' ,['like', 'ma_he_thong', $cusomSearch],
            ['like', 'ten_he_thong', $cusomSearch],
            ['like', 'mo_ta', $cusomSearch]] );
 
		} else {
        	$query->andFilterWhere([
            'id' => $this->id,
            'truc_thuoc' => $this->truc_thuoc,
            'thoi_gian_tao' => $this->thoi_gian_tao,
            'nguoi_tao' => $this->nguoi_tao,
        ]);

        $query->andFilterWhere(['like', 'ma_he_thong', $this->ma_he_thong])
            ->andFilterWhere(['like', 'ten_he_thong', $this->ten_he_thong])
            ->andFilterWhere(['like', 'mo_ta', $this->mo_ta]);
		}
        return $dataProvider;
    }
}
