<?php

namespace app\modules\muasam\models;

use Yii;
use app\modules\bophan\models\BoPhan;
use app\modules\bophan\models\DoiTac;
use app\modules\dungchung\models\CustomFunc;
use app\modules\bophan\models\NhanVien;
use app\modules\taisan\models\ThietBi;
use app\modules\taisan\models\Vitri;
use app\modules\taisan\models\HeThong;
use app\modules\user\models\User;
/**
 * This is the model class for table "ts_ct_phieu_nhap_hang".
 *
 * @property int $id
 * @property string $ma_thiet_bi
 * @property int|null $id_vi_tri
 * @property int|null $id_he_thong
 * @property int|null $id_thiet_bi_cha
 * @property int|null $id_phieu_mua_sam
 * @property int|null $id_ct_phieu_mua_sam
 * @property int|null $nam_san_xuat
 * @property string|null $serial
 * @property string|null $model
 * @property string|null $xuat_xu
 * @property int|null $id_hang_bao_hanh
 * @property int|null $id_nhien_lieu
 * @property string|null $dac_tinh_ky_thuat
 * @property int|null $id_don_vi_bao_tri
 * @property string|null $han_bao_hanh
 * @property string|null $ghi_chu
 * @property int|null $id_nguoi_quan_ly
 * @property int|null $id_bo_phan_quan_ly
 * @property int|null $id_thiet_bi
 * @property int|null $nguoi_tao
 * @property string|null $ngay_tao
 * @property int|null $nguoi_cap_nhat
 * @property string|null $ngay_cap_nhat
 *
 * @property TsPhieuNhapHang $ctPhieuMuaSam
 * @property TsPhieuMuaSam $phieuMuaSam
 */
class CtPhieuNhapHang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_ct_phieu_nhap_hang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ma_thiet_bi','id_phieu_mua_sam','id_ct_phieu_mua_sam'], 'required'],
            [['id_vi_tri', 'id_he_thong', 'id_thiet_bi_cha', 'id_phieu_mua_sam', 'id_ct_phieu_mua_sam', 'nam_san_xuat', 'id_hang_bao_hanh', 'id_nhien_lieu', 'id_don_vi_bao_tri', 'id_nguoi_quan_ly', 'id_bo_phan_quan_ly', 'id_thiet_bi', 'nguoi_tao', 'nguoi_cap_nhat'], 'integer'],
            [['dac_tinh_ky_thuat', 'ghi_chu'], 'string'],
            [['han_bao_hanh', 'ngay_tao', 'ngay_cap_nhat'], 'safe'],
            [['ma_thiet_bi', 'serial', 'model', 'xuat_xu'], 'string', 'max' => 255],
            [['id_ct_phieu_mua_sam'], 'exist', 'skipOnError' => true, 'targetClass' => CtPhieuMuaSam::class, 'targetAttribute' => ['id_ct_phieu_mua_sam' => 'id']],
            [['id_phieu_mua_sam'], 'exist', 'skipOnError' => true, 'targetClass' => PhieuMuaSam::class, 'targetAttribute' => ['id_phieu_mua_sam' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ma_thiet_bi' => 'Mã thiết bị',
            'id_vi_tri' => 'Vị trí',
            'id_he_thong' => 'Hệ thống',
            'id_thiet_bi_cha' => 'Thiết bị cha',
            'id_phieu_mua_sam' => 'Phiếu mua sắm',
            'id_ct_phieu_mua_sam' => 'Tên thiết bị',
            'nam_san_xuat' => 'Năm sản xuất',
            'serial' => 'Serial',
            'model' => 'Model',
            'xuat_xu' => 'Xuất xứ',
            'id_hang_bao_hanh' => 'Hãng bão hành',
            'id_nhien_lieu' => 'Nhiên liệu',
            'dac_tinh_ky_thuat' => 'Đặc tính kỹ thuật',
            'id_don_vi_bao_tri' => 'Đơn vị bão trì',
            'han_bao_hanh' => 'Hạn bão hành',
            'ghi_chu' => 'Ghi chú',
            'id_nguoi_quan_ly' => 'Người quản lý',
            'id_bo_phan_quan_ly' => 'Bộ phận quản lý',
            'id_thiet_bi' => 'Trạng thái nhập',
            'nguoi_tao' => 'Người tạo',
            'ngay_tao' => 'Ngày tạo',
            'nguoi_cap_nhat' => 'Người cập nhật',
            'ngay_cap_nhat' => 'Ngày cập nhật',
        ];
    }

    /**
     * Gets query for [[CtPhieuMuaSam]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCtPhieuMuaSam()
    {
        return $this->hasOne(CtPhieuMuaSam::class, ['id' => 'id_ct_phieu_mua_sam']);
    }

    /**
     * Gets query for [[PhieuMuaSam]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhieuMuaSam()
    {
        return $this->hasOne(PhieuMuaSam::class, ['id' => 'id_phieu_mua_sam']);
    }
    public function getNguoiQuanLy()
    {
        return $this->id_nguoi_quan_ly !=NULL ? $this->hasOne(NhanVien::class, ['id' => 'id_nguoi_quan_ly']) : NULL;
    }
    public function getThietBiCha()
    {
        return $this->id_thiet_bi_cha != NULL ? $this->hasOne(ThietBi::class, ['id' => 'id_thiet_bi_cha']) : '';
    }
    /**
     * Gets query for [[HangBaoHanh]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHangBaoHanh()
    {
        return $this->id_hang_bao_hanh != NULL ? $this->hasOne(DoiTac::class, ['id' => 'id_hang_bao_hanh']) : NULL;
    }
     /**
     * Gets query for [[ViTri]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getViTri()
    {
        return $this->id_vi_tri !=NULL ? $this->hasOne(ViTri::class, ['id' => 'id_vi_tri']) : NULL;
    }
    /**
     * Gets query for [[LoaiThietBi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHeThong()
    {
        return $this->id_he_thong != NULL ? $this->hasOne(HeThong::class, ['id' => 'id_he_thong']) : NULL;
    }
    /**
     * Gets query for [[BoPhanQuanLy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBoPhanQuanLy()
    {
        return $this->id_bo_phan_quan_ly !=NULL ? $this->hasOne(BoPhan::class, ['id' => 'id_bo_phan_quan_ly']) : '';
    }
    
    /**
     * Gets query for [[BoPhanBaoTri]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBoPhanBaoTri()
    {
        return $this->id_don_vi_bao_tri !=NULL ? $this->hasOne(BoPhan::class, ['id' => 'id_don_vi_bao_tri']) : '';
    }
    public function getTenNguoiQuanLy(){
        return $this->nguoiQuanLy != NULL ? $this->nguoiQuanLy->ten_nhan_vien : '';
    }
    public function getTenHangBaoHanh(){
        return $this->hangBaoHanh != NULL ? $this->hangBaoHanh->ten_doi_tac : '';
    }
    public function getTenBoPhanQuanLy(){
        return $this->boPhanQuanLy != NULL ? $this->boPhanQuanLy->ten_bo_phan : '';
    }
    public function getTenThietBiCha(){
        return $this->thietBiCha != NULL ? $this->thietBiCha->ten_thiet_bi : '';
    }
    public function getNguoiTao()
    {
        return $this->hasOne(User::class, ['id' => 'nguoi_tao']);
    }
    public function getNguoiCapNhat()
    {
        return $this->hasOne(User::class, ['id' => 'nguoi_cap_nhat']);
    }
    public function beforeSave($insert) {
        //ngaythangnam
        $cus = new CustomFunc();
        if ($this->isNewRecord) {
            $this->ngay_tao = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->id;

        }else{
            $this->ngay_cap_nhat = date('Y-m-d H:i:s');
            $this->nguoi_cap_nhat = Yii::$app->user->id;
            $cus = new CustomFunc();
            if($this->han_bao_hanh != null)
                $this->han_bao_hanh = $cus->convertDMYToYMD($this->han_bao_hanh);
        }
        
        
        
        return parent::beforeSave($insert);
    }
    /**
     * lay ten vi tri tu relation viTri
     * @return string
     */
    public function getTenViTri(){
        return $this->viTri != NULL ? $this->viTri->ten_vi_tri : '';
    }
    
    /**
     * lay ten he thong tu relation heThong
     * @return string
     */
    public function getTenHeThong(){
        return $this->heThong != NULL ? $this->heThong->ten_he_thong : '';
    }
    /**
     * lay ten bo phan bao tri tu relation boPhanQuanLy
     * @return string
     */
    public function getTenBoPhanBaoTri(){
        return $this->boPhanBaoTri != NULL ? $this->boPhanBaoTri->ten_bo_phan : '';
    }
}
