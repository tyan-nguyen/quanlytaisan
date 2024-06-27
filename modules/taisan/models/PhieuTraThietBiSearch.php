<?php

namespace app\modules\taisan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\taisan\models\PhieuTraThietBi;
/**
 * PhieuTraThietBiSearch represents the model behind the search form about `app\models\TsPhieuTraThietBi`.
 */
class PhieuTraThietBiSearch extends PhieuTraThietBi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_nguoi_tra'], 'integer'],
            [['noi_dung_tra', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
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
        $query = PhieuTraThietBi::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_DESC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
		if($cusomSearch != NULL){
			$query->andFilterWhere ( [ 'OR' ,['like', 'noi_dung_tra', $cusomSearch]] );
 
		} else {
        	$query->andFilterWhere([
            'id' => $this->id,
            'id_nguoi_tra' => $this->id_nguoi_tra,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'noi_dung_tra', $this->noi_dung_tra]);
		}
        return $dataProvider;
    }
}
