<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ts_loai_thiet_bi".
 *
 * @property int $id
 * @property string $ma_loai
 * @property string $ten_loai
 * @property string|null $don_vi_tinh
 * @property int|null $truc_thuoc
 * @property string $loai_thiet_bi
 * @property string|null $ghi_chu
 * @property string|null $thoi_gian_tao
 * @property int|null $nguoi_tao
 *
 * @property TsThietBi[] $tsThietBis
 */
class TsLoaiThietBi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_loai_thiet_bi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ma_loai', 'ten_loai', 'loai_thiet_bi'], 'required'],
            [['truc_thuoc', 'nguoi_tao'], 'integer'],
            [['ghi_chu'], 'string'],
            [['thoi_gian_tao'], 'safe'],
            [['ma_loai', 'don_vi_tinh', 'loai_thiet_bi'], 'string', 'max' => 20],
            [['ten_loai'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ma_loai' => 'Ma Loai',
            'ten_loai' => 'Ten Loai',
            'don_vi_tinh' => 'Don Vi Tinh',
            'truc_thuoc' => 'Truc Thuoc',
            'loai_thiet_bi' => 'Loai Thiet Bi',
            'ghi_chu' => 'Ghi Chu',
            'thoi_gian_tao' => 'Thoi Gian Tao',
            'nguoi_tao' => 'Nguoi Tao',
        ];
    }

    /**
     * Gets query for [[TsThietBis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTsThietBis()
    {
        return $this->hasMany(TsThietBi::class, ['id_loai_thiet_bi' => 'id']);
    }
}
