<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ts_phieu_bao_tri".
 *
 * @property int $id
 * @property int|null $id_ke_hoach
 * @property int|null $ky_thu
 * @property int|null $id_don_vi_bao_tri
 * @property int|null $id_nguoi_chiu_trach_nhiem
 * @property string|null $thoi_gian_bat_dau
 * @property string|null $thoi_gian_ket_thuc
 * @property string|null $noi_dung_thuc_hien
 * @property int|null $da_hoan_thanh
 * @property string|null $thoi_gian_tao
 * @property int|null $nguoi_tao
 *
 * @property TsKeHoachBaoTri $keHoach
 */
class TsPhieuBaoTri extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_phieu_bao_tri';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ke_hoach', 'ky_thu', 'id_don_vi_bao_tri', 'id_nguoi_chiu_trach_nhiem', 'nguoi_tao', 'da_hoan_thanh'], 'integer'],
            [['thoi_gian_bat_dau', 'thoi_gian_ket_thuc', 'thoi_gian_tao'], 'safe'],
            [['noi_dung_thuc_hien'], 'string'],
            [['id_ke_hoach'], 'exist', 'skipOnError' => true, 'targetClass' => TsKeHoachBaoTri::class, 'targetAttribute' => ['id_ke_hoach' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ke_hoach' => 'Id Ke Hoach',
            'ky_thu' => 'Ky Thu',
            'id_don_vi_bao_tri' => 'Id Don Vi Bao Tri',
            'id_nguoi_chiu_trach_nhiem' => 'Id Nguoi Chiu Trach Nhiem',
            'thoi_gian_bat_dau' => 'Thoi Gian Bat Dau',
            'thoi_gian_ket_thuc' => 'Thoi Gian Ket Thuc',
            'noi_dung_thuc_hien' => 'Noi Dung Thuc Hien',
            'da_hoan_thanh' => 'Đã hoàn thành',
            'thoi_gian_tao' => 'Thoi Gian Tao',
            'nguoi_tao' => 'Nguoi Tao',
        ];
    }

    /**
     * Gets query for [[KeHoach]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKeHoach()
    {
        return $this->hasOne(TsKeHoachBaoTri::class, ['id' => 'id_ke_hoach']);
    }
}
