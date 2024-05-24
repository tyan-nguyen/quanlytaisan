<?php

namespace app\modules\dungchung\models;

use Yii;

class TaiLieuBase extends \app\models\TsTaiLieu
{
    CONST FOLDER_DOCUMENTS = '/uploads/documents/';
    CONST FOLDER_DOCUMENTS_ICONS = '/uploads/icons/';
    public $file;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['loai', 'id_tham_chieu', 'ten_tai_lieu'], 'required'],
            [['id_tham_chieu', 'nguoi_tao'], 'integer'],
            [['file_size'], 'number'],
            [['ghi_chu'], 'string'],
            [['thoi_gian_tao'], 'safe'],
            [['loai'], 'string', 'max' => 20],
            [['ten_tai_lieu', 'duong_dan', 'ten_file_luu'], 'string', 'max' => 255],
            [['file_extension'], 'string', 'max' => 10],
            [['file'], 'file'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'loai' => 'Loai',
            'id_tham_chieu' => 'Id Tham Chieu',
            'ten_tai_lieu' => 'Ten Tai Lieu',
            'duong_dan' => 'Duong Dan',
            'ten_file_luu' => 'Ten File Luu',
            'file_extension' => 'File Extension',
            'file_size' => 'File Size',
            'ghi_chu' => 'Ghi Chu',
            'thoi_gian_tao' => 'Thoi Gian Tao',
            'nguoi_tao' => 'Nguoi Tao',
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->thoi_gian_tao = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->id;
        }
        return parent::beforeSave($insert);
    }
    
    /**
     * {@inheritdoc}
     * xoa file anh
     */
    public function beforeDelete()
    {
        if($this->duong_dan != NULL){
            $filePath = Yii::getAlias('@webroot') . $this::FOLDER_DOCUMENTS . $this->duong_dan;
            if(file_exists($filePath)){
                unlink($filePath);
            }
        }
        return parent::beforeDelete();
    }
}
