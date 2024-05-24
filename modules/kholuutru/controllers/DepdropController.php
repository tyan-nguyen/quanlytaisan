<?php

namespace app\modules\kholuutru\controllers;

use Yii;
use yii\web\Controller;
use app\modules\bophan\models\NhanVien;
use yii\web\Response;

/**
 * Default controller for the `kholuutru` module
 */
class DepdropController extends Controller
{
    /**
     * Tra danh sach nhan vien theo dinh dang cua Depdrop
     * @return array
     */
    public function actionGetNhanVien()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];                
                $out = array();                
                if($cat_id != null){
                    $list = NhanVien::find()->where(['id_bo_phan'=>$cat_id])->all();
                    foreach ($list as $indexPhong =>$phong){                        
                        $out[$phong->boPhan->ten_bo_phan][] = ['id'=>$phong->id, 'name'=>$phong->ten_nhan_vien];
                    }
                }                
                return ['output'=>$out, 'selected'=>'2'];
            }
        }
        return ['output'=>'', 'selected'=>''];
    }
}