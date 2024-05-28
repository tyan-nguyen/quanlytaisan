<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ts_yeu_cau_van_hanh".
 *
 * @property int $id
 * @property int $id_nguoi_lap
 * @property int $id_nguoi_gui
 * @property int|null $id_nguoi_duyet
 * @property int|null $id_nguoi_xuat
 * @property int|null $id_nguoi_nhan
 * @property int|null $id_nguoi_yeu_cau
 * @property int|null $id_bo_phan
 * @property string|null $cong_trinh
 * @property string|null $ngay_lap
 * @property string|null $ngay_gui
 * @property string|null $ngay_duyet
 * @property string|null $ngay_xuat
 * @property string|null $ngay_nhan
 * @property string|null $ly_do
 * @property string|null $hieu_luc
 * @property string|null $noi_dung_lap
 * @property string|null $noi_dung_gui
 * @property string|null $noi_dung_duyet
 * @property string|null $noi_dung_xuat
 * @property string|null $noi_dung_nhan
 * @property string|null $dia_diem
 * @property string $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 */
class TsYeuCauVanHanh extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_yeu_cau_van_hanh';
    }
}
