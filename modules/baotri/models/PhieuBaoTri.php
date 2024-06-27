<?php

namespace app\modules\baotri\models;

use app\widgets\views\StatusWithIconWidget;
use Yii;
use app\modules\baotri\models\base\PhieuBaoTriBase;
use app\modules\bophan\models\NhanVien;
use app\modules\bophan\models\BoPhan;

class PhieuBaoTri extends PhieuBaoTriBase
{
    /**
     * Gets query for [[KeHoach]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKeHoach()
    {
        return $this->hasOne(KeHoachBaoTri::class, ['id' => 'id_ke_hoach']);
    }
    
    /**
     * Gets query for [[NguoiChiuTrachNhiem]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNguoiChiuTrachNhiem()
    {
        return $this->hasOne(NhanVien::class, ['id' => 'id_nguoi_chiu_trach_nhiem']);
    }
    
    /**
     * Gets query for [[DonViBaoTri]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDonViBaoTri()
    {
        return $this->hasOne(BoPhan::class, ['id' => 'id_don_vi_bao_tri']);
    }
    
    /**
     * get list phieu bao tri dang json de fill vao calendar
     */
    public static function listPhieuBaoTriArray(){
        $arr = array();
        $model = PhieuBaoTri::find()->all();
        foreach ($model as $mod){
            $arr[] = [
                'title' => $mod->keHoach->ten_cong_viec,
                'start' => $mod->thoi_gian_bat_dau,
                'end' => $mod->thoi_gian_ket_thuc==null?$mod->thoi_gian_bat_dau:$mod->thoi_gian_ket_thuc,
                'id' => $mod->id,
            ];
        }
        return $arr;
    }
}