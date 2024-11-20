<?php

namespace app\modules\taisan\models;

use app\modules\dungchung\models\CustomFunc;
use app\modules\taisan\models\PhieuTraThietBi;
use app\modules\taisan\models\ThietBi;
use Yii;

/**
 * This is the model class for table "ts_phieu_tra_thiet_bi_ct".
 *
 * @property int $id
 * @property int $id_thiet_bi
 * @property int $id_phieu_tra_thiet_bi
 * @property string|null $ngay_tra
 * @property string $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 * @property int $id_ycvhct
 * @property int $tra_khong_ve_kho
 */
class PhieuTraThietBiCtBase extends \app\models\TsPhieuTraThietBiCt
{

    const MODEL_ID = 'phieu-tra-thiet-bi-ct';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ycvhct', 'ngay_tra'], 'required'],
            [['id_thiet_bi', 'id_phieu_tra_thiet_bi', 'id_ycvhct', 'tra_khong_ve_kho'], 'integer'],
            [['ngay_tra', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['id_phieu_tra_thiet_bi'], 'exist', 'skipOnError' => true, 'targetClass' => PhieuTraThietBi::class, 'targetAttribute' => ['id_phieu_tra_thiet_bi' => 'id']],
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
            'id_phieu_tra_thiet_bi' => 'Phiếu trả thiết bị',
            'ngay_tra' => 'Ngày trả',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày cập nhật',
            'deleted_at' => 'Deleted At',
            'id_ycvhct'=>'Thiết bị',
            'tra_khong_ve_kho' => 'Trả thiết bị nhưng không chuyển về kho'
        ];
    }

    public function getThietBi()
    {
        return $this->hasOne(ThietBi::class, ['id' => 'id_thiet_bi']);
    }

    public function getPhieuTraThietBi()
    {
        return $this->hasOne(PhieuTraThietBi::className(), ['id' => 'id_phieu_tra_thiet_bi']);
    }
    
    public function getChiTietVanHanh()
    {
        return $this->hasOne(YeuCauVanHanhCt::className(), ['id' => 'id_ycvhct']);
    }
    
    public function getNgayTra()
    {
        $cus = new CustomFunc();
        return $cus->convertYMDToDMY($this->ngay_tra);
    }
}
