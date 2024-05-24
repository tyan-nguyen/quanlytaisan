<?php

namespace app\modules\bophan\models;

use Yii;
use app\modules\dungchung\models\History;
use app\modules\kholuutru\models\KhoLuuTru;

class BoPhanBase extends \app\models\TsBoPhan
{
    //set id cho model (dung de luu dung chung)
    const MODEL_ID = 'bophan';
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ma_bo_phan', 'ten_bo_phan'], 'required'],
            [['truc_thuoc', 'la_dv_quan_ly', 'la_dv_su_dung', 'la_dv_bao_tri', 'la_dv_van_tai', 'la_dv_mua_hang', 'la_dv_quan_ly_kho', 'la_trung_tam_chi_phi', 'id_kho_vat_tu', 'id_kho_phe_lieu', 'id_kho_thanh_pham', 'nguoi_tao'], 'integer'],
            [['thoi_gian_tao'], 'safe'],
            [['ma_bo_phan'], 'string', 'max' => 20],
            [['ten_bo_phan'], 'string', 'max' => 255],
            [['ma_bo_phan'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ma_bo_phan' => 'Mã bộ phận',
            'ten_bo_phan' => 'Tên bộ phận',
            'truc_thuoc' => 'Trực thuộc',
            'la_dv_quan_ly' => 'Là đơn vị quản lý tài sản',
            'la_dv_su_dung' => 'Là đơn vị sử dụng tài sản',
            'la_dv_bao_tri' => 'Là đơn vị bảo trì',
            'la_dv_van_tai' => 'Là đơn vị vận tải',
            'la_dv_mua_hang' => 'Là đơn vị mua hàng',
            'la_dv_quan_ly_kho' => 'Là đơn vị quản lý kho',
            'la_trung_tam_chi_phi' => 'Là trung tâm chi phí',
            'id_kho_vat_tu' => 'Kho vật tư',
            'id_kho_phe_lieu' => 'Kho phế liệu',
            'id_kho_thanh_pham' => 'Kho thành phẩm',
            'thoi_gian_tao' => 'Thời gian tạo',
            'nguoi_tao' => 'Người tạo',
        ];
    }

    /**
     * Gets query for [[TsKeHoachBaoTris]].
     *
     * @return \yii\db\ActiveQuery
     */
    /* public function getTsKeHoachBaoTris()
    {
        return $this->hasMany(TsKeHoachBaoTri::class, ['id_don_vi_bao_tri' => 'id']);
    }
    */
    /**
     * Gets query for [[TsNhanViens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTsNhanViens()
    {
        return $this->hasMany(NhanVien::class, ['id_bo_phan' => 'id']);
    }

    /**
     * Gets query for [[TsThietBis]].
     *
     * @return \yii\db\ActiveQuery
     */
    /* public function getTsThietBis()
    {
        return $this->hasMany(TsThietBi::class, ['id_bo_phan_quan_ly' => 'id']);
    } */
    
    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->thoi_gian_tao = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->isGuest ? '' : Yii::$app->user->id;
            if($this->truc_thuoc == null)
                $this->truc_thuoc = 0;
        }
        return parent::beforeSave($insert);
    }
    
    /**
     * {@inheritdoc}
     */
    public function afterSave( $insert, $changedAttributes ){
        parent::afterSave($insert, $changedAttributes);
        History::addHistory($this::MODEL_ID, $changedAttributes, $this, $insert);
    }
    
    /**
     * Gets query for [[BoPhan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDonViTrucThuoc(){
        return $this->truc_thuoc!=NULL?$this->hasOne(BoPhan::class, ['id' => 'truc_thuoc'])/* ->andOnCondition('truc_thuoc IS NOT NULL') */:NULL;
    }
    
    /**
     * Gets query for [[KhoLuuTru]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdKhoVatTu(){
        return $this->id_kho_vat_tu!=NULL ? $this->hasOne(KhoLuuTru::class, ['id' => 'id_kho_vat_tu']) : NULL;
    }
    
    /**
     * Gets query for [[KhoLuuTru]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdKhoPheLieu(){
        return $this->id_kho_phe_lieu!=NULL ? $this->hasOne(KhoLuuTru::class, ['id' => 'id_kho_phe_lieu']) : NULL;
    }
    
    /**
     * Gets query for [[BoPhan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdKhoThanhPham(){
        return $this->id_kho_thanh_pham!=NULL ? $this->hasOne(KhoLuuTru::class, ['id' => 'id_kho_thanh_pham']) : NULL;
    }
}
