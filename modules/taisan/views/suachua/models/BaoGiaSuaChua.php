<?php

namespace app\modules\suachua\models;

use Yii;

/**
 * This is the model class for table "ts_bao_gia_sua_chua".
 *
 * @property int $id
 * @property int $id_phieu_sua_chua
 * @property string|null $so_bao_gia
 * @property int|null $flag_index
 * @property string|null $ngay_bao_gia
 * @property string|null $ngay_ket_thuc
 * @property string|null $ngay_gui_bg
 * @property string|null $trang_thai
 * @property float|null $phi_linh_kien
 * @property float|null $phi_khac
 * @property float|null $tong_tien
 * @property string|null $ghi_chu_bg1
 * @property string|null $ghi_chu_bg2
 * @property string|null $ngay_tao
 * @property int|null $nguoi_tao
 * @property string|null $ngay_cap_nhat
 * @property int|null $nguoi_cap_nhat
 * @property int|null $nguoi_duyet_bg
 *
 * @property TsPhieuSuaChua $phieuSuaChua
 * @property TsCtBaoGiaSuaChua[] $tsCtBaoGiaSuaChuas
 */
class BaoGiaSuaChua extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_bao_gia_sua_chua';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_phieu_sua_chua'], 'required'],
            [['so_bao_gia', 'id_phieu_sua_chua', 'flag_index', 'nguoi_tao', 'nguoi_cap_nhat', 'nguoi_duyet_bg'], 'integer'],
            [['ngay_bao_gia', 'ngay_ket_thuc', 'ngay_gui_bg', 'ngay_tao', 'ngay_cap_nhat'], 'safe'],
            [['phi_linh_kien', 'phi_khac', 'tong_tien'], 'number'],
            [['ghi_chu_bg1', 'ghi_chu_bg2'], 'string'],
            [['trang_thai'], 'string', 'max' => 255],
            [['id_phieu_sua_chua'], 'exist', 'skipOnError' => true, 'targetClass' => PhieuSuaChua::class, 'targetAttribute' => ['id_phieu_sua_chua' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_phieu_sua_chua' => 'Phiếu sửa chữa',
            'so_bao_gia' => 'Báo giá lần thứ',
            'flag_index' => 'index',
            'ngay_bao_gia' => 'Ngày báo giá',
            'ngay_ket_thuc' => 'Ngày hết hạn',
            'ngay_gui_bg' => 'Ngày gửi báo giá',
            'trang_thai' => 'Trạng thái',
            'phi_linh_kien' => 'Phí linh kiện',
            'phi_khac' => 'Phí khác',
            'tong_tien' => 'Tổng tiền',
            'ghi_chu_bg1' => 'Ghi chú từ người gửi',
            'ghi_chu_bg2' => 'Ghi chú từ người duyệt',
            'ngay_tao' => 'Ngày tạo',
            'nguoi_tao' => 'Người tạo',
            'ngay_cap_nhat' => 'Ngày cập nhật',
            'nguoi_cap_nhat' => 'Người cập nhật',
            'nguoi_duyet_bg' => 'Người duyệt báo giá',
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
     * Gets query for [[TsCtBaoGiaSuaChuas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCtBaoGiaSuaChuas()
    {
        return $this->hasMany(CtBaoGiaSuaChua::class, ['id_bao_gia' => 'id']);
    }
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->ngay_tao = date('Y-m-d H:i:s');
            $this->ngay_bao_gia = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->id;
        }
        if($this->getOldAttribute('trang_thai')!=$this->trang_thai)
        {
            if($this->trang_thai=="approved" || $this->trang_thai=="rejected")
            {
                $this->ngay_ket_thuc = date('Y-m-d H:i:s');
                $this->nguoi_duyet_bg = Yii::$app->user->id;
                $this->flag_index = 0;
                if($this->trang_thai=="rejected")
                $this->flag_index = -1;
                
            }
            if($this->trang_thai=="submited")
            $this->ngay_gui_bg = date('Y-m-d H:i:s');
            //$this->save();
        }
        return parent::beforeSave($insert);
    }
    public function afterSave($insert,$changedAttributes) {

        if(isset($changedAttributes['trang_thai']))
        {
            $phieuSuaChua=$this->phieuSuaChua;
            if($this->trang_thai=="approved")
            {
                
                $phieuSuaChua->trang_thai='processing';
                $phieuSuaChua->phi_linh_kien=$this->phi_linh_kien;
                $phieuSuaChua->phi_khac=$this->phi_khac;
                $phieuSuaChua->tong_tien=$this->tong_tien;
                $phieuSuaChua->save();
            }
            else if($phieuSuaChua->tong_tien)
            {
                $phieuSuaChua->phi_linh_kien=0;
                $phieuSuaChua->phi_khac=0;
                $phieuSuaChua->tong_tien=0;
                $phieuSuaChua->save();
            }
            
        }
        
        return parent::afterSave($insert,$changedAttributes);
    }
    public static function getBaoGiaByPhieuSuaChua($id_phieu_sua_chua)
    {
        $baoGiaSuaChua=BaoGiaSuaChua::find()->where([
            "id_phieu_sua_chua"=>$id_phieu_sua_chua,
            "flag_index"=>0
            ])->one();
        if(!$baoGiaSuaChua)
        {
            $data=[
                "id_phieu_sua_chua"=>$id_phieu_sua_chua,
                "flag_index"=>0,
                "so_bao_gia"=>BaoGiaSuaChua::find()->where([
                    "id_phieu_sua_chua"=>$id_phieu_sua_chua
                    ])->count()+1,
                "trang_thai"=>"draft",
                "phi_linh_kien"=>0,
                "phi_khac"=>0,
                "tong_tien"=>0

            ];
            $baoGiaSuaChua=new BaoGiaSuaChua($data);
            $baoGiaSuaChua->save();
            
            //echo json_encode($baoGiaSuaChua->getErrors());
            return $baoGiaSuaChua;
        }
        return $baoGiaSuaChua;
    }
    public static function getDmTrangThai(){
        return [
            "draft"=>'Nháp',
            "submited"=>'Chờ duyệt',
            "rejected"=>"Từ chối",
            "approved"=>'Đã duyệt',
        ];
    }
}
