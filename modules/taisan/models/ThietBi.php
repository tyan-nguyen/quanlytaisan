<?php

namespace app\modules\taisan\models;

use Yii;
use app\modules\dungchung\models\CustomFunc;
use app\widgets\views\StatusWithIconWidget;

class ThietBi extends ThietBiBase{
    /**
     * hien thi url cua qr code
     * @return string
     */
    public function getQrCode(){
        return Yii::getAlias('@web') . $this::QR_FOLDER . $this->autoid . '.png';
    }
    
    /**
     * lay ten bo phan quan ly tu relation boPhanQuanLy
     * @return string
     */
    public function getTenBoPhanQuanLy(){
        return $this->boPhanQuanLy != NULL ? $this->boPhanQuanLy->ten_bo_phan : '';
    }
    
    /**
     * lay ten bo phan bao tri tu relation boPhanQuanLy
     * @return string
     */
    public function getTenBoPhanBaoTri(){
        return $this->boPhanBaoTri != NULL ? $this->boPhanBaoTri->ten_bo_phan : '';
    }
    
    /**
     * lay ten trung tam chi phi tu relation trungTamChiPhi
     * @return string
     */
    public function getTenTrungTamChiPhi(){
        return $this->trungTamChiPhi != NULL ? $this->trungTamChiPhi->ten_bo_phan : '';
    }
    
    /**
     * lay ten nhan vien tu relation nguoiQuanLy
     * @return string
     */
    public function getTenNguoiQuanLy(){
        return $this->nguoiQuanLy != NULL ? $this->nguoiQuanLy->ten_nhan_vien : '';
    }
    
    /**
     * lay ten loai thiet bi tu relation loaiThietBi
     * @return string
     */
    public function getTenLoaiThietBi(){
        return $this->loaiThietBi != NULL ? $this->loaiThietBi->ten_loai : '';
    }
    
    /**
     * lay ten hang bao hanh tu relation hangBaoHanh
     * @return string
     */
    public function getTenHangBaoHanh(){
        return $this->hangBaoHanh != NULL ? $this->hangBaoHanh->ten_doi_tac : '';
    }
    
    /**
     * lay ten vi tri tu relation viTri
     * @return string
     */
    public function getTenViTri(){
        return $this->viTri != NULL ? $this->viTri->ten_vi_tri : '';
    }
    
    /**
     * lay ten he thong tu relation heThong
     * @return string
     */
    public function getTenHeThong(){
        return $this->heThong != NULL ? $this->heThong->ten_he_thong : '';
    }
    
    /**
     * lay ten thiet bi cha tu relation thietBiCha
     * @return string
     */
    public function getTenThietBiCha(){
        return $this->thietBiCha != NULL ? $this->thietBiCha->ten_thiet_bi : '';
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
     * hien thi han bao hanh dd/mm/yyyy
     * @return string
     */
    public function getHanBaoHanh(){
        $cus = new CustomFunc();
        return $cus->convertYMDToDMY($this->han_bao_hanh);
    }
    
    /**
     * hien thi ngay mua dd/mm/yyyy
     * @return string
     */
    public function getNgayMua(){
        $cus = new CustomFunc();
        return $cus->convertYMDToDMY($this->ngay_mua);
    }
    
    /**
     * hien thi ngay dua vao su dung dd/mm/yyyy
     * @return string
     */
    public function getNgayDuaVaoSuDung(){
        $cus = new CustomFunc();
        return $cus->convertYMDToDMY($this->ngay_dua_vao_su_dung);
    }
    
    /**
     * Danh muc trang thai label with Badge & Icon
     * @param int $val
     * @return string
     */
    public function getTenTrangThaiWithBadge($val=NULL){
        if($val==NULL){
            $val = $this->trang_thai;
        }
        switch ($val){
            case "HOATDONG":
                $label = "Đang hoạt động";
                $icon = 'fe fe-check';
                $type = 'primary';
                break;
            case "SUACHUA":
                $label = "Đang sửa chữa";
                $icon = 'ion-wrench';
                $type = 'info';
                break;
            case "HONG":
                $label = "Đã hỏng";
                $icon = 'fe fe-power';
                $type = 'warning';
                break;
            case "MAT":
                $label = "Đã mất/Thất lạc";
                $icon = 'fe fe-x';
                $type = 'danger';
                break;
            case "THANHLY":
                $label = "Đã thanh lý";
                $icon = 'fe fe-log-out';
                $type = 'default';
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