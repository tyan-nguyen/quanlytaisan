<?php

namespace app\module\baotri\models;

use app\modules\bophan\models\BoPhan;
use app\modules\bophan\models\NhanVien;
use app\modules\taisan\models\ThietBi;
use Yii;

/**
 * This is the model class for table "ts_ke_hoach_bao_tri".
 *
 * @property int $id
 * @property int|null $id_he_thong
 * @property int $id_thiet_bi
 * @property int|null $id_chi_tiet
 * @property string $ten_cong_viec
 * @property int $id_loai_bao_tri
 * @property string|null $ngay_bao_tri_cuoi
 * @property int $bao_truoc
 * @property string|null $can_cu
 * @property int|null $so_ky
 * @property string|null $ky_bao_tri
 * @property int $id_don_vi_bao_tri
 * @property int $id_nguoi_chiu_trach_nhiem
 * @property string $muc_do_uu_tien
 * @property int|null $truc_thuoc
 * @property float|null $thoi_gian_thuc_hien
 * @property string|null $don_vi_thoi_gian
 * @property int|null $dung_may
 * @property int|null $thue_ngoai
 * @property int|null $da_het_hieu_luc
 * @property string|null $ngay_het_hieu_luc
 * @property string|null $thoi_gian_tao
 * @property int|null $nguoi_tao
 *
 * @property TsBoPhan $donViBaoTri
 * @property TsLoaiBaoTri $loaiBaoTri
 * @property TsNhanVien $nguoiChiuTrachNhiem
 * @property TsThietBi $thietBi
 */
class KeHoachBaoTriBase extends \app\models\TsKeHoachBaoTri
{
    

    public function rules()
    {
        return [
            [['id_he_thong', 'id_thiet_bi', 'id_chi_tiet', 'id_loai_bao_tri', 'bao_truoc', 'so_ky', 'id_don_vi_bao_tri', 'id_nguoi_chiu_trach_nhiem', 'truc_thuoc', 'dung_may', 'thue_ngoai', 'da_het_hieu_luc', 'nguoi_tao'], 'integer'],
            [['id_thiet_bi', 'ten_cong_viec', 'id_loai_bao_tri', 'bao_truoc', 'id_don_vi_bao_tri', 'id_nguoi_chiu_trach_nhiem', 'muc_do_uu_tien'], 'required'],
            [['ngay_bao_tri_cuoi', 'ngay_het_hieu_luc', 'thoi_gian_tao'], 'safe'],
            [['thoi_gian_thuc_hien'], 'number'],
            [['ten_cong_viec'], 'string', 'max' => 255],
            [['can_cu', 'ky_bao_tri', 'muc_do_uu_tien', 'don_vi_thoi_gian'], 'string', 'max' => 20],
//             [['id_thiet_bi'], 'exist', 'skipOnError' => true, 'targetClass' => TsThietBi::class, 'targetAttribute' => ['id_thiet_bi' => 'id']],
//             [['id_loai_bao_tri'], 'exist', 'skipOnError' => true, 'targetClass' => TsLoaiBaoTri::class, 'targetAttribute' => ['id_loai_bao_tri' => 'id']],
//             [['id_don_vi_bao_tri'], 'exist', 'skipOnError' => true, 'targetClass' => TsBoPhan::class, 'targetAttribute' => ['id_don_vi_bao_tri' => 'id']],
//             [['id_nguoi_chiu_trach_nhiem'], 'exist', 'skipOnError' => true, 'targetClass' => TsNhanVien::class, 'targetAttribute' => ['id_nguoi_chiu_trach_nhiem' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_he_thong' => 'Id He Thong',
            'id_thiet_bi' => 'Id Thiet Bi',
            'id_chi_tiet' => 'Id Chi Tiet',
            'ten_cong_viec' => 'Ten Cong Viec',
            'id_loai_bao_tri' => 'Id Loai Bao Tri',
            'ngay_bao_tri_cuoi' => 'Ngay Bao Tri Cuoi',
            'bao_truoc' => 'Bao Truoc',
            'can_cu' => 'Can Cu',
            'so_ky' => 'So Ky',
            'ky_bao_tri' => 'Ky Bao Tri',
            'id_don_vi_bao_tri' => 'Id Don Vi Bao Tri',
            'id_nguoi_chiu_trach_nhiem' => 'Id Nguoi Chiu Trach Nhiem',
            'muc_do_uu_tien' => 'Muc Do Uu Tien',
            'truc_thuoc' => 'Truc Thuoc',
            'thoi_gian_thuc_hien' => 'Thoi Gian Thuc Hien',
            'don_vi_thoi_gian' => 'Don Vi Thoi Gian',
            'dung_may' => 'Dung May',
            'thue_ngoai' => 'Thue Ngoai',
            'da_het_hieu_luc' => 'Da Het Hieu Luc',
            'ngay_het_hieu_luc' => 'Ngay Het Hieu Luc',
            'thoi_gian_tao' => 'Thoi Gian Tao',
            'nguoi_tao' => 'Nguoi Tao',
        ];
    }

    /**
     * Gets query for [[DonViBaoTri]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDonViBaoTri()
    {
        return $this->hasOne(BoPhan::class, ['id' => 'id_don_vi_bao_tri']);
    }

    /**
     * Gets query for [[LoaiBaoTri]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLoaiBaoTri()
    {
       // return $this->hasOne(TsLoaiBaoTri::class, ['id' => 'id_loai_bao_tri']);
    }

    /**
     * Gets query for [[NguoiChiuTrachNhiem]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNguoiChiuTrachNhiem()
    {
        return $this->hasOne(NhanVien::class, ['id' => 'id_nguoi_chiu_trach_nhiem']);
    }

    /**
     * Gets query for [[ThietBi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getThietBi()
    {
        return $this->hasOne(ThietBi::class, ['id' => 'id_thiet_bi']);
    }
}
