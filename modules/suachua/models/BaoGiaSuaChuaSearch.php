<?php

namespace app\modules\suachua\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\suachua\models\BaoGiaSuaChua;

/**
 * BaoGiaSuaChuaSearch represents the model behind the search form about `app\modules\suachua\models\BaoGiaSuaChua`.
 */
class BaoGiaSuaChuaSearch extends BaoGiaSuaChua
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_phieu_sua_chua', 'flag_index', 'nguoi_tao', 'nguoi_cap_nhat', 'nguoi_duyet_bg'], 'integer'],
            [['so_bao_gia', 'ngay_bao_gia', 'ngay_ket_thuc', 'ngay_gui_bg', 'trang_thai', 'ghi_chu_bg1', 'ghi_chu_bg2', 'ngay_tao', 'ngay_cap_nhat'], 'safe'],
            [['phi_linh_kien', 'phi_khac', 'tong_tien'], 'number'],
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
        $query = BaoGiaSuaChua::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                    //'trang_thai'=>[new \yii\db\Expression('FIELD (trang_thai, submited,approved,rejected,draft)')]
                    //'trang_thai'=>['submited','approved','rejected','draft']
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
            //['like', 'trang_thai', $cusomSearch],
            ['like', 'ghi_chu_bg1', $cusomSearch],
            ['like', 'ghi_chu_bg2', $cusomSearch]] );
 
		} else {
        	$query->andFilterWhere([
            'id' => $this->id,
            'id_phieu_sua_chua' => $this->id_phieu_sua_chua,
            'flag_index' => $this->flag_index,
            'ngay_bao_gia' => $this->ngay_bao_gia,
            'ngay_ket_thuc' => $this->ngay_ket_thuc,
            'ngay_gui_bg' => $this->ngay_gui_bg,
            'phi_linh_kien' => $this->phi_linh_kien,
            'phi_khac' => $this->phi_khac,
            'tong_tien' => $this->tong_tien,
            'ngay_tao' => $this->ngay_tao,
            'nguoi_tao' => $this->nguoi_tao,
            'ngay_cap_nhat' => $this->ngay_cap_nhat,
            'nguoi_cap_nhat' => $this->nguoi_cap_nhat,
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
}
