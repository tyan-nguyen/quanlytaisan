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
     * chuyen doi ngay chuoi Y-m-d H:i:s -> dd/mm/yyyy
     * @param string $date_string
     * @return string
     */
    public function convertYMDHISToDMY($date_string){
        return $date_string!=null ? date("d/m/Y", strtotime($date_string)) : '';
    }
    /**
     * chuyen doi ngay chuoi Y-m-d H:i:s -> Y-m-d
     * @param string $date_string
     * @return string
     */
    public function convertYMDHISToYMD($date_string){
        return $date_string!=null ? date("Y-m-d", strtotime($date_string)) : '';
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
    
    /**
     * chuyen doi ngay chuoi dd/mm/yyyy -> Y-m-d h:i:s để lưu CSDL
     * @param string $date_string
     * @return string
     */
    public function convertDMYToYMDHIS($date_string){
        if($date_string != null){
            $date_string = str_replace('/', '-', $date_string);
            return date("Y-m-d 07:00:00", strtotime($date_string));
        } else
            return '';
    }
    
    /**
     * tinh so ngay hoat dong = ngay ket thuc - ngay bat dau, neu ngay bat dau = ket thuc thi ket qua la 1 ngay
     * $fromDate: Y-m-d H:i:s
     * $toDate: Y-m-d H:i:s
     */
    public static function calculateDayActivity($fromDate, $toDate){
        $timeStart = new \DateTime($fromDate);
        $timeEnd = new \DateTime($toDate);
        return $timeStart->diff($timeEnd)->format("%r%a") + 1;// 0 is 1, 1 is 2
    }
}