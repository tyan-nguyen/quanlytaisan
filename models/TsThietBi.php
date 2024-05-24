<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ts_thiet_bi".
 *
 * @property int $id
 * @property string|null $autoid
 * @property string $ma_thiet_bi
 * @property int|null $id_vi_tri
 * @property int|null $id_he_thong
 * @property int $id_loai_thiet_bi
 * @property int $id_bo_phan_quan_ly
 * @property string $ten_thiet_bi
 * @property int|null $id_thiet_bi_cha
 * @property int|null $id_layout
 * @property string|null $nam_san_xuat
 * @property string|null $serial
 * @property string|null $model
 * @property string|null $xuat_xu
 * @property int|null $id_hang_bao_hanh
 * @property int|null $id_nhien_lieu
 * @property string|null $dac_tinh_ky_thuat
 * @property int|null $id_lop_hu_hong
 * @property int|null $id_trung_tam_chi_phi
 * @property int|null $id_don_vi_bao_tri
 * @property int $id_nguoi_quan_ly
 * @property string|null $ngay_mua
 * @property string|null $han_bao_hanh
 * @property string|null $ngay_dua_vao_su_dung
 * @property string|null $trang_thai
 * @property string|null $ngay_ngung_hoat_dong
 * @property string|null $ghi_chu
 * @property string|null $thoi_gian_tao
 * @property int|null $nguoi_tao
 *
 * @property TsBoPhan $boPhanQuanLy
 * @property TsLoaiThietBi $loaiThietBi
 * @property TsNhanVien $nguoiQuanLy
 * @property TsKeHoachBaoTri[] $tsKeHoachBaoTris
 */
class TsThietBi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_thiet_bi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ma_thiet_bi', 'id_loai_thiet_bi', 'id_bo_phan_quan_ly', 'ten_thiet_bi', 'id_nguoi_quan_ly'], 'required'],
            [['id_vi_tri', 'id_he_thong', 'id_loai_thiet_bi', 'id_bo_phan_quan_ly', 'id_thiet_bi_cha', 'id_layout', 'id_hang_bao_hanh', 'id_nhien_lieu', 'id_lop_hu_hong', 'id_trung_tam_chi_phi', 'id_don_vi_bao_tri', 'id_nguoi_quan_ly', 'nguoi_tao'], 'integer'],
            [['dac_tinh_ky_thuat', 'ghi_chu'], 'string'],
            [['ngay_mua', 'han_bao_hanh', 'ngay_dua_vao_su_dung', 'ngay_ngung_hoat_dong', 'thoi_gian_tao'], 'safe'],
            [['ma_thiet_bi', 'nam_san_xuat', 'trang_thai'], 'string', 'max' => 20],
            [['autoid', 'ten_thiet_bi', 'serial', 'model'], 'string', 'max' => 255],
            [['xuat_xu'], 'string', 'max' => 100],
            [['id_loai_thiet_bi'], 'exist', 'skipOnError' => true, 'targetClass' => TsLoaiThietBi::class, 'targetAttribute' => ['id_loai_thiet_bi' => 'id']],
            [['id_bo_phan_quan_ly'], 'exist', 'skipOnError' => true, 'targetClass' => TsBoPhan::class, 'targetAttribute' => ['id_bo_phan_quan_ly' => 'id']],
            [['id_nguoi_quan_ly'], 'exist', 'skipOnError' => true, 'targetClass' => TsNhanVien::class, 'targetAttribute' => ['id_nguoi_quan_ly' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'autoid' => 'Autoid',
            'ma_thiet_bi' => 'Ma Thiet Bi',
            'id_vi_tri' => 'Id Vi Tri',
            'id_he_thong' => 'Id He Thong',
            'id_loai_thiet_bi' => 'Id Loai Thiet Bi',
            'id_bo_phan_quan_ly' => 'Id Bo Phan Quan Ly',
            'ten_thiet_bi' => 'Ten Thiet Bi',
            'id_thiet_bi_cha' => 'Id Thiet Bi Cha',
            'id_layout' => 'Id Layout',
            'nam_san_xuat' => 'Nam San Xuat',
            'serial' => 'Serial',
            'model' => 'Model',
            'xuat_xu' => 'Xuat Xu',
            'id_hang_bao_hanh' => 'Id Hang Bao Hanh',
            'id_nhien_lieu' => 'Id Nhien Lieu',
            'dac_tinh_ky_thuat' => 'Dac Tinh Ky Thuat',
            'id_lop_hu_hong' => 'Id Lop Hu Hong',
            'id_trung_tam_chi_phi' => 'Id Trung Tam Chi Phi',
            'id_don_vi_bao_tri' => 'Id Don Vi Bao Tri',
            'id_nguoi_quan_ly' => 'Id Nguoi Quan Ly',
            'ngay_mua' => 'Ngay Mua',
            'han_bao_hanh' => 'Han Bao Hanh',
            'ngay_dua_vao_su_dung' => 'Ngay Dua Vao Su Dung',
            'trang_thai' => 'Trang Thai',
            'ngay_ngung_hoat_dong' => 'Ngay Ngung Hoat Dong',
            'ghi_chu' => 'Ghi Chu',
            'thoi_gian_tao' => 'Thoi Gian Tao',
            'nguoi_tao' => 'Nguoi Tao',
        ];
    }

    /**
     * Gets query for [[BoPhanQuanLy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBoPhanQuanLy()
    {
        return $this->hasOne(TsBoPhan::class, ['id' => 'id_bo_phan_quan_ly']);
    }

    /**
     * Gets query for [[LoaiThietBi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLoaiThietBi()
    {
        return $this->hasOne(TsLoaiThietBi::class, ['id' => 'id_loai_thiet_bi']);
    }

    /**
     * Gets query for [[NguoiQuanLy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNguoiQuanLy()
    {
        return $this->hasOne(TsNhanVien::class, ['id' => 'id_nguoi_quan_ly']);
    }

    /**
     * Gets query for [[TsKeHoachBaoTris]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTsKeHoachBaoTris()
    {
        return $this->hasMany(TsKeHoachBaoTri::class, ['id_thiet_bi' => 'id']);
    }
}
