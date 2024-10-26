<?php

namespace app\modules\muasam\models;

use Yii;
use app\modules\user\models\User;
use app\modules\bophan\models\DoiTac;
/**
 * This is the model class for table "ts_bao_gia_mua_sam".
 *
 * @property int $id
 * @property int $id_phieu_mua_sam
 * @property string|null $so_bao_gia
 * @property int|null $flag_index
 * @property string|null $ngay_bao_gia
 * @property string|null $ngay_ket_thuc
 * @property string|null $ngay_gui_bg
 * @property string|null $trang_thai
 * @property float|null $tong_tien
 * @property string|null $ghi_chu_bg1
 * @property string|null $ghi_chu_bg2
 * @property int|null $nguoi_tao
 * @property string|null $ngay_tao
 * @property int|null $nguoi_cap_nhat
 * @property string|null $ngay_cap_nhat
 * @property int|null $nguoi_duyet_bg
 *
 * @property TsPhieuMuaSam $phieuMuaSam
 * @property TsCtBaoGiaMuaSam[] $tsCtBaoGiaMuaSams
 */
class BaoGiaMuaSam extends \yii\db\ActiveRecord
{
    const MODEL_ID = 'bao-gia-mua-sam';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_bao_gia_mua_sam';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_phieu_mua_sam','id_dv_bao_gia'], 'required'],
            [['id_phieu_mua_sam', 'flag_index', 'nguoi_tao', 'nguoi_cap_nhat', 'nguoi_duyet_bg','id_dv_bao_gia'], 'integer'],
            [['ngay_bao_gia', 'ngay_ket_thuc', 'ngay_gui_bg', 'ngay_tao', 'ngay_cap_nhat'], 'safe'],
            [['tong_tien','so_bao_gia'], 'number'],
            [['ghi_chu_bg1', 'ghi_chu_bg2'], 'string'],
            [['trang_thai'], 'string', 'max' => 255],
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
            'id_phieu_mua_sam' => 'Số phiếu',
            'id_dv_bao_gia'=> 'Đơn vị báo giá',
            'so_bao_gia' => 'Lần báo giá',
            'flag_index' => 'Flag Index',
            'ngay_bao_gia' => 'Ngày báo giá',
            'ngay_ket_thuc' => 'Ngày duyệt báo giá',
            'ngay_gui_bg' => 'Ngày gửi báo giá',
            'trang_thai' => 'Trạng thái',
            'tong_tien' => 'Tổng tiền',
            'ghi_chu_bg1' => 'Ghi chú người gửi',
            'ghi_chu_bg2' => 'Ghi chú người duyệt',
            'nguoi_tao' => 'Người tạo',
            'ngay_tao' => 'Ngày tạo',
            'nguoi_cap_nhat' => 'Người cập nhật',
            'ngay_cap_nhat' => 'Ngày cập nhật',
            'nguoi_duyet_bg' => 'Người duyệt báo giá',
        ];
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
    public function getDvBaoGia()
    {
        return $this->hasOne(DoiTac::class, ['id' => 'id_dv_bao_gia']);
    }
    /**
     * Gets query for [[TsCtBaoGiaMuaSams]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCtBaoGiaMuaSams()
    {
        $phieuMuaSam=$this->phieuMuaSam;
        if($phieuMuaSam->dm_mua_sam==='thiet_bi')
            return $this->hasMany(CtBaoGiaMuaSam::class, ['id_bao_gia' => 'id']);
        else
            return $this->hasMany(CtBaoGiaMuaSamVt::class, ['id_bao_gia' => 'id']);
    }
    public static function getBaoGiaByPhieuMuaSam($id_phieu_mua_sam)
    {
        $baoGia=BaoGiaMuaSam::find()->where([
            "id_phieu_mua_sam"=>$id_phieu_mua_sam,
            "flag_index"=>0
            ])->one();
        if(!$baoGia)
        {
            $data=[
                "id_phieu_mua_sam"=>$id_phieu_mua_sam,
                "flag_index"=>0,
                "so_bao_gia"=>BaoGiaMuaSam::find()->where([
                    "id_phieu_mua_sam"=>$id_phieu_mua_sam
                    ])->count()+1,
                "trang_thai"=>"draft",
                //"phi_linh_kien"=>0,
                //"phi_khac"=>0,
                "tong_tien"=>0

            ];
            $baoGia=new BaoGiaMuaSam($data);
            $baoGia->save();
            
            //echo json_encode($baoGia->getErrors());
            return $baoGia;
        }
        return $baoGia;
    }
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $phieuMuaSam=$this->phieuMuaSam;
            //chỉ cho tạo báo giá mua sắm ở trạng thái đã duyệt hoặc đã gửi báo giá 
            if(!in_array($phieuMuaSam->trang_thai,['approved','quote_sent']))
            return;
            $this->so_bao_gia=BaoGiaMuaSam::find()->where([
                "id_phieu_mua_sam"=>$this->id_phieu_mua_sam,
                "id_dv_bao_gia"=>$this->id_dv_bao_gia
                ])->count()+1;
            $this->ngay_tao = date('Y-m-d H:i:s');
            $this->ngay_bao_gia = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->id;
        }
        else{
            
        }
        if($this->getOldAttribute('trang_thai')!=$this->trang_thai)
        {
            if(count($this->ctBaoGiaMuaSams)==0)
            return ;
            if($this->trang_thai=="approved" || $this->trang_thai=="rejected")
            {
                $this->ngay_ket_thuc = date('Y-m-d H:i:s');
                $this->nguoi_duyet_bg = Yii::$app->user->id;
                $this->flag_index = 0;
                if($this->trang_thai=="rejected")
                $this->flag_index = -1;
                else{
                    //xử lý duyệt báo giá. là từ chối tất cả các báo giá còn lại
                    $baoGia=BaoGiaMuaSam::find()->where(['id_phieu_mua_sam'=>$this->id_phieu_mua_sam])
                    ->andWhere(['flag_index'=>0])
                    ->andWhere(['<>','id',$this->id])->all();
                    foreach($baoGia as $key=>$bg)
                    {
                        $bg->trang_thai="rejected";
                        $bg->save();
                    }
                }
                
            }
            if($this->trang_thai=="submited")
            $this->ngay_gui_bg = date('Y-m-d H:i:s');
            $this->ngay_cap_nhat = date('Y-m-d H:i:s');
            $this->nguoi_cap_nhat = Yii::$app->user->id;
            //$this->save();
        }
        elseif($this->trang_thai=="rejected" || $this->trang_thai=="approved"){
            //nếu trạng thái đã duyệt hoặc đã từ chói thì không lưu
            return false;
        }
        return parent::beforeSave($insert);
    }
    public function afterSave($insert,$changedAttributes) {

        if(isset($changedAttributes['trang_thai']))
        {
            $phieuMuaSam=$this->phieuMuaSam;
            if($this->trang_thai=="approved")
            {
                
                $phieuMuaSam->trang_thai='processing';
                $phieuMuaSam->tong_phi=$this->tong_tien;
                $phieuMuaSam->save();
                //xóa toàn bộ ct nhập hàng cũ
                PhieuNhapHang::deleteAll(["id_phieu_mua_sam"=>$phieuMuaSam->id]);
                $phieuNhapHang=CtPhieuNhapHang::deleteAll(["id_phieu_mua_sam"=>$phieuMuaSam->id]);
                //đẩy toàn bộ báo giá qua phiếu nhập hàng
                $phieuNhapHang=new PhieuNhapHang([
                    "trang_thai"=>'draft',
                    "id_phieu_mua_sam"=>$phieuMuaSam->id,
                    "ngay_nhap_hang"=>date('Y-m-d H:i:s')
                ]);
                $phieuNhapHang->save();
                foreach($this->ctBaoGiaMuaSams as $key=>$item)
                {
                    //xử lý cho phiếu nhập thiết bị
                    if($phieuMuaSam->dm_mua_sam=='thiet_bi')
                    for ($i = 0; $i < $item->so_luong; $i++)
                    {
                        //$han_bao_hanh= date('Y-m-d', strtotime($phieuNhapHang->ngay_nhap_hang . ' +'.$item->han_bao_hanh.' month'));
                        $han_bao_hanh = new \DateTime($phieuNhapHang->ngay_nhap_hang);
                        $han_bao_hanh->modify('+'.$item->han_bao_hanh.' month');
                        $ctNhapHang=new CtPhieuNhapHang([
                            'ma_thiet_bi' => str_replace('.','',microtime(true)),
                            'id_phieu_mua_sam' => $phieuMuaSam->id,
                            'id_ct_phieu_mua_sam' => $item->id_ct_phieu_mua_sam,
                            'nam_san_xuat' => $item->nam_san_xuat,
                            'id_nguoi_quan_ly' => $phieuMuaSam->id_nguoi_quan_ly,
                            'id_bo_phan_quan_ly' => $phieuMuaSam->id_bo_phan_quan_ly,
                            'model' => $item->model,
                            'xuat_xu' => $item->xuat_xu,
                            'dac_tinh_ky_thuat' => $item->dac_tinh_ky_thuat,
                            'han_bao_hanh' => $han_bao_hanh->format('Y-m-d')
                        ]);
                        
                        $ctNhapHang->save(false);
                        //echo json_encode($ctNhapHang->getErrors());
                    }
                    else{
                        //xử lý cho phiếu nhập vật tư
                        $ctNhapHang=new CtPhieuNhapHangVt([
                            'id_phieu_mua_sam' => $phieuMuaSam->id,
                            'id_ct_phieu_mua_sam_vt' => $item->id_ct_phieu_mua_sam,
                            'hang_san_xuat' => $item->hang_san_xuat,
                            'so_luong' => $item->so_luong,
                            'don_gia' => $item->don_gia,
                            //'id_kho' => $item->id_kho,
                            //'don_vi_tinh' => $item->don_vi_tinh
                        ]);
                        $ctNhapHang->save(false);
                    }
                    

                }
            }
            else if($phieuMuaSam->tong_phi)
            {
                $phieuMuaSam->tong_phi=0;
                $phieuMuaSam->save();
            }
            
        }
        
        return parent::afterSave($insert,$changedAttributes);
    }
    public static function getDmTrangThai(){
        return [
            "draft"=>'Nháp',
            "submited"=>'Chờ duyệt',
            "rejected"=>"Từ chối",
            "approved"=>'Đã duyệt',
        ];
    }
    public static function getColorTrangThai(){
        return [
            "draft"=>'info',
            "submited"=>'warning',
            "rejected"=>"danger",
            "approved"=>'success',
        ];
    }
    public function getNguoiTao()
    {
        return $this->hasOne(User::class, ['id' => 'nguoi_tao']);
    }
    public function getNguoiCapNhat()
    {
        return $this->hasOne(User::class, ['id' => 'nguoi_cap_nhat']);
    }
    public function getNguoiDuyet()
    {
        return $this->hasOne(User::class, ['id' => 'nguoi_duyet_bg']);
    }
    public static function getCountNewByStatus($status){
        return BaoGiaMuaSam::find()->where(['in','trang_thai',$status])->count();
    }
}
