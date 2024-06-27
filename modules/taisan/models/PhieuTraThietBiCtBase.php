<?php

namespace app\modules\taisan\models;

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
            [['id_thiet_bi'], 'required'],
            [['id_thiet_bi', 'id_phieu_tra_thiet_bi'], 'integer'],
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
        ];
    }

    public function getThietBi()
    {
        return $this->hasOne(ThietBi::class, ['id' => 'id_thiet_bi']);
    }
}
