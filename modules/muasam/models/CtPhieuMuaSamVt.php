<?php

namespace app\modules\muasam\models;

use Yii;
use app\modules\dungchung\models\CustomFunc;
use app\modules\kholuutru\models\KhoLuuTru;
/**
 * This is the model class for table "ts_ct_phieu_mua_sam_vt".
 *
 * @property int $id
 * @property int $id_phieu_mua_sam
 * @property string $ten_vat_tu
 * @property int $id_kho
 * @property string|null $hang_san_xuat
 * @property int|null $so_luong
 * @property string|null $trang_thai
 * @property string|null $ghi_chu
 * @property int|null $nguoi_tao
 * @property string|null $ngay_tao
 * @property int|null $nguoi_cap_nhat
 * @property string|null $ngay_cap_nhat
 *
 * @property TsKhoLuuTru $kho
 * @property TsPhieuMuaSam $phieuMuaSam
 * @property TsCtPhieuNhapHangVt[] $tsCtPhieuNhapHangVts
 */
class CtPhieuMuaSamVt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_ct_phieu_mua_sam_vt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_phieu_mua_sam', 'ten_vat_tu', 'id_kho'], 'required'],
            [['id_phieu_mua_sam', 'id_kho', 'so_luong', 'nguoi_tao', 'nguoi_cap_nhat'], 'integer'],
            [['ghi_chu'], 'string'],
            [['ngay_tao', 'ngay_cap_nhat'], 'safe'],
            [['ten_vat_tu', 'hang_san_xuat', 'trang_thai','don_vi_tinh'], 'string', 'max' => 255],
            [['id_kho'], 'exist', 'skipOnError' => true, 'targetClass' => KhoLuuTru::class, 'targetAttribute' => ['id_kho' => 'id']],
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
            'id_phieu_mua_sam' => 'Phiếu mua sắm',
            'ten_vat_tu' => 'Tên vật tư',
            'id_kho' => 'Kho lưu trữ',
            'hang_san_xuat' => 'hãng sản xuất',
            'so_luong' => 'Số lượng',
            'trang_thai' => 'Trạng thái',
            'ghi_chu' => 'Ghi chú',
            'nguoi_tao' => 'Người tạo',
            'ngay_tao' => 'Ngày tạo',
            'nguoi_cap_nhat' => 'Người cập nhật',
            'ngay_cap_nhat' => 'Ngày cập nhật',
            'don_vi_tinh'=>'Đơn vị tính'
        ];
    }

    /**
     * Gets query for [[Kho]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKho()
    {
        return $this->hasOne(KhoLuuTru::class, ['id' => 'id_kho']);
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
     * Gets query for [[TsCtPhieuNhapHangVts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCtPhieuNhapHangVts()
    {
        return $this->hasMany(CtPhieuNhapHangVt::class, ['id_ct_phieu_mua_sam_vt' => 'id']);
    }
    
    public function beforeSave($insert) {
        //ngaythangnam
        $cus = new CustomFunc();
        if ($this->isNewRecord) {
            $this->ngay_tao = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->id;
            $this->trang_thai = "draft";

        }else{
            $this->ngay_cap_nhat = date('Y-m-d H:i:s');
            $this->nguoi_cap_nhat = Yii::$app->user->id;
        }
        
        
        
        return parent::beforeSave($insert);
    }
}
