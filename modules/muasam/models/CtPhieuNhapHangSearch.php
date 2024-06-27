<?php

namespace app\modules\muasam\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\muasam\models\CtPhieuNhapHang;

/**
 * CtPhieuNhapHangSearch represents the model behind the search form about `app\modules\muasam\models\CtPhieuNhapHang`.
 */
class CtPhieuNhapHangSearch extends CtPhieuNhapHang
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_vi_tri', 'id_he_thong', 'id_thiet_bi_cha', 'id_phieu_mua_sam', 'id_ct_phieu_mua_sam', 'nam_san_xuat', 'id_hang_bao_hanh', 'id_nhien_lieu', 'id_don_vi_bao_tri', 'id_nguoi_quan_ly', 'id_bo_phan_quan_ly', 'id_thiet_bi', 'nguoi_tao', 'nguoi_cap_nhat'], 'integer'],
            [['ma_thiet_bi', 'serial', 'model', 'xuat_xu', 'dac_tinh_ky_thuat', 'han_bao_hanh', 'ghi_chu', 'ngay_tao', 'ngay_cap_nhat'], 'safe'],
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
        $query = CtPhieuNhapHang::find();

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
			$query->andFilterWhere ( [ 'OR' ,['like', 'ma_thiet_bi', $cusomSearch],
            ['like', 'serial', $cusomSearch],
            ['like', 'model', $cusomSearch],
            ['like', 'xuat_xu', $cusomSearch],
            ['like', 'dac_tinh_ky_thuat', $cusomSearch],
            ['like', 'ghi_chu', $cusomSearch]] );
 
		} else {
        	$query->andFilterWhere([
            'id' => $this->id,
            'id_vi_tri' => $this->id_vi_tri,
            'id_he_thong' => $this->id_he_thong,
            'id_thiet_bi_cha' => $this->id_thiet_bi_cha,
            'id_phieu_mua_sam' => $this->id_phieu_mua_sam,
            'id_ct_phieu_mua_sam' => $this->id_ct_phieu_mua_sam,
            'nam_san_xuat' => $this->nam_san_xuat,
            'id_hang_bao_hanh' => $this->id_hang_bao_hanh,
            'id_nhien_lieu' => $this->id_nhien_lieu,
            'id_don_vi_bao_tri' => $this->id_don_vi_bao_tri,
            'han_bao_hanh' => $this->han_bao_hanh,
            'id_nguoi_quan_ly' => $this->id_nguoi_quan_ly,
            'id_bo_phan_quan_ly' => $this->id_bo_phan_quan_ly,
            'id_thiet_bi' => $this->id_thiet_bi,
            'nguoi_tao' => $this->nguoi_tao,
            'ngay_tao' => $this->ngay_tao,
            'nguoi_cap_nhat' => $this->nguoi_cap_nhat,
            'ngay_cap_nhat' => $this->ngay_cap_nhat,
        ]);

        $query->andFilterWhere(['like', 'ma_thiet_bi', $this->ma_thiet_bi])
            ->andFilterWhere(['like', 'serial', $this->serial])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'xuat_xu', $this->xuat_xu])
            ->andFilterWhere(['like', 'dac_tinh_ky_thuat', $this->dac_tinh_ky_thuat])
            ->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu]);
		}
        return $dataProvider;
    }
}
