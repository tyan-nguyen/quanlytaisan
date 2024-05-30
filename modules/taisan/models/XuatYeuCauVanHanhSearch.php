<?php

namespace app\modules\taisan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\taisan\models\YeuCauVanHanh;

/**
 * XuatYeuCauVanHanhSearch represents the model behind the search form about `app\models\YeuCauVanHanh`.
 */
class XuatYeuCauVanHanhSearch extends YeuCauVanHanh
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_nguoi_lap', 'id_nguoi_yeu_cau', 'id_nguoi_gui', 'id_nguoi_duyet', 'id_nguoi_xuat', 'id_nguoi_nhan', 'id_bo_phan_quan_ly'], 'integer'],
            [['cong_trinh', 'ngay_lap', 'ngay_gui', 'ngay_duyet', 'ngay_xuat', 'ngay_nhan', 'ly_do', 'hieu_luc', 'noi_dung_lap', 'noi_dung_gui', 'noi_dung_duyet', 'noi_dung_xuat', 'noi_dung_nhan', 'dia_diem', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
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
        $query = YeuCauVanHanh::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'hieu_luc' => SORT_ASC,
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        if ($cusomSearch != NULL) {
            $query->andFilterWhere([
                'OR', ['like', 'cong_trinh', $cusomSearch],
                ['like', 'ly_do', $cusomSearch],
                ['like', 'hieu_luc', $cusomSearch],
                ['like', 'noi_dung_lap', $cusomSearch],
                ['like', 'noi_dung_gui', $cusomSearch],
                ['like', 'noi_dung_duyet', $cusomSearch],
                ['like', 'noi_dung_xuat', $cusomSearch],
                ['like', 'noi_dung_nhan', $cusomSearch],
                ['like', 'dia_diem', $cusomSearch]
            ]);
        } else {
            $query->andFilterWhere([
                'id' => $this->id,
                'id_nguoi_lap' => $this->id_nguoi_lap,
                'id_nguoi_yeu_cau' => $this->id_nguoi_yeu_cau,
                'id_nguoi_gui' => $this->id_nguoi_gui,
                'id_nguoi_duyet' => $this->id_nguoi_duyet,
                'id_nguoi_xuat' => $this->id_nguoi_xuat,
                'id_nguoi_nhan' => $this->id_nguoi_nhan,
                'id_bo_phan_quan_ly' => $this->id_bo_phan_quan_ly,
                'ngay_lap' => $this->ngay_lap,
                'ngay_gui' => $this->ngay_gui,
                'ngay_duyet' => $this->ngay_duyet,
                'ngay_xuat' => $this->ngay_xuat,
                'ngay_nhan' => $this->ngay_nhan,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'deleted_at' => $this->deleted_at,
            ]);

            $query->andFilterWhere(['like', 'cong_trinh', $this->cong_trinh])
                ->andFilterWhere(['like', 'ly_do', $this->ly_do])
                ->andFilterWhere(['like', 'hieu_luc', $this->hieu_luc])
                ->andFilterWhere(['like', 'noi_dung_lap', $this->noi_dung_lap])
                ->andFilterWhere(['like', 'noi_dung_gui', $this->noi_dung_gui])
                ->andFilterWhere(['like', 'noi_dung_duyet', $this->noi_dung_duyet])
                ->andFilterWhere(['like', 'noi_dung_xuat', $this->noi_dung_xuat])
                ->andFilterWhere(['like', 'noi_dung_nhan', $this->noi_dung_nhan])
                ->andFilterWhere(['like', 'dia_diem', $this->dia_diem]);
        }


        $query->orderBy(new \yii\db\Expression("
        CASE
            WHEN hieu_luc IS NULL THEN 0
            WHEN hieu_luc = 'DADUYET' THEN 1
            ELSE 2
        END ASC
    "));
        return $dataProvider;
    }
}
