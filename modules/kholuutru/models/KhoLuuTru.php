<?php

namespace app\modules\kholuutru\models;

use Yii;
use yii\helpers\ArrayHelper;

class KhoLuuTru extends KhoLuuTruBase
{
    /**
     * lay danh sach kho luu tru
     * @return array
     */
    public static function getList(){
        $list = KhoLuuTru::find()->all();
        return ArrayHelper::map($list, 'id', 'ten_kho');
    }
    
    /**
     * lay ten loai kho
     * @return string
     */
    public function getTenLoaiKho(){
        return $this->getLoaiKhoLabel($this->loai_kho);
    }
    
    /**
     * lay ten nguoi quan ly
     * @return string
     */
    public function getTenNguoiQuanLy(){
        return $this->nguoiQuanLy!=NULL?$this->nguoiQuanLy->ten_nhan_vien:'';
    }
    
    /**
     * lay ten bo phan quan ly
     * @return string
     */
    public function getTenBoPhanQuanLy(){
        return $this->boPhanQuanLy!=NULL?$this->boPhanQuanLy->ten_bo_phan:'';
    }
}