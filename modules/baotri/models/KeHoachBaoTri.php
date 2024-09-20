<?php

namespace app\modules\baotri\models;

use app\modules\bophan\models\BoPhan;
use app\modules\bophan\models\NhanVien;
use app\modules\taisan\models\ThietBi;
use app\widgets\views\StatusWithIconWidget;
use Yii;
use app\modules\taisan\models\HeThong;

class KeHoachBaoTri extends KeHoachBaoTriBase
{
    /**
     * check đã tạo phiếu bảo trì hay chưa
     */
    public function getCheckPhieu(){
        if($this->phieuBaoTris == null)
            return false;
        else 
            return true;
    }
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
                $label = "Không";
                $icon = 'fa fa-times';
                $type = 'info';
                break;
            case "1":
                $label = "Có";
                $icon = 'fe fe-check';
                $type = 'primary';
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
     * get ky bao tri label
     */
    public function getKyBaoTriLabel($value){
        if($value == 1){
            return 'Ngày';
        } else if($value == 2){
            return 'Tuần';
        }else if($value == 3){
            return 'Tháng';
        } else if($value == 4){
            return 'Năm';
        } else {
            return '';
        }
    }
    
    /**
     * lấy ngày bảo trì dựa trên ngày bảo trì trước và tần suất thực hiện
     * @param string $ngayBaoTriTruoc
     * @param string $kyBaoTri
     * @param int $tanSuat
     * @return string (date)
     */
    public static function tinhNgayBaoTriKeTiep($ngayBaoTriTruoc, $kyBaoTri, $tanSuat){
        $ngayBaoTri = '';
        switch ($kyBaoTri){
            case "1"://Ngày
                $ngayBaoTri = KeHoachBaoTri::themSoNgay($ngayBaoTriTruoc, $tanSuat);
                break;
            case "2"://Tuần
                $ngayBaoTri = KeHoachBaoTri::themSoTuan($ngayBaoTriTruoc, $tanSuat);
                break;
            case "3"://Tháng
                $ngayBaoTri = KeHoachBaoTri::themSoThang($ngayBaoTriTruoc, $tanSuat);
                break;
            case "4"://Năm
                $ngayBaoTri = KeHoachBaoTri::themSoNam($ngayBaoTriTruoc, $tanSuat);
                break;
            default:
                $ngayBaoTri = '';
        }
        return $ngayBaoTri;
    }
    
    /**
     * Cộng số ngày vào ngày
     * @param string $ngay
     * @param int $soNgay
     * @return string (date)
     */
    public static function themSoNgay($ngay, $soNgay){
        return date('Y-m-d', strtotime($ngay. ' + ' . $soNgay . ' days'));
    }
    
    /**
     * Cộng số tuần vào ngày
     * @param string $tuan
     * @param int $soTuan
     * @return string
     */
    public static function themSoTuan($ngay, $soTuan){
        return date('Y-m-d', strtotime($ngay. ' + ' . $soTuan . ' weeks'));
    }
    
    /**
     * Cộng số tháng vào ngày
     * @param string $thang
     * @param int $soThang
     * @return string
     */
    public static function themSoThang($ngay, $soThang){
        return date('Y-m-d', strtotime($ngay. ' + ' . $soThang . ' months'));
    }
    
    /**
     * Cộng số năm vào ngày
     * @param string $nam
     * @param int $soNam
     * @return string
     */
    public static function themSoNam($ngay, $soNam){
        return date('Y-m-d', strtotime($ngay. ' + ' . $soNam . ' years'));
    }
    /**
     * Gets query for [[HeThong]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHeThong()
    {
        return $this->hasOne(HeThong::class, ['id' => 'id_he_thong']);
    }
}
