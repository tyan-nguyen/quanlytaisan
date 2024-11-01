<?php

namespace app\modules\kholuutru\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\kholuutru\models\DmVatTu;

/**
 * DmVatTuSearch represents the model behind the search form about `app\modules\kholuutru\models\DmVatTu`.
 */
class DmVatTuSearch extends DmVatTu
{
    public $trangThaiSoLuong;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_kho', 'nguoi_tao', 'so_luong'], 'integer'],
            [['ten_vat_tu', 'don_vi_tinh', 'trang_thai', 'ngay_tao', 'hang_san_xuat', 'trangThaiSoLuong'], 'safe'],
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
        $query = DmVatTu::find();

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
			$query->andFilterWhere ( [ 'OR' ,['like', 'ten_vat_tu', $cusomSearch],
            ['like', 'don_vi_tinh', $cusomSearch],
            ['like', 'trang_thai', $cusomSearch]] );
 
		} else {
        	$query->andFilterWhere([
            'id' => $this->id,
            'so_luong' => $this->so_luong,
            'id_kho' => $this->id_kho,
            'don_gia' => $this->don_gia,
            'ngay_tao' => $this->ngay_tao,
            'nguoi_tao' => $this->nguoi_tao,
        ]);

        $query->andFilterWhere(['like', 'ten_vat_tu', $this->ten_vat_tu])
            ->andFilterWhere(['like', 'don_vi_tinh', $this->don_vi_tinh])
            ->andFilterWhere(['like', 'trang_thai', $this->trang_thai]);
		}
		
		if($this->trangThaiSoLuong){
		    if($this->trangThaiSoLuong == 'LON')
		      $query->andWhere('so_luong > 0');
		    else if($this->trangThaiSoLuong == 'NHO')
		      $query->andWhere('so_luong <= 0');
		}
        return $dataProvider;
    }
}
