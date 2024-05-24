<?php
namespace app\modules\user\models;

use app\modules\taisan\models\ThietBi;
use app\modules\taisan\models\LoaiThietBi;

class Dashboard{
    /**
     * sum so luong tai san dang hoat dong
     * @return number|string|NULL
     */
    public function getSumTaiSanDangHoatDong(){
       return ThietBi::find()->where([
           'trang_thai'=>ThietBi::STATUS_HOATDONG
       ])->count();
    }
    
    /**
     * sum so luong tai san dang sua chua
     * @return number|string|NULL
     */
    public function getSumTaiSanDangSuaChua(){
        return ThietBi::find()->where([
            'trang_thai'=>ThietBi::STATUS_SUACHUA
        ])->count();
    }
    
    /**
     * sum so luong tai san da hong
     * @return number|string|NULL
     */
    public function getSumTaiSanDaHong(){
        return ThietBi::find()->where([
            'trang_thai'=>ThietBi::STATUS_HONG
        ])->count();
    }
    
    /**
     * get so luong dang hoat dong theo loai thiet bi
     * @param string $type
     * @return number|string|NULL
     */
    public function getSumLoaiThietBiDangHoatDong($type){
        return ThietBi::find()->alias('t')->joinWith([
            'loaiThietBi as ltb'
        ])->where([
            'ltb.loai_thiet_bi'=>$type,
            't.trang_thai'=>ThietBi::STATUS_HOATDONG
        ])->count();
    }
    
    /**
     * get list to add box-thongke in dashboard
     * @return array
     */
    public function getListTaiSanPercent(){
        $tsModel = new ThietBi();
        $arr = array();
        $tsActive = $this->getSumTaiSanDangHoatDong();
        $tsRepair = $this->getSumTaiSanDangSuaChua();
        $tsBroken = $this->getSumTaiSanDaHong();
        $sum = $tsActive + $tsRepair + $tsBroken;
        
        $arr[] = ['label'=>$tsModel->getTenTrangThai(ThietBi::STATUS_HOATDONG), 'sum'=>$tsActive, 'percent'=>($sum>0?(round($tsActive/$sum,4)*100): 0) . '%', 'color'=>'#17b794'];
        $arr[] = ['label'=>$tsModel->getTenTrangThai(ThietBi::STATUS_SUACHUA), 'sum'=>$tsRepair, 'percent'=>($sum>0?(round($tsRepair/$sum, 4)*100):0) . '%', 'color'=>'#eb6f33'];
        $arr[] = ['label'=>$tsModel->getTenTrangThai(ThietBi::STATUS_HONG), 'sum'=>$tsBroken, 'percent'=>($sum>0?(round($tsBroken/$sum,4)*100):0) . '%', 'color'=>'#01b8ff'];
        
        return $arr;
    }
}