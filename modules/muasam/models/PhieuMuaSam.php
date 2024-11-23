<?php

namespace app\modules\muasam\models;

use Yii;
use app\modules\dungchung\models\CustomFunc;
use app\modules\user\models\User;
use app\modules\bophan\models\NhanVien;
use app\modules\bophan\models\BoPhanBase as BoPhan;
/**
 * This is the model class for table "ts_phieu_mua_sam".
 *
 * @property int $id
 * @property string|null $ngay_yeu_cau
 * @property int|null $id_nguoi_duyet
 * @property float|null $tong_phi
 * @property string|null $trang_thai
 * @property string|null $ghi_chu
 * @property int|null $nguoi_tao
 * @property string|null $ngay_tao
 * @property int|null $nguoi_cap_nhat
 * @property string|null $ngay_cap_nhat
 *
 * @property User $nguoiDuyet
 * @property TsBaoGiaMuaSam[] $tsBaoGiaMuaSams
 * @property TsCtPhieuMuaSam[] $tsCtPhieuMuaSams
 * @property TsCtPhieuNhapHang[] $tsCtPhieuNhapHangs
 * @property TsPhieuNhapHang[] $tsPhieuNhapHangs
 */
class PhieuMuaSam extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_phieu_mua_sam';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ngay_yeu_cau', 'ngay_tao', 'ngay_cap_nhat'], 'safe'],
            [['id_nguoi_duyet', 'nguoi_tao', 'nguoi_cap_nhat','id_nguoi_quan_ly','id_bo_phan_quan_ly','id_tt_mua_sam'], 'integer'],
            [['tong_phi','danh_gia_ms','danh_gia_bg'], 'number'],
            [['ghi_chu','ghi_chu2','ghi_chu_duyet'], 'string'],
            [['trang_thai','dm_mua_sam'], 'string', 'max' => 255],
            [['id_nguoi_duyet'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_nguoi_duyet' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Số phiếu',
            'id_tt_mua_sam' => 'Trung tâm mua sắm',
            'ngay_yeu_cau' => 'Ngày yêu cầu',
            'id_nguoi_duyet' => 'Người duyệt',
            'tong_phi' => 'Tổng phí',
            'trang_thai' => 'Trạng thái',
            'ghi_chu' => 'Ghi chú',
            'ghi_chu_duyet'=>'Ghi chú duyệt/từ chối',
            'nguoi_tao' => 'Người tạo',
            'id_nguoi_quan_ly' => 'Người yêu cầu',
            'id_bo_phan_quan_ly' => 'Bộ phận',
            'nguoi_cap_nhat' => 'Người cập nhật',
            'ngay_cap_nhat' => 'Ngày cập nhật',
            'danh_gia_ms'=>'Đánh giá TT mua sắm',
            'danh_gia_bg'=>'Đánh giá dv báo giá',
            'ghi_chu2'=>'ghi chú 2',
            'dm_mua_sam'=>'Danh mục mua sắm'
        ];
    }

    /**
     * Gets query for [[NguoiDuyet]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNguoiDuyet()
    {
        return $this->hasOne(User::class, ['id' => 'id_nguoi_duyet']);
    }
    /**
     * relation Trung tâm mua sắm
     * @return \yii\db\ActiveQuery
     */
    public function getTrungTamMuaSam()
    {
        return $this->hasOne(BoPhan::class, ['id' => 'id_tt_mua_sam']);
    }
    /**
     * Gets query for [[TsBaoGiaMuaSams]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBaoGiaMuaSam()
    {
        return $this->hasOne(BaoGiaMuaSam::class, ['id_phieu_mua_sam' => 'id'])->where(['flag_index'=>0]);
    }
    public function getBaoGiaMuaSams()
    {
        return $this->hasMany(BaoGiaMuaSam::class, ['id_phieu_mua_sam' => 'id'])->where(['flag_index'=>0]);
    }
    /**
     * Gets query for [[TsCtPhieuMuaSams]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCtPhieuMuaSams()
    {
        if($this->dm_mua_sam=='thiet_bi')
            return $this->hasMany(CtPhieuMuaSam::class, ['id_phieu_mua_sam' => 'id']);
        else
            return $this->hasMany(CtPhieuMuaSamVt::class, ['id_phieu_mua_sam' => 'id']);
    }

    /**
     * Gets query for [[TsCtPhieuNhapHangs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCtPhieuNhapHangs()
    {
        if($this->dm_mua_sam==='thiet_bi')
            return $this->hasMany(CtPhieuNhapHang::class, ['id_phieu_mua_sam' => 'id']);
        else 
            return $this->hasMany(CtPhieuNhapHangVt::class, ['id_phieu_mua_sam' => 'id']);
    }

    /**
     * Gets query for [[TsPhieuNhapHangs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhieuNhapHang()
    {
        return $this->hasOne(PhieuNhapHang::class, ['id_phieu_mua_sam' => 'id']);
    }
    public function beforeSave($insert) {
        
        //ngaythangnam
        $cus = new CustomFunc();
        if ($this->isNewRecord) {
            $this->ngay_tao = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->id;
            $this->trang_thai = "draft";

        }else{
            if($this->trang_thai != "draft" && count($this->ctPhieuMuaSams)==0)
                return ;
            if($this->getOldAttribute('trang_thai')!=$this->trang_thai && ($this->trang_thai === "approved" || $this->trang_thai === "rejected"))
            $this->id_nguoi_duyet = Yii::$app->user->id;

            $this->ngay_cap_nhat = date('Y-m-d H:i:s');
            $this->nguoi_cap_nhat = Yii::$app->user->id;
        }
        
        
        if($this->ngay_yeu_cau != null)
            $this->ngay_yeu_cau = $cus->convertDMYToYMD($this->ngay_yeu_cau);
        
        
        return parent::beforeSave($insert);
    }
    public static function getDmTrangThai(){
        return [
            "draft"=>'Nháp',
            "submited"=>'Chờ duyệt',
            "rejected"=>"Từ chối",
            "approved"=>'Đã duyệt',
            "quote_sent"=>'Chờ duyệt báo giá',
            "processing"=>"Đang nhập hàng",
            "completed"=>"Hoàn thành"       ];
    }
    public static function getDmMuaSam(){
        return [
            "thiet_bi"=>'Thiết bị',
            "vat_tu"=>'Vật tư',
        ];
    }
    public function getNguoiTao()
    {
        return $this->hasOne(User::class, ['id' => 'nguoi_tao']);
    }
    public static function getListMuaSamByStatus($status)
    {
        return PhieuMuaSam::find()->where(['in','trang_thai',$status])->limit(10)->orderBy('id','desc')->all();
    }
    public function getNguoiCapNhat()
    {
        return $this->hasOne(User::class, ['id' => 'nguoi_cap_nhat']);
    }
    public function getLichSuBaoGiaMuaSams()
    {
        return $this->hasMany(BaoGiaMuaSam::class, ['id_phieu_mua_sam' => 'id'])->where(['flag_index'=>-1]);
    }
    /**
     * lay ten nhan vien tu relation nguoiQuanLy
     * @return string
     */
    public function getTenNguoiQuanLy(){
        return $this->nguoiQuanLy != NULL ? $this->nguoiQuanLy->ten_nhan_vien : '';
    }
    /**
     * lay ten bo phan quan ly tu relation boPhanQuanLy
     * @return string
     */
    public function getTenBoPhanQuanLy(){
        return $this->boPhanQuanLy->ten_bo_phan ?? '';
    }
    /**
     * Gets query for [[NguoiQuanLy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNguoiQuanLy()
    {
        return $this->id_nguoi_quan_ly !=NULL ? $this->hasOne(NhanVien::class, ['id' => 'id_nguoi_quan_ly']) : NULL;
    }
    /**
     * Gets query for [[BoPhanQuanLy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBoPhanQuanLy()
    {
        return $this->hasOne(BoPhan::class, ['id' => 'id_bo_phan_quan_ly']);
    }
    public static function getColorTrangThai(){
        return [
            "draft"=>'info',
            "submited"=>'warning',
            "rejected"=>"danger",
            "approved"=>'primary',
            "quote_sent"=>'warning',
            "processing"=>'secondary',
            "completed"=>'success',
        ];
    }
    
}
