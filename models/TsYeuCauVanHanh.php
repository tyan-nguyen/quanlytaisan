<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ts_yeu_cau_van_hanh".
 *
 * @property int $id
 * @property int $id_nguoi_lap
 * @property int|null $id_nguoi_yeu_cau
 * @property int|null $id_nguoi_gui
 * @property int|null $id_nguoi_duyet
 * @property int|null $id_nguoi_xuat
 * @property int|null $id_nguoi_nhan
 * @property int|null $id_bo_phan_quan_ly
 * @property string|null $cong_trinh
 * @property string|null $ngay_lap
 * @property string|null $ngay_gui
 * @property string|null $ngay_duyet
 * @property string|null $ngay_xuat
 * @property string|null $ngay_nhan
 * @property string|null $ly_do
 * @property string|null $hieu_luc
 * @property string|null $noi_dung_lap
 * @property string|null $noi_dung_gui
 * @property string|null $noi_dung_duyet
 * @property string|null $noi_dung_xuat
 * @property string|null $noi_dung_nhan
 * @property string|null $dia_diem
 * @property string $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $loai_phieu
 *
 * @property TsYeuCauVanHanhCt[] $tsYeuCauVanHanhCts
 */
class TsYeuCauVanHanh extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_yeu_cau_van_hanh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_nguoi_lap'], 'required'],
            [['id_nguoi_lap', 'id_nguoi_yeu_cau', 'id_nguoi_gui', 'id_nguoi_duyet', 'id_nguoi_xuat', 'id_nguoi_nhan', 'id_bo_phan_quan_ly'], 'integer'],
            [['ngay_lap', 'ngay_gui', 'ngay_duyet', 'ngay_xuat', 'ngay_nhan', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['cong_trinh', 'ly_do', 'hieu_luc', 'noi_dung_lap', 'noi_dung_gui', 'noi_dung_duyet', 'noi_dung_xuat', 'noi_dung_nhan', 'dia_diem'], 'string', 'max' => 255],
            [['loai_phieu'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_nguoi_lap' => 'Id Nguoi Lap',
            'id_nguoi_yeu_cau' => 'Id Nguoi Yeu Cau',
            'id_nguoi_gui' => 'Id Nguoi Gui',
            'id_nguoi_duyet' => 'Id Nguoi Duyet',
            'id_nguoi_xuat' => 'Id Nguoi Xuat',
            'id_nguoi_nhan' => 'Id Nguoi Nhan',
            'id_bo_phan_quan_ly' => 'Id Bo Phan Quan Ly',
            'cong_trinh' => 'Cong Trinh',
            'ngay_lap' => 'Ngay Lap',
            'ngay_gui' => 'Ngay Gui',
            'ngay_duyet' => 'Ngay Duyet',
            'ngay_xuat' => 'Ngay Xuat',
            'ngay_nhan' => 'Ngay Nhan',
            'ly_do' => 'Ly Do',
            'hieu_luc' => 'Hieu Luc',
            'noi_dung_lap' => 'Noi Dung Lap',
            'noi_dung_gui' => 'Noi Dung Gui',
            'noi_dung_duyet' => 'Noi Dung Duyet',
            'noi_dung_xuat' => 'Noi Dung Xuat',
            'noi_dung_nhan' => 'Noi Dung Nhan',
            'dia_diem' => 'Dia Diem',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'loai_phieu' => 'Loại phiếu'
        ];
    }

    /**
     * Gets query for [[TsYeuCauVanHanhCts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTsYeuCauVanHanhCts()
    {
        return $this->hasMany(TsYeuCauVanHanhCt::class, ['id_yeu_cau_van_hanh' => 'id']);
    }
}
