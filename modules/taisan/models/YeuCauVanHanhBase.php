<?php

namespace app\modules\taisan\models;

use Yii;
use app\modules\bophan\models\NhanVien;
use app\modules\dungchung\models\DungChung;
use app\modules\dungchung\models\CustomFunc;
use app\modules\bophan\models\BoPhan;
use app\modules\user\models\User;
use app\widgets\views\StatusWithIconWidget;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class YeuCauVanHanhBase extends \app\models\TsYeuCauVanHanh
{
    const MODEL_ID = 'yeu-cau-van-hanh';

    const STATUS_NHAP = 'NHAP';
    const STATUS_DAGUI = 'DAGUI';
    const STATUS_CHODUYET = 'CHODUYET';
    const STATUS_DADUYET = 'DADUYET';
    const STATUS_VANHANH = 'VANHANH';
    const STATUS_DATRA = 'DATRA';

    const  SCENARIO_SEND_REQUEST = 'send_request';

    // public $idNguoiDuyet;
    // public $ngayDuyet;
    // public $noiDungDuyet;

    /**
     * Danh muc trang thai hieu luc
     * @return string[]
     */
    public static function getDmHieuLuc()
    {
        return [
            YeuCauVanHanhBase::STATUS_NHAP => 'Nháp',
            YeuCauVanHanhBase::STATUS_DAGUI => 'Đã gửi',
            YeuCauVanHanhBase::STATUS_CHODUYET => 'Chờ duyệt',
            YeuCauVanHanhBase::STATUS_DADUYET => 'Đã duyệt',
            YeuCauVanHanhBase::STATUS_DATRA => 'Đã trả',
            YeuCauVanHanhBase::STATUS_VANHANH => 'Đang vận hành',
        ];
    }

    /**
     * Danh muc Ten trang thai
     * @param int $val
     * @return string
     */
    public function getTenHieuLuc($val = NULL)
    {
        if ($val == NULL) {
            $val = $this->hieu_luc;
        }
        switch ($val) {
            case YeuCauVanHanhBase::STATUS_NHAP:
                $label = "Nháp";
                break;
            case YeuCauVanHanhBase::STATUS_DAGUI:
                $label = "Đã gửi";
                break;
            case YeuCauVanHanhBase::STATUS_VANHANH:
                $label = "Đang vận hành";
                break;
            case YeuCauVanHanhBase::STATUS_CHODUYET:
                $label = "Chờ duyệt";
                break;
            case YeuCauVanHanhBase::STATUS_DADUYET:
                $label = "Đã duyệt";
                break;
            case YeuCauVanHanhBase::STATUS_DATRA:
                $label = "Đã trả";
                break;
            default:
                $label = '';
        }
        return $label;
    }

    public function getTenHieuLucWithBadge($val = NULL)
    {
        if ($val == NULL) {
            $val = $this->hieu_luc;
        }
        switch ($val) {
            case "NHAP":
                $label = "Nháp";
                $icon = 'fe fe-file';
                $type = 'default';
                break;

            case "DAGUI":
                $label = "Đã gửi";
                $icon = 'fe fe-send';
                $type = 'default';
                break;
            case "CHODUYET":
                $label = "Chờ duyệt";
                $icon = 'fe fe-clock';
                $type = 'warning';
                break;
            case "DADUYET":
                $label = "Đã duyệt";
                $icon = 'fe fe-check';
                $type = 'success';
                break;

            case "VANHANH":
                $label = "Đang vận hành";
                $icon = 'fe fe-check';
                $type = 'warning';
                break;
            case "DATRA":
                $label = "Đã trả";
                $icon = 'fe fe-check';
                $type = 'primary';
                break;
            default:
                $label = '';
        }
        return $label != '' ? StatusWithIconWidget::widget([
            'label' => $label,
            'icon' => $icon,
            'type' => $type
        ]) : '';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_nguoi_lap'], 'required'],
            // [['id_nguoi_gui' ,'ngay_gui'], 'required', 'on' => self::SCENARIO_SEND_REQUEST],
            [
                ['id_nguoi_lap', 'id_nguoi_yeu_cau', 'id_nguoi_gui', 'id_nguoi_duyet', 'id_nguoi_xuat', 'id_nguoi_nhan', 'id_bo_phan_quan_ly'],
                'integer'
            ],
            [
                [
                    'ngay_lap', 'ngay_duyet', 'ngay_xuat', 'ngay_nhan', 'created_at', 'updated_at', 'deleted_at',
                    'noi_dung_duyet', 'id_nguoi_duyet',
                    'noi_dung_gui', 'id_nguoi_gui',
                    'noi_dung_xuat', 'id_nguoi_xuat',
                    'noi_dung_nhan', 'id_nguoi_nhan'
                    //  'idNguoiDuyet', 'ngayDuyet', 'noiDungDuyet'
                ],
                'safe'
            ],
            [
                ['ly_do', 'hieu_luc', 'noi_dung_lap', 'noi_dung_gui', 'noi_dung_duyet', 'noi_dung_xuat', 'noi_dung_nhan', 'dia_diem', 'cong_trinh'],
                'string', 'max' => 255
            ],

            [['id_bo_phan_quan_ly'], 'exist', 'skipOnError' => true, 'targetClass' => BoPhan::class, 'targetAttribute' => ['id_bo_phan_quan_ly' => 'id']],
            [['id_nguoi_lap'], 'exist', 'skipOnError' => true, 'targetClass' => NhanVien::class, 'targetAttribute' => ['id_nguoi_lap' => 'id']],
            [['id_nguoi_gui'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_nguoi_gui' => 'id']],
            [['id_nguoi_duyet'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_nguoi_duyet' => 'id']],
            [['id_nguoi_xuat'], 'exist', 'skipOnError' => true, 'targetClass' => NhanVien::class, 'targetAttribute' => ['id_nguoi_xuat' => 'id']],
            [['id_nguoi_nhan'], 'exist', 'skipOnError' => true, 'targetClass' => NhanVien::class, 'targetAttribute' => ['id_nguoi_nhan' => 'id']],
            [['id_nguoi_yeu_cau'], 'exist', 'skipOnError' => true, 'targetClass' => NhanVien::class, 'targetAttribute' => ['id_nguoi_yeu_cau' => 'id']],
        ];
    }

    // public function scenarios()
    // {
    //     $scenarios = parent::scenarios();
    //     $scenarios[self::SCENARIO_SEND_REQUEST] = ['id_nguoi_gui', 'ngay_gui'];
    //     return $scenarios;
    // }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_nguoi_lap' => 'Người lập',
            'id_nguoi_yeu_cau' => 'Người yêu cầu',
            'id_nguoi_gui' => 'Người gửi',
            'id_nguoi_duyet' => 'Người duyệt',
            'id_nguoi_xuat' => 'Người xuất',
            'id_nguoi_nhan' => 'Người nhận',
            'id_bo_phan_quan_ly' => 'Bộ phận',
            'cong_trinh' => 'Công trình',

            'ngay_lap' => 'Ngày lập',
            'ngay_gui' => 'Ngày gửi',
            'ngay_duyet' => 'Ngày duyệt',
            'ngay_xuat' => 'Ngày xuất',
            'ngay_nhan' => 'Ngày nhận',

            'ly_do' => 'Lý do yêu cầu',
            'hieu_luc' => 'Hiệu lực',
            'noi_dung_lap' => 'Nội dung lập',
            'noi_dung_gui' => 'Nội dung gửi',
            'noi_dung_duyet' => 'Nội dung duyệt',
            'noi_dung_xuat' => 'Nội dung xuất',
            'noi_dung_nhan' => 'Nội dung nhận',
            'dia_diem' => 'Địa điểm',

            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày cập nhật',
            'deleted_at' => 'Ngày xóa',
        ];
    }

    /**
     * # Relations
     */
    public function getBoPhan()
    {
        return $this->id_bo_phan_quan_ly != NULL ? $this->hasOne(BoPhan::class, ['id' => 'id_bo_phan_quan_ly']) : '';
    }

    public function getNguoiLap()
    {
        return $this->id_nguoi_lap != NULL ? $this->hasOne(NhanVien::class, ['id' => 'id_nguoi_lap']) : NULL;
    }

    // public function getNguoiGui()
    // {
    //     return $this->id_nguoi_gui != NULL ? $this->hasOne(NhanVien::class, ['id' => 'id_nguoi_gui']) : NULL;
    // }
    
    public function getNguoiGui()
    {
        return $this->id_nguoi_gui != NULL ? $this->hasOne(User::class, ['id' => 'id_nguoi_gui']) : NULL;
    }

    public function getNguoiDuyet()
    {
        return $this->id_nguoi_duyet != NULL ? $this->hasOne(User::class, ['id' => 'id_nguoi_duyet']) : NULL;
    }

    public function getNguoiXuat()
    {
        return $this->id_nguoi_xuat != NULL ? $this->hasOne(User::class, ['id' => 'id_nguoi_xuat']) : NULL;
    }

    public function getNguoiNhan()
    {
        return $this->id_nguoi_nhan != NULL ? $this->hasOne(NhanVien::class, ['id' => 'id_nguoi_nhan']) : NULL;
    }

    public function getNguoiYeuCau()
    {
        return $this->id_nguoi_yeu_cau != NULL ? $this->hasOne(NhanVien::class, ['id' => 'id_nguoi_yeu_cau']) : NULL;
    }


    public function getDetails()
    {
        return $this->hasMany(YeuCauVanHanhCt::className(), ['id_yeu_cau_van_hanh' => 'id']);
    }

    public function getCreatedAt()
    {
        $cus = new CustomFunc();
        return $cus->convertYMDToDMY($this->created_at);
    }

    public function getNgayLap()
    {
        $cus = new CustomFunc();
        return $cus->convertYMDToDMY($this->ngay_lap);
    }

    public function getUpdatedAt()
    {
        $cus = new CustomFunc();
        return $cus->convertYMDToDMY($this->updated_at);
    }
    // public function getHeThong()
    // {
    //     return $this->id_he_thong != NULL ? $this->hasOne(HeThong::class, ['id' => 'id_he_thong']) : NULL;
    // }
}
