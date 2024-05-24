<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ts_tai_lieu".
 *
 * @property int $id
 * @property string $loai
 * @property int $id_tham_chieu
 * @property string|null $ten_tai_lieu
 * @property string|null $duong_dan
 * @property string|null $ten_file_luu
 * @property string|null $file_extension
 * @property float|null $file_size
 * @property string|null $ghi_chu
 * @property string $thoi_gian_tao
 * @property int|null $nguoi_tao
 */
class TsTaiLieu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_tai_lieu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['loai', 'id_tham_chieu', 'thoi_gian_tao'], 'required'],
            [['id_tham_chieu', 'nguoi_tao'], 'integer'],
            [['file_size'], 'number'],
            [['ghi_chu'], 'string'],
            [['thoi_gian_tao'], 'safe'],
            [['loai'], 'string', 'max' => 20],
            [['ten_tai_lieu', 'duong_dan', 'ten_file_luu'], 'string', 'max' => 255],
            [['file_extension'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'loai' => 'Loai',
            'id_tham_chieu' => 'Id Tham Chieu',
            'ten_tai_lieu' => 'Ten Tai Lieu',
            'duong_dan' => 'Duong Dan',
            'ten_file_luu' => 'Ten File Luu',
            'file_extension' => 'File Extension',
            'file_size' => 'File Size',
            'ghi_chu' => 'Ghi Chu',
            'thoi_gian_tao' => 'Thoi Gian Tao',
            'nguoi_tao' => 'Nguoi Tao',
        ];
    }
}
