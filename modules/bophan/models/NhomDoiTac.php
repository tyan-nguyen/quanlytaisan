<?php

namespace app\modules\bophan\models;

use Yii;
use yii\helpers\ArrayHelper;

class NhomDoiTac extends NhomDoiTacBase
{
    /**
     * lay danh sach tat ca doi tac
     * @return array
     */
     public static function getList(){
         $list = NhomDoiTac::find()->all();
         return ArrayHelper::map($list, 'id', 'ten_nhom');
     }
}