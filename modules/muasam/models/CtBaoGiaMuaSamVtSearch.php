<?php

namespace app\modules\muasam\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\muasam\models\CtBaoGiaMuaSamVt;

/**
 * CtBaoGiaMuaSamVtSearch represents the model behind the search form about `app\modules\muasam\models\CtBaoGiaMuaSamVt`.
 */
class CtBaoGiaMuaSamVtSearch extends CtBaoGiaMuaSamVt
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_bao_gia', 'id_ct_phieu_mua_sam', 'so_luong', 'nguoi_tao', 'nguoi_cap_nhat'], 'integer'],
            [['hang_san_xuat', 'ghi_chu', 'ngay_tao', 'ngay_cap_nhat'], 'safe'],
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
        $query = CtBaoGiaMuaSamVt::find();

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
			$query->andFilterWhere ( [ 'OR' ,['like', 'hang_san_xuat', $cusomSearch],
            ['like', 'ghi_chu', $cusomSearch]] );
 
		} else {
        	$query->andFilterWhere([
            'id' => $this->id,
            'id_bao_gia' => $this->id_bao_gia,
            'id_ct_phieu_mua_sam' => $this->id_ct_phieu_mua_sam,
            'so_luong' => $this->so_luong,
            'don_gia' => $this->don_gia,
            'thanh_tien' => $this->thanh_tien,
            'nguoi_tao' => $this->nguoi_tao,
            'ngay_tao' => $this->ngay_tao,
            'nguoi_cap_nhat' => $this->nguoi_cap_nhat,
            'ngay_cap_nhat' => $this->ngay_cap_nhat,
        ]);

        $query->andFilterWhere(['like', 'hang_san_xuat', $this->hang_san_xuat])
            ->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu]);
		}
        return $dataProvider;
    }
}
