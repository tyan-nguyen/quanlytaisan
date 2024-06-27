<?php

namespace app\modules\muasam\models;

use Yii;
use app\modules\dungchung\models\CustomFunc;
use app\modules\user\models\User;
/**
 * This is the model class for table "ts_ct_bao_gia_mua_sam".
 *
 * @property int $id
 * @property int $id_bao_gia
 * @property int $id_ct_phieu_mua_sam
 * @property int|null $nam_san_xuat
 * @property string|null $model
 * @property string|null $xuat_xu
 * @property string|null $dac_tinh_ky_thuat
 * @property int|null $han_bao_hanh
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
class CtBaoGiaMuaSam extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_ct_bao_gia_mua_sam';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['model','id_bao_gia', 'id_ct_phieu_mua_sam','xuat_xu','nam_san_xuat','han_bao_hanh','so_luong','don_gia'], 'required'],
            [['id_bao_gia', 'id_ct_phieu_mua_sam', 'nam_san_xuat', 'han_bao_hanh', 'so_luong', 'nguoi_tao', 'nguoi_cap_nhat'], 'integer'],
            [['dac_tinh_ky_thuat', 'ghi_chu'], 'string'],
            [['don_gia', 'thanh_tien'], 'number'],
            [['ngay_tao', 'ngay_cap_nhat'], 'safe'],
            [['model', 'xuat_xu'], 'string', 'max' => 255],
            [['id_bao_gia'], 'exist', 'skipOnError' => true, 'targetClass' => BaoGiaMuaSam::class, 'targetAttribute' => ['id_bao_gia' => 'id']],
            [['id_ct_phieu_mua_sam'], 'exist', 'skipOnError' => true, 'targetClass' => CtPhieuMuaSam::class, 'targetAttribute' => ['id_ct_phieu_mua_sam' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_bao_gia' => 'Id Bao Gia',
            'id_ct_phieu_mua_sam' => 'Thiết bị',
            'nam_san_xuat' => 'Năm sản xuất',
            'model' => 'Model',
            'xuat_xu' => 'Xuất xứ',
            'dac_tinh_ky_thuat' => 'Đặc tính kỹ thuật',
            'han_bao_hanh' => 'Hạn bảo hành(tháng)',
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
        return $this->hasOne(CtPhieuMuaSam::class, ['id' => 'id_ct_phieu_mua_sam']);
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
    public function afterSave($insert, $changedAttributes) {
        $baoGia=BaoGiaMuaSam::findOne($this->id_bao_gia);
        $baoGia->tong_tien=$this->sumBaoGia();
        $baoGia->save();
        return parent::afterSave($insert, $changedAttributes);
    }
    public function sumBaoGia()
    {
        return CtBaoGiaMuaSam::find()->where([
            "id_bao_gia"=>$this->id_bao_gia,
            ])->sum("thanh_tien");
    }

    public function getNguoiTao()
    {
        return $this->hasOne(User::class, ['id' => 'nguoi_tao']);
    }
    public function getNguoiCapNhat()
    {
        return $this->hasOne(User::class, ['id' => 'nguoi_cap_nhat']);
    }
}
