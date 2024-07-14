<?php

namespace app\modules\muasam\models;

use Yii;
use app\modules\user\models\User;
use app\modules\dungchung\models\CustomFunc;
/**
 * This is the model class for table "ts_ct_phieu_nhap_hang_vt".
 *
 * @property int $id
 * @property int|null $id_phieu_mua_sam
 * @property int|null $id_ct_phieu_mua_sam_vt
 * @property string|null $hang_san_xuat
 * @property int|null $so_luong
 * @property string|null $ghi_chu
 * @property float|null $don_gia
 * @property int|null $id_vat_tu
 * @property int|null $id_kho
 * @property string|null $don_vi_tinh
 * @property int|null $nguoi_tao
 * @property string|null $ngay_tao
 * @property int|null $nguoi_cap_nhat
 * @property string|null $ngay_cap_nhat
 *
 * @property TsCtPhieuMuaSamVt $ctPhieuMuaSamVt
 * @property TsPhieuMuaSam $phieuMuaSam
 */
class CtPhieuNhapHangVt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_ct_phieu_nhap_hang_vt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_phieu_mua_sam', 'id_ct_phieu_mua_sam_vt', 'so_luong', 'id_vat_tu', 'id_kho', 'nguoi_tao', 'nguoi_cap_nhat'], 'integer'],
            [['hang_san_xuat', 'ghi_chu'], 'string'],
            [['don_gia'], 'number'],
            [['ngay_tao', 'ngay_cap_nhat'], 'safe'],
            [['don_vi_tinh'], 'string', 'max' => 255],
            [['id_ct_phieu_mua_sam_vt'], 'exist', 'skipOnError' => true, 'targetClass' => CtPhieuMuaSamVt::class, 'targetAttribute' => ['id_ct_phieu_mua_sam_vt' => 'id']],
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
            'id_ct_phieu_mua_sam_vt' => 'Tên vật tư',
            'hang_san_xuat' => 'Hãng sản xuất',
            'so_luong' => 'Số lượng',
            'ghi_chu' => 'Ghi chú',
            'don_gia' => 'Đơn giá',
            'id_vat_tu' => 'Trạng thái nhập',
            'id_kho' => 'Kho lưu trữ',
            'don_vi_tinh' => 'Đơn vị tính',
            'nguoi_tao' => 'Người tạo',
            'ngay_tao' => 'Ngày tạo',
            'nguoi_cap_nhat' => 'Người cập nhật',
            'ngay_cap_nhat' => 'Ngày cập nhật',
        ];
    }

    /**
     * Gets query for [[CtPhieuMuaSamVt]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCtPhieuMuaSamVt()
    {
        return $this->hasOne(CtPhieuMuaSamVt::class, ['id' => 'id_ct_phieu_mua_sam_vt']);
    }
    public function getCtPhieuMuaSam()
    {
        return $this->hasOne(CtPhieuMuaSamVt::class, ['id' => 'id_ct_phieu_mua_sam_vt']);
    }
    /**
     * Gets query for [[PhieuMuaSam]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhieuMuaSam()
    {
        return $this->hasOne(TsPhieuMuaSam::class, ['id' => 'id_phieu_mua_sam']);
    }
    public function beforeSave($insert) {
        //ngaythangnam
        $cus = new CustomFunc();
        if ($this->isNewRecord) {
            $this->ngay_tao = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->id;

        }else{
            $this->ngay_cap_nhat = date('Y-m-d H:i:s');
            $this->nguoi_cap_nhat = Yii::$app->user->id;
            
        }
        
        
        
        return parent::beforeSave($insert);
    }
}
