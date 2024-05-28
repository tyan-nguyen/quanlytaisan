<?php

namespace app\modules\taisan\models;

use Yii;
use app\modules\dungchung\models\CustomFunc;
use app\widgets\views\StatusWithIconWidget;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class YeuCauVanHanh extends YeuCauVanHanhBase
{



    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
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

        if ($this->ngay_lap != null)
            $this->ngay_lap = $cus->convertDMYToYMD($this->ngay_lap);
        if ($this->ngay_duyet != null)
            $this->ngay_duyet = $cus->convertDMYToYMD($this->ngay_duyet);
        // if ($this->ngayDuyet != null)
        //     $this->ngayDuyet = $cus->convertDMYToYMD($this->ngayDuyet);
        // ngayDuyet


        if ($insert) {
            $this->hieu_luc = 'NHAP';
        }

        // if ($this->isNewRecord)
        //     $this->created_at = date('Y-m-d H:i:s');

        // $this->updated_at = date('Y-m-d H:i:s');
        //        if (parent::beforeSave($insert)) {
        //            if ($this->isNewRecord) {
        //                $this->created_at =date('Y-m-d H:i:s');
        //            }
        //            $this->updated_at = date('Y-m-d H:i:s');
        //            return true;
        //        }
        //        return false;

        return parent::beforeSave($insert);
    }
}
