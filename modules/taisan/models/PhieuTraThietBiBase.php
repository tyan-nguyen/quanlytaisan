<?php

namespace app\modules\taisan\models;

use app\modules\bophan\models\NhanVien;
use Yii;
use app\modules\dungchung\models\DungChung;
use app\modules\dungchung\models\CustomFunc;
use app\modules\taisan\models\PhieuTraThietBiCt;
use app\widgets\views\StatusWithIconWidget;

/**
 * This is the model class for table "ts_phieu_tra_thiet_bi".
 *
 * @property int $id
 * @property int $id_nguoi_tra
 * @property string|null $noi_dung_tra
 * @property string $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 */
class PhieuTraThietBiBase extends \app\models\TsPhieuTraThietBi
{
    const MODEL_ID = 'phieu-tra-thiet-bi';
    const STATUS_NHAP = 'NHAP';
    const STATUS_DATRA = 'DATRA';

    public static function getDmHieuLuc()
    {
        return [
            PhieuTraThietBiBase::STATUS_NHAP => 'Nháp',
            PhieuTraThietBiBase::STATUS_DATRA => 'Đã trả',
        ];
    }

    public function getTenHieuLucWithBadge($val = NULL)
    {
        if ($val == NULL) {
            $val = $this->hieu_luc;
        }
        switch ($val) {
            case "NHAP":
                $label = "Nháp";
                $icon = 'fe fe-file';
                $type = 'default';
                break;

            case "DATRA":
                $label = "Đã trả";
                $icon = 'fe fe-send';
                $type = 'primary';
                break;
            default:
                $label = '';
        }
        return $label != '' ? StatusWithIconWidget::widget([
            'label' => $label,
            'icon' => $icon,
            'type' => $type
        ]) : '';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_nguoi_tra'], 'required'],
            [['id_nguoi_tra'], 'integer'],
            [['id_nguoi_nhan'], 'integer'],
            [
                ['created_at', 'updated_at', 'deleted_at', 'noi_dung_tra'],
                'safe'
            ],
            [['noi_dung_tra', 'hieu_luc'], 'string', 'max' => 255],
            [['id_nguoi_tra'], 'exist', 'skipOnError' => true, 'targetClass' => NhanVien::class, 'targetAttribute' => ['id_nguoi_tra' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_nguoi_tra' => 'Người trả',
            'id_nguoi_nhan' => 'Người nhận',
            'noi_dung_tra' => 'Nội dung trả',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày cập nhật',
            'deleted_at' => 'Ngày xóa',
        ];
    }


    /**
     * Relation 
     */

    public function getNguoiTra()
    {
        return $this->id_nguoi_tra != NULL ? $this->hasOne(NhanVien::class, ['id' => 'id_nguoi_tra']) : NULL;
    }

    public function getNguoiNhan()
    {
        return $this->id_nguoi_nhan != NULL ? $this->hasOne(NhanVien::class, ['id' => 'id_nguoi_nhan']) : NULL;
    }

    public function getCreatedAt()
    {
        $cus = new CustomFunc();
        return $cus->convertYMDToDMY($this->created_at);
    }

  

    public function getDetails()
    {
        return $this->hasMany(PhieuTraThietBiCt::className(), ['id_phieu_tra_thiet_bi' => 'id']);
    }
}
