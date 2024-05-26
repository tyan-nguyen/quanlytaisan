<?php

namespace app\modules\suachua\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\suachua\models\DmTTSuaChua;

/**
 * DmTTSuaChuaSearch represents the model behind the search form about `app\modules\suachua\models\DmTTSuaChua`.
 */
class DmTTSuaChuaSearch extends DmTTSuaChua
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'danh_gia'], 'integer'],
            [['ten_tt_sua_chua', 'dien_thoai1', 'dien_thoai2', 'dia_chi', 'nguoi_lien_he'], 'safe'],
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
        $query = DmTTSuaChua::find();

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
			$query->andFilterWhere ( [ 'OR' ,['like', 'ten_tt_sua_chua', $cusomSearch],
            ['like', 'dien_thoai1', $cusomSearch],
            ['like', 'dien_thoai2', $cusomSearch],
            ['like', 'dia_chi', $cusomSearch],
            ['like', 'nguoi_lien_he', $cusomSearch]] );
 
		} else {
        	$query->andFilterWhere([
            'id' => $this->id,
            'danh_gia' => $this->danh_gia,
        ]);

        $query->andFilterWhere(['like', 'ten_tt_sua_chua', $this->ten_tt_sua_chua])
            ->andFilterWhere(['like', 'dien_thoai1', $this->dien_thoai1])
            ->andFilterWhere(['like', 'dien_thoai2', $this->dien_thoai2])
            ->andFilterWhere(['like', 'dia_chi', $this->dia_chi])
            ->andFilterWhere(['like', 'nguoi_lien_he', $this->nguoi_lien_he]);
		}
        return $dataProvider;
    }
}
