<?php

namespace app\modules\muasam\models;

use Yii;
use app\modules\taisan\models\ThietBiBase as ThietBi;
use app\modules\dungchung\models\CustomFunc;
/**
 * This is the model class for table "ts_phieu_nhap_hang".
 *
 * @property int $id
 * @property string|null $so_phieu
 * @property string|null $ngay_nhap_hang
 * @property int|null $id_phieu_mua_sam
 * @property string|null $trang_thai
 * @property string|null $ghi_chu
 * @property int|null $nguoi_tao
 * @property string|null $ngay_tao
 * @property int|null $nguoi_cap_nhat
 * @property string|null $ngay_cap_nhat
 *
 * @property TsPhieuMuaSam $phieuMuaSam
 * @property TsCtPhieuNhapHang[] $tsCtPhieuNhapHangs
 */
class PhieuNhapHang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_phieu_nhap_hang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ngay_nhap_hang', 'ngay_tao', 'ngay_cap_nhat'], 'safe'],
            [['id_phieu_mua_sam', 'nguoi_tao', 'nguoi_cap_nhat'], 'integer'],
            [['ghi_chu'], 'string'],
            [['so_phieu', 'trang_thai'], 'string', 'max' => 255],
            [['id_phieu_mua_sam'], 'exist', 'skipOnError' => true, 'targetClass' => PhieuMuaSam::class, 'targetAttribute' => ['id_phieu_mua_sam' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'so_phieu' => 'Số phiếu',
            'ngay_nhap_hang' => 'Ngày nhập hàng',
            'id_phieu_mua_sam' => 'Phiếu mua sắm',
            'trang_thai' => 'Trạng thái',
            'ghi_chu' => 'Ghi chú',
            'nguoi_tao' => 'Người tạo',
            'ngay_tao' => 'Ngày tạo',
            'nguoi_cap_nhat' => 'Người cập nhật',
            'ngay_cap_nhat' => 'Ngày cập nhật',
        ];
    }

    /**
     * Gets query for [[PhieuMuaSam]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhieuMuaSam()
    {
        return $this->hasOne(PhieuMuaSam::class, ['id' => 'id_phieu_mua_sam']);
    }

    /**
     * Gets query for [[TsCtPhieuNhapHangs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCtPhieuNhapHangs()
    {
        return $this->hasMany(CtPhieuNhapHang::class, ['id_phieu_mua_sam' => 'id_phieu_mua_sam']);
    }
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->ngay_tao = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->id;
        }
        else{
            if($this->getOldAttribute('trang_thai')!=$this->trang_thai && $this->trang_thai === "completed")
            {
                
                $isSuccess=$this->chuyenThietBi();
                if(!$isSuccess)
                $this->trang_thai="draft";
                else{
                    $phieuMuaSam=$this->phieuMuaSam;
                    $phieuMuaSam->trang_thai="completed";
                    $phieuMuaSam->save();
                }
            }
        }
        $cus = new CustomFunc();
        if($this->ngay_nhap_hang != null)
            $this->ngay_nhap_hang = $cus->convertDMYToYMD($this->ngay_nhap_hang);

            
        $this->ngay_cap_nhat = date('Y-m-d H:i:s');
        $this->nguoi_cap_nhat = Yii::$app->user->id;
        
        return parent::beforeSave($insert);
    }
    public function afterSave($insert,$changedAttributes) {

        // if(isset($changedAttributes['trang_thai']))
        // {
        //     $phieuMuaSam=$this->phieuMuaSam;
        //     if($this->trang_thai=="completed")
        //     {
                
        //         $this->chuyenThietBi();
        //     }
            
        // }
        
        return parent::afterSave($insert,$changedAttributes);
    }
    public function chuyenThietBi()
    {
        $cus = new CustomFunc();
        
        foreach($this->ctPhieuNhapHangs as $key=>$item)
        {
            if(!$item->id_thiet_bi)
            {
                $ctPhieuMuaSam=$item->ctPhieuMuaSam;
                $data=[
                    'ma_thiet_bi' => $item->ma_thiet_bi,//*
                    'id_vi_tri' => $item->id_vi_tri,//*
                    'id_he_thong' => $item->id_he_thong,//*
                    'id_loai_thiet_bi' => $ctPhieuMuaSam->id_loai_thiet_bi,//*
                    'id_bo_phan_quan_ly' => $item->id_bo_phan_quan_ly,//*
                    'ten_thiet_bi' => $ctPhieuMuaSam->ten_thiet_bi,//*
                    'id_thiet_bi_cha' => $item->id_thiet_bi_cha,//*
                    //'id_layout' => $item->id_layout,
                    'nam_san_xuat' => $item->nam_san_xuat."",//*
                    'serial' => $item->serial,//*
                    'model' => $item->model,//*
                    'xuat_xu' => $item->xuat_xu,//*
                    'id_hang_bao_hanh' => $item->id_hang_bao_hanh,//*
                    'id_nhien_lieu' => $item->id_nhien_lieu,
                    'dac_tinh_ky_thuat' => $item->dac_tinh_ky_thuat,//*
                    //'id_lop_hu_hong' => $item->id_lop_hu_hong,
                    //'id_trung_tam_chi_phi' => $item->id_trung_tam_chi_phi,
                    'id_don_vi_bao_tri' => $item->id_don_vi_bao_tri,//*
                    'id_nguoi_quan_ly' => $item->id_nguoi_quan_ly,//*
                    'ngay_mua' => $cus->convertYMDToDMY($item->ngay_tao),//*
                    'han_bao_hanh' => $cus->convertYMDToDMY($item->han_bao_hanh),//*
                    'trang_thai' => ThietBi::STATUS_HOATDONG,//*
                ];
                $thietBi=new ThietBi($data);
                
                if($thietBi->save())
                {
                    $item->id_thiet_bi=$thietBi->id;
                    $item->save();
                    
                }
                else{
                    //echo 123;
                    //echo json_encode($thietBi->getErrors());
                }
            }
            
            
        }
        $checkNhapHang=CtPhieuNhapHang::find()
        ->where(['id_phieu_mua_sam' => $this->id_phieu_mua_sam])
        ->andWhere('id_thiet_bi is null')
        ->count();
        
        if($checkNhapHang>0)
        return false;
        else return true;
    }
    public static function getDmTrangThai(){
        return [
            "draft"=>'Nháp',
            "submited"=>'Chờ duyệt',
            "rejected"=>"Từ chối",
            "approved"=>'Đã duyệt',
            "processing"=>"Đang nhập hàng",
            "completed"=>"Hoàn thành"       ];
    }
    public static function getColorTrangThai(){
        return [
            "draft"=>'info',
            "submited"=>'warning',
            "rejected"=>"danger",
            "approved"=>'primary',
            "processing"=>'secondary',
            "completed"=>'success',
        ];
    }
}
