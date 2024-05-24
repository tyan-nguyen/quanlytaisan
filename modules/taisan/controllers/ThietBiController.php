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

/**
 * ThietBiController implements the CRUD actions for ThietBi model.
 */
class ThietBiController extends Controller
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
				    'copy' => ['POST'],
				],
			],
		];
	}
	
	public function beforeAction($action)
	{
	    Yii::$app->params['moduleID'] = 'Module Quản lý tài sản';
	    Yii::$app->params['modelID'] = 'Quản lý Thiết bị';
	    return parent::beforeAction($action);
	}

    /**
     * Lists all ThietBi models.
     * @return mixed
     */
    public function actionIndex($layout=0)
    {    
        $searchModel = new ThietBiSearch();
        if(isset($_POST['search']) && $_POST['search'] != null){
            $dataProvider = $searchModel->search(Yii::$app->request->post(), $_POST['search'], NULL, NULL);
        } else if ($searchModel->load(Yii::$app->request->post())) {
            $searchModel = new ThietBiSearch(); // "reset"
            $dataProvider = $searchModel->search(Yii::$app->request->post());
        } else {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        } 
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tsLayout' => $layout
        ]);
    }
    
    /**
     * Lists all ThietBi models for user.
     * @return mixed
     */
    public function actionIndexUser($layout=0)
    {
        $searchModel = new ThietBiSearch();
        $user = User::findOne(Yii::$app->user->id);
        $idUser = ($user->idNhanVien != NULL) ? $user->idNhanVien : '0';//khong co tai khoan thi ko load
        if(isset($_POST['search']) && $_POST['search'] != null){
            $dataProvider = $searchModel->search(Yii::$app->request->post(), $_POST['search'], $idUser, NULL);
        } else if ($searchModel->load(Yii::$app->request->post())) {
            $searchModel = new ThietBiSearch(); // "reset"
            $dataProvider = $searchModel->search(Yii::$app->request->post(), NULL, $idUser, NULL);
        } else {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, NULL, $idUser, NULL);
        }
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tsLayout' => $layout
        ]);
    }
    
    /**
     * Lists all ThietBi models for bo phan.
     * @return mixed
     */
    public function actionIndexBoPhan($layout=0)
    {
        $searchModel = new ThietBiSearch();
        $user = User::findOne(Yii::$app->user->id);
        $idBoPhan = ($user->idBoPhan != NULL) ? $user->idBoPhan : '0';//khong co tai khoan thi ko load
        if(isset($_POST['search']) && $_POST['search'] != null){
            $dataProvider = $searchModel->search(Yii::$app->request->post(), $_POST['search'], NULL, $idBoPhan);
        } else if ($searchModel->load(Yii::$app->request->post())) {
            $searchModel = new ThietBiSearch(); // "reset"
            $dataProvider = $searchModel->search(Yii::$app->request->post(), NULL, NULL, $idBoPhan);
        } else {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, NULL, NULL, $idBoPhan);
        }
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tsLayout' => $layout
        ]);
    }
     
    /**
     * quet qrcode in thiet bi index page
     */
    public function actionQrScan(){
        $request = Yii::$app->request;
        if($request->isAjax){
            $model = new ThietBi();
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "QR Scan",
                    'content'=>$this->renderAjax('qr-scan', compact('model')),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                    Html::button('Tìm thiết bị',['class'=>'btn btn-primary','type'=>"submit", 'id'=>'btnQrScan'])
                ];
            }else{
                $model->load($request->post());
                $model2 = ThietBi::findOne(['autoid'=>$model->autoid]);
                if( $model2 !=null){
                    return [
                        'title'=> "Thiết bị #".$model2->id,
                        'content'=>$this->renderAjax('view', ['model'=>$model2]),
                        'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                        Html::a('Sửa',['update','id'=>$model2->id],['class'=>'btn btn-primary','role'=>'modal-remote']).
                        Html::a('<i class="fa fa-qrcode" aria-hidden="true"></i> Tiếp tục Scan',['qr-scan'],['class'=>'btn btn-info','role'=>'modal-remote'])
                    ];
                } else {
                    $model->autoid = '';//set lai textbox
                    return [
                        'title'=> "QR Scan",
                        'content'=>$this->renderAjax('qr-scan',compact('model')),
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                        Html::button('Tìm thiết bị',['class'=>'btn btn-primary','type'=>"submit", 'id'=>'btnQrScan'])
                    ];
                }
            }
        }
    }


    /**
     * Displays a single ThietBi model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Thiết bị/tài sản",
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                            Html::a('Sửa',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote']).
                        Html::a('Copy',['copy','id'=>$id],[
                            'class'=>'btn btn-warning',
                            'role'=>'modal-remote',
                            'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                            'data-request-method'=>'post',
                            'data-toggle'=>'tooltip',
                            'data-confirm-title'=>'Thông báo',
                            'data-confirm-message'=>'Dữ liệu sẽ được nhân đôi ngoại trừ mã thiết bị. Bạn có chắc chắn thực hiện không?',
                        ])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }
    
    public function actionCopy($id){
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model = ThietBi::findOne($id);
            $data = $model->attributes;
            $model2 = new ThietBi();
            $model2->setAttributes($data);
            $model2->autoid = null;
            $model2->ma_thiet_bi = $model->ma_thiet_bi . '-copy';
            $model2->thoi_gian_tao = null;
            $model2->nguoi_tao = null;
            if($model2->save()){
                return [
                    'title'=> "Thiết bị/tài sản",
                    'forceReload'=>'#crud-datatable-pjax',
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($model2->id),
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                    Html::a('Sửa',['update','id'=>$model2->id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
            }
        }
    }

    /**
     * Creates a new ThietBi model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new ThietBi();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Thêm mới thiết bị",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit", 'value'=>'luuTam'])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                $submitType = isset($request->post()['submitType'])?$request->post()['submitType']:'';
                if($submitType == 'luuTam'){
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Cập nhật nhân viên",
                        'content'=>$this->renderAjax('update', [
                            'model' => $model,
                        ]),
                        'tcontent'=>'Đã lưu tạm thông tin, vui lòng thêm hình ảnh (nếu có)!',
                        'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                        Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                        
                    ];   
                }
                else{
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        //'title'=> "Thêm mới Nhân viên",
                        //'content'=>'<span class="text-success">Thêm mới thành công</span>',
                        'title'=>'Tài sản/Thiết bị',
                        'content'=>$this->renderAjax( ('view'), [
                            'model' => $model,
                        ]),
                        'tcontent'=>'Thêm mới thành công!',
                        'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::a('Tiếp tục thêm',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
            
                    ];
                }        
            }else{           
                return [
                    'title'=> "Thêm mới thiết bị",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing ThietBi model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Cập nhật Tài sản/Thiết bị",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Tài sản/Thiết bị",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                            Html::a('Sửa',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Cập nhật thiết bị ".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing ThietBi model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

     /**
     * Delete multiple existing ThietBi model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    /**
     * Finds the ThietBi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ThietBi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ThietBi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
