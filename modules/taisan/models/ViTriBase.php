<?php

namespace app\modules\taisan\models;
use app\modules\dungchung\models\History;
use Yii;
use app\modules\dungchung\models\CustomFunc;

class ViTriBase extends \app\models\TsViTri{
    
    const MODEL_ID = 'vitri';
    
    public function rules()
    {
        return [
            [['ma_vi_tri', 'ten_vi_tri'], 'required'],
            [['mo_ta'], 'string'],
            [['truc_thuoc', 'da_ngung_hoat_dong', 'id_layout', 'nguoi_tao'], 'integer'],
            [['ngay_ngung_hoat_dong', 'thoi_gian_tao'], 'safe'],
            [['ma_vi_tri'], 'string', 'max' => 20],
            [['ten_vi_tri'], 'string', 'max' => 255],
            [['toa_do_x', 'toa_do_y'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ma_vi_tri' => 'Mã vị trí',
            'ten_vi_tri' => 'Tên vị trí',
            'mo_ta' => 'Mô tả',
            'truc_thuoc' => 'Trực thuộc',
            'da_ngung_hoat_dong' => 'Đã ngưng hoạt động',
            'ngay_ngung_hoat_dong' => 'Ngày ngưng hoạt động',
            'id_layout' => 'Layout',
            'toa_do_x' => 'Toạ độ X',
            'toa_do_y' => 'Toạ độ Y',
            'thoi_gian_tao' => 'Thời gian tạo',
            'nguoi_tao' => 'Người tạo',
        ];
    }
    public function getViTriTrucThuoc()
    {
        return $this->truc_thuoc!=NULL?$this->hasOne(ViTri::class, ['id' => 'truc_thuoc']):NULL;
    }
        /**
     * {@inheritdoc}
     */
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->thoi_gian_tao = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->isGuest ? '' : Yii::$app->user->id;
            if($this->truc_thuoc == null)
                $this->truc_thuoc = 0;
        }
        $cus = new CustomFunc();
        if($this->ngay_ngung_hoat_dong != null)
            $this->ngay_ngung_hoat_dong = $cus->convertDMYToYMD($this->ngay_ngung_hoat_dong);
        return parent::beforeSave($insert);
    }
    
    /**
     * {@inheritdoc}
     */
    public function afterSave( $insert, $changedAttributes ){
        parent::afterSave($insert, $changedAttributes);
        History::addHistory($this::MODEL_ID, $changedAttributes, $this, $insert);
    }
}
