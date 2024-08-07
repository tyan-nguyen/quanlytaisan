<?php

namespace app\modules\suachua\models;

use Yii;
use app\modules\taisan\models\ThietBiBase;
use app\modules\suachua\models\DmTTSuaChua;
use app\modules\dungchung\models\CustomFunc;
/**
 * This is the model class for table "ts_phieu_sua_chua".
 *
 * @property int $id
 * @property int $id_thiet_bi
 * @property int $id_tt_sua_chua
 * @property string|null $ngay_sua_chua
 * @property string|null $ngay_du_kien_hoan_thanh
 * @property string|null $ngay_hoan_thanh
 * @property float|null $phi_linh_kien
 * @property float|null $phi_khac
 * @property float|null $tong_tien
 * @property string|null $trang_thai
 * @property string|null $ngay_tao
 * @property int|null $nguoi_tao
 * @property string|null $ngay_cap_nhat
 * @property int|null $nguoi_cap_nhat
 * @property string|null $ghi_chu1
 * @property string|null $ghi_chu2
 * @property int|null $danh_gia_sc
 *
 * @property TsThietBi $thietBi
 * @property TsBaoGiaSuaChua[] $tsBaoGiaSuaChuas
 * @property TsDmTtSuaChua $ttSuaChua
 */
class PhieuSuaChua extends \yii\db\ActiveRecord
{
    const MODEL_ID = 'phieu-sua-chua';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_phieu_sua_chua';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_thiet_bi', 'id_tt_sua_chua'], 'required'],
            [['id_thiet_bi', 'id_tt_sua_chua', 'nguoi_tao', 'nguoi_cap_nhat', 'danh_gia_sc'], 'integer'],
            [['ngay_sua_chua', 'ngay_du_kien_hoan_thanh', 'ngay_hoan_thanh', 'ngay_tao', 'ngay_cap_nhat'], 'safe'],
            [['phi_linh_kien', 'phi_khac', 'tong_tien'], 'number'],
            [['ghi_chu1', 'ghi_chu2','dia_chi'], 'string'],
            [['trang_thai'], 'string', 'max' => 255],
            [['id_thiet_bi'], 'exist', 'skipOnError' => true, 'targetClass' => ThietBiBase::class, 'targetAttribute' => ['id_thiet_bi' => 'id']],
            [['id_tt_sua_chua'], 'exist', 'skipOnError' => true, 'targetClass' => DmTTSuaChua::class, 'targetAttribute' => ['id_tt_sua_chua' => 'id']],
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
            'id_tt_sua_chua' => 'Trung tâm sửa chữa',
            'ngay_sua_chua' => 'Ngày sửa chữa',
            'ngay_du_kien_hoan_thanh' => 'Ngày dự kiến hoàn thành',
            'ngay_hoan_thanh' => 'Ngày hoàn thành',
            'phi_linh_kien' => 'Phí linh kiện',
            'phi_khac' => 'Phí khác',
            'tong_tien' => 'Tổng tiền',
            'trang_thai' => 'Trạng thái',
            'dia_chi' => 'Địa điểm',
            'ngay_tao' => 'Ngày tạo',
            'nguoi_tao' => 'Người tạo',
            'ngay_cap_nhat' => 'Ngày cập nhật',
            'nguoi_cap_nhat' => 'Người cập nhật',
            'ghi_chu1' => 'Tình trạng hư hỏng',
            'ghi_chu2' => 'Ghi chú 2',
            'danh_gia_sc' => 'Đánh giá',
        ];
    }

    /**
     * Gets query for [[ThietBi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getThietBi()
    {
        return $this->hasOne(ThietBiBase::class, ['id' => 'id_thiet_bi']);
    }

    /**
     * Gets query for [[TsBaoGiaSuaChuas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBaoGiaSuaChuas()
    {
        return $this->hasMany(BaoGiaSuaChua::class, ['id_phieu_sua_chua' => 'id']);
    }
    public function getVatTus()
    {
        return $this->hasMany(PhieuSuaChuaVatTu::class, ['id_phieu_sua_chua' => 'id']);
    }
    public function getBaoGiaSuaChua()
    {
        return $this->hasOne(BaoGiaSuaChua::class, ['id_phieu_sua_chua' => 'id'])->where(["flag_index"=>0]);
    }
    public function getLichSuBaoGiaSuaChuas()
    {
        return $this->hasMany(BaoGiaSuaChua::class, ['id_phieu_sua_chua' => 'id'])->where(['flag_index'=>-1]);
    }
    public function getLichSuSuaChuas()
    {
        return $this->hasMany(PhieuSuaChua::class, ['id_thiet_bi' => 'id_thiet_bi'])->where(['<>','id',$this->id]);
    }
    /**
     * Gets query for [[TtSuaChua]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTtSuaChua()
    {
        return $this->hasOne(DmTTSuaChua::class, ['id' => 'id_tt_sua_chua']);
    }
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->ngay_tao = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->id;
            $this->trang_thai = "new";
        }
        
        //ngaythangnam
        $cus = new CustomFunc();
        if($this->ngay_sua_chua != null)
            $this->ngay_sua_chua = $cus->convertDMYToYMD($this->ngay_sua_chua);
        if($this->ngay_du_kien_hoan_thanh != null)
            $this->ngay_du_kien_hoan_thanh = $cus->convertDMYToYMD($this->ngay_du_kien_hoan_thanh);
        if($this->ngay_hoan_thanh != null)
            $this->ngay_hoan_thanh = $cus->convertDMYToYMD($this->ngay_hoan_thanh);
        
        
        return parent::beforeSave($insert);
    }
    public function afterSave($insert,$changedAttributes) {

        if(isset($changedAttributes['danh_gia_sc']))
        {
            $avg=PhieuSuaChua::find()->where(['id_tt_sua_chua'=>$this->id_tt_sua_chua])->average('danh_gia_sc');
            $this->ttSuaChua->danh_gia=(int) $avg;
            $this->ttSuaChua->save();
            
        }
        
        return parent::afterSave($insert,$changedAttributes);
    }
    public static function getDmTrangThai(){
        return [
            "new"=>'Mới',
            "processing"=>'Đang sửa chữa',
            "completed"=>"Hoàn thành"
        ];
    }
}
