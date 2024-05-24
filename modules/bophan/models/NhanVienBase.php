<?php

namespace app\modules\bophan\models;

use Yii;
use app\models\TsNhanVien as NhanVienModel;
use app\modules\dungchung\models\History;
use app\modules\dungchung\models\CustomFunc;
use app\modules\dungchung\models\DungChung;

class NhanVienBase extends NhanVienModel
{
    const MODEL_ID = 'nhanvien';
    
    /**
     * Danh muc gioi tinh
     * @return string[]
     */
    public static function getDmGioiTinh(){
        return [
            0=>'Nam', 
            1=>'Nữ'
        ];
    }
    
    /**
     * Danh muc gioi tinh label
     * @param int $val
     * @return string
     */
    public static function getGioiTinhLabel($val){
        $label = '';
        if($val == 0){
            $label = 'Nam';
        }else if($val == 1){    
            $label = 'Nữ';
        }
        return $label;            
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten_nhan_vien', 'id_bo_phan'], 'required'],
            [['gioi_tinh', 'da_thoi_viec', 'nguoi_tao'], 'integer'],
            [['dia_chi'], 'string'],
            [['thoi_gian_tao', 'ngay_vao_lam', 'ngay_thoi_viec'], 'safe'],
            [['ma_nhan_vien', 'dien_thoai'], 'string', 'max' => 20],
            [['ten_nhan_vien'], 'string', 'max' => 100],
            [['ngay_sinh'], 'string', 'max' => 10],
            [['chuc_vu', 'ten_truy_cap', 'email'], 'string', 'max' => 200],
            [['ma_nhan_vien'], 'unique'],
            [['id_bo_phan'], 'exist', 'skipOnError' => true, 'targetClass' => BoPhan::class, 'targetAttribute' => ['id_bo_phan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_bo_phan'=>'Thuộc bộ phận',
            'ma_nhan_vien' => 'Mã nhân viên',
            'ten_nhan_vien' => 'Tên nhân viên',
            'ngay_sinh' => 'Ngày sinh',
            'gioi_tinh' => 'Giới tính',
            'chuc_vu' => 'Chức vụ',
            'ten_truy_cap' => 'Tên truy cập',
            'ngay_vao_lam' => 'Ngày vào làm',
            'da_thoi_viec' => 'Đã thôi việc',
            'ngay_thoi_viec' => 'Ngày thôi việc',
            'dien_thoai' => 'Điện thoại',
            'email' => 'Email',
            'dia_chi' => 'Địa chỉ',
            'thoi_gian_tao' => 'Thời gian tạo',
            'nguoi_tao' => 'Người tạo',
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->thoi_gian_tao = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->isGuest ? '' : Yii::$app->user->id;
        }
        $cus = new CustomFunc();
        if($this->ngay_vao_lam != null)
            $this->ngay_vao_lam = $cus->convertDMYToYMD($this->ngay_vao_lam);
        if($this->ngay_thoi_viec != null)
            $this->ngay_thoi_viec = $cus->convertDMYToYMD($this->ngay_thoi_viec);
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
     * {@inheritdoc}
     * xoa file anh, tai lieu, lich su sau khi xoa du lieu
     */
    public function afterDelete()
    {
        DungChung::xoaThamChieu($this::MODEL_ID, $this->id);
        return parent::afterDelete();
    }
    /**
     * Gets query for [[BoPhan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBoPhan()
    {
        return $this->hasOne(BoPhan::class, ['id' => 'id_bo_phan']);
    }
}
