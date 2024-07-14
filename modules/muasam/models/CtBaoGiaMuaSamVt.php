<?php

namespace app\modules\muasam\models;

use Yii;
use app\modules\dungchung\models\CustomFunc;
use app\modules\user\models\User;
/**
 * This is the model class for table "ts_ct_bao_gia_mua_sam_vt".
 *
 * @property int $id
 * @property int $id_bao_gia
 * @property int $id_ct_phieu_mua_sam
 * @property string|null $hang_san_xuat
 * @property int|null $so_luong
 * @property string|null $ghi_chu
 * @property float|null $don_gia
 * @property float|null $thanh_tien
 * @property int|null $nguoi_tao
 * @property string|null $ngay_tao
 * @property int|null $nguoi_cap_nhat
 * @property string|null $ngay_cap_nhat
 *
 * @property TsBaoGiaMuaSam $baoGia
 * @property TsCtPhieuMuaSam $ctPhieuMuaSam
 */
class CtBaoGiaMuaSamVt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_ct_bao_gia_mua_sam_vt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_bao_gia', 'id_ct_phieu_mua_sam'], 'required'],
            [['id_bao_gia', 'id_ct_phieu_mua_sam', 'so_luong', 'nguoi_tao', 'nguoi_cap_nhat'], 'integer'],
            [['hang_san_xuat', 'ghi_chu'], 'string'],
            [['don_gia', 'thanh_tien'], 'number'],
            [['ngay_tao', 'ngay_cap_nhat'], 'safe'],
            [['id_bao_gia'], 'exist', 'skipOnError' => true, 'targetClass' => BaoGiaMuaSam::class, 'targetAttribute' => ['id_bao_gia' => 'id']],
            [['id_ct_phieu_mua_sam'], 'exist', 'skipOnError' => true, 'targetClass' => CtPhieuMuaSamVt::class, 'targetAttribute' => ['id_ct_phieu_mua_sam' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_bao_gia' => 'Báo giá',
            'id_ct_phieu_mua_sam' => 'Vật tư',
            'hang_san_xuat' => 'Hãng sản xuất',
            'so_luong' => 'Số lượng',
            'ghi_chu' => 'Ghi chú',
            'don_gia' => 'Đơn giá',
            'thanh_tien' => 'Thành tiền',
            'nguoi_tao' => 'Người tạo',
            'ngay_tao' => 'Ngày tạo',
            'nguoi_cap_nhat' => 'Người cập nhật',
            'ngay_cap_nhat' => 'Ngày cập nhật',
        ];
    }

    /**
     * Gets query for [[BaoGia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBaoGia()
    {
        return $this->hasOne(BaoGiaMuaSam::class, ['id' => 'id_bao_gia']);
    }

    /**
     * Gets query for [[CtPhieuMuaSam]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCtPhieuMuaSam()
    {
        return $this->hasOne(CtPhieuMuaSamVt::class, ['id' => 'id_ct_phieu_mua_sam']);
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
        if(isset($this->so_luong) && isset($this->don_gia))
        $this->thanh_tien=$this->so_luong * $this->don_gia;
        
        
        
        return parent::beforeSave($insert);
    }
}
