<?php

namespace app\modules\taisan\controllers;

use app\modules\taisan\models\ThietBi;
use app\modules\taisan\models\ThietBiSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use app\modules\user\models\User;
use app\modules\taisan\models\HeThong;
use app\modules\suachua\models\PhieuSuaChuaSearch;
use app\modules\baotri\models\search\PhieuBaoTriSearch;
use app\modules\taisan\models\YeuCauVanHanhCt;
use app\modules\taisan\models\search\ThongKeThietBiSearch;

/**
 * ThietBiController implements the CRUD actions for ThietBi model.
 */
class ThongKeController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }
    
    public function beforeAction($action)
    {
        Yii::$app->params['moduleID'] = 'Module Quản lý tài sản';
        Yii::$app->params['modelID'] = 'Thống kê';
        return parent::beforeAction($action);
    }
    
    public function actionThongKeTaiSanMuaSam($layout=0){
        Yii::$app->params['modelID'] = 'Thống kê tài sản mua sắm';
        
        $searchModel = new ThongKeThietBiSearch();
        if(isset($_POST['search']) && $_POST['search'] != null){
            $dataProvider = $searchModel->search(Yii::$app->request->post(), $_POST['search'], NULL, NULL);
        } else if ($searchModel->load(Yii::$app->request->post())) {
            $searchModel = new ThongKeThietBiSearch(); // "reset"
            $dataProvider = $searchModel->search(Yii::$app->request->post());
        } else {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }
        
        return $this->render('ts-mua-sam', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tsLayout' => $layout
        ]);
    }
    
    public function actionThongKeTaiSanHoatDong($idThietBi=NULL, $tuNgay=NULL, $denNgay=NULL, $showBaoTri=NULL, $showSuaChua=NULL, $showVanHanh=NULL){
        if(!isset($showBaoTri) || $showBaoTri == NULL)
            $showBaoTri = false;
        if(!isset($showSuaChua) || $showSuaChua == NULL)
            $showSuaChua = false;
        if(!isset($showVanHanh) || $showVanHanh == NULL)
            $showVanHanh = false;
        
        Yii::$app->params['modelID'] = 'Thống kê lịch sử sử dụng tài sản/sữa chữa';
        
        $model = ThietBi::findOne($idThietBi);
        $lichSuHoatDong = array();
        if($model!=NULL){
            if($showBaoTri){
                $lichSuHoatDong = array_merge($lichSuHoatDong, $model->getLichSuBaoTri($tuNgay, $denNgay));
            }
            if($showSuaChua){
                $lichSuHoatDong = array_merge($lichSuHoatDong, $model->getLichSuSuaChua($tuNgay, $denNgay));
            }
            if($showVanHanh){
                $lichSuHoatDong = array_merge($lichSuHoatDong, $model->getLichSuVanHanh($tuNgay, $denNgay));
            }
            usort($lichSuHoatDong, function($a, $b) {
                return $a['ngay_sort'] <=> $b['ngay_sort'];
            });
            $lichSuHoatDong = array_reverse($lichSuHoatDong);
        }else{
            $thietBiSearch = new ThietBiSearch();
            if($showBaoTri){
                $lichSuHoatDong = array_merge($lichSuHoatDong, $thietBiSearch->getLichSuBaoTri($tuNgay, $denNgay));
            }
            if($showSuaChua){
                $lichSuHoatDong = array_merge($lichSuHoatDong, $thietBiSearch->getLichSuSuaChua($tuNgay, $denNgay));
            }
            if($showVanHanh){
                $lichSuHoatDong = array_merge($lichSuHoatDong, $thietBiSearch->getLichSuVanHanh($tuNgay, $denNgay));
            }
            usort($lichSuHoatDong, function($a, $b) {
                return $a['ngay_sort'] <=> $b['ngay_sort'];
            });
                $lichSuHoatDong = array_reverse($lichSuHoatDong);
        }
        return $this->render('ts-hoat-dong', [
            'model'=>$model,
            'lichSuHoatDong'=>$lichSuHoatDong,
            'idThietBi'=>$idThietBi,
            'tuNgay'=>$tuNgay,
            'denNgay'=>$denNgay,
            'showBaoTri'=>$showBaoTri,
            'showSuaChua'=>$showSuaChua,
            'showVanHanh'=>$showVanHanh
        ]);
    }
    
}
?>