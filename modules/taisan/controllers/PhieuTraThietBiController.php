<?php

namespace app\modules\taisan\controllers;

use Yii;
use app\modules\taisan\models\PhieuTraThietBi;
use app\modules\taisan\models\PhieuTraThietBiCt;
use app\modules\taisan\models\PhieuTraThietBiSearch;
use app\modules\taisan\models\YeuCauVanHanhCt;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/**
 * PhieuTraThietBiController implements the CRUD actions for PhieuTraThietBi model.
 */
class PhieuTraThietBiController extends Controller
{

    public function beforeAction($action)
    {
        Yii::$app->params['moduleID'] = 'Module Phiếu trả thiết bị';
        Yii::$app->params['modelID'] = 'Quản lý Phiếu trả thiết bị';

        return parent::beforeAction($action);
    }

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
    
    /**
     * load in phieu
     * @return mixed
     */
    public function actionGetPhieuTraThietBiInAjax($idPhieu)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = PhieuTraThietBi::findOne($idPhieu);
        if($model !=null){
            return [
                'status'=>'success',
                'content' => $this->renderAjax('_print_phieu', [
                    'model' => $model
                ])
            ];
        } else {
            return [
                'status'=>'failed',
                'content' => 'Phiếu trả thiết bị không tồn tại!'
            ];
        }
    }

    /**
     * Lists all PhieuTraThietBi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhieuTraThietBiSearch();
        if (isset($_POST['search']) && $_POST['search'] != null) {
            $dataProvider = $searchModel->search(Yii::$app->request->post(), $_POST['search']);
        } else if ($searchModel->load(Yii::$app->request->post())) {
            $searchModel = new PhieuTraThietBiSearch(); // "reset"
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
     * Displays a single PhieuTraThietBi model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $modelsDetail = $model->details;

        $hieuLuc = $model->hieu_luc ?? null;
        $isDraft = true;
        if ($hieuLuc !== null && $hieuLuc !== 'NHAP') {
            $isDraft = false;
        }



        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if (Yii::$app->request->post('hieu_luc') === 'DATRA') {
                // ngay tra thuc te

                $post = $request->post();
                foreach($modelsDetail as $returnDetail) {
                    //vu
                    /* $requestDetail = YeuCauVanHanhCt::find()
                    ->joinWith('thietBi')
                    ->where(['ts_thiet_bi.id' => $returnDetail->id_thiet_bi, 'ts_thiet_bi.trang_thai' => 'VANHANH'])
                    ->one(); */
                    //an sua
                    $requestDetail = YeuCauVanHanhCt::findOne($returnDetail->id_ycvhct);

                    if ($requestDetail) {
                        $requestDetail->ngay_tra_thuc_te = $returnDetail->ngay_tra;
                        $requestDetail->save(false);
                        
                        $thietBi = $requestDetail->thietBi; // Assuming there's a relation to get the thietBi
                        if ($thietBi) {
                            $thietBi->trang_thai = 'HOATDONG';
                            $thietBi->save(false);
                        }
                        
                        $requestDetail->yeuCauVanHanh->setTrangThaiDaTra();
                    }
                    //end an sua
                }
                // /.ngay tra thuc te
                $model->hieu_luc = Yii::$app->request->post('hieu_luc');
                if ($model->save(false)) {
                    return [
                        'forceReload' => '#crud-datatable-pjax',
                        'title' => "Xác nhận trả thiết bị thành công",
                        'content' => $this->renderAjax('view', [
                            'model' => $model,
                            'modelsDetail' => $modelsDetail,
                            
                        ]),
                        'tcontent' => 'Xuất phiếu thành công',
                        'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"])
                            .($model->details!=null?Html::a(
                                '<i class="fa fa-print"></i> In Phiếu (A5, A4)',
                                '#',
                                [
                                    'onClick'=>'InPhieu()',
                                    'data-pjax'=>0,
                                    'class' => 'btn btn-primary'
                                ]) : '')
                    ];
                   // Yii::$app->session->setFlash('success', 'Successfully.');
                   // return $this->redirect(['index']);
                    // return [
                    //     'success' => true,
                    //     'redirectUrl' => \yii\helpers\Url::to(['index']),
                    // ];
                } else {
                    return [
                        'forceClose' => true,                       
                        'tcontent' => 'Có lỗi xảy ra khi thao tác trả thiết bị, vui lòng kiểm tra lại!',
                        
                    ];
                   // Yii::$app->session->setFlash('error', 'Failed.');
                    // return [
                    //     'success' => false,
                    //     'message' => 'Failed to approve the request.',
                    // ];
                }
                // return $this->redirect(['view', 'id' => $model->id]);
            }

            return [
                'title' => "Phiếu trả thiết bị",
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                    'modelsDetail' => $modelsDetail,
                ]),
                'footer' => Html::button('Đóng lại', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                    Html::a('Sửa', ['update', 'id' => $id], [
                        'class' => 'btn btn-primary', 'role' => 'modal-remote',
                        'hidden' => !$isDraft
                    ])
                    . Html::submitButton('Xác nhận', [
                        'class' => 'btn btn-warning',
                        'id' => 'confirm-button',
                        'form' => 'confirm-form',
                        'hidden' => !$isDraft
                    ]).
                    ($model->details!=null?Html::a(
                        '<i class="fa fa-print"></i> In Phiếu (A5, A4)',
                        '#',
                        [
                            'onClick'=>'InPhieu()',
                            'data-pjax'=>0,
                            'class' => 'btn btn-primary'
                        ]) : '')
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
                'modelsDetail' => $modelsDetail,

            ]);
        }
    }

    protected function createMultiple($modelClass, $multipleModels = [])
    {
        $model    = new $modelClass;
        $formName = $model->formName();
        $post     = Yii::$app->request->post($formName);
        $models   = [];

        if (!empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::map($multipleModels, 'id', 'id'));
            $multipleModels = array_combine($keys, $multipleModels);
        }

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item['id']) && !empty($item['id']) && isset($multipleModels[$item['id']])) {
                    $models[] = $multipleModels[$item['id']];
                } else {
                    $models[] = new $modelClass;
                }
            }
        }

        return $models;
    }


    /**
     * Creates a new PhieuTraThietBi model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new PhieuTraThietBi();
        //$modelsDetail = [new PhieuTraThietBiCt()];

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;

            if ($request->isGet) {
                return [
                    'title' => "Thêm mới",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        //'modelsDetail' => $modelsDetail,
                    ]),
                    'footer' => Html::button('Đóng lại', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                        Html::button('Nháp', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post()) & $model->save()) {
                $hieuLuc = $model->hieu_luc ?? null;
                $isDraft = true;
                if ($hieuLuc !== null && $hieuLuc !== 'NHAP') {
                    $isDraft = false;
                }
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title' => "Cập nhật",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        //'modelsDetail' => $modelsDetail,
                    ]),
                    'footer' => Html::button('Đóng lại', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                    Html::button('Lưu lại', [
                        'class' => 'btn btn-primary', 'type' => "submit",
                        'hidden' => !$isDraft
                    ])
                ];
            } else {
                return [
                    'title' => "Thêm mới",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        //'modelsDetail' => $modelsDetail,
                    ]),
                    'footer' => Html::button('Đóng lại', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                    Html::button('Nháp', ['class' => 'btn btn-primary', 'type' => "submit"])
                    
                ];
            }
        }
    }

    /**
     * Updates an existing PhieuTraThietBi model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $modelsDetail = $model->details;

        $hieuLuc = $model->hieu_luc ?? null;
        $isDraft = true;
        if ($hieuLuc !== null && $hieuLuc !== 'NHAP') {
            $isDraft = false;
        }

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Cập nhật Phiếu trả thiết bị",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng lại', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                        Html::button('Lưu lại', [
                            'class' => 'btn btn-primary', 'type' => "submit",
                            'hidden' => !$isDraft
                        ])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title' => "Cập nhật thành công",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'modelsDetail' => $modelsDetail,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"]),
                ];
            } else {
                return [
                    'title' => "Cập nhật Phiếu trả thiết bị",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng lại', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                        Html::button('Lưu lại', [
                            'class' => 'btn btn-primary', 'type' => "submit",
                            'hidden' => !$isDraft
                        ])
                ];
            }
        }
    }

    /**
     * Delete an existing PhieuTraThietBi model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    /**
     * Delete multiple existing PhieuTraThietBi model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys
        $delOk = true;
        $fList = array();
        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            try {
                $model->delete();
            } catch (\Exception $e) {
                $delOk = false;
                $fList[] = $model->id;
            }
        }

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'forceClose' => true, 'forceReload' => '#crud-datatable-pjax',
                'tcontent' => $delOk == true ? 'Xóa thành công!' : ('Không thể xóa:' . implode('</br>', $fList)),
            ];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the PhieuTraThietBi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PhieuTraThietBi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PhieuTraThietBi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
