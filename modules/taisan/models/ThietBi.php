<?php

namespace app\modules\taisan\models;

use Yii;
use app\modules\dungchung\models\CustomFunc;
use app\widgets\views\StatusWithIconWidget;
use app\modules\baotri\models\PhieuBaoTri;
use yii\helpers\ArrayHelper;
use app\modules\suachua\models\PhieuSuaChua;
use app\modules\baotri\models\KeHoachBaoTri;

class ThietBi extends ThietBiBase
{
    /**
     * hien thi url cua qr code
     * @return string
     */
    public function getQrCode()
    {
        return Yii::getAlias('@web') . $this::QR_FOLDER . $this->autoid . '.png';
    }
    
    /**
     * get list data thong ke lich su hoat dong, sua chua, bao tri cua tai san
     */
    /* public function getLichSuHoatDong(){
        $result = array_merge($this->getLichSuBaoTri(), $this->getLichSuSuaChua());
        
        return $result;
    } */        
    public function getLichSuBaoTri($tuNgay, $denNgay){
        $custom = new CustomFunc();
        $result = array();
        $query = PhieuBaoTri::find()->alias('t')
        ->joinWith(['keHoach as kh'])
        ->where([
            'kh.id_thiet_bi' => $this->id,
            't.da_hoan_thanh' => 1
        ]);
        if($tuNgay && $denNgay){
            $tuNgay = $custom->convertDMYToYMD($tuNgay);
            $denNgay = $custom->convertDMYToYMD($denNgay);
            $query->andWhere(['>=','thoi_gian_bat_dau', $tuNgay]);
            $query->andWhere(['<=','thoi_gian_bat_dau', $denNgay]);
        } else if($tuNgay && !$denNgay){
            $tuNgay = $custom->convertDMYToYMD($tuNgay);
            $query->andWhere(['>=','thoi_gian_bat_dau', $tuNgay]);
        } else if(!$tuNgay && $denNgay){
            $denNgay = $custom->convertDMYToYMD($denNgay);
            $query->andWhere(['<=','thoi_gian_bat_dau', $denNgay]);
        }
        $phieuBaoTris = $query->all();
        foreach ($phieuBaoTris as $phieuBaoTri){
            $result[] = [
                'ngay' => $custom->convertYMDHISToDMY($phieuBaoTri->thoi_gian_bat_dau),
                'ngay_sort' => str_replace('-', '', $custom->convertYMDHISToYMD($phieuBaoTri->thoi_gian_bat_dau)),
                'noi_dung' => $phieuBaoTri->keHoach->ten_cong_viec,
                'loai'=>KeHoachBaoTri::MODEL_ID,
                'tham_chieu'=>$phieuBaoTri->id
            ];
        }
        return $result;
    }
    public function getLichSuSuaChua($tuNgay, $denNgay){
        $custom = new CustomFunc();
        $result = array();
        $query = PhieuSuaChua::find()->where(['id_thiet_bi'=>$this->id])->andWhere(['=','trang_thai','completed']);
        if($tuNgay && $denNgay){
            $tuNgay = $custom->convertDMYToYMD($tuNgay);
            $denNgay = $custom->convertDMYToYMD($denNgay);
            $query->andWhere(['>=','ngay_sua_chua', $tuNgay]);
            $query->andWhere(['<=','ngay_sua_chua', $denNgay]);
        } else if($tuNgay && !$denNgay){
            $tuNgay = $custom->convertDMYToYMD($tuNgay);
            $query->andWhere(['>=','ngay_sua_chua', $tuNgay]);
        } else if(!$tuNgay && $denNgay){
            $denNgay = $custom->convertDMYToYMD($denNgay);
            $query->andWhere(['<=','ngay_sua_chua', $denNgay]);
        }
        $phieuSuaChuas = $query->all();
        foreach ($phieuSuaChuas as $phieuSuaChua){
            $result[] = [
                'ngay' => $custom->convertYMDHISToDMY($phieuSuaChua->ngay_sua_chua),
                'ngay_sort' => str_replace('-', '', $custom->convertYMDHISToYMD($phieuSuaChua->ngay_sua_chua)),
                'noi_dung' => 'Địa điểm: ' . $phieuSuaChua->dia_chi . '. Tình trạng: ' . $phieuSuaChua->ghi_chu1,
                'loai'=>PhieuSuaChua::MODEL_ID,
                'tham_chieu'=>$phieuSuaChua->id
            ];
        }
        return $result;
    }
    public function getLichSuVanHanh($tuNgay, $denNgay){
        $custom = new CustomFunc();
        $result = array();
        $query = YeuCauVanHanhCt::find()->where(['id_thiet_bi'=>$this->id]);
        if($tuNgay && $denNgay){
            $tuNgay = $custom->convertDMYToYMD($tuNgay);
            $denNgay = $custom->convertDMYToYMD($denNgay);
            $query->andWhere(['>=','DATE(ngay_bat_dau)', $tuNgay]);
            $query->andWhere(['<=','DATE(ngay_bat_dau)', $denNgay]);
        } else if($tuNgay && !$denNgay){
            $tuNgay = $custom->convertDMYToYMD($tuNgay);
            $query->andWhere(['>=','DATE(ngay_bat_dau)', $tuNgay]);
        } else if(!$tuNgay && $denNgay){
            $denNgay = $custom->convertDMYToYMD($denNgay);
            $query->andWhere(['<=','DATE(ngay_bat_dau)', $denNgay]);
        }
        $yeuCauVanHanhCts = $query->all();
        foreach ($yeuCauVanHanhCts as $phieuVanHanh){
            $result[] = [
                'ngay' => $custom->convertYMDHISToDMY($phieuVanHanh->ngay_bat_dau),
                'ngay_sort' => str_replace('-', '', $custom->convertYMDHISToYMD($phieuVanHanh->ngay_bat_dau)),
                'noi_dung' => 'Thời gian: '.$custom->convertYMDHISToDMY($phieuVanHanh->ngay_bat_dau)
                    . ' - '
                    .$custom->convertYMDHISToDMY($phieuVanHanh->ngay_ket_thuc)
                    .'. Địa điểm: ' . $phieuVanHanh->yeuCauVanHanh->cong_trinh . 
                    '. Nội dung: ' . $phieuVanHanh->yeuCauVanHanh->ly_do,
                'loai'=>YeuCauVanHanh::MODEL_ID,
                'tham_chieu'=>$phieuVanHanh->id
            ];
        }
        return $result;
    }

    /**
     * lay ten bo phan quan ly tu relation boPhanQuanLy
     * @return string
     */
    public function getTenBoPhanQuanLy()
    {
        return $this->boPhanQuanLy != NULL ? $this->boPhanQuanLy->ten_bo_phan : '';
    }

    /**
     * lay ten bo phan bao tri tu relation boPhanQuanLy
     * @return string
     */
    public function getTenBoPhanBaoTri()
    {
        return $this->boPhanBaoTri != NULL ? $this->boPhanBaoTri->ten_bo_phan : '';
    }

    /**
     * lay ten trung tam chi phi tu relation trungTamChiPhi
     * @return string
     */
    public function getTenTrungTamChiPhi()
    {
        return $this->trungTamChiPhi != NULL ? $this->trungTamChiPhi->ten_bo_phan : '';
    }

    /**
     * lay ten nhan vien tu relation nguoiQuanLy
     * @return string
     */
    public function getTenNguoiQuanLy()
    {
        return $this->nguoiQuanLy != NULL ? $this->nguoiQuanLy->ten_nhan_vien : '';
    }

    /**
     * lay ten loai thiet bi tu relation loaiThietBi
     * @return string
     */
    public function getTenLoaiThietBi()
    {
        return $this->loaiThietBi != NULL ? $this->loaiThietBi->ten_loai : '';
    }

    /**
     * lay ten hang bao hanh tu relation hangBaoHanh
     * @return string
     */
    public function getTenHangBaoHanh()
    {
        return $this->hangBaoHanh != NULL ? $this->hangBaoHanh->ten_doi_tac : '';
    }

    /**
     * lay ten vi tri tu relation viTri
     * @return string
     */
    public function getTenViTri()
    {
        return $this->viTri != NULL ? $this->viTri->ten_vi_tri : '';
    }

    /**
     * lay ten he thong tu relation heThong
     * @return string
     */
    public function getTenHeThong()
    {
        return $this->heThong != NULL ? $this->heThong->ten_he_thong : '';
    }

    /**
     * lay ten thiet bi cha tu relation thietBiCha
     * @return string
     */
    public function getTenThietBiCha()
    {
        return $this->thietBiCha != NULL ? $this->thietBiCha->ten_thiet_bi : '';
    }

    /**
     * hien thi ngay ngung hoat dong dd/mm/yyyy
     * @return string
     */
    public function getNgayNgungHoatDong()
    {
        $cus = new CustomFunc();
        return $cus->convertYMDToDMY($this->ngay_ngung_hoat_dong);
    }

    /**
     * hien thi han bao hanh dd/mm/yyyy
     * @return string
     */
    public function getHanBaoHanh()
    {
        $cus = new CustomFunc();
        return $cus->convertYMDToDMY($this->han_bao_hanh);
    }

    /**
     * hien thi ngay mua dd/mm/yyyy
     * @return string
     */
    public function getNgayMua()
    {
        $cus = new CustomFunc();
        return $cus->convertYMDToDMY($this->ngay_mua);
    }

    /**
     * hien thi ngay dua vao su dung dd/mm/yyyy
     * @return string
     */
    public function getNgayDuaVaoSuDung()
    {
        $cus = new CustomFunc();
        return $cus->convertYMDToDMY($this->ngay_dua_vao_su_dung);
    }

    /**
     * Danh muc trang thai label with Badge & Icon
     * @param int $val
     * @return string
     */
    public function getTenTrangThaiWithBadge($val = NULL)
    {
        if ($val == NULL) {
            $val = $this->trang_thai;
        }
        switch ($val) {
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
            case "VANHANH":
                $label = "Đang vận hành";
                $icon = 'fe fe-check';
                $type = 'warning';
                break;
            default:
                $label = '';
        }
        return $label != '' ? StatusWithIconWidget::widget([
            'label' => $label,
            'icon' => $icon,
            'type' => $type
        ]) : '';
    }
}
