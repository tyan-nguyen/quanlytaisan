<?php

namespace app\modules\suachua\models;

use Yii;

/**
 * This is the model class for table "ts_dm_tt_sua_chua".
 *
 * @property int $id
 * @property string $ten_tt_sua_chua
 * @property string|null $dien_thoai1
 * @property string|null $dien_thoai2
 * @property string|null $dia_chi
 * @property string|null $nguoi_lien_he
 * @property int|null $danh_gia
 *
 * @property TsPhieuSuaChua[] $tsPhieuSuaChuas
 */
class DmTTSuaChua extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_dm_tt_sua_chua';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten_tt_sua_chua'], 'required'],
            [['dia_chi'], 'string'],
            [['danh_gia'], 'integer'],
            [['ten_tt_sua_chua', 'dien_thoai1', 'dien_thoai2', 'nguoi_lien_he'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ten_tt_sua_chua' => 'Tên trung tâm sửa chữa',
            'dien_thoai1' => 'Điện thoại 1',
            'dien_thoai2' => 'Điện thoại 2',
            'dia_chi' => 'Địa chỉ',
            'nguoi_lien_he' => 'Tên người liên hệ',
            'danh_gia' => 'Đánh giá',
        ];
    }

    /**
     * Gets query for [[TsPhieuSuaChuas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTsPhieuSuaChuas()
    {
        return $this->hasMany(TsPhieuSuaChua::class, ['id_tt_sua_chua' => 'id']);
    }
}
