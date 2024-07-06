<?php

namespace app\modules\bophan\models;

use Yii;

/**
 * This is the model class for table "ts_dm_dv_bao_gia".
 *
 * @property int $id
 * @property string $ten_don_vi
 * @property string|null $dien_thoai1
 * @property string|null $dien_thoai2
 * @property string|null $dia_chi
 * @property string|null $nguoi_lien_he
 * @property int|null $danh_gia
 */
class DmDvBaoGia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_dm_dv_bao_gia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten_don_vi'], 'required'],
            [['dia_chi'], 'string'],
            [['danh_gia'], 'integer'],
            [['ten_don_vi', 'dien_thoai1', 'dien_thoai2', 'nguoi_lien_he'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ten_don_vi' => 'Tên đơn vị',
            'dien_thoai1' => 'Điện thoại 1',
            'dien_thoai2' => 'Điện thoại 2',
            'dia_chi' => 'Địa chỉ',
            'nguoi_lien_he' => 'Người liên hệ',
            'danh_gia' => 'Đánh giá',
        ];
    }
}
