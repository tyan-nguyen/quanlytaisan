<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ts_vi_tri".
 *
 * @property int $id
 * @property string $ma_vi_tri
 * @property string $ten_vi_tri
 * @property string|null $mo_ta
 * @property int|null $truc_thuoc
 * @property int|null $da_ngung_hoat_dong
 * @property string|null $ngay_ngung_hoat_dong
 * @property int|null $id_layout
 * @property string|null $toa_do_x
 * @property string|null $toa_do_y
 * @property string|null $thoi_gian_tao
 * @property int|null $nguoi_tao
 */
class TsViTri extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_vi_tri';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ma_vi_tri', 'ten_vi_tri'], 'required'],
            [['mo_ta'], 'string'],
            [['truc_thuoc', 'da_ngung_hoat_dong', 'id_layout', 'nguoi_tao'], 'integer'],
            [['ngay_ngung_hoat_dong', 'thoi_gian_tao'], 'safe'],
            [['ma_vi_tri'], 'string', 'max' => 20],
            [['ten_vi_tri'], 'string', 'max' => 255],
            [['toa_do_x', 'toa_do_y'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ma_vi_tri' => 'Ma Vi Tri',
            'ten_vi_tri' => 'Ten Vi Tri',
            'mo_ta' => 'Mo Ta',
            'truc_thuoc' => 'Truc Thuoc',
            'da_ngung_hoat_dong' => 'Da Ngung Hoat Dong',
            'ngay_ngung_hoat_dong' => 'Ngay Ngung Hoat Dong',
            'id_layout' => 'Id Layout',
            'toa_do_x' => 'Toa Do X',
            'toa_do_y' => 'Toa Do Y',
            'thoi_gian_tao' => 'Thoi Gian Tao',
            'nguoi_tao' => 'Nguoi Tao',
        ];
    }
}
