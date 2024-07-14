<?php

namespace app\modules\muasam\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\muasam\models\CtPhieuNhapHangVt;

/**
 * CtPhieuNhapHangVtSearch represents the model behind the search form about `app\modules\muasam\models\CtPhieuNhapHangVt`.
 */
class CtPhieuNhapHangVtSearch extends CtPhieuNhapHangVt
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_phieu_mua_sam', 'id_ct_phieu_mua_sam_vt', 'so_luong', 'id_vat_tu', 'id_kho', 'nguoi_tao', 'nguoi_cap_nhat'], 'integer'],
            [['hang_san_xuat', 'ghi_chu', 'don_vi_tinh', 'ngay_tao', 'ngay_cap_nhat'], 'safe'],
            [['don_gia'], 'number'],
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
        $query = CtPhieuNhapHangVt::find();

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
            ['like', 'ghi_chu', $cusomSearch],
            ['like', 'don_vi_tinh', $cusomSearch]] );
 
		} else {
        	$query->andFilterWhere([
            'id' => $this->id,
            'id_phieu_mua_sam' => $this->id_phieu_mua_sam,
            'id_ct_phieu_mua_sam_vt' => $this->id_ct_phieu_mua_sam_vt,
            'so_luong' => $this->so_luong,
            'don_gia' => $this->don_gia,
            'id_vat_tu' => $this->id_vat_tu,
            'id_kho' => $this->id_kho,
            'nguoi_tao' => $this->nguoi_tao,
            'ngay_tao' => $this->ngay_tao,
            'nguoi_cap_nhat' => $this->nguoi_cap_nhat,
            'ngay_cap_nhat' => $this->ngay_cap_nhat,
        ]);

        $query->andFilterWhere(['like', 'hang_san_xuat', $this->hang_san_xuat])
            ->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu])
            ->andFilterWhere(['like', 'don_vi_tinh', $this->don_vi_tinh]);
		}
        return $dataProvider;
    }
}
