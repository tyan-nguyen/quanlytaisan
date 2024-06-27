<?php

namespace app\modules\muasam\controllers;

use Yii;
use app\modules\muasam\models\PhieuMuaSam;
use app\modules\muasam\models\PhieuMuaSamSearch;
use app\modules\muasam\models\CtPhieuMuaSamSearch;
use app\modules\muasam\models\CtBaoGiaMuaSamSearch;
use app\modules\muasam\models\CtPhieuNhapHangSearch;
use app\modules\muasam\models\BaoGiaMuaSam;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\filters\AccessControl;

/**
 * PhieuMuaSamController implements the CRUD actions for PhieuMuaSam model.
 */
class PhieuMuaSamController extends Controller
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

    /**
     * Lists all PhieuMuaSam models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new PhieuMuaSamSearch();
  		if(isset($_POST['search']) && $_POST['search'] != null){
            $dataProvider = $searchModel->search(Yii::$app->request->post(), $_POST['search']);
        } else if ($searchModel->load(Yii::$app->request->post())) {
            $searchModel = new PhieuMuaSamSearch(); // "reset"
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
     * Displays a single PhieuMuaSam model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "PhieuMuaSam",
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                            Html::a('Sửa',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new PhieuMuaSam model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new PhieuMuaSam();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Thêm mới phiếu mua sắm",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Thêm mới phiếu mua sắm",
                    'content'=>'<span class="text-success">Thêm mới thành công</span>',
                    'tcontent'=>'Thêm mới thành công!',
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                            Html::a('Thêm thiết bị cần mua',['/muasam/phieu-mua-sam/chi-tiet-phieu-mua-sam','id_phieu_mua_sam'=>$model->id],['class'=>'btn btn-primary'])
        
                ];         
            }else{           
                return [
                    'title'=> "Thêm mới phiếu mua sắm",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
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
     * Updates an existing PhieuMuaSam model.
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
                    'title'=> "Cập nhật phiếu mua sắm",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Phiếu mua sắm",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'tcontent'=>'Cập nhật thành công!',
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                            Html::a('Sửa',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Cập nhật phiếu mua sắm",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
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
                $refererUrl = Yii::$app->request->referrer;
                return $this->redirect($refererUrl);
            } else {
                $refererUrl = Yii::$app->request->referrer;
                return $this->redirect($refererUrl);
            }
        }
    }

    /**
     * Delete an existing PhieuMuaSam model.
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
     * Delete multiple existing PhieuMuaSam model.
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
     * Finds the PhieuMuaSam model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PhieuMuaSam the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PhieuMuaSam::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionChiTietPhieuMuaSam($id_phieu_mua_sam)
    {
        $model = $this->findModel($id_phieu_mua_sam);

        //chi tiết phiếu mua sắm
        $searchModelCt = new CtPhieuMuaSamSearch();
        $searchModelCt->id_phieu_mua_sam=$id_phieu_mua_sam;
  		if(isset($_POST['search']) && $_POST['search'] != null){
            $dataProviderCt = $searchModelCt->search(Yii::$app->request->post(), $_POST['search']);
        } else if ($searchModelCt->load(Yii::$app->request->post())) {
            $searchModelCt = new CtPhieuMuaSamSearch(); // "reset"
            $dataProviderCt = $searchModelCt->search(Yii::$app->request->post());
        } else {
            $dataProviderCt = $searchModelCt->search(Yii::$app->request->queryParams);
        }    

        //báo giá mua sắm
        
        $baoGia=BaoGiaMuaSam::getBaoGiaByPhieuMuaSam($id_phieu_mua_sam);
        $searchModelBg = new CtBaoGiaMuaSamSearch();
        $searchModelBg->id_bao_gia=$baoGia->id;
  		if(isset($_POST['search']) && $_POST['search'] != null){
            $dataProviderBg = $searchModelBg->search(Yii::$app->request->post(), $_POST['search']);
        } else if ($searchModelBg->load(Yii::$app->request->post())) {
            $searchModelBg = new CtBaoGiaMuaSamSearch(); // "reset"
            $dataProviderBg = $searchModelBg->search(Yii::$app->request->post());
        } else {
            $dataProviderBg = $searchModelBg->search(Yii::$app->request->queryParams);
        }

        //chi tiết phiếu nhập
        $searchModelPn = new CtPhieuNhapHangSearch();
        $searchModelPn->id_phieu_mua_sam=$id_phieu_mua_sam;
  		if(isset($_POST['search']) && $_POST['search'] != null){
            $dataProviderPn = $searchModelPn->search(Yii::$app->request->post(), $_POST['search']);
        } else if ($searchModelPn->load(Yii::$app->request->post())) {
            $searchModelPn = new CtPhieuNhapHangSearch(); // "reset"
            $dataProviderPn = $searchModelPn->search(Yii::$app->request->post());
        } else {
            $dataProviderPn = $searchModelPn->search(Yii::$app->request->queryParams);
        }  
        return $this->render('detail', [
            'model' => $model,
            'baoGia'=>$baoGia,
            'searchModelCt' => $searchModelCt,
            'dataProviderCt' => $dataProviderCt,
            'searchModelBg' => $searchModelBg,
            'dataProviderBg' => $dataProviderBg,
            'searchModelPn' => $searchModelPn,
            'dataProviderPn' => $dataProviderPn,
        ]);
    }
}
