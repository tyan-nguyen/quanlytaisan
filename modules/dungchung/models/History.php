<?php

namespace app\modules\dungchung\models;

use Yii;
use app\widgets\views\HistoryWidget;
use app\modules\bophan\models\NhanVien;
use app\modules\bophan\models\BoPhan;
use app\modules\bophan\models\DoiTac;
use app\modules\kholuutru\models\KhoLuuTru;
use app\modules\taisan\models\HeThong;
use app\modules\taisan\models\LoaiThietBi;
use app\modules\taisan\models\ThietBi;
use app\modules\taisan\models\ViTri;
use app\modules\user\models\User;
use app\modules\baotri\models\LoaiBaoTri;

class History extends HistoryBase
{
    /**
    * get lich su thuoc id tham chieu
    * @param string $loai
    * @param int $idthamchieu
    * @return \yii\db\ActiveRecord[]
    */
    public static function getHistoryThamChieu($loai, $idthamchieu){
        return History::find()->where([
            'loai'=>$loai,
            'id_tham_chieu'=>$idthamchieu
        ])->orderBy('id DESC')->all();
    }
    
    /**
     * Hien thi lich su cho view cua cac module co cau hinh luu lich su
     * @param string $loai
     * @param int $idthamchieu
     */
    public static function showHistory($loai,$idthamchieu){
        $his = History::getHistoryThamChieu($loai, $idthamchieu);
        echo HistoryWidget::widget([
            'data'=>$his
        ]);
    }
    
    /**
     * xoa tat ca lich su thuoc id tham chieu(khi xoa tham chieu)
     * @param string $loai
     * @param int $idthamchieu
     */
    public static function xoaHistoryThamChieu($loai, $idthamchieu){
        $models = History::getHistoryThamChieu($loai, $idthamchieu);
        foreach ($models as $indexMod=>$model){
            $model->delete();
        }
    }
    
    /**
     * lay link lien ket den id tham chieu (view action)
     * @return string
     */
    public function getShowLink(){
        switch ($this->loai){
            case NhanVien::MODEL_ID:
                $module = 'bophan';
                $control = 'nhan-vien';
                break;
            case BoPhan::MODEL_ID:
                $module = 'bophan';
                $control = 'bo-phan';
                break;
            case DoiTac::MODEL_ID:
                $module = 'bophan';
                $control = 'doi-tac';
                break;
            case KhoLuuTru::MODEL_ID:
                $module = 'kholuutru';
                $control = 'kho';
                break;
            case HeThong::MODEL_ID:
                $module = 'taisan';
                $control = 'he-thong';
                break;
            case LoaiThietBi::MODEL_ID:
                $module = 'taisan';
                $control = 'loai-thiet-bi';
                break;
            case ThietBi::MODEL_ID:
                $module = 'taisan';
                $control = 'thiet-bi';
                break;
            case ViTri::MODEL_ID:
                $module = 'taisan';
                $control = 'vi-tri';
                break;
            case LoaiBaoTri::MODEL_ID:
                $module = 'baotri';
                $control = 'loai-bao-tri';
                break;
            case User::MODEL_ID:
                $module = 'user';
                $control = 'user-ajax';
                break;
            default:
                $module = 'module';
                $control = 'control';
        }

        $link = '/' . $module . '/' . $control;
        return Yii::getAlias('@web') . $link . '/view?id=' . $this->id_tham_chieu;
    }
    
    /**
     * hien thi ten cua id tham chieu de hien thi trong lich su hoat dong
     * @return string
     */
    public function getShowName(){
        $name = '';
        switch ($this->loai){
            case NhanVien::MODEL_ID:
                $query = NhanVien::findOne($this->id_tham_chieu);
                $name = $query != null ? $query->ten_nhan_vien : '';
                break;
            case BoPhan::MODEL_ID:
                $query = BoPhan::findOne($this->id_tham_chieu);
                $name = $query != null ? $query->ten_bo_phan : '';
                break;
            case DoiTac::MODEL_ID:
                $query = DoiTac::findOne($this->id_tham_chieu);
                $name = $query != null ? $query->ten_doi_tac : '';
                break;
            case KhoLuuTru::MODEL_ID:
                $query = KhoLuuTru::findOne($this->id_tham_chieu);
                $name = $query != null ? $query->ten_kho : '';
                break;
            case HeThong::MODEL_ID:
                $query = HeThong::findOne($this->id_tham_chieu);
                $name = $query != null ? $query->ten_he_thong : '';
                break;
            case LoaiThietBi::MODEL_ID:
                $query = LoaiThietBi::findOne($this->id_tham_chieu);
                $name = $query != null ? $query->ten_loai: '';
                break;
            case ThietBi::MODEL_ID:
                $query = ThietBi::findOne($this->id_tham_chieu);
                $name = $query != null ? $query->ten_thiet_bi : '';
                break;
            case ViTri::MODEL_ID:
                $query = ViTri::findOne($this->id_tham_chieu);
                $name = $query != null ? $query->ten_vi_tri : '';
                break;
            case LoaiBaoTri::MODEL_ID:
                $query = LoaiBaoTri::findOne($this->id_tham_chieu);
                $name = $query != null ? $query->ten : '';
                break;
            case User::MODEL_ID:
                $query = User::findOne($this->id_tham_chieu);
                $name = $query != null ? $query->username : '';
                break;
            default:
                $name = '';
        }
        
        return $name;
    }
    
    /**
     * hien thi ten loai tham chieu de hien thi trong lich su hoat dong
     * @return string
     */
    public function getShowLoai(){
        $name = '';
        switch ($this->loai){
            case NhanVien::MODEL_ID:
                $name = 'Dữ liệu nhân viên';
                break;
            case BoPhan::MODEL_ID:
                $name = 'Dữ liệu phòng ban - bộ phận';
                break;
            case DoiTac::MODEL_ID:
                $name = 'Dữ liệu đối tác - khách hàng';
                break;
            case KhoLuuTru::MODEL_ID:
                $name = 'Dữ liệu danh mục kho lưu trữ';
                break;
            case HeThong::MODEL_ID:
                $name = 'Dữ liệu hệ thống thiết bị';
                break;
            case LoaiThietBi::MODEL_ID:
                $name = 'Dữ liệu loại thiết bị';
                break;
            case ThietBi::MODEL_ID:
                $name = 'Dữ liệu thiết bị';
                break;
            case ViTri::MODEL_ID:
                $name = 'Dữ liệu vị trí';
                break;
            case LoaiBaoTri::MODEL_ID:
                $name = 'Dữ liệu loại bảo trì';
                break;
            case User::MODEL_ID:
                $name = 'Dữ liệu tài khoản';
                break;
            default:
                $name = '';
        }
        
        return $name;
    }
    
    /**
     * hien thi thoi gian tao d/m/y H:i:s
     * @return string
     */
    public function getThoiGianTao(){
        $cus = new CustomFunc();
        return $cus->convertYMDHISToDMYHID($this->thoi_gian_tao);
    }
    
}
