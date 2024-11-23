<?php

namespace app\modules\suachua\controllers;

use Yii;
use app\modules\suachua\models\BaoGiaSuaChua;
use app\modules\suachua\models\BaoGiaSuaChuaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\filters\AccessControl;
use app\modules\user\models\User;
use yii\web\ForbiddenHttpException;
use app\modules\suachua\models\PhieuSuaChua;
use app\modules\suachua\models\PhieuSuaChuaSearch;

/**
 * BaoGiaSuaChuaController implements the CRUD actions for BaoGiaSuaChua model.
 */
class XuatKhoSuaChuaController extends Controller
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
        Yii::$app->params['moduleID'] = 'Module Sửa chữa';
        Yii::$app->params['modelID'] = 'Duyệt phiếu xuất kho vật tư sửa chữa';
        
        return parent::beforeAction($action);
    }
    
    /**
     * Lists all BaoGiaSuaChua models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhieuSuaChuaSearch();
        $searchModel->duyet_vt_kho = 'draft_sent';
        if(isset($_POST['search']) && $_POST['search'] != null){
            $dataProvider = $searchModel->search(Yii::$app->request->post(), $_POST['search']);
        } else if ($searchModel->load(Yii::$app->request->post())) {
            $searchModel = new PhieuSuaChuaSearch(); // "reset"
            $dataProvider = $searchModel->search(Yii::$app->request->post());
        } else {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Updates an existing PhieuSuaChua model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param: hanh dong duyet/khongduyet
     * @return mixed
     */
    public function actionUpdate($id, $hanhdong='duyet')
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $title = 'Duyệt';
        if($hanhdong == 'khongduyet')
            $title = 'Không duyệt';
        
        if($request->isAjax){
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "$title phiếu xuất kho vật tư",
                    'content'=>$this->renderAjax('form-duyet', [
                        'model' => $model,
                        'title'=>$title
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                    Html::button('Xác nhận',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post())){
                $act = 'ok';
                if($hanhdong == 'khongduyet')
                    $act = 'draft_reject';
                $model->duyet_vt_kho = $act;
                $model->ngay_duyet_vt_kho = date('Y-m-d H:i:s');
                $model->nguoi_duyet_vt_kho = Yii::$app->user->id;
                if($model->save()){
                    return [
                        'forceClose'=>true,
                        'forceReload'=>'#crud-datatable-pjax',
                        'tcontent'=>"Bạn đã $title phiếu yêu cầu vật tư!",
                    ];
                }else{
                    return [
                        'title'=> "$title phiếu xuất kho vật tư",
                        'content'=>$this->renderAjax('form-duyet', [
                            'model' => $model,
                            'title'=>$title
                        ]),
                        'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                        Html::button('Xác nhận',['class'=>'btn btn-primary','type'=>"submit"])
                    ];
                }
            }else{
                return [
                    'title'=> "$title phiếu xuất kho vật tư",
                    'content'=>$this->renderAjax('form-duyet', [
                        'model' => $model,
                        'title'=>$title
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                    Html::button('Xác nhận',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }
        }
    }
    
    /**
     * Finds the PhieuSuaChua model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PhieuSuaChua the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PhieuSuaChua::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}