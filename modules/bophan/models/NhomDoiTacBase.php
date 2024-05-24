<?php

namespace app\modules\bophan\models;

use Yii;

class NhomDoiTacBase extends \app\models\TsNhomDoiTac
{
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
            'ma_nhom' => 'Mã nhóm',
            'ten_nhom' => 'Tên nhóm',
            'thoi_gian_tao' => 'Thời gian tạo',
            'nguoi_tao' => 'Người tạo',
        ];
    }

    /**
     * Gets query for [[TsDoiTacs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTsDoiTacs()
    {
        return $this->hasMany(DoiTac::class, ['id_nhom_doi_tac' => 'id']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->thoi_gian_tao = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->isGuest ? '' : Yii::$app->user->id;
        }
        return parent::beforeSave($insert);
    }
}
