<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ts_thiet_bi_vat_tu".
 *
 * @property int $id
 * @property int $id_thiet_bi
 * @property int $id_vat_tu
 * @property string|null $qr_code
 * @property string|null $model
 * @property string|null $so_serial
 * @property string|null $ghi_chu
 * @property int|null $id_phieu_sua_chua
 * @property int|null $id_tbvt_thay_the
 * @property string|null $trang_thai
 * @property int|null $tru_ton_kho
 * @property int|null $id_kho danh cho vt hong
 * @property string|null $thoi_gian_tao
 * @property int|null $nguoi_tao
 *
 * @property TsThietBi $thietBi
 * @property TsDmVatTu $vatTu
 */
class TsThietBiVatTu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_thiet_bi_vat_tu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_thiet_bi', 'id_vat_tu'], 'required'],
            [['id_thiet_bi', 'id_vat_tu', 'id_phieu_sua_chua', 'id_tbvt_thay_the', 'tru_ton_kho', 'id_kho', 'nguoi_tao'], 'integer'],
            [['ghi_chu'], 'string'],
            [['thoi_gian_tao'], 'safe'],
            [['qr_code', 'model', 'so_serial'], 'string', 'max' => 255],
            [['trang_thai'], 'string', 'max' => 20],
            [['id_thiet_bi'], 'exist', 'skipOnError' => true, 'targetClass' => TsThietBi::class, 'targetAttribute' => ['id_thiet_bi' => 'id']],
            [['id_vat_tu'], 'exist', 'skipOnError' => true, 'targetClass' => TsDmVatTu::class, 'targetAttribute' => ['id_vat_tu' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_thiet_bi' => 'Id Thiet Bi',
            'id_vat_tu' => 'Id Vat Tu',
            'qr_code' => 'Qr Code',
            'model' => 'Model',
            'so_serial' => 'So Serial',
            'ghi_chu' => 'Ghi Chu',
            'id_phieu_sua_chua' => 'Id Phieu Sua Chua',
            'id_tbvt_thay_the' => 'Id Tbvt Thay The',
            'trang_thai' => 'Trang Thai',
            'tru_ton_kho' => 'Tru Ton Kho',
            'id_kho' => 'Id Kho',
            'thoi_gian_tao' => 'Thoi Gian Tao',
            'nguoi_tao' => 'Nguoi Tao',
        ];
    }

    /**
     * Gets query for [[ThietBi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getThietBi()
    {
        return $this->hasOne(TsThietBi::class, ['id' => 'id_thiet_bi']);
    }

    /**
     * Gets query for [[VatTu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVatTu()
    {
        return $this->hasOne(TsDmVatTu::class, ['id' => 'id_vat_tu']);
    }
}
