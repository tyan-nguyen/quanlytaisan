<?php

namespace app\modules\baotri\controllers;

use app\modules\baotri\models\KeHoachBaoTri;
use app\modules\baotri\models\KeHoachBaoTriSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * KeHoachBaoTriController implements the CRUD actions for KeHoachBaoTri model.
 */
class LichBaoTriController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    
    public function beforeAction($action)
    {
        Yii::$app->params['moduleID'] = 'Module Quản lý Bảo trì-Bảo dưỡng';
        Yii::$app->params['modelID'] = 'Quản lý Kế hoạch bảo trì';
        return parent::beforeAction($action);
    }
    
    public function actionIndex(){
        return $this->render('index');
    }
    
    public function actionBaotri(){
           
        $searchModel = new KeHoachBaoTriSearch();
        if(isset($_POST['search']) && $_POST['search'] != null){
            $dataProvider = $searchModel->searchDS(Yii::$app->request->post(), $_POST['search']);
        } else if ($searchModel->load(Yii::$app->request->post())) {
            $searchModel = new KeHoachBaoTriSearch(); // "reset"
            $dataProvider = $searchModel->searchDS(Yii::$app->request->post());
        } else {
            //$dataProvider = $searchModel->searchDS(Yii::$app->request->queryParams);echo date('Y-m-d', strtotime($date. ' + 5 days'));
            $parames= ['tuNgay'=>date("Y-m-d"), 'denNgay'=>date("Y-m-d",strtotime(date("Y-m-d"). ' + 30 days'))];
            $dataProvider = $searchModel->searchDS($parames);
            //var_dump($parames);
        }
        
        return $this->render('dsToiHan', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); 
    }
    
    /**
     * Displays a single KeHoachBaoTri model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
       
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title'=> "Kế hoạch bảo trì",
                'content'=>$this->renderAjax('view', [
                    'model' => KeHoachBaoTri::findOne($id),
                ]),
                'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                Html::a('Sửa',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
            ];
        }else{
            return $this->render('view', [
                'model' => KeHoachBaoTri::findOne($id),
            ]);
        }
        
    }
    
    public function actionTest(){
        echo date("d/m/Y");
    }
    
}