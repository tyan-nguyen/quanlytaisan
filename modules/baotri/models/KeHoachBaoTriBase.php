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
 * @property string|null $ngay_bao_tri_cuoi
 * @property int $bao_truoc
 * @property string|null $can_cu
 * @property int|null $so_ky
 * @property string|null $ky_bao_tri
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
  public function rules()
    {
        return [
            [['id_he_thong', 'id_thiet_bi', 'id_chi_tiet', 'id_loai_bao_tri', 'bao_truoc', 'so_ky', 'id_don_vi_bao_tri', 'id_nguoi_chiu_trach_nhiem', 'truc_thuoc', 'dung_may', 'thue_ngoai', 'da_het_hieu_luc', 'nguoi_tao'], 'integer'],
            [['id_thiet_bi', 'ten_cong_viec', 'id_loai_bao_tri', 'bao_truoc', 'id_don_vi_bao_tri', 'id_nguoi_chiu_trach_nhiem', 'muc_do_uu_tien'], 'required'],
            [['ngay_bao_tri_cuoi', 'ngay_thuc_hien', 'ngay_het_hieu_luc', 'thoi_gian_tao'], 'safe'],
            [['thoi_gian_thuc_hien'], 'number'],
            [['ten_cong_viec'], 'string', 'max' => 255],
            [['can_cu', 'ky_bao_tri', 'muc_do_uu_tien', 'don_vi_thoi_gian'], 'string', 'max' => 20],
            [['id_thiet_bi'], 'exist', 'skipOnError' => true, 'targetClass' => TsThietBi::class, 'targetAttribute' => ['id_thiet_bi' => 'id']],
            [['id_loai_bao_tri'], 'exist', 'skipOnError' => true, 'targetClass' => TsLoaiBaoTri::class, 'targetAttribute' => ['id_loai_bao_tri' => 'id']],
            [['id_don_vi_bao_tri'], 'exist', 'skipOnError' => true, 'targetClass' => TsBoPhan::class, 'targetAttribute' => ['id_don_vi_bao_tri' => 'id']],
            [['id_nguoi_chiu_trach_nhiem'], 'exist', 'skipOnError' => true, 'targetClass' => TsNhanVien::class, 'targetAttribute' => ['id_nguoi_chiu_trach_nhiem' => 'id']],
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
            'ngay_bao_tri_cuoi' => 'Ngày bảo trì cuối',
            'bao_truoc' => 'Báo trước',
            'can_cu' => 'Căn cứ',
            'so_ky' => 'Số kỳ',
            'ky_bao_tri' => 'Kỳ bảo trì',
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
     * {@inheritdoc}
     */
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->thoi_gian_tao = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->isGuest ? '' : Yii::$app->user->id;
        }
        $cus = new CustomFunc();
        if($this->ngay_bao_tri_cuoi != null)
            $this->ngay_bao_tri_cuoi = $cus->convertDMYToYMD($this->ngay_bao_tri_cuoi);
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
}
