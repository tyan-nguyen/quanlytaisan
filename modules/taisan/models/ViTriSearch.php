<?php

namespace app\modules\taisan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\taisan\models\ViTri;

/**
 * ViTriSearch represents the model behind the search form about `app\modules\taisan\models\ViTri`.
 */
class ViTriSearch extends ViTri
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'truc_thuoc', 'id_layout', 'nguoi_tao'], 'integer'],
            [['ma_vi_tri', 'ten_vi_tri', 'mo_ta', 'da_ngung_hoat_dong', 'ngay_ngung_hoat_dong', 'toa_do_x', 'toa_do_y', 'thoi_gian_tao'], 'safe'],
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
        $query = ViTri::find();

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
			$query->andFilterWhere ( [ 'OR' ,['like', 'ma_vi_tri', $cusomSearch],
            ['like', 'ten_vi_tri', $cusomSearch],
            ['like', 'mo_ta', $cusomSearch],
            ['like', 'da_ngung_hoat_dong', $cusomSearch],
            ['like', 'toa_do_x', $cusomSearch],
            ['like', 'toa_do_y', $cusomSearch]] );
 
		} else {
        	$query->andFilterWhere([
            'id' => $this->id,
            'truc_thuoc' => $this->truc_thuoc,
            'ngay_ngung_hoat_dong' => $this->ngay_ngung_hoat_dong,
            'id_layout' => $this->id_layout,
            'thoi_gian_tao' => $this->thoi_gian_tao,
            'nguoi_tao' => $this->nguoi_tao,
        ]);

        $query->andFilterWhere(['like', 'ma_vi_tri', $this->ma_vi_tri])
            ->andFilterWhere(['like', 'ten_vi_tri', $this->ten_vi_tri])
            ->andFilterWhere(['like', 'mo_ta', $this->mo_ta])
            ->andFilterWhere(['like', 'da_ngung_hoat_dong', $this->da_ngung_hoat_dong])
            ->andFilterWhere(['like', 'toa_do_x', $this->toa_do_x])
            ->andFilterWhere(['like', 'toa_do_y', $this->toa_do_y]);
		}
        return $dataProvider;
    }
}
