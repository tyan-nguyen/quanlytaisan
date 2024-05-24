<?php

namespace app\modules\dungchung\models;

use Da\QrCode\QrCode;
use Yii;

class DungChung
{
    /**
     * xoa cac hinh anh, history, tai lieu tham chieu den id cua 1 model
     * @param string $loai
     * @param int $idthamchieu
     */
    public static function xoaThamChieu($loai, $idthamchieu){
        HinhAnh::xoaHinhAnhThamChieu($loai, $idthamchieu);
        History::xoaHistoryThamChieu($loai, $idthamchieu);
        TaiLieu::xoaTaiLieuThamChieu($loai, $idthamchieu);
    }
    
    /**
     * tao QR code cho 1 chuoi ky tu
     * @param string $folder // --> ex: /folder/abc/
     * @param string $string
     */
    public static function createQRcode($folder, $string){
        $qrPath = Yii::getAlias('@webroot') . $folder .$string;
        $qrCode = (new QrCode($string))
        // ->useLogo(Yii::getAlias('@webroot/uploads/qrlibs/'). 'logo.png')
        ->setSize(2000)
        ->setMargin(5)
        ->useForegroundColor(0, 0, 0);
        //->useForegroundColor(51, 153, 255);
        
        $qrCode->writeFile($qrPath . '.png');
    }
}