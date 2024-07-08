<?php
namespace app\modules\user\models;

use app\modules\taisan\models\ThietBi;
use app\modules\taisan\models\LoaiThietBi;
use app\modules\baotri\models\PhieuBaoTri;
use yii\db\Expression;
use app\modules\dungchung\models\History;

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
    
    /**
     * get danh sách đến hạn bảo trì thêm vào box-baotri (hiển thị 6 item)
     */
    public function getPhieuDenHanBaoTri(){
        $query = PhieuBaoTri::find();
        $query->andFilterWhere(['>=', new Expression('DATE(thoi_gian_bat_dau)'), new Expression('CURDATE()')]);
        $query->andFilterWhere([
            'da_hoan_thanh' => 0,
        ]);
        return $query->limit(5)->orderBy(['thoi_gian_bat_dau'=>SORT_ASC])->all();
    }
    
    /**
     * lấy danh sách lịch sử hoạt động hiển thị trên dashboard
     */
    public function getLichSuHoatDong(){
        $query = History::find()->limit(7)->orderBy(['id'=>SORT_DESC])->all();
        return $query;
    }
}