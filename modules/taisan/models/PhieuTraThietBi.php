<?php

namespace app\modules\taisan\models;

// use app\models\PhieuTraThietBiBase;
use Yii;
use app\modules\dungchung\models\CustomFunc;
use app\widgets\views\StatusWithIconWidget;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class PhieuTraThietBi extends PhieuTraThietBiBase
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
        // $cus = new CustomFunc();

        // if ($this->ngay_tra != null)
        //     $this->ngay_tra = $cus->convertDMYToYMD($this->ngay_tra);

        if ($insert) {
            $this->hieu_luc = 'NHAP';
            $this->nguoi_tao = Yii::$app->user->identity->id;
        }
        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($this->hieu_luc == 'DATRA') {  // Adjust the condition as needed
            $this->updateRequestStatus();
        }
    }

    protected function updateRequestStatus()
    {
        if ($this->id_yeu_cau_van_hanh) {
            $request = YeuCauVanHanh::findOne($this->id_yeu_cau_van_hanh);
            if ($request) {
                $request->hieu_luc = 'DATRA';
                $request->save(false);
            }
        }
    }
}
