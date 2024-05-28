<?php

namespace app\modules\taisan\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use app\modules\dungchung\models\CustomFunc;


class YeuCauVanHanhCt extends YeuCauVanHanhCtBase
{

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function beforeSave($insert)
    {

        $cus = new CustomFunc();

        if ($this->ngay_bat_dau != null)
            $this->ngay_bat_dau = $cus->convertDMYToYMD($this->ngay_bat_dau);
        // var_dump($this->ngay_bat_dau);

        if ($this->ngay_ket_thuc != null)
            $this->ngay_ket_thuc = $cus->convertDMYToYMD($this->ngay_ket_thuc);

        return parent::beforeSave($insert);
    }
}
