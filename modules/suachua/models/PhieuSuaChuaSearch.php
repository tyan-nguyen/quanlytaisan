<?php

namespace app\modules\suachua\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\suachua\models\PhieuSuaChua;
use app\modules\dungchung\models\CustomFunc;
use app\modules\user\models\User;

/**
 * PhieuSuaChuaSearch represents the model behind the search form about `app\modules\suachua\models\PhieuSuaChua`.
 */
class PhieuSuaChuaSearch extends PhieuSuaChua
{
    public $ngay_hoan_thanh_from;
    public $ngay_hoan_thanh_to;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_thiet_bi', 'id_tt_sua_chua', 'nguoi_tao', 'nguoi_cap_nhat', 'danh_gia_sc'], 'integer'],
            [['ngay_sua_chua', 'ngay_du_kien_hoan_thanh', 'ngay_hoan_thanh', 'trang_thai', 'ngay_tao', 'ngay_cap_nhat', 'ghi_chu1', 'ghi_chu2', 'duyet_vt_kho', 'ngay_duyet_vt_kho', 'nguoi_duyet_vt_kho', 'noi_dung_duyet_vt_kho', 'da_xuat_vt_kho', 'ngay_xuat_vt_kho', 'nguoi_xuat_vt_kho', 'ngay_hoan_thanh_from', 
               'ngay_hoan_thanh_to' 
            ], 'safe'],
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
        $query = PhieuSuaChua::find();

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
        if(User::hasRole('nLanhDao', false) || User::hasRole('nQuanLy', false) /*|| User::hasPermission('qThemBaoGiaSuaChua')*/ ){
            //$query->andWhere("nguoi_tao = ".Yii::$app->user->id." OR trang_thai NOT IN ('draft', 'draft_sent', 'draft_reject')");
            //$query->andWhere("nguoi_tao = ".Yii::$app->user->id." OR trang_thai NOT IN ('draft', 'draft_reject')");
            $query->andWhere("nguoi_tao = ".Yii::$app->user->id." OR trang_thai NOT IN ('draft')");
        }else{
            $query->andFilterWhere(['like', 'trang_thai', $this->trang_thai]);
        }
		if($cusomSearch != NULL){
			$query->andFilterWhere ( [ 'OR' ,['like', 'trang_thai', $cusomSearch],
            ['like', 'ghi_chu1', $cusomSearch],
            ['like', 'ghi_chu2', $cusomSearch]] );
 
		} else {
		    // $this->ngay_hoan_thanh = $custom->convertDMYToYMD($this->ngay_hoan_thanh);
		    $tuNgay = null;
		    $denNgay = null;
		    
		    if (!empty($this->ngay_hoan_thanh_from)) {
		        $tuNgay = date('Y-m-d 00:00:00', strtotime(str_replace('/', '-', $this->ngay_hoan_thanh_from)));
		    }
		    
		    if (!empty($this->ngay_hoan_thanh_to)) {
		        $denNgay = date('Y-m-d 23:59:59', strtotime(str_replace('/', '-', $this->ngay_hoan_thanh_to)));
		    }
		    
		    // Tìm kiếm between
		    if ($tuNgay && $denNgay) {
		        $query->andWhere(['between', 'ngay_hoan_thanh', $tuNgay, $denNgay]);
		    }
		    
		    // Chỉ có từ ngày
		    if ($tuNgay && !$denNgay) {
		        $query->andWhere(['>=', 'ngay_hoan_thanh', $tuNgay]);
		    }
		    
		    // Chỉ có đến ngày
		    if (!$tuNgay && $denNgay) {
		        $query->andWhere(['<=', 'ngay_hoan_thanh', $denNgay]);
		    }
		    
		    $custom = new CustomFunc();
		    if($this->ngay_sua_chua!=null){
		        $this->ngay_sua_chua = $custom->convertDMYToYMD($this->ngay_sua_chua);
		    }

        	$query->andFilterWhere([
                'id' => $this->id,
                'id_thiet_bi' => $this->id_thiet_bi,
                'id_tt_sua_chua' => $this->id_tt_sua_chua,
                'ngay_sua_chua' => $this->ngay_sua_chua,
                'ngay_du_kien_hoan_thanh' => $this->ngay_du_kien_hoan_thanh,
                //'ngay_hoan_thanh' => $this->ngay_hoan_thanh,
                'phi_linh_kien' => $this->phi_linh_kien,
                'phi_khac' => $this->phi_khac,
                'tong_tien' => $this->tong_tien,
                'ngay_tao' => $this->ngay_tao,
                //'nguoi_tao' => $this->nguoi_tao,
                'ngay_cap_nhat' => $this->ngay_cap_nhat,
                'nguoi_cap_nhat' => $this->nguoi_cap_nhat,
                'danh_gia_sc' => $this->danh_gia_sc,
        	    'duyet_vt_kho' => $this->duyet_vt_kho
            ]);

        //$query->andFilterWhere(['like', 'trang_thai', $this->trang_thai])
        $query->andFilterWhere(['like', 'trang_thai', $this->trang_thai])
            ->andFilterWhere(['like', 'ghi_chu1', $this->ghi_chu1])
            ->andFilterWhere(['like', 'ghi_chu2', $this->ghi_chu2]);
		}
        return $dataProvider;
    }
}
