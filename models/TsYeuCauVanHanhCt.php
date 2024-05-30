<?php

namespace app\models;

use Yii;

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
 */
class TsYeuCauVanHanhCt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_yeu_cau_van_hanh_ct';
    }
}
