<?php

namespace app\modules\muasam\models;

use Yii;
use app\modules\taisan\models\LoaiThietBi;
use app\modules\dungchung\models\CustomFunc;
/**
 * This is the model class for table "ts_ct_phieu_mua_sam".
 *
 * @property int $id
 * @property int $id_phieu_mua_sam
 * @property string $ten_thiet_bi
 * @property int $id_loai_thiet_bi
 * @property string|null $dac_tinh_ky_thuat
 * @property int|null $so_luong
 * @property string|null $trang_thai
 * @property string|null $ghi_chu
 * @property int|null $nguoi_tao
 * @property string|null $ngay_tao
 * @property int|null $nguoi_cap_nhat
 * @property string|null $ngay_cap_nhat
 *
 * @property TsLoaiThietBi $loaiThietBi
 * @property TsPhieuMuaSam $phieuMuaSam
 * @property TsCtBaoGiaMuaSam[] $tsCtBaoGiaMuaSams
 */
class CtPhieuMuaSam extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_ct_phieu_mua_sam';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_phieu_mua_sam', 'ten_thiet_bi', 'id_loai_thiet_bi'], 'required'],
            [['id_phieu_mua_sam', 'id_loai_thiet_bi', 'so_luong', 'nguoi_tao', 'nguoi_cap_nhat'], 'integer'],
            [['dac_tinh_ky_thuat', 'ghi_chu'], 'string'],
            [['ngay_tao', 'ngay_cap_nhat'], 'safe'],
            [['ten_thiet_bi', 'trang_thai'], 'string', 'max' => 255],
            [['id_loai_thiet_bi'], 'exist', 'skipOnError' => true, 'targetClass' => LoaiThietBi::class, 'targetAttribute' => ['id_loai_thiet_bi' => 'id']],
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
            'id_phieu_mua_sam' => 'Id Phieu Mua Sam',
            'ten_thiet_bi' => 'Tên thiết bị',
            'id_loai_thiet_bi' => 'Loại thiết bị',
            'dac_tinh_ky_thuat' => 'Đặc tính kỹ thuật',
            'so_luong' => 'Số lượng',
            'trang_thai' => 'Trạng thái',
            'ghi_chu' => 'Ghi chú',
            'nguoi_tao' => 'Người tạo',
            'ngay_tao' => 'Ngày tạo',
            'nguoi_cap_nhat' => 'Người cập nhật',
            'ngay_cap_nhat' => 'Ngày cập nhật'
        ];
    }

    /**
     * Gets query for [[LoaiThietBi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLoaiThietBi()
    {
        return $this->hasOne(LoaiThietBi::class, ['id' => 'id_loai_thiet_bi']);
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
     * Gets query for [[TsCtBaoGiaMuaSams]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTsCtBaoGiaMuaSams()
    {
        return $this->hasMany(CtBaoGiaMuaSam::class, ['id_ct_phieu_mua_sam' => 'id']);
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
