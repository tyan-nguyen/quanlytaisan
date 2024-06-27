<?php

namespace app\modules\baotri\models;

use app\modules\bophan\models\BoPhan;
use app\modules\bophan\models\NhanVien;
use app\modules\dungchung\models\History;
use app\modules\taisan\models\HeThong;
use app\modules\taisan\models\ThietBi;
use app\modules\dungchung\models\CustomFunc;
use Yii;

/**
 * This is the model class for table "ts_ke_hoach_bao_tri".
 *
 * @property int $id
 * @property int|null $id_he_thong
 * @property int $id_thiet_bi
 * @property int|null $id_chi_tiet
 * @property string $ten_cong_viec
 * @property int $id_loai_bao_tri
 * @property string|null $ngay_bat_dau
 * @property int $bao_truoc
 * @property string|null $can_cu
 * @property int|null $so_ky
 * @property string|null $ky_bao_tri
 * @property int|null $tan_suat
 * @property int $id_don_vi_bao_tri
 * @property int $id_nguoi_chiu_trach_nhiem
 * @property string $muc_do_uu_tien
 * @property int|null $truc_thuoc
 * @property string|null $ngay_thuc_hien
 * @property float|null $thoi_gian_thuc_hien
 * @property string|null $don_vi_thoi_gian
 * @property int|null $dung_may
 * @property int|null $thue_ngoai
 * @property int|null $da_het_hieu_luc
 * @property string|null $ngay_het_hieu_luc
 * @property string|null $thoi_gian_tao
 * @property int|null $nguoi_tao
 *
 * @property TsBoPhan $donViBaoTri
 * @property TsLoaiBaoTri $loaiBaoTri
 * @property TsNhanVien $nguoiChiuTrachNhiem
 * @property TsThietBi $thietBi
 */
class KeHoachBaoTriBase extends \app\models\TsKeHoachBaoTri
{
   const MODEL_ID = "baotri";
   var $denNgay=null;
   
   /**
    * {@inheritdoc}
    */
   public function rules()
   {
       return [
           [['id_he_thong', 'id_thiet_bi', 'id_chi_tiet', 'id_loai_bao_tri', 'bao_truoc', 'so_ky', 'tan_suat', 'id_don_vi_bao_tri', 'id_nguoi_chiu_trach_nhiem', 'truc_thuoc', 'dung_may', 'thue_ngoai', 'da_het_hieu_luc', 'nguoi_tao'], 'integer'],
           [['id_thiet_bi', 'ten_cong_viec', 'id_loai_bao_tri', 'id_don_vi_bao_tri', 'id_nguoi_chiu_trach_nhiem', 'muc_do_uu_tien', 'so_ky', 'ky_bao_tri', 'tan_suat'], 'required'],
           [['ngay_bat_dau', 'ngay_het_hieu_luc', 'thoi_gian_tao', 'ngay_thuc_hien'], 'safe'],
           [['thoi_gian_thuc_hien'], 'number'],
           [['ten_cong_viec'], 'string', 'max' => 255],
           [['can_cu', 'ky_bao_tri', 'muc_do_uu_tien', 'don_vi_thoi_gian'], 'string', 'max' => 20],
           [['id_thiet_bi'], 'exist', 'skipOnError' => true, 'targetClass' => ThietBi::class, 'targetAttribute' => ['id_thiet_bi' => 'id']],
           [['id_loai_bao_tri'], 'exist', 'skipOnError' => true, 'targetClass' => LoaiBaoTri::class, 'targetAttribute' => ['id_loai_bao_tri' => 'id']],
           [['id_don_vi_bao_tri'], 'exist', 'skipOnError' => true, 'targetClass' => BoPhan::class, 'targetAttribute' => ['id_don_vi_bao_tri' => 'id']],
           [['id_nguoi_chiu_trach_nhiem'], 'exist', 'skipOnError' => true, 'targetClass' => NhanVien::class, 'targetAttribute' => ['id_nguoi_chiu_trach_nhiem' => 'id']],
       ];
   }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_he_thong' => 'Hệ thống',
            'id_thiet_bi' => 'Thiết bị',
            'id_chi_tiet' => 'Chi tiết',
            'ten_cong_viec' => 'Tên công việc',
            'id_loai_bao_tri' => 'Loại bảo trì',
            'ngay_bat_dau' => 'Ngày bắt đầu',
            'bao_truoc' => 'Báo trước',
            'can_cu' => 'Căn cứ',
            'so_ky' => 'Số kỳ',
            'ky_bao_tri' => 'Kỳ bảo trì',
            'tan_suat' => 'Tần suất',
            'id_don_vi_bao_tri' => 'Đơn vị bảo trì',
            'id_nguoi_chiu_trach_nhiem' => 'Người chịu trách nhiệm',
            'muc_do_uu_tien' => 'Mức độ ưu tiên',
            'truc_thuoc' => 'Trực thuộc',
            'ngay_thuc_hien' => 'Ngày thực hiện',
            'denNgay'=>'Đến ngày thực hiện',
            'thoi_gian_thuc_hien' => 'Thời gian thực hiện',
            'don_vi_thoi_gian' => 'Đơn vị thời gian',
            'dung_may' => 'Dừng máy',
            'thue_ngoai' => 'Thuê ngoài',
            'da_het_hieu_luc' => 'Đã hết hiệu lực',
            'ngay_het_hieu_luc' => 'Ngày hết hiệu lực',
            'thoi_gian_tao' => 'Thoi Gian Tao',
            'nguoi_tao' => 'Nguoi Tao',
        ];
    }

    /**
     * Gets query for [[DonViBaoTri]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDonViBaoTri()
    {
        return $this->hasOne(BoPhan::class, ['id' => 'id_don_vi_bao_tri']);
    }

    /**
     * Gets query for [[LoaiBaoTri]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLoaiBaoTri()
    {
        return $this->hasOne(LoaiBaoTri::class, ['id' => 'id_loai_bao_tri']);
    }

    /**
     * Gets query for [[NguoiChiuTrachNhiem]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNguoiChiuTrachNhiem()
    {
        return $this->hasOne(NhanVien::class, ['id' => 'id_nguoi_chiu_trach_nhiem']);
    }

    /**
     * Gets query for [[ThietBi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getThietBi()
    {
        return $this->hasOne(ThietBi::class, ['id' => 'id_thiet_bi']);
    }
    
    /**
     * Gets query for [[TsThietBis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhieuBaoTris()
    {
        return $this->hasMany(PhieuBaoTri::class, ['id_ke_hoach' => 'id']);
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
        if($this->ngay_bat_dau != null)
            $this->ngay_bat_dau = $cus->convertDMYToYMD($this->ngay_bat_dau);
        if($this->ngay_thuc_hien != null)
            $this->ngay_thuc_hien = $cus->convertDMYToYMD($this->ngay_thuc_hien);
        if($this->ngay_het_hieu_luc != null)
            $this->ngay_het_hieu_luc = $cus->convertDMYToYMD($this->ngay_het_hieu_luc);
        
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
     * tao phieu bao tri tu dong
     */
    public function taoPhieuBaoTri(){
        $soKy = $this->so_ky;
        $ngayBatDau = '';
        $ngayKetThuc = '';
        $ngayBaoTriTruoc = '';
        $err = false;
        for($i=1;$i<=$soKy;$i++){
            //tinh ngay thuc hien
            if($i>1){
                $ngayBatDau = KeHoachBaoTri::tinhNgayBaoTriKeTiep($ngayBaoTriTruoc, $this->ky_bao_tri, $this->tan_suat);
            } else {
                $ngayBatDau = $this->ngay_bat_dau;
            }
            $ngayBaoTriTruoc = $ngayBatDau;//dùng cho vòng lặp tiếp theo
            //tinh $ngayKetThuc
            //... tam thoi cho tự nhập vào phiếu lúc thực hiện xong         
            
            $phieuBaoTri = new PhieuBaoTri();
            $phieuBaoTri->id_ke_hoach = $this->id;
            $phieuBaoTri->ky_thu = $i;
            $phieuBaoTri->id_don_vi_bao_tri = $this->id_don_vi_bao_tri;
            $phieuBaoTri->id_nguoi_chiu_trach_nhiem = $this->id_nguoi_chiu_trach_nhiem;
            $phieuBaoTri->thoi_gian_bat_dau = $ngayBatDau;
            $phieuBaoTri->thoi_gian_ket_thuc = $ngayKetThuc;
            $phieuBaoTri->noi_dung_thuc_hien = '';
            if($phieuBaoTri->save()){
                
            } else {
                $err = true;
            }
        }
            
        return $err==false? true : false;
    }
}
