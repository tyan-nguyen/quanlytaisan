<?php

namespace app\modules\bophan\models;

use Yii;
use yii\helpers\ArrayHelper;

class DoiTac extends DoiTacBase
{
    /**
     * lay ten nhom doi tac qua relation
     * @return string
     */
    public function getTenNhomDoiTac(){
        return $this->nhomDoiTac->ten_nhom;
    }
    
    /**
     * lay model ds hang bao hanh
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getHangBaoHanh(){
        return DoiTac::find()->where(['la_nha_cung_cap'=>1])->orderBy('ID DESC')->all();
    }
    
    /**
     * get list hang bao hanh de fill combobox
     * @return array|mixed
     */
    public static function getHangBaoHanhList(){
        return ArrayHelper::map(DoiTac::getHangBaoHanh(), 'id', 'ten_doi_tac');
    }
    
}