<?php

namespace app\modules\taisan\models;

use Yii;
use app\modules\dungchung\models\CustomFunc;
use app\widgets\views\StatusWithIconWidget;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class YeuCauVanHanh extends YeuCauVanHanhBase
{

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function beforeSave($insert)
    {
        $cus = new CustomFunc();

        if ($this->ngay_lap != null)
            $this->ngay_lap = $cus->convertDMYToYMD($this->ngay_lap);

        if ($this->ngay_duyet != null)
            $this->ngay_duyet = $cus->convertDMYToYMD($this->ngay_duyet);

        if ($this->ngay_gui != null)
            $this->ngay_gui = $cus->convertDMYToYMD($this->ngay_gui);

        if ($this->ngay_xuat != null)
            $this->ngay_xuat = $cus->convertDMYToYMD($this->ngay_xuat);

        if ($this->ngay_nhan != null)
            $this->ngay_nhan = $cus->convertDMYToYMD($this->ngay_nhan);

        if ($insert) {
            $this->hieu_luc = 'NHAP';
        }

        // if ($this->isNewRecord)
        //     $this->created_at = date('Y-m-d H:i:s');

        // $this->updated_at = date('Y-m-d H:i:s');
        //        if (parent::beforeSave($insert)) {
        //            if ($this->isNewRecord) {
        //                $this->created_at =date('Y-m-d H:i:s');
        //            }
        //            $this->updated_at = date('Y-m-d H:i:s');
        //            return true;
        //        }
        //        return false;

        return parent::beforeSave($insert);
    }
    
    /**
     * lấy danh sách thiết bị theo id yêu cầu vận hành chi tiết
     *  đang trong phiếu yêu cầu vận hành nhưng chưa trả để fill dropdownlist
     * @return array
     */
    public static function getListThietBiByIDChiTiet(){
        $query = YeuCauVanHanhCt::find()
        //->joinWith(['thietBi tb'])
        ->where('ngay_tra_thuc_te IS NULL')
        //->orderBy(['tb.ten_thiet_bi'=>SORT_ASC])
        ->all();
        // Them trang thai hoat dong vao thiet bi
        return ArrayHelper::map($query, 'id', function($model) {
            return $model->thietBi->ten_thiet_bi . ' - ' . $model->thietBi->getTenTrangThai($model->thietBi->trang_thai);
        });
    }
    
    /**
     * check ycvh chi tiet da tra het thi trang thai la da tra
     */
    public function setTrangThaiDaTra(){
        if($this->hieu_luc == self::STATUS_VANHANH){
            $coThietBiChuaTra = false;
            foreach ($this->details as $dt){
                if($dt->ngay_tra_thuc_te == NULL){
                    $coThietBiChuaTra = true;
                    break;
                }
            }
            if($coThietBiChuaTra == false){
                $this->hieu_luc = self::STATUS_DATRA;
                $this->save();
            }
        }
    }
}
