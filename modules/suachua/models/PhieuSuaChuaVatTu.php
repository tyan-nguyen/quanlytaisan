<?php

namespace app\modules\suachua\models;

use Yii;
use app\modules\kholuutru\models\DmVatTu;
/**
 * This is the model class for table "ts_phieu_sua_chua_vat_tu".
 *
 * @property int $id
 * @property int $id_phieu_sua_chua
 * @property int $id_vat_tu
 * @property int|null $so_luong
 * @property string|null $ghi_chu
 * @property string|null $don_vi_tinh
 * @property string|null $ngay_tao
 * @property int|null $nguoi_tao
 * @property string|null $ngay_cap_nhat
 * @property int|null $nguoi_cap_nhat
 *
 * @property TsPhieuSuaChua $phieuSuaChua
 * @property TsDmVatTu $vatTu
 */
class PhieuSuaChuaVatTu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_phieu_sua_chua_vat_tu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_phieu_sua_chua', 'id_vat_tu'], 'required'],
            [['id_phieu_sua_chua', 'id_vat_tu', 'so_luong', 'nguoi_tao', 'nguoi_cap_nhat'], 'integer'],
            [['ghi_chu'], 'string'],
            [['ngay_tao', 'ngay_cap_nhat'], 'safe'],
            [['don_vi_tinh'], 'string', 'max' => 255],
            [['id_phieu_sua_chua'], 'exist', 'skipOnError' => true, 'targetClass' => PhieuSuaChua::class, 'targetAttribute' => ['id_phieu_sua_chua' => 'id']],
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
            'id_phieu_sua_chua' => 'Id Phieu Sua Chua',
            'id_vat_tu' => 'Vật tư',
            'so_luong' => 'Số lượng',
            'ghi_chu' => 'Ghi chú',
            'don_vi_tinh' => 'Đơn vị tính',
            'ngay_tao' => 'Ngày tạo',
            'nguoi_tao' => 'Người tạo',
            'ngay_cap_nhat' => 'Ngày cập nhật',
            'nguoi_cap_nhat' => 'Người cập nhật',
        ];
    }

    /**
     * Gets query for [[PhieuSuaChua]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhieuSuaChua()
    {
        return $this->hasOne(PhieuSuaChua::class, ['id' => 'id_phieu_sua_chua']);
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
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->ngay_tao = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->id;
            $this->vatTu->so_luong=$this->vatTu->so_luong - $this->so_luong;
            
        }
        else{
            $this->vatTu->so_luong=$this->vatTu->so_luong - $this->so_luong + $this->getOldAttribute('so_luong');
            
        }
        $this->vatTu->ghiChuThayDoi="Sửa chữa thiết bị ".$this->phieuSuaChua->thietBi->ten_thiet_bi;
        $this->vatTu->save();
        $this->ngay_cap_nhat = date('Y-m-d H:i:s');
        $this->nguoi_cap_nhat = Yii::$app->user->id;
        $this->don_vi_tinh=$this->vatTu->don_vi_tinh;
        
        return parent::beforeSave($insert);
    }
    public function beforeDelete(){
        $this->vatTu->so_luong=$this->vatTu->so_luong + $this->so_luong;
        $this->vatTu->ghiChuThayDoi="Sửa chữa thiết bị ".$this->phieuSuaChua->thietBi->ten_thiet_bi;
        $this->vatTu->save();
        return parent::beforeDelete();
    }
    public function getVatTuByKho()
    {
        
        // Giả sử bạn có một model DmVatTu và bảng chứa danh sách vật tư
        if(!$this->isNewRecord)
        return \app\modules\kholuutru\models\DmVatTu::find()
            ->select(['ten_vat_tu','id'])
            ->where(['id_kho' => $this->vatTu->id_kho])
            ->indexBy('id')
            ->column();
        return [];
    }
}
