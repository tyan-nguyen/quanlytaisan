<?php

namespace app\modules\taisan\models;

use app\modules\dungchung\models\CustomFunc;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

// use app\models\TsYeuCauVanHanh;
use app\modules\taisan\models\YeuCauVanHanh;
use app\modules\user\models\User;

/**
 * YeuCauVanHanhSearch represents the model behind the search form about `app\models\TsYeuCauVanHanh`.
 */
class YeuCauVanHanhSearch extends YeuCauVanHanh
{
    public $idThietBi; //use in form search
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                ['id', 'id_nguoi_lap', 'id_nguoi_gui', 'id_nguoi_duyet', 'id_nguoi_xuat', 'id_nguoi_nhan', 'id_nguoi_yeu_cau', 'id_bo_phan_quan_ly', 'idThietBi'],
                'integer'
            ],
            [
                ['ngay_lap', 'ngay_gui', 'ngay_duyet', 'ngay_xuat', 'ngay_nhan', 'ly_do', 'hieu_luc', 'noi_dung_lap', 'noi_dung_gui', 'noi_dung_duyet', 'noi_dung_xuat', 'noi_dung_nhan', 'dia_diem', 'created_at', 'updated_at', 'deleted_at'],
                'safe'
            ],
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
    public function search($params, $cusomSearch = NULL)
    {
        $cus = new CustomFunc();
        $query = YeuCauVanHanh::find()->alias('t');
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'hieu_luc' => SORT_ASC,
                ]
            ]
        ]);

        $this->load($params);
        
        if($this->idThietBi){
            $query->joinWith(['details as dt']);
            $query->andFilterWhere(['dt.id_thiet_bi'=>$this->idThietBi]);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        //lọc nếu quyền nhân viên chỉ xem được phiếu do mình tạo
        //nếu là quản lý hoặc lãnh đạo thì cho xem hết
        if(User::hasRole('nNhanVien', false)){
            $query->andFilterWhere([
                'id_nguoi_lap' => User::getCurrentNhanVienID(),
            ]);
        }
        
        if ($cusomSearch != NULL) {
            $query->andFilterWhere([
                'OR', ['like', 'ly_do', $cusomSearch],
                ['like', 'hieu_luc', $cusomSearch],
                ['like', 'noi_dung_lap', $cusomSearch],
                ['like', 'noi_dung_gui', $cusomSearch],
                ['like', 'noi_dung_duyet', $cusomSearch],
                ['like', 'noi_dung_xuat', $cusomSearch],
                ['like', 'noi_dung_nhan', $cusomSearch],
                ['like', 'cong_trinh', $cusomSearch],
                ['like', 'dia_diem', $cusomSearch]
            ]);
        } else {
            $query->andFilterWhere([
                'id' => $this->id,
                'id_nguoi_lap' => $this->id_nguoi_lap,
                'id_nguoi_gui' => $this->id_nguoi_gui,
                'id_nguoi_duyet' => $this->id_nguoi_duyet,
                'id_nguoi_xuat' => $this->id_nguoi_xuat,
                'id_nguoi_nhan' => $this->id_nguoi_nhan,
                'id_nguoi_yeu_cau' => $this->id_nguoi_yeu_cau,
                'id_bo_phan_quan_ly' => $this->id_bo_phan_quan_ly,
                'ngay_lap' => $this->ngay_lap != null ? $cus->convertDMYToYMD($this->ngay_lap) : $this->ngay_lap,
                'ngay_duyet' => $this->ngay_duyet != null ? $cus->convertDMYToYMD($this->ngay_duyet) : $this->ngay_duyet,
                'ngay_xuat' => $this->ngay_xuat != null ? $cus->convertDMYToYMD($this->ngay_xuat) : $this->ngay_xuat,
                'ngay_nhan' => $this->ngay_nhan != null ? $cus->convertDMYToYMD($this->ngay_nhan) : $this->ngay_nhan,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'deleted_at' => $this->deleted_at,
            ]);

            $query->andFilterWhere(['like', 'ly_do', $this->ly_do])
                ->andFilterWhere(['like', 'hieu_luc', $this->hieu_luc])
                ->andFilterWhere(['like', 'noi_dung_lap', $this->noi_dung_lap])
                ->andFilterWhere(['like', 'noi_dung_gui', $this->noi_dung_gui])
                ->andFilterWhere(['like', 'noi_dung_duyet', $this->noi_dung_duyet])
                ->andFilterWhere(['like', 'noi_dung_xuat', $this->noi_dung_xuat])
                ->andFilterWhere(['like', 'noi_dung_nhan', $this->noi_dung_nhan])
                ->andFilterWhere(['like', 'dia_diem', $this->dia_diem]);

            $query->orderBy(new \yii\db\Expression("
                CASE
                    WHEN hieu_luc IS NULL THEN 0
                    WHEN hieu_luc = '' THEN 1
                    WHEN hieu_luc = 'NHAP' THEN 2
                    ELSE 10
                END ASC
            "));
        }


        return $dataProvider;
    }
}
