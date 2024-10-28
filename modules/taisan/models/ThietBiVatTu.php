<?php

namespace app\modules\taisan\models;

use Yii;
use app\modules\kholuutru\models\DmVatTu;

class ThietBiVatTu extends ThietBiVatTuBase
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_thiet_bi', 'id_vat_tu'], 'required'],
            [['id_thiet_bi', 'id_vat_tu', 'id_phieu_sua_chua', 'id_tbvt_thay_the', 'nguoi_tao', 'tru_ton_kho', 'id_kho'], 'integer'],
            [['ghi_chu'], 'string'],
            [['thoi_gian_tao'], 'safe'],
            [['qr_code', 'model', 'so_serial'], 'string', 'max' => 255],
            [['trang_thai'], 'string', 'max' => 20],
            [['id_thiet_bi'], 'exist', 'skipOnError' => true, 'targetClass' => ThietBi::class, 'targetAttribute' => ['id_thiet_bi' => 'id']],
            [['id_vat_tu'], 'exist', 'skipOnError' => true, 'targetClass' => DmVatTu::class, 'targetAttribute' => ['id_vat_tu' => 'id']],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_thiet_bi' => 'Thiết bị',
            'id_vat_tu' => 'Vật tư',
            'qr_code' => 'Qr Code',
            'model' => 'Model',
            'so_serial' => 'Số Serial',
            'ghi_chu' => 'Ghi chú',
            'id_phieu_sua_chua' => 'Phiếu sửa chữa',
            'id_tbvt_thay_the' => 'Thiết bị vật tư thay thế',
            'trang_thai' => 'Trạng thái',
            'tru_ton_kho' => 'Trừ tồn kho',
            'id_kho' => 'Kho lưu trữ',
            'thoi_gian_tao' => 'Thời gian tạo',
            'nguoi_tao' => 'Người tạo',
        ];
    }
    /**
     * hien thi url cua qr code
     * @return string
     */
    public function getQrCode()
    {
        return Yii::getAlias('@web') . $this::QR_FOLDER . $this->qr_code . '.png';
    }
    
}