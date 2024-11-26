<?php

namespace app\modules\taisan\models;


use Yii;
use app\modules\dungchung\models\CustomFunc;
use app\modules\taisan\models\ThietBi;


/**
 * This is the model class for table "ts_yeu_cau_van_hanh_ct".
 *
 * @property int $id
 * @property int $id_thiet_bi
 * @property int $id_yeu_cau_van_hanh
 * @property string|null $ngay_bat_dau
 * @property string|null $ngay_ket_thuc
 * @property string $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $id_ycvhct_chuyen
 * @property string|null $loai_van_hanh
 */
class YeuCauVanHanhCtBase extends \app\models\TsYeuCauVanHanhCt
{
    const MODEL_ID = 'yeu-cau-van-hanh-ct';
    const TYPE_VH_NEW = 'VH_MOI';
    const TYPE_VH_FORWARD = 'VH_CHUYEN_TIEP';
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['id_thiet_bi'],
                'required'
            ],
            [
                ['id_thiet_bi', 'id_yeu_cau_van_hanh', 'id_ycvhct_chuyen'],
                'integer'
            ],
            [
                ['ngay_bat_dau', 'ngay_ket_thuc', 'created_at', 'updated_at', 'deleted_at'],
                'safe'
            ],
            [['loai_van_hanh'], 'string', 'max' => 20],
            [['id_yeu_cau_van_hanh'], 'exist', 'skipOnError' => true, 'targetClass' => YeuCauVanHanh::class, 'targetAttribute' => ['id_yeu_cau_van_hanh' => 'id']],
            [['id_thiet_bi'], 'exist', 'skipOnError' => true, 'targetClass' => ThietBi::class, 'targetAttribute' => ['id_thiet_bi' => 'id']],

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
            'id_yeu_cau_van_hanh' => 'Yêu cầu vận hành',
            'ngay_bat_dau' => 'Ngày bắt đầu',
            'ngay_ket_thuc' => 'Ngày kết thúc',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày cập nhật',
            'deleted_at' => 'Deleted At',
            'id_ycvhct_chuyen' => 'ID Yêu cầu chuyển',
            'loai_van_hanh' => 'Loại vận hành',
        ];
    }

    public function getThietBi()
    {
        return $this->hasOne(ThietBi::class, ['id' => 'id_thiet_bi']);
    }

    public function getNgayBatDau(){
        $cus = new CustomFunc();
        return $cus->convertYMDToDMY($this->ngay_bat_dau);
    }
    public function getNgayKetThuc(){
        $cus = new CustomFunc();
        return $cus->convertYMDToDMY($this->ngay_ket_thuc);
    }

    public function getYeuCauVanHanh()
    {
        return $this->hasOne(YeuCauVanHanh::class, ['id' => 'id_yeu_cau_van_hanh']);
    }
    
    public function getYcvhctChuyen()
    {
        if($this->id_ycvhct_chuyen != null)
            return $this->hasOne(YeuCauVanHanhCt::class, ['id' => 'id_ycvhct_chuyen']);
        else 
            return null;
    }
    
    public function getPhieuTraThietBiChiTiet()
    {
        return PhieuTraThietBiCt::findOne(['id_ycvhct'=>$this->id]);
        //return $this->hasMany(PhieuTraThietBiCt::class, ['id_ycvhct' => 'id']);
    }
    
    /**
     * hiển thị label cho loại phiếu
     */
    public function getLoaiVanHanh(){
        switch ($this->loai_van_hanh) {
            case self::TYPE_VH_NEW:
                $label = "Vận hành mới";
                break;
            case self::TYPE_VH_FORWARD:
                $label = "Vận hành chuyển tiếp";
                break;
            default:
                $label = '';
        }
        return $label;
    }
    /**
     * hiển thị label cho loại phiếu with Badge
     */
    public function getLoaiVanHanhWithBadge(){
        switch ($this->loai_van_hanh) {
            case self::TYPE_VH_NEW:
                $label = '<span class="badge bg-primary">Vận hành mới</span>';
                break;
            case self::TYPE_VH_FORWARD:
                $label = '<span class="badge bg-secondary">Vận hành chuyển tiếp</span>';
                break;
            default:
                $label = '';
        }
        return $label;
    }
    
}
