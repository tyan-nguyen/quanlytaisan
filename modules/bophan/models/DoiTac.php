<?php

namespace app\modules\bophan\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\modules\muasam\models\PhieuMuaSam;
use app\modules\suachua\models\PhieuSuaChua;

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
    public function getLichSuSuaChua()
    {
        $phieuSuaChua=PhieuSuaChua::find()
        ->select(['ts_phieu_sua_chua.*'])
        ->leftJoin('ts_bao_gia_sua_chua', 'ts_phieu_sua_chua.id = ts_bao_gia_sua_chua.id_phieu_sua_chua')
        ->where(['=','ts_bao_gia_sua_chua.id_dv_bao_gia',$this->id])
        ->andWhere(['=','ts_bao_gia_sua_chua.flag_index',0])
        ->orderBy('id','desc')->limit(10)->all();
        return $phieuSuaChua;
    }
    public function getLichSuMuaSam()
    {
        $phieuMuaSam=PhieuMuaSam::find()
        ->select(['ts_phieu_mua_sam.*'])
        ->leftJoin('ts_bao_gia_mua_sam', 'ts_phieu_mua_sam.id = ts_bao_gia_mua_sam.id_phieu_mua_sam')
        ->where(['=','ts_bao_gia_mua_sam.id_dv_bao_gia',$this->id])
        ->andWhere(['=','ts_bao_gia_mua_sam.flag_index',0])
        ->orderBy('id','desc')->limit(10)->all();
        return $phieuMuaSam;
        return $this->hasMany(PhieuMuaSam::class, ['id_bo_phan_quan_ly' => 'id'])->orderBy('id','desc')->limit(10);
    }
    
}