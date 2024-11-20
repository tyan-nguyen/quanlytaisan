<?php

namespace app\modules\taisan\models;

use app\modules\taisan\models\PhieuTraThietBiCtBase;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use app\modules\dungchung\models\CustomFunc;



class PhieuTraThietBiCt extends PhieuTraThietBiCtBase
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

        if ($this->ngay_tra != null)
            $this->ngay_tra = $cus->convertDMYToYMD($this->ngay_tra);
        
        if($this->id_ycvhct){
            $ycvhct = YeuCauVanHanhCt::findOne($this->id_ycvhct);
            if($ycvhct){
                $this->id_thiet_bi = $ycvhct->id_thiet_bi;
            } else {
                $this->id_ycvhct = NULL;
            }
        }
        if ($insert) {
            if($this->tra_khong_ve_kho == null)
                $this->tra_khong_ve_kho == 0;
        }
        

        return parent::beforeSave($insert);
    }
}
