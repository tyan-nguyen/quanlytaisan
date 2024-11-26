<?php

namespace app\modules\taisan\controllers;

use app\modules\taisan\models\ThietBi;
use Yii;
use app\modules\taisan\models\YeuCauVanHanh;
use app\modules\taisan\models\YeuCauVanHanhCt;
use app\modules\taisan\models\YeuCauVanHanhSearch;
use app\modules\user\models\User;
use Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\base\Model;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;

/**
 * YeuCauVanHanhController implements the CRUD actions for YeuCauVanHanh model.
 */
class YeuCauChuyenTiepController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'ghost-access' => [
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
        Yii::$app->params['moduleID'] = 'Module Phiếu yêu cầu vận hành';
        Yii::$app->params['modelID'] = 'Quản lý Phiếu yêu cầu vận hành';
        
        return parent::beforeAction($action);
    }
    
    public function actionCreate($idycvhct)
    {
        $request = Yii::$app->request;
        
        $model = new YeuCauVanHanh();
        $model->loai_phieu = YeuCauVanHanh::TYPE_YC_FORWARD;
        $ycvhctModel = YeuCauVanHanhCt::findOne($idycvhct);
        if(!$ycvhctModel){
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            if ($request->isGet) {
                return [
                    'title' => "Thêm mới",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'ycvhctModel'=>$ycvhctModel
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                    Html::button('Lưu Nháp', ['class' => 'btn btn-primary', 'type' => "submit"]),
                ];
            } else if ($model->load($request->post())) {
                if($model->save()){
                    //model ycvhct: se update sau khi duyet phieu chuyen tiep
                    //tao moi yeu cau van hanh chi tiet
                    $ycvhct = new YeuCauVanHanhCt();
                    $ycvhct->id_thiet_bi = $ycvhctModel->id_thiet_bi;
                    $ycvhct->id_yeu_cau_van_hanh = $model->id;
                    $ycvhct->ngay_bat_dau = date('Y-m-d H:i:s');
                    //ngay_ket_thuc
                    //ngay_tra_thuc_te
                    $ycvhct->loai_van_hanh = YeuCauVanHanhCt::TYPE_VH_FORWARD;
                    $ycvhct->id_ycvhct_chuyen = $ycvhctModel->id;
                    $ycvhct->save();
                    
                    return [
                        'forceReload' => '#crud-datatable-pjax',
                        'title' => "Thêm mới",
                        'content' => '<span class="text-success">Tạo phiếu thành công</span>',
                        'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                        Html::a('Tiếp tục thêm mới', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote']),
                    ];
                }else {
                    return [
                        'title' => "Thêm mới",
                        'content' => $this->renderAjax('create', [
                            'model' => $model,
                            'ycvhctModel'=>$ycvhctModel
                        ]),
                        'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                        Html::button('Nháp', ['class' => 'btn btn-primary', 'type' => "submit"]),
                    ];
                }
            } else {
                return [
                    'title' => "Thêm mới",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'ycvhctModel'=>$ycvhctModel
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                    Html::button('Nháp', ['class' => 'btn btn-primary', 'type' => "submit"]),
                ];
            }
        } /* else {
        if ($model->load($request->post())) {
        
        $modelsDetail = $this->createMultiple(YeuCauVanHanhCt::classname());
        Model::loadMultiple($modelsDetail, $request->post());
        
        // Debugging
        // var_dump($request->post());
        // var_dump($model->attributes);
        // var_dump($modelsDetail);
        
        $valid = $model->validate();
        $valid = Model::validateMultiple($modelsDetail) && $valid;
        
        // Debugging
        //var_dump($valid);
        
        if ($valid) {
        $transaction = Yii::$app->db->beginTransaction();
        try {
        if ($flag = $model->save(false)) {
        foreach ($modelsDetail as $modelDetail) {
        $modelDetail->id_yeu_cau_van_hanh = $model->id;
        if (!($flag = $modelDetail->save(false))) {
        $transaction->rollBack();
        break;
        }
        }
        }
        
        if ($flag) {
        $transaction->commit();
        return $this->redirect(['view', 'id' => $model->id]);
        }
        } catch (\Exception $e) {
        $transaction->rollBack();
        }
        }
        }
        
        return $this->render('create', [
        'model' => $model,
        'modelsDetail' => (empty($modelsDetail)) ? [new YeuCauVanHanhCt] : $modelsDetail,
        ]);
        } */
    }
    
}