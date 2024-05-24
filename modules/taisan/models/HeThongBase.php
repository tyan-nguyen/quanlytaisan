<?php

namespace app\modules\taisan\models;

use Yii;
use app\modules\dungchung\models\History;


class HeThongBase extends \app\models\TsHeThong
{
    //set id cho model (dung de luu dung chung)
    const MODEL_ID = 'hethong';
   
    public function rules()
    {
        return [
            [['ma_he_thong', 'ten_he_thong'], 'required'],
            [['truc_thuoc', 'nguoi_tao'], 'integer'],
            [['mo_ta'], 'string'],
            [['thoi_gian_tao'], 'safe'],
            [['ma_he_thong'], 'string', 'max' => 20],
            [['ten_he_thong'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ma_he_thong' => 'Mã hệ thống',
            'ten_he_thong' => 'Tên hệ thống',
            'truc_thuoc' => 'Trực thuộc',
            'mo_ta' => 'Mô tả',
            'thoi_gian_tao' => 'Thời gian tạo',
            'nguoi_tao' => 'Người tạo',
        ];
    }
    
    /**
     * Gets query for [[trucThuoc]].
     * @return NULL|\yii\db\ActiveQuery
     */
    public function getHeThongTrucThuoc()
    {
        return $this->truc_thuoc!=NULL?$this->hasOne(HeThong::class, ['id' => 'truc_thuoc']):NULL;
    }
    
    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->thoi_gian_tao = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->isGuest ? '' : Yii::$app->user->id;
            if($this->truc_thuoc == null)
                $this->truc_thuoc = 0;
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
