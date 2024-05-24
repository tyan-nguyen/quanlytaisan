<?php

namespace app\modules\baotri\models;

use app\modules\bophan\models\BoPhan;
use app\modules\bophan\models\NhanVien;
use app\modules\taisan\models\ThietBi;
use app\widgets\views\StatusWithIconWidget;
use Yii;

class KeHoachBaoTri extends KeHoachBaoTriBase
{

    /**
     * Danh muc trang thai label with Badge & Icon
     * @param int $val
     * @return string
     */
    public function getMucDoUuTienWithBadge($val=NULL){
        if($val==NULL){
            $val = $this->muc_do_uu_tien;
        }
        switch ($val){
            case "0":
                $label = "Không ưu tiên";
                $icon = 'fe fe-check';
                $type = 'primary';
                break;
            case "1":
                $label = "Ưu tiên";
                $icon = 'ion-wrench';
                $type = 'info';
                break;
            case "2":
                $label = "Xử lý gấp";
                $icon = 'fe fe-power';
                $type = 'danger';
                break;
            default:
                $label = '';
        }
        return $label != '' ? StatusWithIconWidget::widget([
            'label'=>$label,
            'icon'=>$icon,
            'type'=>$type
        ]) : '';
    }
    
    /**
     * Danh muc trang thai label with Badge & Icon
     * @param int $val
     * @return string
     */
    public function getThueNgoaiWithBadge($val=NULL){
        if($val==NULL){
            $val = $this->thue_ngoai;
        }
        switch ($val){
            case "0":
                $label = "Có";
                $icon = 'fe fe-check';
                $type = 'primary';
                break;
            case "1":
                $label = "Không";
                $icon = 'a fa-times';
                $type = 'info';
                break;
            default:
                $label = '';
        }
        return $label != '' ? StatusWithIconWidget::widget([
            'label'=>$label,
            'icon'=>$icon,
            'type'=>$type
        ]) : '';
    }
}
