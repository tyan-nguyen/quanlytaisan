<?php

namespace app\modules\kholuutru\models;

use Yii;
use app\modules\user\models\User;
/**
 * This is the model class for table "ts_dm_vat_tu".
 *
 * @property int $id
 * @property string $ten_vat_tu
 * @property int|null $so_luong
 * @property int|null $id_kho
 * @property string|null $don_vi_tinh
 * @property string|null $trang_thai
 * @property float|null $don_gia
 * @property string|null $ngay_tao
 * @property int|null $nguoi_tao
 *
 * @property TsKhoLuuTru $kho
 */
class DmVatTu extends \yii\db\ActiveRecord
{
    const TT_MOI = 'new';
    const TT_HU_HONG = 'damaged';
    /**
     * {@inheritdoc}
     */
    public $ghiChuThayDoi="";
    public static function tableName()
    {
        return 'ts_dm_vat_tu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten_vat_tu'], 'required'],
            [['so_luong', 'id_kho', 'nguoi_tao','so_luong_min'], 'integer'],
            [['don_gia'], 'number'],
            [['ngay_tao'], 'safe'],
            [['ten_vat_tu', 'don_vi_tinh', 'trang_thai','hang_san_xuat'], 'string', 'max' => 255],
            [['id_kho'], 'exist', 'skipOnError' => true, 'targetClass' => KhoLuuTru::class, 'targetAttribute' => ['id_kho' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ten_vat_tu' => 'Tên vật tư',
            'so_luong' => 'Số lượng',
            'so_luong_min'=>'Số lượng giới hạn',
            'id_kho' => 'Kho lưu trữ',
            'don_vi_tinh' => 'Đơn vị tính',
            'hang_san_xuat' => 'Hãng sản xuất',
            'trang_thai' => 'Trạng thái',
            'don_gia' => 'Đơn giá',
            'ngay_tao' => 'Ngày tạo',
            'nguoi_tao' => 'Người tạo',
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
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->ngay_tao = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->id;
            if($this->trang_thai == null)
                $this->trang_thai = self::TT_MOI;
        }

        
        return parent::beforeSave($insert);
    }
    public function getLichSuVatTus()
    {
        return $this->hasMany(LichSuVatTu::class, ['id_vat_tu' => 'id']);
    }
    public static function getDmTrangThai(){
        return [
            self::TT_MOI => 'Mới',
            self::TT_HU_HONG => 'Hư hỏng',

        ];
    }
    public function getNguoiTao()
    {
        return $this->hasOne(User::class, ['id' => 'nguoi_tao']);
    }
    public function afterSave($insert,$changedAttributes) {

        if(isset($changedAttributes['so_luong']))
        {
            $so_luong=$this->so_luong - $changedAttributes['so_luong'];
            //nếu số lượng != 0 thì mới ghi lịch sử
            if($so_luong!=0)
            {
                $lichSu=new LichSuVatTu();
                $lichSu->id_vat_tu=$this->id;
                $lichSu->so_luong_cu=$changedAttributes['so_luong'];
                $lichSu->so_luong_moi=$this->so_luong;
                $lichSu->so_luong=$this->so_luong - $changedAttributes['so_luong'];
                $lichSu->ghi_chu=$this->ghiChuThayDoi;
                $lichSu->save();
            }
            
            
        }
        
        return parent::afterSave($insert,$changedAttributes);
    }
}
