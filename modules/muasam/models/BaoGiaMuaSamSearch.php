<?php

namespace app\modules\muasam\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\muasam\models\BaoGiaMuaSam;

/**
 * BaoGiaMuaSamSearch represents the model behind the search form about `app\modules\muasam\models\BaoGiaMuaSam`.
 */
class BaoGiaMuaSamSearch extends BaoGiaMuaSam
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_phieu_mua_sam', 'flag_index', 'nguoi_tao', 'nguoi_cap_nhat', 'nguoi_duyet_bg'], 'integer'],
            [['so_bao_gia', 'ngay_bao_gia', 'ngay_ket_thuc', 'ngay_gui_bg', 'trang_thai', 'ghi_chu_bg1', 'ghi_chu_bg2', 'ngay_tao', 'ngay_cap_nhat'], 'safe'],
            [['tong_tien'], 'number'],
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
        $query = BaoGiaMuaSam::find();

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
			$query->andFilterWhere ( [ 'OR' ,['like', 'so_bao_gia', $cusomSearch],
            ['like', 'trang_thai', $cusomSearch],
            ['like', 'ghi_chu_bg1', $cusomSearch],
            ['like', 'ghi_chu_bg2', $cusomSearch]] );
 
		} else {
        	$query->andFilterWhere([
            'id' => $this->id,
            'id_phieu_mua_sam' => $this->id_phieu_mua_sam,
            'flag_index' => $this->flag_index,
            'ngay_bao_gia' => $this->ngay_bao_gia,
            'ngay_ket_thuc' => $this->ngay_ket_thuc,
            'ngay_gui_bg' => $this->ngay_gui_bg,
            'tong_tien' => $this->tong_tien,
            'nguoi_tao' => $this->nguoi_tao,
            'ngay_tao' => $this->ngay_tao,
            'nguoi_cap_nhat' => $this->nguoi_cap_nhat,
            'ngay_cap_nhat' => $this->ngay_cap_nhat,
            'nguoi_duyet_bg' => $this->nguoi_duyet_bg,
        ]);

        $query->andFilterWhere(['like', 'so_bao_gia', $this->so_bao_gia])
        ->andFilterWhere(['<>', 'trang_thai', "draft"])//không hiển thị trạng thái nhấp trên ds duyệt báo giá
            ->andFilterWhere(['like', 'ghi_chu_bg1', $this->ghi_chu_bg1])
            ->andFilterWhere(['like', 'ghi_chu_bg2', $this->ghi_chu_bg2]);
		}
        $query->orderBy([new \yii\db\Expression("FIELD (trang_thai, 'submited','approved','rejected','draft')")]);
        return $dataProvider;
    }
    public function searchAll($params, $cusomSearch=NULL)
    {
        $query = BaoGiaMuaSam::find();

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
			$query->andFilterWhere ( [ 'OR' ,['like', 'so_bao_gia', $cusomSearch],
            ['like', 'trang_thai', $cusomSearch],
            ['like', 'ghi_chu_bg1', $cusomSearch],
            ['like', 'ghi_chu_bg2', $cusomSearch]] );
 
		} else {
        	$query->andFilterWhere([
            'id' => $this->id,
            'id_phieu_mua_sam' => $this->id_phieu_mua_sam,
            'flag_index' => $this->flag_index,
            'ngay_bao_gia' => $this->ngay_bao_gia,
            'ngay_ket_thuc' => $this->ngay_ket_thuc,
            'ngay_gui_bg' => $this->ngay_gui_bg,
            'tong_tien' => $this->tong_tien,
            'nguoi_tao' => $this->nguoi_tao,
            'ngay_tao' => $this->ngay_tao,
            'nguoi_cap_nhat' => $this->nguoi_cap_nhat,
            'ngay_cap_nhat' => $this->ngay_cap_nhat,
            'nguoi_duyet_bg' => $this->nguoi_duyet_bg,
        ]);

        $query->andFilterWhere(['like', 'so_bao_gia', $this->so_bao_gia])
            ->andFilterWhere(['like', 'ghi_chu_bg1', $this->ghi_chu_bg1])
            ->andFilterWhere(['like', 'ghi_chu_bg2', $this->ghi_chu_bg2]);
		}
        //$query->orderBy([new \yii\db\Expression("FIELD (trang_thai, 'submited','approved','rejected','draft')")]);
        return $dataProvider;
    }
}
