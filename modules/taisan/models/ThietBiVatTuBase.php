<?php

namespace app\modules\taisan\models;

use Yii;
use app\modules\dungchung\models\History;
use app\modules\dungchung\models\DungChung;
use app\modules\kholuutru\models\DmVatTu;
use app\modules\kholuutru\models\KhoLuuTru;


class ThietBiVatTuBase extends \app\models\TsThietBiVatTu
{
    //set id cho model (dung de luu dung chung)
    const MODEL_ID = 'thietbivattu';
    const QR_FOLDER = '/uploads/qrvtlibs/';
    //status
    const STATUS_HOATDONG = 'HOATDONG';
    const STATUS_SUACHUA = 'SUACHUA';
    const STATUS_HONG = 'HONG';
    const STATUS_THANHLY = 'THANHLY';
    /**
     * Danh muc trang thai
     * @return string[]
     */
    public static function getDmTrangThai()
    {
        return [
            ThietBiVatTuBase::STATUS_HOATDONG => 'Đang hoạt động',
            ThietBiVatTuBase::STATUS_SUACHUA => 'Đang sửa chữa',
            ThietBiVatTuBase::STATUS_HONG => 'Đã hỏng',
            ThietBiVatTuBase::STATUS_THANHLY => 'Đã thanh lý',
            
        ];
    }
    
    /**
     * Danh muc trang thai label
     * @param int $val
     * @return string
     */
    public function getTenTrangThai($val = NULL)
    {
        if ($val == NULL) {
            $val = $this->trang_thai;
        }
        switch ($val) {
            case ThietBiVatTuBase::STATUS_HOATDONG:
                $label = "Đang hoạt động";
                break;
            case ThietBiVatTuBase::STATUS_SUACHUA:
                $label = "Đang sửa chữa";
                break;
            case ThietBiVatTuBase::STATUS_HONG:
                $label = "Đã hỏng";
                break;
            case ThietBiVatTuBase::STATUS_THANHLY:
                $label = "Đã thanh lý";
                break;
                
            default:
                $label = '';
        }
        return $label;
    }
    /**
     * Gets query for [[ThietBi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getThietBi()
    {
        return $this->hasOne(ThietBi::class, ['id' => 'id_thiet_bi']);
    }
    
    /**
     * Gets query for [[VatTu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVatTu()
    {
        return $this->hasOne(DmVatTu::class, ['id' => 'id_vat_tu']);
    }
    /**
     * Gets query for [[DmKho]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKho()
    {
        return $this->hasOne(KhoLuuTru::class, ['id' => 'id_kho']);
    }
    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->thoi_gian_tao = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->isGuest ? '' : Yii::$app->user->id;
            if($this->trang_thai == null)
                $this->trang_thai = self::STATUS_HOATDONG;
        }
        //neu la record moi hoac du lieu cu chua co qr_code
        if ($this->qr_code == null) {
            //$this->qr_code = md5(Yii::$app->user->id . date('Y-m-d H:i:s'));
            $this->qr_code = chr(rand(97, 122)) . Yii::$app->user->id . strtotime(date('Y-m-d H:i:s'));
        }
        return parent::beforeSave($insert);
    }
    
    /**
     * {@inheritdoc}
     */
    public function afterSave( $insert, $changedAttributes ){
        if($insert && $this->tru_ton_kho == true){
            $this->vatTu->so_luong = $this->vatTu->so_luong - 1;
            $this->vatTu->ghiChuThayDoi = 'Trừ kho sau khi thêm mới vật tư vào thiết bị '.$this->thietBi->ten_thiet_bi;
            $this->vatTu->save();
        }
        
        parent::afterSave($insert, $changedAttributes);
        //create qr code
        DungChung::createQRcode($this::QR_FOLDER, $this->qr_code);
        //add history
        History::addHistory($this::MODEL_ID, $changedAttributes, $this, $insert);
    }
    
    /**
     * xoa file QR code
     */
    private function deleleQr()
    {
        $filePath = Yii::getAlias('@webroot') . $this::QR_FOLDER . $this->qr_code . '.png';
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
    
    /**
     * {@inheritdoc}
     * xoa file anh, tai lieu, lich su sau khi xoa du lieu
     */
    public function afterDelete()
    {
        //xoa tham chieu
        DungChung::xoaThamChieu($this::MODEL_ID, $this->id);   
        //xoa qr
        $this->deleleQr();
        return parent::afterDelete();
    }

}