<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ts_he_thong".
 *
 * @property int $id
 * @property string $ma_he_thong
 * @property string $ten_he_thong
 * @property int|null $truc_thuoc
 * @property string|null $mo_ta
 * @property string|null $thoi_gian_tao
 * @property int|null $nguoi_tao
 */
class TsHeThong extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_he_thong';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ma_he_thong', 'ten_he_thong'], 'required'],
            [['truc_thuoc', 'nguoi_tao'], 'integer'],
            [['mo_ta'], 'string'],
            [['thoi_gian_tao'], 'safe'],
            [['ma_he_thong'], 'string', 'max' => 20],
            [['ten_he_thong'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ma_he_thong' => 'Ma He Thong',
            'ten_he_thong' => 'Ten He Thong',
            'truc_thuoc' => 'Truc Thuoc',
            'mo_ta' => 'Mo Ta',
            'thoi_gian_tao' => 'Thoi Gian Tao',
            'nguoi_tao' => 'Nguoi Tao',
        ];
    }
}
