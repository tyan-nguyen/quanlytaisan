<?php

namespace app\modules\bophan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\bophan\models\BoPhan;

/**
 * BoPhanSearch represents the model behind the search form about `app\modules\bophan\models\BoPhan`.
 */
class BoPhanSearch extends BoPhan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'truc_thuoc', 'id_kho_vat_tu', 'id_kho_phe_lieu', 'id_kho_thanh_pham', 'nguoi_tao'], 'integer'],
            [['ma_bo_phan', 'ten_bo_phan', 'la_dv_quan_ly', 'la_dv_su_dung', 'la_dv_bao_tri', 'la_dv_van_tai', 'la_dv_mua_hang', 'la_dv_quan_ly_kho', 'la_trung_tam_chi_phi', 'thoi_gian_tao'], 'safe'],
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
        $query = BoPhan::find();

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
			$query->andFilterWhere ( [ 'OR' ,['like', 'ma_bo_phan', $cusomSearch],
            ['like', 'ten_bo_phan', $cusomSearch],
            ['like', 'la_dv_quan_ly', $cusomSearch],
            ['like', 'la_dv_su_dung', $cusomSearch],
            ['like', 'la_dv_bao_tri', $cusomSearch],
            ['like', 'la_dv_van_tai', $cusomSearch],
            ['like', 'la_dv_mua_hang', $cusomSearch],
            ['like', 'la_dv_quan_ly_kho', $cusomSearch],
            ['like', 'la_trung_tam_chi_phi', $cusomSearch]] );
 
		} else {
        	$query->andFilterWhere([
            'id' => $this->id,
            'truc_thuoc' => $this->truc_thuoc,
            'id_kho_vat_tu' => $this->id_kho_vat_tu,
            'id_kho_phe_lieu' => $this->id_kho_phe_lieu,
            'id_kho_thanh_pham' => $this->id_kho_thanh_pham,
            'thoi_gian_tao' => $this->thoi_gian_tao,
            'nguoi_tao' => $this->nguoi_tao,
        ]);

        $query->andFilterWhere(['like', 'ma_bo_phan', $this->ma_bo_phan])
            ->andFilterWhere(['like', 'ten_bo_phan', $this->ten_bo_phan])
            ->andFilterWhere(['like', 'la_dv_quan_ly', $this->la_dv_quan_ly])
            ->andFilterWhere(['like', 'la_dv_su_dung', $this->la_dv_su_dung])
            ->andFilterWhere(['like', 'la_dv_bao_tri', $this->la_dv_bao_tri])
            ->andFilterWhere(['like', 'la_dv_van_tai', $this->la_dv_van_tai])
            ->andFilterWhere(['like', 'la_dv_mua_hang', $this->la_dv_mua_hang])
            ->andFilterWhere(['like', 'la_dv_quan_ly_kho', $this->la_dv_quan_ly_kho])
            ->andFilterWhere(['like', 'la_trung_tam_chi_phi', $this->la_trung_tam_chi_phi]);
		}
        return $dataProvider;
    }
}
