<?php

namespace app\modules\taisan\models;

use app\modules\baotri\models\KeHoachBaoTri;
use app\modules\bophan\models\NhanVien;
use app\modules\dungchung\models\History;
use app\modules\dungchung\models\DungChung;
use Yii;
use app\modules\bophan\models\DoiTac;
use app\modules\dungchung\models\CustomFunc;
use app\modules\bophan\models\BoPhan;

class ThietBiBase extends \app\models\TsThietBi
{
    const MODEL_ID = 'thiet-bi';
    const QR_FOLDER = '/uploads/qrlibs/';
    const STATUS_HOATDONG = 'HOATDONG';
    const STATUS_SUACHUA = 'SUACHUA';
    const STATUS_HONG = 'HONG';
    const STATUS_MAT = 'MAT';
    const STATUS_THANHLY = 'THANHLY';
    
    /**
     * Danh muc trang thai
     * @return string[]
     */
    public static function getDmTrangThai(){
        return [
            ThietBiBase::STATUS_HOATDONG=>'Đang hoạt động',
            ThietBiBase::STATUS_SUACHUA=>'Đang sửa chữa',
            ThietBiBase::STATUS_HONG=>'Đã hỏng',
            ThietBiBase::STATUS_MAT=>'Đã mất/Thất lạc',
            ThietBiBase::STATUS_THANHLY=>'Đã thanh lý'
        ];
    }
    
    /**
     * Danh muc trang thai label
     * @param int $val
     * @return string
     */
    public function getTenTrangThai($val=NULL){
        if($val==NULL){
            $val = $this->trang_thai;
        }
        switch ($val){
            case ThietBiBase::STATUS_HOATDONG:
                $label = "Đang hoạt động";
                break;
            case ThietBiBase::STATUS_SUACHUA:
                $label = "Đang sửa chữa";
                break;
            case ThietBiBase::STATUS_HONG:
                $label = "Đã hỏng";
                break;
            case ThietBiBase::STATUS_MAT:
                $label = "Đã mất/Thất lạc";
                break;
            case ThietBiBase::STATUS_THANHLY:
                $label = "Đã thanh lý";
                break;
            default:
                $label = '';
        }
        return $label;
    }
    
    public function rules()
    {
        return [
            [['ma_thiet_bi', 'id_loai_thiet_bi', 'id_bo_phan_quan_ly', 'ten_thiet_bi', 'id_nguoi_quan_ly'], 'required'],
            [['id_vi_tri', 'id_he_thong', 'id_bo_phan_quan_ly', 'id_thiet_bi_cha', 'id_layout', 'id_hang_bao_hanh', 'id_nhien_lieu', 'id_lop_hu_hong', 'id_trung_tam_chi_phi', 'id_don_vi_bao_tri', 'id_nguoi_quan_ly', 'nguoi_tao'], 'integer'],
            [['dac_tinh_ky_thuat', 'ghi_chu'], 'string'],
            [['ngay_mua', 'han_bao_hanh', 'ngay_dua_vao_su_dung', 'ngay_ngung_hoat_dong', 'thoi_gian_tao'], 'safe'],
            [['ma_thiet_bi', 'nam_san_xuat', 'trang_thai'], 'string', 'max' => 20],
            [['autoid', 'ten_thiet_bi', 'serial', 'model'], 'string', 'max' => 255],
            [['xuat_xu'], 'string', 'max' => 100],
            [['autoid'], 'unique'],
            [['id_loai_thiet_bi'], 'exist', 'skipOnError' => true, 'targetClass' => LoaiThietBi::class, 'targetAttribute' => ['id_loai_thiet_bi' => 'id']],
            [['id_bo_phan_quan_ly'], 'exist', 'skipOnError' => true, 'targetClass' => BoPhan::class, 'targetAttribute' => ['id_bo_phan_quan_ly' => 'id']],
            [['id_nguoi_quan_ly'], 'exist', 'skipOnError' => true, 'targetClass' => NhanVien::class, 'targetAttribute' => ['id_nguoi_quan_ly' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'autoid'=>'Mã tự động',
            'ma_thiet_bi' => 'Mã thiết bị',//*
            'id_vi_tri' => 'Vị trí',//*
            'id_he_thong' => 'Hệ thống',//*
            'id_loai_thiet_bi' => 'Loại thiết bị',//*
            'id_bo_phan_quan_ly' => 'Bộ phận quản lý',//*
            'ten_thiet_bi' => 'Tên thiết bị',//*
            'id_thiet_bi_cha' => 'Thiết bị cha',//*
            'id_layout' => 'Layout',
            'nam_san_xuat' => 'Năm sản xuất',//*
            'serial' => 'Serial',//*
            'model' => 'Model',//*
            'xuat_xu' => 'Xuất xứ',//*
            'id_hang_bao_hanh' => 'Bảo hành',//*
            'id_nhien_lieu' => 'Nhiên liệu',
            'dac_tinh_ky_thuat' => 'Đặc tính kỹ thuật',//*
            'id_lop_hu_hong' => 'Lớp hư hõng',
            'id_trung_tam_chi_phi' => 'Trung tâm chi phí',
            'id_don_vi_bao_tri' => 'Đơn vị bảo trì',//*
            'id_nguoi_quan_ly' => 'Người quản lý',//*
            'ngay_mua' => 'Ngày mua',//*
            'han_bao_hanh' => 'Hạn bảo hành',//*
            'ngay_dua_vao_su_dung' => 'Ngày đưa vào sử dụng',//*
            'trang_thai' => 'Trạng thái',//*
            'ngay_ngung_hoat_dong' => 'Ngày ngưng hoạt động',//*
            'ghi_chu' => 'Ghi chú',//*
            'thoi_gian_tao' => 'Thời gian tạo',
            'nguoi_tao' => 'Người tạo',
        ];
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
    
    /**
     * Gets query for [[TrungTamChiPhi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrungTamChiPhi()
    {
        return $this->id_trung_tam_chi_phi !=NULL ? $this->hasOne(BoPhan::class, ['id' => 'id_trung_tam_chi_phi']) : '';
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
     * Gets query for [[LoaiThietBi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLoaiThietBi()
    {
        return $this->hasOne(LoaiThietBi::class, ['id' => 'id_loai_thiet_bi']);
        //return $this->id_loai_thiet_bi != NULL ? $this->hasOne(LoaiThietBi::class, ['id' => 'id_loai_thiet_bi']) : NULL;
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
     * Gets query for [[NguoiQuanLy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNguoiQuanLy()
    {
        return $this->id_nguoi_quan_ly !=NULL ? $this->hasOne(NhanVien::class, ['id' => 'id_nguoi_quan_ly']) : NULL;
    }

    /**
     * Gets query for [[TsKeHoachBaoTris]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTsKeHoachBaoTris()
    {
        return $this->hasMany(KeHoachBaoTri::class, ['id_thiet_bi' => 'id']);
    }
    
    public function getThietBiCha()
    {
        return $this->id_thiet_bi_cha != NULL ? $this->hasOne(ThietBi::class, ['id' => 'id_thiet_bi_cha']) : '';
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->thoi_gian_tao = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->id;
        }
        //neu la record moi hoac du lieu cu chua co autoid
        if($this->autoid == null){
            //$this->autoid = md5(Yii::$app->user->id . date('Y-m-d H:i:s'));
            $this->autoid = chr(rand(97,122)) . Yii::$app->user->id . strtotime(date('Y-m-d H:i:s'));
        }
        //ngaythangnam
        $cus = new CustomFunc();
        if($this->ngay_ngung_hoat_dong != null)
            $this->ngay_ngung_hoat_dong = $cus->convertDMYToYMD($this->ngay_ngung_hoat_dong);
        if($this->han_bao_hanh != null)
            $this->han_bao_hanh = $cus->convertDMYToYMD($this->han_bao_hanh);
        if($this->ngay_mua != null)
            $this->ngay_mua = $cus->convertDMYToYMD($this->ngay_mua);
        if($this->ngay_dua_vao_su_dung != null)
            $this->ngay_dua_vao_su_dung = $cus->convertDMYToYMD($this->ngay_dua_vao_su_dung);
        
        return parent::beforeSave($insert);
    }
    
    /**
     * {@inheritdoc}
     */
    public function afterSave( $insert, $changedAttributes ){
        parent::afterSave($insert, $changedAttributes);
        //create qr code
        DungChung::createQRcode($this::QR_FOLDER, $this->autoid);
        //create history
        History::addHistory($this::MODEL_ID, $changedAttributes, $this, $insert);
    }
    
    /**
     * xoa file QR code
     */
    private function deleleQr(){
        $filePath = Yii::getAlias('@webroot') . $this::QR_FOLDER . $this->autoid . '.png';
        if(file_exists($filePath)){
            unlink($filePath);
        }
    }
     /**
     * {@inheritdoc}
     * xoa file anh, tai lieu, lich su sau khi xoa du lieu
     */
    public function afterDelete()
    {
        //xoa tham chieu
        DungChung::xoaThamChieu($this::MODEL_ID, $this->id);
        //xoa qr
        $this->deleleQr();
        
        return parent::afterDelete();
    }
}
