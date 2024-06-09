<?php

namespace app\models;

use Yii;

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
class TsPhieuTraThietBi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_phieu_tra_thiet_bi';
    }
}
