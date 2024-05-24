<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ts_loai_bao_tri".
 *
 * @property int $id
 * @property string $ten
 * @property string|null $ghi_chu
 * @property string|null $thoi_gian_tao
 * @property int|null $nguoi_tao
 *
 * @property TsKeHoachBaoTri[] $tsKeHoachBaoTris
 */
class TsLoaiBaoTri extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_loai_bao_tri';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten'], 'required'],
            [['ghi_chu'], 'string'],
            [['thoi_gian_tao'], 'safe'],
            [['nguoi_tao'], 'integer'],
            [['ten'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ten' => 'Ten',
            'ghi_chu' => 'Ghi Chu',
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
        return $this->hasMany(TsKeHoachBaoTri::class, ['id_loai_bao_tri' => 'id']);
    }
}
