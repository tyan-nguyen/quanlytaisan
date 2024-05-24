<?php

namespace app\modules\kholuutru\models;

use Yii;
use app\modules\dungchung\models\History;
use app\modules\bophan\models\NhanVien;
use app\modules\bophan\models\BoPhan;

class KhoLuuTruBase extends \app\models\TsKhoLuuTru
{
    const MODEL_ID = 'kholuutru';

    /**
     * Danh muc Loai Kho luu tru
     * @return string[]
     */
    public static function getDmLoaiKho(){
        return [
            1=>'Sản xuất', 
            2=>'Vật tư',
            3=>'Phế liệu'
        ];
    }
    
    /**
     * Danh muc Loai Kho luu tru label
     * @param int $val
     * @return string
     */
    public static function getLoaiKhoLabel($val){
        $label = '';
        if($val == 1){
            $label = 'Sản xuất';
        }else if($val == 2){
            $label = 'Vật tư';
        }else if($val == 3){
            $label = 'Phế liệu';
        }
        return $label;
    }
    
   /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ma_kho', 'ten_kho', 'loai_kho', 'id_nguoi_quan_ly', 'id_bo_phan_quan_ly'], 'required'],
            [['loai_kho', 'id_nguoi_quan_ly', 'id_bo_phan_quan_ly', 'gia_tri_toi_da', 'nguoi_tao'], 'integer'],
            [['thoi_gian_tao'], 'safe'],
            [['ma_kho', 'dien_thoai'], 'string', 'max' => 20],
            [['ten_kho', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ma_kho' => 'Mã Kho',
            'ten_kho' => 'Tên Kho',
            'loai_kho' => 'Loại Kho',
            'id_nguoi_quan_ly' => 'Người quản lý',
            'id_bo_phan_quan_ly' => 'Bộ phận quản lý',
            'gia_tri_toi_da' => 'Giá trị tối đa',
            'dien_thoai' => 'Điện thoại',
            'email' => 'Email',
            'thoi_gian_tao' => 'Thời gian tạo',
            'nguoi_tao' => 'Người tạo',
        ];
    }

    /**
     * Gets query for [[TsNhanVienKhos]].
     *
     * @return \yii\db\ActiveQuery
     */
   /*  public function getTsNhanVienKhos()
    {
        return $this->hasMany(TsNhanVienKho::class, ['id_kho' => 'id']);
    } */
    /**
     * {@inheritdoc}
     */
    
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->thoi_gian_tao = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->isGuest ? '' : Yii::$app->user->id;
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
    public function getBoPhanQuanLy()
    {
        return $this->hasOne(BoPhan::class, ['id' => 'id_bo_phan_quan_ly']);
    }
    
    /**
     * Gets query for [[NhanVien]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNguoiQuanLy()
    {
        return $this->hasOne(NhanVien::class, ['id' => 'id_nguoi_quan_ly']);
    }
}
