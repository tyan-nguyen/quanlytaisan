<?php

namespace app\modules\suachua\controllers;

use Yii;
use app\modules\suachua\models\PhieuSuaChua;
use app\modules\suachua\models\PhieuSuaChuaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\filters\AccessControl;
use app\modules\suachua\models\PhieuSuaChuaVatTuSearch;
use app\modules\suachua\models\CtBaoGiaSuaChuaSearch;
use app\modules\suachua\models\BaoGiaSuaChuaSearch;
use app\modules\suachua\models\BaoGiaSuaChua;
use app\modules\user\models\User;
use yii\web\ForbiddenHttpException;
use app\modules\suachua\models\PhieuSuaChuaVatTu;

/**
 * PhieuSuaChuaController implements the CRUD actions for PhieuSuaChua model.
 */
class PhieuSuaChuaController extends Controller
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
	    Yii::$app->params['modelID'] = 'Quản lý Phiếu sửa chữa';
	    
	    return parent::beforeAction($action);
	}

    /**
     * Lists all PhieuSuaChua models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new PhieuSuaChuaSearch();
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
     * action xem chi tiết phiếu sửa chữa
     * đã phân quyền, nếu nhân viên chỉ được xem phiếu của mình tạo
     */
    public function actionChiTietPhieuSuaChua($id_phieu_sua_chua)
    {         
        $request = Yii::$app->request;
        $phieuSuaChua = $this->findModel($id_phieu_sua_chua);
        $phieuSuaChuaOld = $this->findModel($id_phieu_sua_chua);
        //check null model
        if($phieuSuaChua == null){
            throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
        }
        //check quyền truy cập phiếu
        /* if(User::hasRole('nNhanVien', false) && $phieuSuaChua->nguoi_tao != Yii::$app->user->id){
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        } */
        if(User::hasRole('nNhanVien',false) && $phieuSuaChua->nguoi_tao != Yii::$app->user->id){
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }
        
        $notSave = false;
        if ($phieuSuaChua->load($request->post())) {
            if( ($phieuSuaChua->trang_thai == 'new' && $phieuSuaChuaOld->trang_thai != 'new')
                || ($phieuSuaChua->trang_thai == 'draft_reject' && $phieuSuaChuaOld->trang_thai != 'draft_reject')){
                $phieuSuaChua->nguoi_duyet_phieu = Yii::$app->user->id;
                $phieuSuaChua->thoi_gian_duyet_phieu = date('Y-m-d H:i:s');
            }
            if($phieuSuaChua->save()){
                return $this->redirect(['detail', 'id_phieu_sua_chua' => $phieuSuaChua->id]);
            }else{
                $notSave = true;
            }
        } else {
            $notSave = true;
        }
        if($notSave) {
            //grid view vật tư
            $searchModelVatTu = new PhieuSuaChuaVatTuSearch();
            $searchModelVatTu->trang_thai="new";
            $searchModelVatTu->id_phieu_sua_chua=$id_phieu_sua_chua;
            if(isset($_POST['search']) && $_POST['search'] != null){
                $dataProviderVatTu = $searchModelVatTu->search(Yii::$app->request->post(), $_POST['search']);
            } else if ($searchModelVatTu->load(Yii::$app->request->post())) {
                $searchModelVatTu = new PhieuSuaChuaVatTuSearch(); // "reset"
                $dataProviderVatTu = $searchModelVatTu->search(Yii::$app->request->post());
            } else {
                $dataProviderVatTu = $searchModelVatTu->search(Yii::$app->request->queryParams);
            }    
            //end grid view vật tư

            //grid view vật tư
            $searchModelVatTuHH = new PhieuSuaChuaVatTuSearch();
            $searchModelVatTuHH->id_phieu_sua_chua=$id_phieu_sua_chua;
            $searchModelVatTuHH->trang_thai="damaged";
            if(isset($_POST['search']) && $_POST['search'] != null){
                $dataProviderVatTuHH = $searchModelVatTuHH->search(Yii::$app->request->post(), $_POST['search']);
            } else if ($searchModelVatTuHH->load(Yii::$app->request->post())) {
                //$searchModelVatTuHH = new PhieuSuaChuaVatTuSearch(); // "reset"
                $dataProviderVatTuHH = $searchModelVatTuHH->search(Yii::$app->request->post());
            } else {
                $dataProviderVatTuHH = $searchModelVatTuHH->search(Yii::$app->request->queryParams);
            }    
            //end grid view vật tư

            //báo giá mua sắm
        
        
            $searchModelBgsc = new BaoGiaSuaChuaSearch();
            $searchModelBgsc->id_phieu_sua_chua=$id_phieu_sua_chua;
            if(isset($_POST['search']) && $_POST['search'] != null){
                $dataProviderBgsc = $searchModelBgsc->searchAll(Yii::$app->request->post(), $_POST['search']);
            } else if ($searchModelBgsc->load(Yii::$app->request->post())) {
                $searchModelBgsc = new BaoGiaSuaChuaSearch(); // "reset"
                $dataProviderBgsc = $searchModelBgsc->searchAll(Yii::$app->request->post());
            } else {
                $dataProviderBgsc = $searchModelBgsc->searchAll(Yii::$app->request->queryParams);
            }

            //grid view báo giá
            //$baoGiaSuaChua=BaoGiaSuaChua::getBaoGiaByPhieuSuaChua($id_phieu_sua_chua);
            $id_bao_gia=Yii::$app->request->get('id_bao_gia');
            if($id_bao_gia)
                $baoGiaSuaChua=BaoGiaSuaChua::findOne($id_bao_gia);
            else
                $baoGiaSuaChua=null;
            //var_dump($baoGiaSuaChua->id_phieu_sua_chua);
            $searchModelBaoGia = new CtBaoGiaSuaChuaSearch();
            $searchModelBaoGia->id_bao_gia=$baoGiaSuaChua->id ?? 0;
            if(isset($_POST['search']) && $_POST['search'] != null){
                $dataProviderBaoGia = $searchModelBaoGia->search(Yii::$app->request->post(), $_POST['search']);
            } else if ($searchModelBaoGia->load(Yii::$app->request->post())) {
                $searchModelBaoGia = new CtBaoGiaSuaChuaSearch(); // "reset"
                $dataProviderBaoGia = $searchModelBaoGia->search(Yii::$app->request->post());
            } else {
                $dataProviderBaoGia = $searchModelBaoGia->search(Yii::$app->request->queryParams);
            }  
            //end grid view báo giá
            return $this->render('detail', [
                'searchModelVatTu' => $searchModelVatTu,
                'dataProviderVatTu' => $dataProviderVatTu,
                'searchModelVatTuHH' => $searchModelVatTuHH,
                'dataProviderVatTuHH' => $dataProviderVatTuHH,
                'searchModelBaoGia' => $searchModelBaoGia,
                'dataProviderBaoGia' => $dataProviderBaoGia,
                'baoGiaSuaChua'=>$baoGiaSuaChua,
                "phieuSuaChua"=>$phieuSuaChua,
                //'dataProviderBg' => $dataProviderBg,
                'dataProviderBgsc'=>$dataProviderBgsc
            ]);
        }
    }

    /**
     * Displays a single PhieuSuaChua model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Thông tin phiếu sửa chữa",
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
     * Creates a new PhieuSuaChua model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new PhieuSuaChua();  
        
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Thêm mới phiếu sửa chữa",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Thêm mới phiếu sửa chữa",
                    'content'=>'<span class="text-success">Thêm mới thành công</span>',
                    'tcontent'=>'Thêm mới thành công!',
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                    Html::a('Xem thông tin phiếu sửa chữa',['/suachua/phieu-sua-chua/chi-tiet-phieu-sua-chua','id_phieu_sua_chua'=>$model->id],['class'=>'btn btn-primary'])
        
                ];         
            }else{           
                return [
                    'title'=> "Thêm mới phiếu sửa chữa",
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
     * Updates an existing PhieuSuaChua model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);    
        $oldModel = $this->findModel($id);
        
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Cập nhật phiếu sửa chữa",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "PhieuSuaChua",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'tcontent'=>'Cập nhật thành công!',
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                            Html::a('Sửa',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Cập nhật phiếu sửa chữa",
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
            if ($model->load($request->post())) {
                if($oldModel->duyet_vt_kho=='draft' && $model->duyet_vt_kho=='draft_sent'){
                    $vatTus = PhieuSuaChuaVatTu::findOne(['id_phieu_sua_chua' => $model->id]);
                    if($vatTus == null){
                        Yii::$app->session->setFlash('error', 'Gửi yêu cầu vật tư kho không thành công! Vui lòng cập nhật lại nội dung yêu cầu vật tư kho.');
                        return $this->redirect(['chi-tiet-phieu-sua-chua', 'id_phieu_sua_chua' => $model->id]);
                    }
                }
                if( ($model->trang_thai == 'new' && $oldModel->trang_thai != 'new')
                    || ($model->trang_thai == 'draft_reject' && $oldModel->trang_thai != 'draft_reject')){
                        $model->nguoi_duyet_phieu = Yii::$app->user->id;
                        $model->thoi_gian_duyet_phieu = date('Y-m-d H:i:s');
                }
                if($model->save()){
                    return $this->redirect(['chi-tiet-phieu-sua-chua', 'id_phieu_sua_chua' => $model->id]);
                }else {
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing PhieuSuaChua model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $delOk = true;
        if(User::hasPermission('qDuyetBaoGiaSuaChua',false) || ($model->nguoi_tao == Yii::$app->user->id
            && $model->trang_thai == 'draft' )){
            $model->delete();
        }else{
            $delOk = false;
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax',
                'tcontent'=>$delOk==true?'Xóa thành công!':'Không thể xóa!'
            ];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing PhieuSuaChua model.
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
                if(User::hasPermission('qDuyetBaoGiaSuaChua',false) || ($model->nguoi_tao == Yii::$app->user->id
                    && $model->trang_thai == 'draft' ))
            	   $model->delete();
                else
                    $delOk = false;
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
    public function actionPrintView($id)
    {
        // Render the view you want to print
        return $this->renderPartial('print',[
            'model'=>$this->findModel($id)
        ]);
    }
    public function actionPrintPhieuXuatKhoView($id)
    {
        // Render the view you want to print
        return $this->renderPartial('print-phieu-xuat-kho',[
            'model'=>$this->findModel($id)
        ]);
    }
    
    /**
     * load in phieu
     * @return mixed
     */
    public function actionGetPhieuSuaChuaInAjax($idPhieu)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($idPhieu);
        if($model !=null){
            return [
                'status'=>'success',
                'content' => $this->renderAjax('_print_phieu_sua_chua', [
                    'model' => $model
                ])
            ];
        } else {
            return [
                'status'=>'failed',
                'content' => 'Phiếu sửa chữa không tồn tại!'
            ];
        }
    }
    /**
     * load in phieu
     * @return mixed
     */
    public function actionGetPhieuXuatKhoInAjax($idPhieu)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($idPhieu);
        if($model !=null){
            return [
                'status'=>'success',
                'content' => $this->renderAjax('_print_phieu_xuat_kho', [
                    'model' => $model
                ])
            ];
        } else {
            return [
                'status'=>'failed',
                'content' => 'Phiếu xuất kho không tồn tại!'
            ];
        }
    }
    
    public function actionGuiBaoGia($id_phieu_sua_chua)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id_phieu_sua_chua);
        
        //check quyền truy cập phiếu
        if(!User::canRoute($this->route, false) /* && $model->nguoi_tao != Yii::$app->user->id */){
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }
        
        $sendOk = false;
        $fList = array();
        foreach ( $model->baoGiaSuaChuas as $baoGia ) {
            
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
    
}
