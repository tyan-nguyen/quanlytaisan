<?php

namespace app\modules\muasam\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\muasam\models\CtPhieuMuaSam;

/**
 * CtPhieuMuaSamSearch represents the model behind the search form about `app\modules\muasam\models\CtPhieuMuaSam`.
 */
class CtPhieuMuaSamSearch extends CtPhieuMuaSam
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_phieu_mua_sam', 'id_loai_thiet_bi', 'so_luong', 'nguoi_tao', 'nguoi_cap_nhat'], 'integer'],
            [['ten_thiet_bi', 'dac_tinh_ky_thuat', 'trang_thai', 'ghi_chu', 'ngay_tao', 'ngay_cap_nhat'], 'safe'],
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
        $query = CtPhieuMuaSam::find();

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
			$query->andFilterWhere ( [ 'OR' ,['like', 'ten_thiet_bi', $cusomSearch],
            ['like', 'dac_tinh_ky_thuat', $cusomSearch],
            ['like', 'trang_thai', $cusomSearch],
            ['like', 'ghi_chu', $cusomSearch]] );
 
		} else {
        	$query->andFilterWhere([
            'id' => $this->id,
            'id_phieu_mua_sam' => $this->id_phieu_mua_sam,
            'id_loai_thiet_bi' => $this->id_loai_thiet_bi,
            'so_luong' => $this->so_luong,
            'nguoi_tao' => $this->nguoi_tao,
            'ngay_tao' => $this->ngay_tao,
            'nguoi_cap_nhat' => $this->nguoi_cap_nhat,
            'ngay_cap_nhat' => $this->ngay_cap_nhat,
        ]);

        $query->andFilterWhere(['like', 'ten_thiet_bi', $this->ten_thiet_bi])
            ->andFilterWhere(['like', 'dac_tinh_ky_thuat', $this->dac_tinh_ky_thuat])
            ->andFilterWhere(['like', 'trang_thai', $this->trang_thai])
            ->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu]);
		}
        return $dataProvider;
    }
}
