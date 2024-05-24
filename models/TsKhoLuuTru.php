<?php

namespace app\models;

use app\modules\bophan\models\NhanVien;
use Yii;

/**
 * This is the model class for table "ts_kho_luu_tru".
 *
 * @property int $id
 * @property string $ma_kho
 * @property string $ten_kho
 * @property int $loai_kho
 * @property int $id_nguoi_quan_ly
 * @property int $id_bo_phan_quan_ly
 * @property int|null $gia_tri_toi_da
 * @property string|null $dien_thoai
 * @property string|null $email
 * @property string|null $thoi_gian_tao
 * @property int|null $nguoi_tao
 *
 * @property TsNhanVienKho[] $tsNhanVienKhos
 */
class TsKhoLuuTru extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_kho_luu_tru';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ma_kho', 'ten_kho', 'loai_kho', 'id_nguoi_quan_ly', 'id_bo_phan_quan_ly'], 'required'],
            [['loai_kho', 'id_nguoi_quan_ly', 'id_bo_phan_quan_ly', 'gia_tri_toi_da', 'nguoi_tao'], 'integer'],
            [['thoi_gian_tao'], 'safe'],
            [['ma_kho', 'dien_thoai'], 'string', 'max' => 20],
            [['ten_kho', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ma_kho' => 'Ma Kho',
            'ten_kho' => 'Ten Kho',
            'loai_kho' => 'Loai Kho',
            'id_nguoi_quan_ly' => 'Id Nguoi Quan Ly',
            'id_bo_phan_quan_ly' => 'Id Bo Phan Quan Ly',
            'gia_tri_toi_da' => 'Gia Tri Toi Da',
            'dien_thoai' => 'Dien Thoai',
            'email' => 'Email',
            'thoi_gian_tao' => 'Thoi Gian Tao',
            'nguoi_tao' => 'Nguoi Tao',
        ];
    }

    /**
     * Gets query for [[TsNhanVienKhos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTsNhanVienKhos()
    {
        return $this->hasMany(NhanVien::class, ['id_kho' => 'id']);
    }
}
