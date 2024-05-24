<?php

namespace app\modules\bophan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\bophan\models\NhomDoiTac;

/**
 * NhomDoiTacSearch represents the model behind the search form about `app\modules\bophan\models\NhomDoiTac`.
 */
class NhomDoiTacSearch extends NhomDoiTac
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nguoi_tao'], 'integer'],
            [['ma_nhom', 'ten_nhom', 'thoi_gian_tao'], 'safe'],
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
        $query = NhomDoiTac::find();

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
			$query->andFilterWhere ( [ 'OR' ,['like', 'ma_nhom', $cusomSearch],
            ['like', 'ten_nhom', $cusomSearch]] );
 
		} else {
        	$query->andFilterWhere([
            'id' => $this->id,
            'thoi_gian_tao' => $this->thoi_gian_tao,
            'nguoi_tao' => $this->nguoi_tao,
        ]);

        $query->andFilterWhere(['like', 'ma_nhom', $this->ma_nhom])
            ->andFilterWhere(['like', 'ten_nhom', $this->ten_nhom]);
		}
        return $dataProvider;
    }
}
