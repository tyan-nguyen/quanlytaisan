<?php

namespace app\modules\suachua\models;

use Yii;

/**
 * This is the model class for table "ts_ct_bao_gia_sua_chua".
 *
 * @property int $id
 * @property int $id_bao_gia
 * @property int|null $id_dm_bao_gia
 * @property string|null $ten_danh_muc
 * @property int|null $so_luong
 * @property string|null $don_vi_tinh
 * @property float|null $don_gia
 * @property float|null $thanh_tien
 * @property string|null $ngay_tao
 * @property int|null $nguoi_tao
 * @property string|null $ngay_cap_nhat
 * @property int|null $nguoi_cap_nhat
 *
 * @property TsBaoGiaSuaChua $baoGia
 */
class CtBaoGiaSuaChua extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_ct_bao_gia_sua_chua';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_bao_gia'], 'required'],
            [['id_bao_gia', 'id_dm_bao_gia', 'so_luong', 'nguoi_tao', 'nguoi_cap_nhat'], 'integer'],
            [['don_gia', 'thanh_tien'], 'number'],
            [['ngay_tao', 'ngay_cap_nhat'], 'safe'],
            [['ten_danh_muc', 'don_vi_tinh'], 'string', 'max' => 255],
            [['id_bao_gia'], 'exist', 'skipOnError' => true, 'targetClass' => BaoGiaSuaChua::class, 'targetAttribute' => ['id_bao_gia' => 'id']],
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
            'id_dm_bao_gia' => 'Danh mục báo giá',
            'ten_danh_muc' => 'Tên danh mục',
            'so_luong' => 'Số lượng',
            'don_vi_tinh' => 'Đơn vị tính',
            'don_gia' => 'Đơn giá',
            'thanh_tien' => 'Thành tiền',
            'ngay_tao' => 'Ngày tạo',
            'nguoi_tao' => 'Người tạo',
            'ngay_cap_nhat' => 'Ngày cập nhật',
            'nguoi_cap_nhat' => 'Người cập nhật',
        ];
    }
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->ngay_tao = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->id;
        }
        $this->ngay_cap_nhat = date('Y-m-d H:i:s');
        $this->thanh_tien = $this->so_luong*$this->don_gia;
        return parent::beforeSave($insert);
    }
    public function afterSave($insert, $changedAttributes) {
        $baoGia=BaoGiaSuaChua::findOne($this->id_bao_gia);
        $baoGia->phi_linh_kien=$this->sumDmBaoGia(1);
        $baoGia->phi_khac=$this->sumDmBaoGia(2);
        $baoGia->tong_tien=$baoGia->phi_linh_kien + $baoGia->phi_khac;
        $baoGia->save();
        return parent::afterSave($insert, $changedAttributes);
    }
    public function afterDelete(){
        $baoGia=BaoGiaSuaChua::findOne($this->id_bao_gia);
        $baoGia->phi_linh_kien=$this->sumDmBaoGia(1);
        $baoGia->phi_khac=$this->sumDmBaoGia(2);
        $baoGia->tong_tien=$baoGia->phi_linh_kien + $baoGia->phi_khac;
        $baoGia->save();
        return parent::beforeDelete();
    }
    public function sumDmBaoGia($id_dm_bao_gia)
    {
        return CtBaoGiaSuaChua::find()->where([
            "id_bao_gia"=>$this->id_bao_gia,
            "id_dm_bao_gia"=>$id_dm_bao_gia,
            ])->sum("thanh_tien");
    }
    /**
     * Gets query for [[BaoGia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBaoGia()
    {
        return $this->hasOne(BaoGiaSuaChua::class, ['id' => 'id_bao_gia']);
    }
    public function getDmBaoGia()
    {
        return [
            "1"=>"Linh kiện/Phụ kiện",
            "2"=>"khác"
        ];
    }
}
