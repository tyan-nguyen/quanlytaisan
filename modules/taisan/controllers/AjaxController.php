<?php

namespace app\modules\taisan\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\modules\taisan\models\ThietBi;
use app\modules\taisan\models\HeThong;

/**
 * Default controller for the `taisan` module
 */
class AjaxController extends Controller
{
    public $freeAccess = true;
    
    public function behaviors()
    {
    	return [
    		'ghost-access'=> [
    			'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
    		],
    	];
    }
    /**
     * use in form taisan
     * @return string[]|NULL[][]|string[]
     */
    public function actionGetTaiSanByHeThong(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = array();
                if($cat_id != null){
                    $heThong = HeThong::findOne($cat_id);
                    $list = ThietBi::find()->where(['id_he_thong'=>$cat_id])->all();
                    foreach ($list as $indexHt =>$ht){
                        $out[$heThong->ten_he_thong][] = ['id'=>$ht->id, 'name'=>$ht->ten_thiet_bi];
                    }
                }
                return ['output'=>$out, 'selected'=>'2'];
            }
        }
        return ['output'=>'', 'selected'=>''];
    }
}
