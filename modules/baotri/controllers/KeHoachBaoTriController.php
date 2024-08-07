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
use app\modules\baotri\models\search\PhieuBaoTriSearch;

/**
 * KeHoachBaoTriController implements the CRUD actions for KeHoachBaoTri model.
 */
class KeHoachBaoTriController extends Controller
{
    var $dataProvider= null;
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
	
	/**
	 * tao phieu bao tri theo ke hoach
	 */
	public function actionTaoPhieuBaoTri($id){
	    Yii::$app->response->format = Response::FORMAT_JSON;
	    $model = $this->findModel($id);
	    //tao phieu bao tri tu dong
	    if($model->ky_bao_tri != null && $model->tan_suat > 0 && $model->so_ky > 0 && $model->ngay_bat_dau !=null){
    	    if($model->taoPhieuBaoTri()){
    	        $searchModelBaoTri = new PhieuBaoTriSearch();
    	        $searchModelBaoTri->id_ke_hoach = $model->id;
    	        $dataProviderBaoTri = $searchModelBaoTri->search(Yii::$app->request->queryParams);
    	        return [
    	            'title'=> "Kế hoạch bảo trì",
    	            'content'=>$this->renderAjax('view', [
    	                'model' => $model,
    	                'searchModelBaoTri' => $searchModelBaoTri,
    	                'dataProviderBaoTri'=>$dataProviderBaoTri
    	            ]),
    	            'tcontent'=>'Tạo phiếu bảo trì thành công!',
    	            'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
    	            Html::a('Sửa',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
    	        ];
    	    } else {
    	        return [
    	            'title'=> "Kế hoạch bảo trì",
    	            'content'=>'Tạo phiếu thất bại!',
    	            'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
    	            Html::a('Sửa',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
    	        ];
    	    }
	    }else {
	        
	        return [
	            'title'=> "Kế hoạch bảo trì",
	            'content'=>$this->renderAjax('view', [
	                'model' => $this->findModel($id),
	            ]),
	            'tcontent'=>'Vui lòng cấu hình lại Kế hoạch bảo trì trước khi tạo phiếu!',
	            'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
	            Html::a('Sửa',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
	        ];
	    }
	}

    /**
     * Lists all KeHoachBaoTri models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new KeHoachBaoTriSearch();
  		if(isset($_POST['search']) && $_POST['search'] != null){
            $dataProvider = $searchModel->search(Yii::$app->request->post(), $_POST['search']);
        } else if ($searchModel->load(Yii::$app->request->post())) {
            $searchModel = new KeHoachBaoTriSearch(); // "reset"
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
     * Displays a single KeHoachBaoTri model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model = $this->findModel($id);
            
            $searchModelBaoTri = new PhieuBaoTriSearch();
            $searchModelBaoTri->id_ke_hoach = $model->id;
            $dataProviderBaoTri = $searchModelBaoTri->search(Yii::$app->request->queryParams);
            
            return [
                    'title'=> "Kế hoạch bảo trì",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'searchModelBaoTri' => $searchModelBaoTri,
                        'dataProviderBaoTri'=>$dataProviderBaoTri
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                            Html::a('Sửa',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote']).
                (!$model->checkPhieu ? Html::a('<i class="fe fe-share-2"></i> Tạo phiếu bảo trì',['tao-phieu-bao-tri','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote']) : '' )
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new KeHoachBaoTri model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new KeHoachBaoTri();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Thêm mới Kế hoạch bảo trì",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Thêm mới Kế hoạch bảo trì",
                    'content'=>'<span class="text-success">Thêm mới thành công</span>',
                    'tcontent'=>'Thêm mới thành công!',
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                            Html::a('Tiếp tục thêm',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Thêm mới Kế hoạch bảo trì",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'fromValidate'=>true
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
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
     * Updates an existing KeHoachBaoTri model.
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
                    'title'=> "Cập nhật Kế hoạch bảo trì",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                    (!$model->checkPhieu ? Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"]) : '')
                ];         
            }else if($model->load($request->post()) && $model->save()){
                
                $searchModelBaoTri = new PhieuBaoTriSearch();
                $searchModelBaoTri->id_ke_hoach = $model->id;
                $dataProviderBaoTri = $searchModelBaoTri->search(Yii::$app->request->queryParams);
                
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Kế hoạch bảo trì",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'searchModelBaoTri' => $searchModelBaoTri,
                        'dataProviderBaoTri'=>$dataProviderBaoTri
                    ]),
                    'tcontent'=>'Cập nhật thành công!',
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                            Html::a('Sửa',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Cập nhật Kế hoạch bảo trì",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'fromValidate'=>true
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                     (!$model->checkPhieu ? Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"]) : '')
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
     * Delete an existing KeHoachBaoTri model.
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
     * Delete multiple existing KeHoachBaoTri model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        $delOk = true;
        $fList = array();
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            try{
            	$model->delete();
            }catch(\Exception $e) {
            	$delOk = false;
            	$fList[] = $model->id;
            }
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax',
            			'tcontent'=>$delOk==true?'Xóa thành công!':('Không thể xóa:'.implode('</br>', $fList)),
            ];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    /**
     * Finds the KeHoachBaoTri model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KeHoachBaoTri the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KeHoachBaoTri::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
