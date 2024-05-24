<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ts_nhom_doi_tac".
 *
 * @property int $id
 * @property string $ma_nhom
 * @property string $ten_nhom
 * @property string|null $thoi_gian_tao
 * @property int|null $nguoi_tao
 *
 * @property TsDoiTac[] $tsDoiTacs
 */
class TsNhomDoiTac extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_nhom_doi_tac';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ma_nhom', 'ten_nhom'], 'required'],
            [['thoi_gian_tao'], 'safe'],
            [['nguoi_tao'], 'integer'],
            [['ma_nhom'], 'string', 'max' => 20],
            [['ten_nhom'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ma_nhom' => 'Ma Nhom',
            'ten_nhom' => 'Ten Nhom',
            'thoi_gian_tao' => 'Thoi Gian Tao',
            'nguoi_tao' => 'Nguoi Tao',
        ];
    }

    /**
     * Gets query for [[TsDoiTacs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTsDoiTacs()
    {
        return $this->hasMany(TsDoiTac::class, ['id_nhom_doi_tac' => 'id']);
    }
}
