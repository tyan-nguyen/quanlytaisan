<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ts_bo_phan".
 *
 * @property int $id
 * @property string $ma_bo_phan
 * @property string $ten_bo_phan
 * @property int|null $truc_thuoc
 * @property int|null $la_dv_quan_ly
 * @property int|null $la_dv_su_dung
 * @property int|null $la_dv_bao_tri
 * @property int|null $la_dv_van_tai
 * @property int|null $la_dv_mua_hang
 * @property int|null $la_dv_quan_ly_kho
 * @property int|null $la_trung_tam_chi_phi
 * @property int|null $id_kho_vat_tu
 * @property int|null $id_kho_phe_lieu
 * @property int|null $id_kho_thanh_pham
 * @property string|null $thoi_gian_tao
 * @property int|null $nguoi_tao
 *
 * @property TsKeHoachBaoTri[] $tsKeHoachBaoTris
 * @property TsNhanVien[] $tsNhanViens
 * @property TsThietBi[] $tsThietBis
 */
class TsBoPhan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_bo_phan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ma_bo_phan', 'ten_bo_phan'], 'required'],
            [['truc_thuoc', 'la_dv_quan_ly', 'la_dv_su_dung', 'la_dv_bao_tri', 'la_dv_van_tai', 'la_dv_mua_hang', 'la_dv_quan_ly_kho', 'la_trung_tam_chi_phi', 'id_kho_vat_tu', 'id_kho_phe_lieu', 'id_kho_thanh_pham', 'nguoi_tao'], 'integer'],
            [['thoi_gian_tao'], 'safe'],
            [['ma_bo_phan'], 'string', 'max' => 20],
            [['ten_bo_phan'], 'string', 'max' => 255],
            [['ma_bo_phan'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ma_bo_phan' => 'Ma Bo Phan',
            'ten_bo_phan' => 'Ten Bo Phan',
            'truc_thuoc' => 'Truc Thuoc',
            'la_dv_quan_ly' => 'La Dv Quan Ly',
            'la_dv_su_dung' => 'La Dv Su Dung',
            'la_dv_bao_tri' => 'La Dv Bao Tri',
            'la_dv_van_tai' => 'La Dv Van Tai',
            'la_dv_mua_hang' => 'La Dv Mua Hang',
            'la_dv_quan_ly_kho' => 'La Dv Quan Ly Kho',
            'la_trung_tam_chi_phi' => 'La Trung Tam Chi Phi',
            'id_kho_vat_tu' => 'Id Kho Vat Tu',
            'id_kho_phe_lieu' => 'Id Kho Phe Lieu',
            'id_kho_thanh_pham' => 'Id Kho Thanh Pham',
            'thoi_gian_tao' => 'Thoi Gian Tao',
            'nguoi_tao' => 'Nguoi Tao',
        ];
    }

    /**
     * Gets query for [[TsKeHoachBaoTris]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTsKeHoachBaoTris()
    {
        return $this->hasMany(TsKeHoachBaoTri::class, ['id_don_vi_bao_tri' => 'id']);
    }

    /**
     * Gets query for [[TsNhanViens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTsNhanViens()
    {
        return $this->hasMany(TsNhanVien::class, ['id_bo_phan' => 'id']);
    }

    /**
     * Gets query for [[TsThietBis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTsThietBis()
    {
        return $this->hasMany(TsThietBi::class, ['id_bo_phan_quan_ly' => 'id']);
    }
}
