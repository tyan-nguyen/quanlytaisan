<?php

namespace app\modules\muasam\controllers;

use Yii;
use app\modules\muasam\models\PhieuMuaSam;
use app\modules\muasam\models\PhieuMuaSamSearch;
use app\modules\muasam\models\CtPhieuMuaSamSearch;
use app\modules\muasam\models\CtPhieuMuaSamVtSearch;
use app\modules\muasam\models\CtBaoGiaMuaSamSearch;
use app\modules\muasam\models\CtBaoGiaMuaSamVtSearch;
use app\modules\muasam\models\CtPhieuNhapHangSearch;
use app\modules\muasam\models\CtPhieuNhapHangVtSearch;
use app\modules\muasam\models\BaoGiaMuaSam;
use app\modules\muasam\models\BaoGiaMuaSamSearch;
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
	
	public function beforeAction($action)
	{
	    Yii::$app->params['moduleID'] = 'Module Quản lý tài sản';
	    Yii::$app->params['modelID'] = 'Quản lý phiếu mua sắm thiết bị';
	    return parent::beforeAction($action);
	}

    /**
     * Lists all PhieuMuaSam models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new PhieuMuaSamSearch();
        $searchModel->dm_mua_sam='thiet_bi';
  		if(isset($_POST['search']) && $_POST['search'] != null){
            $dataProvider = $searchModel->search(Yii::$app->request->post(), $_POST['search']);
        } else if ($searchModel->load(Yii::$app->request->post())) {
            $searchModel = new PhieuMuaSamSearch(); // "reset"
            $searchModel->dm_mua_sam='thiet_bi';
            $dataProvider = $searchModel->search(Yii::$app->request->post());
        } else {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }    
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionListMuaSamVatTu()
    {    
        $searchModel = new PhieuMuaSamSearch();
        $searchModel->dm_mua_sam='vat_tu';
  		if(isset($_POST['search']) && $_POST['search'] != null){
            $dataProvider = $searchModel->search(Yii::$app->request->post(), $_POST['search']);
        } else if ($searchModel->load(Yii::$app->request->post())) {
            $searchModel = new PhieuMuaSamSearch(); // "reset"
            $searchModel->dm_mua_sam='vat_tu';
            $dataProvider = $searchModel->search(Yii::$app->request->post());
        } else {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }    
        return $this->render('list-mua-sam-vat-tu', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionDuyetPhieuMuaSam()
    {    
        $searchModel = new PhieuMuaSamSearch();
        $searchModel->trang_thai='submited';
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
    public function actionCreate($dm_mua_sam='thiet_bi')
    {
        $request = Yii::$app->request;
        $model = new PhieuMuaSam();  
        $model->dm_mua_sam=$dm_mua_sam;
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
                $textBtn='thiết bị';
                if($model->dm_mua_sam=='vat_tu')
                $textBtn='vật tư';
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Thêm mới phiếu mua sắm",
                    'content'=>'<span class="text-success">Thêm mới thành công</span>',
                    'tcontent'=>'Thêm mới thành công!',
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                            Html::a('Thêm '.$textBtn.' cần mua',['/muasam/phieu-mua-sam/chi-tiet-phieu-mua-sam','id_phieu_mua_sam'=>$model->id],['class'=>'btn btn-primary'])
        
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
    public function actionCreateVt()
    {
        return $this->actionCreate('vat_tu');
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
                Yii::$app->session->setFlash('success', $request->post('messageSuccess'));
                $refererUrl = Yii::$app->request->referrer;
                return $this->redirect($refererUrl);
            } else {
                Yii::$app->session->setFlash('error', $request->post('messageError'));
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
    public function actionGuiBaoGia($id_phieu_mua_sam)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id_phieu_mua_sam);
        $sendOk = false;
        $fList = array();
        foreach ( $model->baoGiaMuaSams as $baoGia ) {
            
            try{
                if($baoGia->trang_thai=='draft')
                {
                    $baoGia->trang_thai='submited';
                    //$baoGia->save();
                    if($baoGia->save())
                    $sendOk = true;
                }
            	
            }catch(\Exception $e) {
            	$sendOk = false;
            	$fList[] = $baoGia->id;
            }
            
        }
        if($sendOk)
        {
            $model->trang_thai="quote_sent";
            $model->save();
        }
        
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax-bao-gia',
            			'tcontent'=>$sendOk==true?'Gửi báo giá thành công!':('Không thể gửi báo giá:'.implode('</br>', $fList)),
            ];
        }else{
            /*
            *   Process for non-ajax request
            */
            $refererUrl = Yii::$app->request->referrer;
            return $this->redirect($refererUrl);
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
        if($model->dm_mua_sam=="vat_tu")
        $searchModelCt = new CtPhieuMuaSamVtSearch();

        $searchModelCt->id_phieu_mua_sam=$id_phieu_mua_sam;
  		if(isset($_POST['search']) && $_POST['search'] != null){
            $dataProviderCt = $searchModelCt->search(Yii::$app->request->post(), $_POST['search']);
        } else if ($searchModelCt->load(Yii::$app->request->post())) {
            $searchModelCt = new CtPhieuMuaSamSearch(); // "reset"
            if($model->dm_mua_sam=="vat_tu")
            $searchModelCt = new CtPhieuMuaSamVtSearch();
            $dataProviderCt = $searchModelCt->search(Yii::$app->request->post());
        } else {
            $dataProviderCt = $searchModelCt->search(Yii::$app->request->queryParams);
        }    

        //báo giá mua sắm
        
        
        $searchModelBgms = new BaoGiaMuaSamSearch();
        $searchModelBgms->id_phieu_mua_sam=$id_phieu_mua_sam;
  		if(isset($_POST['search']) && $_POST['search'] != null){
            $dataProviderBgms = $searchModelBgms->searchAll(Yii::$app->request->post(), $_POST['search']);
        } else if ($searchModelBgms->load(Yii::$app->request->post())) {
            $searchModelBgms = new BaoGiaMuaSamSearch(); // "reset"
            $dataProviderBgms = $searchModelBgms->searchAll(Yii::$app->request->post());
        } else {
            $dataProviderBgms = $searchModelBgms->searchAll(Yii::$app->request->queryParams);
        }

        //chi tiết báo giá mua sắm
        
        $id_bao_gia=Yii::$app->request->get('id_bao_gia');
        if($id_bao_gia)
            $baoGia=BaoGiaMuaSam::findOne($id_bao_gia);
        else
            $baoGia=null;

        $searchModelBg = new CtBaoGiaMuaSamSearch();
        if($model->dm_mua_sam=="vat_tu")
        $searchModelBg = new CtBaoGiaMuaSamVtSearch();
        $searchModelBg->id_bao_gia=$baoGia->id ?? 0;
  		if(isset($_POST['search']) && $_POST['search'] != null){
            $dataProviderBg = $searchModelBg->search(Yii::$app->request->post(), $_POST['search']);
        } else if ($searchModelBg->load(Yii::$app->request->post())) {
            $searchModelBg = new CtBaoGiaMuaSamSearch(); // "reset"
            if($model->dm_mua_sam=="vat_tu")
            $searchModelBg = new CtBaoGiaMuaSamVtSearch();
            $dataProviderBg = $searchModelBg->search(Yii::$app->request->post());
        } else {
            $dataProviderBg = $searchModelBg->search(Yii::$app->request->queryParams);
        }

        //chi tiết phiếu nhập
        $searchModelPn = new CtPhieuNhapHangSearch();
        if($model->dm_mua_sam=="vat_tu")
        $searchModelPn = new CtPhieuNhapHangVtSearch();
        $searchModelPn->id_phieu_mua_sam=$id_phieu_mua_sam;
  		if(isset($_POST['search']) && $_POST['search'] != null){
            $dataProviderPn = $searchModelPn->search(Yii::$app->request->post(), $_POST['search']);
        } else if ($searchModelPn->load(Yii::$app->request->post())) {
            
            $searchModelPn = new CtPhieuNhapHangSearch(); // "reset"
            if($model->dm_mua_sam=="vat_tu")
            $searchModelPn = new CtPhieuNhapHangVtSearch();
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
            'dataProviderBgms'=>$dataProviderBgms
        ]);
    }
}
