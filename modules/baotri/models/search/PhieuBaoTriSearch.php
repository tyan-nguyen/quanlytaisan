<?php

namespace app\modules\baotri\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\baotri\models\PhieuBaoTri;
use yii\db\Expression;

/**
 * PhieuBaoTriSearch represents the model behind the search form about `app\modules\baotri\models\PhieuBaoTri`.
 */
class PhieuBaoTriSearch extends PhieuBaoTri
{
    public $idThietBi;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_ke_hoach', 'ky_thu', 'id_don_vi_bao_tri', 'id_nguoi_chiu_trach_nhiem', 'nguoi_tao'], 'integer'],
            [['thoi_gian_bat_dau', 'thoi_gian_ket_thuc', 'noi_dung_thuc_hien', 'thoi_gian_tao', 'da_hoan_thanh', 'idThietBi'], 'safe'],
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
    public function search($params, $cusomSearch=NULL, $denHanBaoTri=NULL)
    {
        $query = PhieuBaoTri::find()->alias('t')->joinWith(['keHoach as kh']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'thoi_gian_bat_dau' => SORT_ASC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
		/* if($cusomSearch != NULL){
			$query->andFilterWhere ( [ 'OR' ,['like', 'noi_dung_thuc_hien', $cusomSearch]] );
 
		} else { */
        $query->andFilterWhere([
            't.id' => $this->id,
            't.id_ke_hoach' => $this->id_ke_hoach,
            't.ky_thu' => $this->ky_thu,
            't.id_don_vi_bao_tri' => $this->id_don_vi_bao_tri,
            't.id_nguoi_chiu_trach_nhiem' => $this->id_nguoi_chiu_trach_nhiem,
            't.thoi_gian_bat_dau' => $this->thoi_gian_bat_dau,
            't.thoi_gian_ket_thuc' => $this->thoi_gian_ket_thuc,
            't.thoi_gian_tao' => $this->thoi_gian_tao,
            't.nguoi_tao' => $this->nguoi_tao,
        	'kh.id_thiet_bi' => $this->idThietBi,
        ]);

        $query->andFilterWhere(['like', 't.noi_dung_thuc_hien', $this->noi_dung_thuc_hien]);
		//}
        if($denHanBaoTri == NULL){
            $query->andFilterWhere([
                't.thoi_gian_bat_dau' => $this->thoi_gian_bat_dau,
            ]);
        } else {
            //xu ly theo ngay bao truoc
            //tam thoi lay theo ngay hien tai tro di va trang thai chua thuc hien
            $query->andFilterWhere(['>=', new Expression('DATE(thoi_gian_bat_dau)'), new Expression('CURDATE()')]);
            $query->andFilterWhere([
                't.da_hoan_thanh' => 0,
            ]);
        }
        
        return $dataProvider;
    }
}
