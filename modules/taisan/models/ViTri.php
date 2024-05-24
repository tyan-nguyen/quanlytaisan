<?php

namespace app\modules\taisan\models;

use Yii;
use app\modules\dungchung\models\CustomFunc;

class ViTri extends ViTriBase
{
    public $arr;//use in getListTree
    public $parr;//use in getListTree
    
    /**
     * lay thong tin he thong truc thuoc
     * @return string
     */
    public function getTenViTriTrucThuoc(){
        return $this->viTriTrucThuoc !=null ? $this->viTriTrucThuoc->ten_vi_tri : '';
    }   
    
    /**
     * hien thi ngay ngung hoat dong dd/mm/yyyy
     * @return string
     */
    public function getNgayNgungHoatDong(){
        $cus = new CustomFunc();
        return $cus->convertYMDToDMY($this->ngay_ngung_hoat_dong);
    }
    
    /**
     * ham de quy lay danh sach vi tri con truc thuoc (xu ly cho getListTree)
     * @param array $arr
     * @param int $pid
     * @param int $level
     */
    private function getChild($arr, $pid, $level){
        $left = $level . '---';
        $listChildCatalogs = $this::find()->where(['truc_thuoc'=>$pid])->all();
        if($listChildCatalogs != null){
            foreach ($listChildCatalogs as $j=>$catalog1){
                $this->arr[$catalog1->id] = $left . ' ' .$catalog1->ten_vi_tri;
                $this->getChild($this->arr, $catalog1->id, $left);
            }
        }
    }
    
    /**
     * hien thi danh sach vi tri theo phan cap cha-con
     * @param boolean $withGroup
     * @return array
     */
    public function getListTree($withGroup=true)
    {
        if($withGroup==true)
            $this->parr = array();
            $this->arr = array();
            //lay ds catalog parent
            $parentCatalogs = $this::find()->where('truc_thuoc IS NULL OR truc_thuoc = 0')->all();
            foreach ($parentCatalogs as $indexCatalog=>$catalog){
                if($withGroup==true)
                    $this->arr = array();
                    $this->arr[$catalog->id] = $catalog->ten_vi_tri;
                    $this->getChild($this->arr, $catalog->id, '');
                    if($withGroup==true)
                        $this->parr[$catalog->ten_vi_tri] = $this->arr;
            }
            if($withGroup==true)
                return $this->parr;
                else
                    return $this->arr;
    }
}
