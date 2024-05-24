<?php

namespace app\modules\dungchung\models;

use Yii;

class TaiLieu extends TaiLieuBase
{
    /**
     * get tai lieu thuoc id tham chieu
     * @param string $loai
     * @param int $idthamchieu
     * @return \yii\db\ActiveRecord[]
     */
    public static function getTaiLieuThamChieu($loai, $idthamchieu){
        return TaiLieu::find()->where([
            'loai' => $loai,
            'id_tham_chieu' => $idthamchieu
        ])->orderBy('ID DESC')->all();
    }
    
    /**
     * xoa tat ca tai lieu thuoc id tham chieu(khi xoa tham chieu)
     * @param string $loai
     * @param int $idthamchieu
     */
    public static function xoaTaiLieuThamChieu($loai, $idthamchieu){
        $models = TaiLieu::getTaiLieuThamChieu($loai, $idthamchieu);
        foreach ($models as $indexMod=>$model){
            $model->delete();
        }
    }
    
    /**
     * get tai lieu ext url image
     * @return string
     */
    public function getExtUrl(){
        return Yii::getAlias('@web') . $this::FOLDER_DOCUMENTS_ICONS . $this->file_extension . '.' . 'png';
    }
    
    /**
     * get tai lieu url
     * @return string
     */
    public function getFileUrl(){
        return Yii::getAlias('@web') . $this::FOLDER_DOCUMENTS . $this->duong_dan;
    }
    
    /**
     * file size by KB
     * @return string
     */
    public function getSizeKB(){
        return ceil($this->file_size/1024) . ' KB';
    }
}
