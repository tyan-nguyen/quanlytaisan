<?php

namespace app\modules\muasam\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\muasam\models\PhieuMuaSam;
use app\modules\dungchung\models\CustomFunc;
use app\modules\user\models\User;

/**
 * PhieuMuaSamSearch represents the model behind the search form about `app\modules\muasam\models\PhieuMuaSam`.
 */
class PhieuMuaSamSearch extends PhieuMuaSam
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_nguoi_duyet', 'nguoi_tao', 'nguoi_cap_nhat'], 'integer'],
            [['ngay_yeu_cau', 'trang_thai', 'ghi_chu', 'ngay_tao', 'ngay_cap_nhat','dm_mua_sam'], 'safe'],
            [['tong_phi'], 'number'],
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
        $query = PhieuMuaSam::find();

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
        //lọc nếu quyền nhân viên chỉ xem được phiếu do mình tạo
        //nếu là quản lý hoặc lãnh đạo thì cho xem hết
        if(User::hasRole('nNhanVien', false)){
            $query->andFilterWhere([
                'nguoi_tao' => Yii::$app->user->id,
            ]);
        }
		if($cusomSearch != NULL){
			$query->andFilterWhere ( [ 'OR' ,['like', 'trang_thai', $cusomSearch],
            ['like', 'ghi_chu', $cusomSearch]] );
 
		} else {
            $cus = new CustomFunc();
            $ngay_yeu_cau=null;
            if($this->ngay_yeu_cau != null)
            $ngay_yeu_cau = $cus->convertDMYToYMD($this->ngay_yeu_cau);
        	$query->andFilterWhere([
            'id' => $this->id,
            'ngay_yeu_cau' => $ngay_yeu_cau,
            'id_nguoi_duyet' => $this->id_nguoi_duyet,
            'tong_phi' => $this->tong_phi,
            'nguoi_tao' => $this->nguoi_tao,
            'ngay_tao' => $this->ngay_tao,
            'nguoi_cap_nhat' => $this->nguoi_cap_nhat,
            'ngay_cap_nhat' => $this->ngay_cap_nhat,
            'dm_mua_sam' => $this->dm_mua_sam,
        ]);

        $query->andFilterWhere(['like', 'trang_thai', $this->trang_thai])
            ->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu]);
		}
        return $dataProvider;
    }
}
