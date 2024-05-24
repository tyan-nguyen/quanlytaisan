<?php

namespace app\modules\taisan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\taisan\models\ThietBi;

/**
 * ThietBiSearch represents the model behind the search form about `app\modules\taisan\models\ThietBi`.
 */
class ThietBiSearch extends ThietBi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_vi_tri', 'id_he_thong', 'id_loai_thiet_bi', 'id_bo_phan_quan_ly', 'id_thiet_bi_cha', 'id_layout', 'id_hang_bao_hanh', 'id_nhien_lieu', 'id_lop_hu_hong', 'id_trung_tam_chi_phi', 'id_don_vi_bao_tri', 'id_nguoi_quan_ly', 'nguoi_tao'], 'integer'],
            [['ma_thiet_bi', 'ten_thiet_bi', 'nam_san_xuat', 'serial', 'model', 'xuat_xu', 'dac_tinh_ky_thuat', 'ngay_mua', 'han_bao_hanh', 'ngay_dua_vao_su_dung', 'trang_thai', 'ngay_ngung_hoat_dong', 'ghi_chu', 'thoi_gian_tao'], 'safe'],
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
    public function search($params, $cusomSearch=NULL, $forUser=NULL, $forBoPhan=NULL)
    {
        $query = ThietBi::find();

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
                ['like', 'ten_thiet_bi', $cusomSearch],
                ['like', 'nam_san_xuat', $cusomSearch],
                ['like', 'serial', $cusomSearch],
                ['like', 'model', $cusomSearch],
                ['like', 'xuat_xu', $cusomSearch],
                ['like', 'dac_tinh_ky_thuat', $cusomSearch],
                ['like', 'trang_thai', $cusomSearch],
                ['like', 'ghi_chu', $cusomSearch] ]);
        } else {
            $query->andFilterWhere([
                'id' => $this->id,
                'id_vi_tri' => $this->id_vi_tri,
                'id_he_thong' => $this->id_he_thong,
                'id_loai_thiet_bi' => $this->id_loai_thiet_bi,
                //'id_bo_phan_quan_ly' => $this->id_bo_phan_quan_ly,
                'id_thiet_bi_cha' => $this->id_thiet_bi_cha,
                'id_layout' => $this->id_layout,
                'id_hang_bao_hanh' => $this->id_hang_bao_hanh,
                'id_nhien_lieu' => $this->id_nhien_lieu,
                'id_lop_hu_hong' => $this->id_lop_hu_hong,
                'id_trung_tam_chi_phi' => $this->id_trung_tam_chi_phi,
                'id_don_vi_bao_tri' => $this->id_don_vi_bao_tri,
                //'id_nguoi_quan_ly' => $this->id_nguoi_quan_ly,
                'ngay_mua' => $this->ngay_mua,
                'han_bao_hanh' => $this->han_bao_hanh,
                'ngay_dua_vao_su_dung' => $this->ngay_dua_vao_su_dung,
                'ngay_ngung_hoat_dong' => $this->ngay_ngung_hoat_dong,
                'thoi_gian_tao' => $this->thoi_gian_tao,
                'nguoi_tao' => $this->nguoi_tao,
            ]);
            
            //search người quản lý thì ko search bo phan
            if($this->id_nguoi_quan_ly == null){
                $query->andFilterWhere([
                    'id_bo_phan_quan_ly' => $this->id_bo_phan_quan_ly,
                ]);
            } else {
                $query->andFilterWhere([
                    'id_nguoi_quan_ly' => $this->id_nguoi_quan_ly,
                ]);
            }
    
            $query->andFilterWhere(['like', 'ma_thiet_bi', $this->ma_thiet_bi])
                ->andFilterWhere(['like', 'ten_thiet_bi', $this->ten_thiet_bi])
                ->andFilterWhere(['like', 'nam_san_xuat', $this->nam_san_xuat])
                ->andFilterWhere(['like', 'serial', $this->serial])
                ->andFilterWhere(['like', 'model', $this->model])
                ->andFilterWhere(['like', 'xuat_xu', $this->xuat_xu])
                ->andFilterWhere(['like', 'dac_tinh_ky_thuat', $this->dac_tinh_ky_thuat])
                ->andFilterWhere(['like', 'trang_thai', $this->trang_thai])
                ->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu]);
        }
        
        //for user
        if($forUser != NULL){
            $query->andFilterWhere([
                'id_nguoi_quan_ly' => $forUser,
            ]);
        }
        
        //for bo phan quan ly
        if($forBoPhan != NULL){
            $query->andFilterWhere([
                'id_bo_phan_quan_ly' => $forBoPhan,
            ]);
        }

        return $dataProvider;
    }
}
