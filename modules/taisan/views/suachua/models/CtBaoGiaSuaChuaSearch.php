<?php

namespace app\modules\suachua\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\suachua\models\CtBaoGiaSuaChua;

/**
 * CtBaoGiaSuaChuaSearch represents the model behind the search form about `app\modules\suachua\models\CtBaoGiaSuaChua`.
 */
class CtBaoGiaSuaChuaSearch extends CtBaoGiaSuaChua
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_bao_gia', 'id_dm_bao_gia', 'so_luong', 'nguoi_tao', 'nguoi_cap_nhat'], 'integer'],
            [['ten_danh_muc', 'don_vi_tinh', 'ngay_tao', 'ngay_cap_nhat'], 'safe'],
            [['don_gia', 'thanh_tien'], 'number'],
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
        $query = CtBaoGiaSuaChua::find();

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
			$query->andFilterWhere ( [ 'OR' ,['like', 'ten_danh_muc', $cusomSearch],
            ['like', 'don_vi_tinh', $cusomSearch]] );
 
		} else {
        	$query->andFilterWhere([
            'id' => $this->id,
            'id_bao_gia' => $this->id_bao_gia,
            'id_dm_bao_gia' => $this->id_dm_bao_gia,
            'so_luong' => $this->so_luong,
            'don_gia' => $this->don_gia,
            'thanh_tien' => $this->thanh_tien,
            'ngay_tao' => $this->ngay_tao,
            'nguoi_tao' => $this->nguoi_tao,
            'ngay_cap_nhat' => $this->ngay_cap_nhat,
            'nguoi_cap_nhat' => $this->nguoi_cap_nhat,
        ]);

        $query->andFilterWhere(['like', 'ten_danh_muc', $this->ten_danh_muc])
            ->andFilterWhere(['like', 'don_vi_tinh', $this->don_vi_tinh]);
		}
        return $dataProvider;
    }
}
