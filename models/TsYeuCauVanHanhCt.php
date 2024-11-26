<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ts_yeu_cau_van_hanh_ct".
 *
 * @property int $id
 * @property int $id_thiet_bi
 * @property int $id_yeu_cau_van_hanh
 * @property string|null $ngay_bat_dau
 * @property string|null $ngay_ket_thuc
 * @property string|null $ngay_tra_thuc_te
 * @property string $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $id_ycvhct_chuyen
 * @property string|null $loai_van_hanh
 *
 * @property TsThietBi $thietBi
 * @property TsYeuCauVanHanh $yeuCauVanHanh
 */
class TsYeuCauVanHanhCt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_yeu_cau_van_hanh_ct';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_thiet_bi', 'id_yeu_cau_van_hanh'], 'required'],
            [['id_thiet_bi', 'id_yeu_cau_van_hanh', 'id_ycvhct_chuyen'], 'integer'],
            [['ngay_bat_dau', 'ngay_ket_thuc', 'ngay_tra_thuc_te', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['loai_van_hanh'], 'string', 'max' => 20],
            [['id_thiet_bi'], 'exist', 'skipOnError' => true, 'targetClass' => TsThietBi::class, 'targetAttribute' => ['id_thiet_bi' => 'id']],
            [['id_yeu_cau_van_hanh'], 'exist', 'skipOnError' => true, 'targetClass' => TsYeuCauVanHanh::class, 'targetAttribute' => ['id_yeu_cau_van_hanh' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_thiet_bi' => 'Id Thiet Bi',
            'id_yeu_cau_van_hanh' => 'Id Yeu Cau Van Hanh',
            'ngay_bat_dau' => 'Ngay Bat Dau',
            'ngay_ket_thuc' => 'Ngay Ket Thuc',
            'ngay_tra_thuc_te' => 'Ngay Tra Thuc Te',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'id_ycvhct_chuyen' => 'Id Phieu Chuyen',
            'loai_van_hanh' => 'Loai Van Hanh',
        ];
    }

    /**
     * Gets query for [[ThietBi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getThietBi()
    {
        return $this->hasOne(TsThietBi::class, ['id' => 'id_thiet_bi']);
    }

    /**
     * Gets query for [[YeuCauVanHanh]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getYeuCauVanHanh()
    {
        return $this->hasOne(TsYeuCauVanHanh::class, ['id' => 'id_yeu_cau_van_hanh']);
    }
}
