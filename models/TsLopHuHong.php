<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ts_lop_hu_hong".
 *
 * @property int $id
 * @property string $ma_lop
 * @property string $ten_lop
 * @property string $ngay_tao
 * @property int $nguoi_tao
 */
class TsLopHuHong extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_lop_hu_hong';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ma_lop', 'ten_lop', 'ngay_tao', 'nguoi_tao'], 'required'],
            [['ngay_tao'], 'safe'],
            [['nguoi_tao'], 'integer'],
            [['ma_lop'], 'string', 'max' => 50],
            [['ten_lop'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ma_lop' => 'Ma Lop',
            'ten_lop' => 'Ten Lop',
            'ngay_tao' => 'Ngay Tao',
            'nguoi_tao' => 'Nguoi Tao',
        ];
    }
}
