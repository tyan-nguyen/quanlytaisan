<?php

namespace app\modules\baotri\models;

use app\modules\dungchung\models\History;
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
class LoaiBaoTriBase extends \app\models\TsLoaiBaoTri
{
  
    const MODEL_ID = "loaibaotri";
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
            'ten' => 'Tên',
            'ghi_chu' => 'Ghi chú',
            'thoi_gian_tao' => 'Thời gian tạo',
            'nguoi_tao' => 'Người tạo',
        ];
    }

    /**
     * Gets query for [[TsKeHoachBaoTris]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTsKeHoachBaoTris()
    {
        return $this->hasMany(KeHoachBaoTri::class, ['id_loai_bao_tri' => 'id']);
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
    
    /**
     * {@inheritdoc}
     */
    public function afterSave( $insert, $changedAttributes ){
        parent::afterSave($insert, $changedAttributes);
        History::addHistory($this::MODEL_ID, $changedAttributes, $this, $insert);
    }
}
