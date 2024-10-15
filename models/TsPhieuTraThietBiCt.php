<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ts_phieu_tra_thiet_bi_ct".
 *
 * @property int $id
 * @property int $id_thiet_bi
 * @property int $id_phieu_tra_thiet_bi
 * @property string|null $ngay_tra
 * @property string $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 * @property int $id_ycvhct
 */
class TsPhieuTraThietBiCt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_phieu_tra_thiet_bi_ct';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_thiet_bi', 'id_phieu_tra_thiet_bi', 'id_ycvhct'], 'required'],
            [['id_thiet_bi', 'id_phieu_tra_thiet_bi', 'id_ycvhct'], 'integer'],
            [['ngay_tra', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_thiet_bi' => 'Thiết bị',
            'id_phieu_tra_thiet_bi' => 'Id Phieu Tra Thiet Bi',
            'ngay_tra' => 'Ngày trả',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'id_ycvhct'=>'ID Chi tiết phiếu yêu cầu vận hành'
        ];
    }
}
