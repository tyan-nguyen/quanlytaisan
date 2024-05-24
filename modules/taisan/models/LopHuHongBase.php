<?php

namespace app\modules\taisan\models;

use Yii;

class LopHuHongBase extends \app\models\TsLopHuHong
{
   
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
