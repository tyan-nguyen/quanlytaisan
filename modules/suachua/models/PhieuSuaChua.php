<?php

namespace app\modules\suachua\models;

use Yii;
use app\modules\taisan\models\ThietBiBase;
use app\modules\suachua\models\DmTTSuaChua;
use app\modules\dungchung\models\CustomFunc;
use app\modules\user\models\User;
use app\modules\bophan\models\BoPhan;
use app\modules\kholuutru\models\DmVatTu;

/**
 * This is the model class for table "ts_phieu_sua_chua".
 *
 * @property int $id
 * @property int $id_thiet_bi
 * @property int $id_tt_sua_chua
 * @property string|null $ngay_sua_chua
 * @property string|null $ngay_du_kien_hoan_thanh
 * @property string|null $ngay_hoan_thanh
 * @property float|null $phi_linh_kien
 * @property float|null $phi_khac
 * @property float|null $tong_tien
 * @property string|null $trang_thai
 * @property string|null $ngay_tao
 * @property int|null $nguoi_tao
 * @property string|null $ngay_cap_nhat
 * @property int|null $nguoi_cap_nhat
 * @property string|null $ghi_chu1
 * @property string|null $ghi_chu2
 * @property int|null $danh_gia_sc
 *
 * @property TsThietBi $thietBi
 * @property TsBaoGiaSuaChua[] $tsBaoGiaSuaChuas
 * @property TsDmTtSuaChua $ttSuaChua
 */
class PhieuSuaChua extends \yii\db\ActiveRecord
{
    const MODEL_ID = 'phieu-sua-chua';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_phieu_sua_chua';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_thiet_bi', 'id_tt_sua_chua'], 'required'],
            [['id_thiet_bi', 'id_tt_sua_chua', 'nguoi_tao', 'nguoi_cap_nhat', 'danh_gia_sc','danh_gia_bg'], 'integer'],
            [['ngay_sua_chua', 'ngay_du_kien_hoan_thanh', 'ngay_hoan_thanh', 'ngay_tao', 'ngay_cap_nhat'], 'safe'],
            [['phi_linh_kien', 'phi_khac', 'tong_tien'], 'number'],
            [['ghi_chu1', 'ghi_chu2','dia_chi'], 'string'],
            [['trang_thai'], 'string', 'max' => 255],
            [['id_thiet_bi'], 'exist', 'skipOnError' => true, 'targetClass' => ThietBiBase::class, 'targetAttribute' => ['id_thiet_bi' => 'id']],
            [['id_tt_sua_chua'], 'exist', 'skipOnError' => true, 'targetClass' => BoPhan::class, 'targetAttribute' => ['id_tt_sua_chua' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_thiet_bi' => 'Thiết bị',
            'id_tt_sua_chua' => 'Trung tâm sửa chữa',
            'ngay_sua_chua' => 'Ngày sửa chữa',
            'ngay_du_kien_hoan_thanh' => 'Ngày dự kiến hoàn thành',
            'ngay_hoan_thanh' => 'Ngày hoàn thành',
            'phi_linh_kien' => 'Phí linh kiện',
            'phi_khac' => 'Phí khác',
            'tong_tien' => 'Tổng tiền',
            'trang_thai' => 'Trạng thái',
            'dia_chi' => 'Địa điểm',
            'ngay_tao' => 'Ngày tạo',
            'nguoi_tao' => 'Người tạo',
            'ngay_cap_nhat' => 'Ngày cập nhật',
            'nguoi_cap_nhat' => 'Người cập nhật',
            'ghi_chu1' => 'Tình trạng hư hỏng',
            'ghi_chu2' => 'Ghi chú 2',
            'danh_gia_sc' => 'Đánh giá sửa chữa',
            'danh_gia_bg' => 'Đánh giá đv báo giá'
        ];
    }

    /**
     * Gets query for [[ThietBi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getThietBi()
    {
        return $this->hasOne(ThietBiBase::class, ['id' => 'id_thiet_bi']);
    }

    /**
     * Gets query for [[TsBaoGiaSuaChuas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBaoGiaSuaChuas()
    {
        return $this->hasMany(BaoGiaSuaChua::class, ['id_phieu_sua_chua' => 'id']);
    }
    public function getVatTus()
    {
        return $this->hasMany(PhieuSuaChuaVatTu::class, ['id_phieu_sua_chua' => 'id'])->where(['trang_thai'=>'new']);
    }
    public function getVatTuHHs()
    {
        return $this->hasMany(PhieuSuaChuaVatTu::class, ['id_phieu_sua_chua' => 'id'])->where(['trang_thai'=>'damaged']);
    }
    public function getBaoGiaSuaChua()
    {
        return $this->hasOne(BaoGiaSuaChua::class, ['id_phieu_sua_chua' => 'id'])->where(["flag_index"=>0]);
    }
    public function getLichSuBaoGiaSuaChuas()
    {
        return $this->hasMany(BaoGiaSuaChua::class, ['id_phieu_sua_chua' => 'id'])->where(['flag_index'=>-1]);
    }
    public function getLichSuSuaChuas()
    {
        return $this->hasMany(PhieuSuaChua::class, ['id_thiet_bi' => 'id_thiet_bi'])->where(['<>','id',$this->id]);
    }
    /**
     * Gets query for [[TtSuaChua]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTtSuaChua()
    {
        return $this->hasOne(BoPhan::class, ['id' => 'id_tt_sua_chua']);
    }
    public function getDoiTac()
    {
        return $this->hasOne(DoiTac::class, ['id' => 'id_tt_sua_chua']);
    }
    public function beforeSave($insert) {
        //ngaythangnam
        $cus = new CustomFunc();
        if ($this->isNewRecord) {
            $this->ngay_tao = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->id;
            $this->trang_thai = "new";
            //mặc định khi tạo mới thì ngày hoàn thành bằng ngày dự kiến hoàn thành
            if($this->ngay_du_kien_hoan_thanh != null)
            $this->ngay_hoan_thanh = $cus->convertDMYToYMD($this->ngay_du_kien_hoan_thanh);

        }
        
        
        if($this->ngay_sua_chua != null)
            $this->ngay_sua_chua = $cus->convertDMYToYMD($this->ngay_sua_chua);
        if($this->ngay_du_kien_hoan_thanh != null)
            $this->ngay_du_kien_hoan_thanh = $cus->convertDMYToYMD($this->ngay_du_kien_hoan_thanh);
        if($this->ngay_hoan_thanh != null)
            $this->ngay_hoan_thanh = $cus->convertDMYToYMD($this->ngay_hoan_thanh);
        
        
        return parent::beforeSave($insert);
    }
    public function afterSave($insert,$changedAttributes) {

        if ($insert) {
            $thietBi=$this->thietBi;
            $thietBi->trang_thai=ThietBiBase::STATUS_SUACHUA;
            $thietBi->save();
        }
        elseif(isset($changedAttributes["trang_thai"]) && $changedAttributes["trang_thai"]!=$this->trang_thai && $this->trang_thai=="completed")
        {
            foreach($this->vatTus as $key=>$phieuSuaChuaVatTu)
            {
                $phieuSuaChuaVatTu->vatTu->so_luong=$phieuSuaChuaVatTu->vatTu->so_luong - $phieuSuaChuaVatTu->so_luong;
                $phieuSuaChuaVatTu->vatTu->ghiChuThayDoi="Sửa chữa thiết bị ".$phieuSuaChuaVatTu->phieuSuaChua->thietBi->ten_thiet_bi;
                $phieuSuaChuaVatTu->vatTu->save();
            }
            foreach($this->vatTuHHs as $key=>$phieuSuaChuaVatTu){
                $vatTu=new DmVatTu([
                    "ten_vat_tu"=>$phieuSuaChuaVatTu->ten_vat_tu,
                    "so_luong"=>$phieuSuaChuaVatTu->so_luong,
                    "don_vi_tinh"=>$phieuSuaChuaVatTu->don_vi_tinh,
                    "id_kho"=>$phieuSuaChuaVatTu->id_kho_luu_tru,
                    "hang_san_xuat"=>$phieuSuaChuaVatTu->hang_san_xuat,
                    "trang_thai"=>$phieuSuaChuaVatTu->trang_thai
                ]);
                $vatTu->save();
                $phieuSuaChuaVatTu->id_vat_tu=$vatTu->id;
                $phieuSuaChuaVatTu->save();
            }
            $thietBi=$this->thietBi;
            $thietBi->trang_thai=ThietBiBase::STATUS_HOATDONG;
            $thietBi->save();
        }
        if(isset($changedAttributes['danh_gia_sc']))
        {
            $avg=PhieuSuaChua::find()->where(['id_tt_sua_chua'=>$this->id_tt_sua_chua])->average('danh_gia_sc');
            $this->ttSuaChua->danh_gia=(int) $avg;
            $this->ttSuaChua->save();
            
        }
        if(isset($changedAttributes['danh_gia_bg']))
        {
            $avg=PhieuSuaChua::find()->where(['id_tt_sua_chua'=>$this->id_tt_sua_chua])->average('danh_gia_bg');
            $dvBaoGia=$this->baoGiaSuaChua->dvBaoGia;
            if($dvBaoGia)
            {
                $dvBaoGia->danh_gia=(int) $avg;
                $dvBaoGia->save();
            }
            
            
        }
        
        return parent::afterSave($insert,$changedAttributes);
    }
    public function beforeDelete(){
        /* if($this->vatTus){
            return false;
        } */
        /* $baoGia=$this->baoGiaSuaChua;
        if(isset($baoGia->trang_thai) && $baoGia->trang_thai=="approved"){
            //nếu trạng thái đã duyệt hoặc đã từ chói thì không lưu
            return false;
        } */
        //xóa báo giá sữa chửa
        
       /*  foreach($this->baoGiaSuaChuas as $key=>$bgSuaChua){
            $bgSuaChua->delete();
        } */
        //cập nhật lại status thiết bị trước khi xóa
        $thietBi=$this->thietBi;
        $thietBi->trang_thai=ThietBiBase::STATUS_HOATDONG;
        $thietBi->save();

        foreach($this->vatTus as $key=>$phieuSuaChuaVatTu)
        {
            $phieuSuaChuaVatTu->vatTu->so_luong=$phieuSuaChuaVatTu->vatTu->so_luong + $phieuSuaChuaVatTu->so_luong;
            $phieuSuaChuaVatTu->vatTu->ghiChuThayDoi="Sửa chữa thiết bị ".$this->thietBi->ten_thiet_bi;
            $phieuSuaChuaVatTu->vatTu->save();
        }

        return parent::beforeDelete();

    }
    
    public static function getDmTrangThai(){
        return [
            "new"=>'Mới',
            "processing"=>'Đang sửa chữa',
            "completed"=>"Hoàn thành"
        ];
    }
    public function getNguoiTao()
    {
        return $this->hasOne(User::class, ['id' => 'nguoi_tao']);
    }
    public function getNguoiCapNhat()
    {
        return $this->hasOne(User::class, ['id' => 'nguoi_cap_nhat']);
    }
    public function getDmDanhGia()
    {
        return [
            '1'=>'1 sao',
            '2'=>'2 sao'
        ];
    }
    
}
