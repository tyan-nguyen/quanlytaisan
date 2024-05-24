<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ts_nhan_vien".
 *
 * @property int $id
 * @property int $id_bo_phan
 * @property string|null $ma_nhan_vien
 * @property string $ten_nhan_vien
 * @property string|null $ngay_sinh
 * @property int|null $gioi_tinh
 * @property string|null $chuc_vu
 * @property string|null $ten_truy_cap
 * @property string|null $ngay_vao_lam
 * @property int|null $da_thoi_viec
 * @property string|null $ngay_thoi_viec
 * @property string|null $dien_thoai
 * @property string|null $email
 * @property string|null $dia_chi
 * @property string|null $thoi_gian_tao
 * @property int|null $nguoi_tao
 *
 * @property TsBoPhan $boPhan
 * @property TsKeHoachBaoTri[] $tsKeHoachBaoTris
 * @property TsNhanVienKho[] $tsNhanVienKhos
 * @property TsThietBi[] $tsThietBis
 */
class TsNhanVien extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_nhan_vien';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_bo_phan', 'ten_nhan_vien'], 'required'],
            [['id_bo_phan', 'gioi_tinh', 'da_thoi_viec', 'nguoi_tao'], 'integer'],
            [['ngay_vao_lam', 'ngay_thoi_viec', 'thoi_gian_tao'], 'safe'],
            [['dia_chi'], 'string'],
            [['ma_nhan_vien', 'dien_thoai'], 'string', 'max' => 20],
            [['ten_nhan_vien'], 'string', 'max' => 100],
            [['ngay_sinh'], 'string', 'max' => 10],
            [['chuc_vu', 'ten_truy_cap', 'email'], 'string', 'max' => 255],
            [['id_bo_phan'], 'exist', 'skipOnError' => true, 'targetClass' => TsBoPhan::class, 'targetAttribute' => ['id_bo_phan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_bo_phan' => 'Id Bo Phan',
            'ma_nhan_vien' => 'Ma Nhan Vien',
            'ten_nhan_vien' => 'Ten Nhan Vien',
            'ngay_sinh' => 'Ngay Sinh',
            'gioi_tinh' => 'Gioi Tinh',
            'chuc_vu' => 'Chuc Vu',
            'ten_truy_cap' => 'Ten Truy Cap',
            'ngay_vao_lam' => 'Ngay Vao Lam',
            'da_thoi_viec' => 'Da Thoi Viec',
            'ngay_thoi_viec' => 'Ngay Thoi Viec',
            'dien_thoai' => 'Dien Thoai',
            'email' => 'Email',
            'dia_chi' => 'Dia Chi',
            'thoi_gian_tao' => 'Thoi Gian Tao',
            'nguoi_tao' => 'Nguoi Tao',
        ];
    }

    /**
     * Gets query for [[BoPhan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBoPhan()
    {
        return $this->hasOne(TsBoPhan::class, ['id' => 'id_bo_phan']);
    }

    /**
     * Gets query for [[TsKeHoachBaoTris]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTsKeHoachBaoTris()
    {
        return $this->hasMany(TsKeHoachBaoTri::class, ['id_nguoi_chiu_trach_nhiem' => 'id']);
    }

    /**
     * Gets query for [[TsNhanVienKhos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTsNhanVienKhos()
    {
        //return $this->hasMany(TsNhanVienKho::class, ['id_nhan_vien' => 'id']);
    }

    /**
     * Gets query for [[TsThietBis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTsThietBis()
    {
        return $this->hasMany(TsThietBi::class, ['id_nguoi_quan_ly' => 'id']);
    }
}
