<?php

namespace app\modules\dungchung\models;

use app\modules\user\models\User;

class CustomFunc 
{    
    /**
     * lay ten tai khoan boi userID
     * @param int $userID
     * @return string
     */
    public function getTenTaiKhoan($userID){
        $model = User::findOne($userID);
        return $model!=NULL?$model->username:'';  
    }
    
    /**
     * chuyen doi ngay chuoi Y-m-d H:i:s -> dd/mm/yyyy H:i:s
     * @param string $date_string
     * @return string
     */
    public function convertYMDHISToDMYHID($date_string){
        return $date_string!=null ? date("d/m/Y(H:i:s)", strtotime($date_string)) : '';
    }
    
    /**
     * chuyen doi ngay chuoi Y-m-d -> dd/mm/yyyy
     * @param string $date_string
     * @return string
     */
    public function convertYMDToDMY($date_string){
        return $date_string!=null ? date("d/m/Y", strtotime($date_string)) : '';
    }
    
    /**
     * chuyen doi ngay chuoi dd/mm/yyyy -> Y-m-d để lưu CSDL
     * @param string $date_string
     * @return string
     */
    public function convertDMYToYMD($date_string){
        if($date_string != null){
            $date_string = str_replace('/', '-', $date_string);
            return date("Y-m-d", strtotime($date_string));
        } else 
            return '';
    }
}