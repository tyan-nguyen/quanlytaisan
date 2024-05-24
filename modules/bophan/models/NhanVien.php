<?php

namespace app\modules\bophan\models;

use Yii;
use app\modules\dungchung\models\CustomFunc;
use yii\helpers\ArrayHelper;

class NhanVien extends \app\modules\bophan\models\NhanVienBase
{
    /**
     * hien thi ngay vao lam dd/mm/yyyy
     * @return string
     */
    public function getNgayVaoLam(){
        $cus = new CustomFunc();
        return $cus->convertYMDToDMY($this->ngay_vao_lam);
    }
    
    /**
     * hien thi ngay thoi viec dd/mm/yyyy
     * @return string
     */
    public function getNgayThoiViec(){
        $cus = new CustomFunc();
        return $cus->convertYMDToDMY($this->ngay_thoi_viec);
    }
    
    /**
     * hien thi ten bo phan cua nhan vien
     * @return string
     */
    public function getTenBoPhan(){
        return $this->boPhan->ten_bo_phan;
    }
    
    /**
     * hien thi gioi tinh cua nhan vien
     * @return string
     */
    public function getGioiTinh(){
        return $this::getGioiTinhLabel($this->gioi_tinh);
    }
    
   /*  public static function getListThuocBoPhan($pid=NULL){
        //var_dump($pid);
        $list = null;
        $arr = array();
        if($pid != null){
            $list = NhanVien::find()->where(['id_bo_phan'=>$pid])->all();
        } else {
            $list = NhanVien::find()->all();
        }
        //return ArrayHelper::map($list, 'id', 'ten_nhan_vien');
        
        foreach ($list as $i=>$val){
            $arr[] = [$val->id, $val->ten_nhan_vien];
        }
        return $arr;
    } */
    
    /**
     * lay lien ket xem nhan vien tren modal tu modules khac
     * @return string
     */
    public function getShowLink(){
        return Yii::getAlias('@web/bophan/nhan-vien/view?id=' . $this->id);
    }
  
}