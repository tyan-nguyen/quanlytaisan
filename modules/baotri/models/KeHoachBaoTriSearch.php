<?php

namespace app\modules\baotri\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\baotri\models\KeHoachBaoTri;
use app\modules\dungchung\models\CustomFunc;
use Codeception\Command\Console;
use PhpParser\Node\NullableType;

/**
 * KeHoachBaoTriSearch represents the model behind the search form about `app\modules\baotri\models\KeHoachBaoTri`.
 */
class KeHoachBaoTriSearch extends KeHoachBaoTri
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_he_thong', 'id_thiet_bi', 'id_chi_tiet', 'id_loai_bao_tri', 'bao_truoc', 'id_don_vi_bao_tri', 'id_nguoi_chiu_trach_nhiem', 'truc_thuoc', 'nguoi_tao'], 'integer'],
            [['ten_cong_viec', 'denNgay', 'ngay_bao_tri_cuoi', 'can_cu', 'so_ky', 'ky_bao_tri', 'muc_do_uu_tien', 'ngay_thuc_hien', 'don_vi_thoi_gian', 'dung_may', 'thue_ngoai', 'da_het_hieu_luc', 'ngay_het_hieu_luc', 'thoi_gian_tao'], 'safe'],
            [['thoi_gian_thuc_hien'], 'number'],
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
        $cus= new CustomFunc();
        $query = KeHoachBaoTri::find();

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
			$query->andFilterWhere ( [ 'OR' ,['like', 'ten_cong_viec', $cusomSearch],
            ['like', 'can_cu', $cusomSearch],
            ['like', 'so_ky', $cusomSearch],
            ['like', 'ky_bao_tri', $cusomSearch],
            ['like', 'muc_do_uu_tien', $cusomSearch],
            ['like', 'don_vi_thoi_gian', $cusomSearch],
            ['like', 'dung_may', $cusomSearch],
            ['like', 'thue_ngoai', $cusomSearch],
            ['like', 'da_het_hieu_luc', $cusomSearch]] );
 
		} else {
        	$query->andFilterWhere([
            'id' => $this->id,
            'id_he_thong' => $this->id_he_thong,
            'id_thiet_bi' => $this->id_thiet_bi,
            'id_chi_tiet' => $this->id_chi_tiet,
            'id_loai_bao_tri' => $this->id_loai_bao_tri,
            'ngay_bao_tri_cuoi' => $this->ngay_bao_tri_cuoi,
            'bao_truoc' => $this->bao_truoc,
            'id_don_vi_bao_tri' => $this->id_don_vi_bao_tri,
            'id_nguoi_chiu_trach_nhiem' => $this->id_nguoi_chiu_trach_nhiem,
            'truc_thuoc' => $this->truc_thuoc,
        	'ngay_thuc_hien' => $this->ngay_thuc_hien!=null? $cus->convertDMYToYMD($this->ngay_thuc_hien): $this->ngay_thuc_hien,
            'thoi_gian_thuc_hien' => $this->thoi_gian_thuc_hien,
            'ngay_het_hieu_luc' => $this->ngay_het_hieu_luc,
            'thoi_gian_tao' => $this->thoi_gian_tao,
            'nguoi_tao' => $this->nguoi_tao,
        ]);

           $query->andFilterWhere(['like', 'ten_cong_viec', $this->ten_cong_viec])
            ->andFilterWhere(['like', 'can_cu', $this->can_cu])
            ->andFilterWhere(['like', 'so_ky', $this->so_ky])
            ->andFilterWhere(['like', 'ky_bao_tri', $this->ky_bao_tri])
            ->andFilterWhere(['like', 'muc_do_uu_tien', $this->muc_do_uu_tien])
            ->andFilterWhere(['like', 'don_vi_thoi_gian', $this->don_vi_thoi_gian])
            ->andFilterWhere(['like', 'dung_may', $this->dung_may])
            ->andFilterWhere(['like', 'thue_ngoai', $this->thue_ngoai])
            ->andFilterWhere(['like', 'da_het_hieu_luc', $this->da_het_hieu_luc]);
		}
        return $dataProvider;
    }
    
    public function searchDS($params, $cusomSearch=NULL)
    {
        $cus= new CustomFunc();
        $query = KeHoachBaoTri::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query->andFilterWhere(['between', 'ngay_thuc_hien',  isset($params["tuNgay"])?$params["tuNgay"]:"", isset($params["denNgay"])? $params["denNgay"]:""]),
        ]);
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $tuNgay= $this->ngay_thuc_hien!=null? $cus->convertDMYToYMD($this->ngay_thuc_hien):"";
        $denNgay= $this->denNgay!=null? $cus->convertDMYToYMD($this->denNgay):"";
        $query->andFilterWhere(['like', 'ten_cong_viec', $this->ten_cong_viec])
        ->andFilterWhere(['between', 'ngay_thuc_hien',  $tuNgay, $denNgay]);
        return $dataProvider;
    }
}
