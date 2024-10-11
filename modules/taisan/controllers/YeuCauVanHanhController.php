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

/**
 * YeuCauVanHanhController implements the CRUD actions for YeuCauVanHanh model.
 */
class YeuCauVanHanhController extends Controller
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

    /**
     * Lists all YeuCauVanHanh models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new YeuCauVanHanhSearch();
        if (isset($_POST['search']) && $_POST['search'] != null) {
            $dataProvider = $searchModel->search(Yii::$app->request->post(), $_POST['search']);
        } else if ($searchModel->load(Yii::$app->request->post())) {
            $searchModel = new YeuCauVanHanhSearch(); // "reset"
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
     * Displays a single YeuCauVanHanh model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $modelsDetail = $model->details;

        $isDraft = false;
        $isPending = false;
        $isApproved = false;
        $isPrint = false;

        $hieuLuc = $model->hieu_luc ?? null;

        if ($hieuLuc !== null && $hieuLuc === 'NHAP') {
            $isDraft = true;
            // $isPending = false;
        } else if ($hieuLuc !== null && $hieuLuc === 'CHODUYET') {
            $isPending = true;
        } else if ($hieuLuc !== null && $hieuLuc === 'DADUYET') {
            $isApproved = true;
        } else if ($hieuLuc !== null && $hieuLuc === 'VANHANH') {
            $isPrint = true;
        }

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Yêu cầu vận hành",
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                    'modelsDetail' => $modelsDetail,

                ]),
                'footer' => Html::button('Đóng lại', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"])

                    . Html::a('Sửa', ['update', 'id' => $id], [
                        'class' => 'btn btn-primary',
                        'role' => 'modal-remote',
                        'hidden' => !$isDraft

                    ])

                    . Html::a('Gửi yêu cầu', ['send-request', 'id' => $id], [
                        'class' => 'btn btn-warning',
                        'role' => 'modal-remote',
                        'hidden' => !$isDraft
                    ])

                    . Html::a('Phê duyệt', ['approve', 'id' => $id], [
                        'class' => 'btn btn-warning',
                        'role' => 'modal-remote',
                        'hidden' => !$isPending
                    ])

                    . Html::a('Xuất', ['operate', 'id' => $id], [
                        'class' => 'btn btn-primary',
                        'role' => 'modal-remote',
                        'hidden' => !$isApproved
                    ])
                    . Html::button('Print', [
                        'class' => 'btn btn-primary',
                        'id' => 'print-button',
                        // 'hidden' => !$isPrint

                    ]),


                // . Html::button('<span class="fe fe-external-link"></span>Gửi phê duyệt', [
                //     'class' => 'btn btn-warning',
                //     'id' => 'send-request-button',
                //     'data-id' => $model->id,
                //     'hidden' => !$isDraft
                // ])
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
                'modelsDetail' => $modelsDetail,

            ]);
        }
    }

    public function actionPendingRequests()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $pendingRequests = YeuCauVanHanh::find()
            ->where(['hieu_luc' => 'CHODUYET'])
            ->all();

        $data = [];
        foreach ($pendingRequests as $request) {
            $data[] = [
                'id' => $request->id,
                'details_count' => $request->getDetailsCount(),
                'ten_bo_phan' => $request->getTenBoPhan()
            ];
        }
        
        return $data;
        // return $pendingRequests;
    }


    // public function actionViewSendRequest($id)
    // {

    //     $request = Yii::$app->request;
    //     $model = $this->findModel($id);
    //     $modelsDetail = $model->details;
    //     // $model->scenario = YeuCauVanHanh::SCENARIO_SEND_REQUEST;

    //     if (Yii::$app->request->isAjax) {
    //         Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    //         return [
    //             'title' => 'Gửi yêu cầu phê duyệt',
    //             'content' => $this->renderAjax('view-send-request', [
    //                 // 'model' => $model,
    //                 'model' => $this->findModel($id),
    //                 'modelsDetail' => $modelsDetail,
    //             ]),
    //             'footer' => Html::button('Đóng', [
    //                 'class' => 'btn btn-default pull-left',
    //                 'data-bs-dismiss' => 'modal'

    //             ]) . Html::button('Gửi yêu cầu', [
    //                 'class' => 'btn btn-primary',
    //                 'type' => 'submit',
    //                 'form' => 'send-request-form'
    //             ])
    //         ];
    //     }

    //     if (Yii::$app->request->post('hieu_luc') === 'CHODUYET') {

    //         $model->hieu_luc = Yii::$app->request->post('hieu_luc');
    //         // $model->id_nguoi_gui = Yii::$app->request->post('YeuCauVanHanh')['id_nguoi_gui'];
    //         // $model->ngay_gui = Yii::$app->request->post('YeuCauVanHanh')['ngay_gui'];
    //         $model->id_nguoi_gui = Yii::$app->user->identity->id;
    //         $model->ngay_gui = date('Y-m-d H:i:s');
    //         $model->noi_dung_gui = Yii::$app->request->post('YeuCauVanHanh')['noi_dung_gui'];

    //         // var_dump($model->validate());

    //         // if ($model->validate() && $model->save(false)) {
    //         if ($model->save(false)) {
    //             Yii::$app->session->setFlash('success', 'Successfully.');
    //             return $this->redirect(['index']);
    //         } else {
    //             Yii::$app->session->setFlash('error', 'Failed.');
    //         }

    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->redirect(['view', 'id' => $model->id]);
    // }

    // public function actionValidateSendRequest($id)
    // {
    //     $model = $this->findModel($id);
    //     $model->scenario = YeuCauVanHanh::SCENARIO_SEND_REQUEST;

    //     if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
    //         Yii::$app->response->format = Response::FORMAT_JSON;
    //         return ActiveForm::validate($model);
    //     }
    // }


    /**
     * Creates a new YeuCauVanHanh model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */


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
     * Calendar Event Action
     */

    // public function actionEvents()
    // {
    //     Yii::$app->response->format = Response::FORMAT_JSON;
    //     $requests = YeuCauVanHanhCt::find()
    //     // ->joinWith('YeuCauVanHanh')
    //     ->joinWith(['yeuCauVanHanh' => function ($query) {
    //         $query->alias('ycvh');
    //     }])
    //     ->where(['ycvh.hieu_luc' => 'VANHANH'])
    //     ->all();

    //     $events = [];

    //     foreach ($requests as $detail) {
    //         $events[] = [
    //             'id' => $detail->id,
    //             'title' => $detail->thietBi->ten_thiet_bi,
    //             'start' => $detail->ngay_bat_dau,
    //             'end' => $detail->ngay_ket_thuc,
    //             // 'url' => Yii::$app->urlManager->createUrl(['/taisan/yeu-cau-van-hanh/view', 'id' => $detail->id_yeu_cau_van_hanh]),
    //         ];
    //     }
    //     return $events;
    // }



    public function actionCreate()
    {
        $request = Yii::$app->request;

        $model = new YeuCauVanHanh();
        $modelsDetail = [new YeuCauVanHanhCt()];

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if ($request->isGet) {
                return [
                    'title' => "Thêm mới",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'modelsDetail' => $modelsDetail,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                        Html::button('Lưu Nháp', ['class' => 'btn btn-primary', 'type' => "submit"]),
                ];
            } else if ($model->load($request->post())) {
                $modelsDetail = $this->createMultiple(YeuCauVanHanhCt::classname());
                Model::loadMultiple($modelsDetail, $request->post());

                /* Debugging */
                // var_dump($request->post());
                // var_dump($model->attributes); 
                // var_dump($modelsDetail); 

                $valid = $model->validate();
                // $validDetail = Model::validateMultiple($modelsDetail);

                $valid = Model::validateMultiple($modelsDetail) && $valid;

                /* Debugging */
                // var_dump($valid);
                // var_dump($model->errors);
                // var_dump($modelsDetail);

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
                            return [
                                'forceReload' => '#crud-datatable-pjax',
                                'title' => "Thêm mới",
                                'content' => '<span class="text-success">Tạo phiếu thành công</span>',
                                'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                                    Html::a('Tiếp tục thêm mới', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote']),
                            ];
                        }
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                    }
                }

                return [
                    'title' => "Thêm mới",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'modelsDetail' => $modelsDetail,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                        Html::button('Nháp', ['class' => 'btn btn-primary', 'type' => "submit"]),
                ];
            }
        } else {
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
        }
    }

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
                    'title' => "Cập nhật",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'modelsDetail' => $modelsDetail,
                    ]),
                    'footer' => Html::button('Đóng', [
                        'class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal",
                    ])
                        . Html::button('Lưu nháp', [
                            'class' => 'btn btn-primary', 'type' => "submit", 'id' => 'draft-button',
                            'disabled' => !$isDraft,
                            'hidden' => !$isDraft

                        ]),
                ];
            } else if ($model->load($request->post())) {

                $oldIDs = ArrayHelper::map($modelsDetail, 'id', 'id');
                $modelsDetail = $this->createMultiple(YeuCauVanHanhCt::classname(), $modelsDetail);
                Model::loadMultiple($modelsDetail, Yii::$app->request->post());
                $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsDetail, 'id', 'id')));

                // validate all models
                $valid = $model->validate();
                $valid = Model::validateMultiple($modelsDetail) && $valid;

                // $valid = true;

                if ($valid) {
                    $transaction = Yii::$app->db->beginTransaction();
                    try {
                        if ($flag = $model->save(false)) {
                            if (!empty($deletedIDs)) {
                                YeuCauVanHanhCt::deleteAll(['id' => $deletedIDs]);
                            }
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
                            return [
                                'forceReload' => '#crud-datatable-pjax',
                                'title' => "Cập nhật thành công",
                                'content' => $this->renderAjax('view', [
                                    'model' => $model,
                                    'modelsDetail' => $modelsDetail,

                                ]),
                                'tcontent' => 'Dữ liệu đã cập nhật!',
                                'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                                    Html::a('Sửa', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                                    . Html::a('Gửi yêu cầu', ['send-request', 'id' => $id], [
                                        'class' => 'btn btn-primary',
                                        'role' => 'modal-remote',
                                        'hidden' => !$isDraft
                                    ])

                                // . Html::button('Gửi phê duyệt', [
                                //     'class' => 'btn btn-warning',
                                //     'id' => 'send-request-button',
                                //     'data-id' => $model->id,
                                //     'hidden' => !$isDraft
                                // ]),
                            ];
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }
                }

                return [

                    'title' => "Cập nhật thành công",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'modelsDetail' => $modelsDetail,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                        Html::button('Sửa', ['class' => 'btn btn-primary', 'type' => "submit"])
                        . Html::button('Gửi phê duyệt', [
                            'class' => 'btn btn-warning',
                            'id' => 'send-request-button',
                            'data-id' => $model->id,
                            'hidden' => !$isDraft
                        ]),
                ];
            }
        } else {
            if ($model->load($request->post())) {
                $oldIDs = ArrayHelper::map($modelsDetail, 'id', 'id');
                $modelsDetail = $this->createMultiple(YeuCauVanHanhCt::classname(), $modelsDetail);
                Model::loadMultiple($modelsDetail, Yii::$app->request->post());
                $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsDetail, 'id', 'id')));

                // validate all models
                $valid = $model->validate();
                $valid = Model::validateMultiple($modelsDetail) && $valid;

                if ($valid) {
                    $transaction = Yii::$app->db->beginTransaction();
                    try {
                        if ($flag = $model->save(false)) {
                            if (!empty($deletedIDs)) {
                                YeuCauVanHanh::deleteAll(['id' => $deletedIDs]);
                            }
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

            return $this->render('update', [
                'model' => $model,
                'modelsDetail' => $modelsDetail,
            ]);
        }
    }

    public function actionSendRequest($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $modelsDetail = $model->details;

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if ($request->isGet) {
                return [
                    'title' => "Gửi yêu cầu",
                    'content' => $this->renderAjax('send-request', [
                        'model' => $model,
                        'modelsDetail' => $modelsDetail,
                    ]),
                    'footer' => Html::button('Đóng', [
                        'class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal",
                    ])
                        . Html::button('Gửi', [
                            'class' => 'btn btn-primary',
                            'type' => 'submit',
                            'form' => 'send-request-form'
                        ])
                ];
            }
        }

        if (Yii::$app->request->post('hieu_luc') === 'CHODUYET') {

            $model->hieu_luc = Yii::$app->request->post('hieu_luc');
            $model->id_nguoi_gui = Yii::$app->user->identity->id;
            $model->ngay_gui = date('Y-m-d H:i:s');
            $model->noi_dung_gui = Yii::$app->request->post('YeuCauVanHanh')['noi_dung_gui'];

            // if ($model->validate() && $model->save(false)) {
            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', 'Successfully.');

                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Gửi yêu cầu thành công",
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                        'modelsDetail' => $modelsDetail,

                    ]),
                    'tcontent' => 'Đã gửi yêu cầu!',
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"])
                ];
            } else {
                Yii::$app->session->setFlash('error', 'Failed.');
            }

            return $this->redirect(['send-request', 'id' => $model->id]);
        }

        return $this->redirect(['send-request', 'id' => $model->id]);
    }

    public function actionApprove($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $modelsDetail = $model->details;

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if ($request->isGet) {
                return [
                    'title' => "Phê duyệt yêu cầu",
                    'content' => $this->renderAjax('approve', [
                        'model' => $model,
                        'modelsDetail' => $modelsDetail,
                    ]),
                    'footer' => Html::button('Đóng', [
                        'class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal",
                    ])
                        . Html::button('Phê duyệt', [
                            'class' => 'btn btn-primary',
                            'type' => 'submit',
                            'form' => 'approve-form'
                        ])
                        . Html::button(
                            'Không duyệt',
                            [
                                'class' => 'btn btn-danger',
                                'type' => 'button',
                                // 'form' => 'approve-form',
                                'onClick' => "setStatusAndSubmit('NGUNG_QUYTRINH')",
                            ]
                        )
                ];
            }
        }

        $status = Yii::$app->request->post('hieu_luc');
        if ($status === 'DADUYET' || $status === 'NGUNG_QUYTRINH') {

            $model->hieu_luc = $status;
            $model->id_nguoi_duyet = Yii::$app->user->identity->id;
            $model->ngay_duyet = date('Y-m-d H:i:s');
            $model->noi_dung_duyet = Yii::$app->request->post('YeuCauVanHanh')['noi_dung_duyet'];

            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', 'Successfully.');

                return [
                    'success' => true,
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Phê duyệt thành công",
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                        'modelsDetail' => $modelsDetail,

                    ]),
                    'tcontent' => 'Phê duyệt thành công!',
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"])
                ];
            } else {
                Yii::$app->session->setFlash('error', 'Failed.');
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->redirect(['view', 'id' => $model->id]);
    }

    public function actionOperate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $modelsDetail = $model->details;
        $userList = ArrayHelper::map(User::find()->all(), 'id', 'username');
        $currentUserId = Yii::$app->user->id??'';
        $currentUserName = Yii::$app->user->identity->username;
        $idNguoiYeuCau = $model->id_nguoi_yeu_cau;

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if ($request->isGet) {
                return [
                    'title' => "Xuất phiếu",
                    'content' => $this->renderAjax('operate', [
                        'model' => $model,
                        'modelsDetail' => $modelsDetail,
                        'userList' => $userList,
                        'currentUserId' => $currentUserId,
                        'idNguoiYeuCau' => $idNguoiYeuCau,


                    ]),
                    'footer' => Html::button('Đóng', [
                        'class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal",
                    ])
                        . Html::button('Xuất phiếu', [
                            'class' => 'btn btn-primary',
                            'type' => 'submit',
                            'form' => 'operate-form'
                        ])
                ];
            }
        }

        if (Yii::$app->request->post('hieu_luc') === 'VANHANH') {

            $model->hieu_luc = Yii::$app->request->post('hieu_luc');


            $model->id_nguoi_xuat = Yii::$app->request->post('YeuCauVanHanh')['id_nguoi_xuat'];
            $model->ngay_xuat = Yii::$app->request->post('YeuCauVanHanh')['ngay_xuat'];
            $model->noi_dung_xuat = Yii::$app->request->post('YeuCauVanHanh')['noi_dung_xuat'];

            $model->id_nguoi_nhan = Yii::$app->request->post('YeuCauVanHanh')['id_nguoi_nhan'];
            $model->ngay_nhan = Yii::$app->request->post('YeuCauVanHanh')['ngay_nhan'];
            $model->noi_dung_nhan = Yii::$app->request->post('YeuCauVanHanh')['noi_dung_nhan'];
            //check details
            $detaiHasError = false;
            if($model->details){
                foreach ($model->details as $detail){
                    if(!$detail->thietBi || !$detail->ngay_bat_dau || !$detail->ngay_ket_thuc){
                        $detaiHasError = true;
                        break;
                    }
                }
            }
            
            if (!$model->validate() || ($model->validate() && !$model->details) || $detaiHasError ) {
                if(!$model->details){
                    $model->addError('id', 'Vui lòng chọn thiết bị cho phiếu yêu cầu vận hành trước khi xuất phiếu!');
                } else if($detaiHasError){
                    $model->addError('id', 'Vui lòng nhập đầy đủ thông tin cho thiết bị như tên thiết bị, ngày bắt đầu, ngày kết thúc trước khi xuất phiếu!');
                }
                return [
                    'title' => "Xuất phiếu",
                    'content' => $this->renderAjax('operate', [
                        'model' => $model,
                        'modelsDetail' => $modelsDetail,
                        'userList' => $userList,
                        'currentUserId' => $currentUserId,
                        'idNguoiYeuCau' => $idNguoiYeuCau,
                        
                        
                    ]),
                    'footer' => Html::button('Đóng', [
                        'class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal",
                    ])
                    . Html::button('Xuất phiếu', [
                        'class' => 'btn btn-primary',
                        'type' => 'submit',
                        'form' => 'operate-form'
                    ])
                ];
            }

            // if ($model->validate() && $model->save(false)) {

            if ($model->save(false)) {
                foreach ($model->details as $detail) {
                    $device = ThietBi::findOne($detail->id_thiet_bi);
                    if ($device) {
                        $device->trang_thai = 'VANHANH';
                        $device->save(false);
                    }
                }

                Yii::$app->session->setFlash('success', 'Successfully.');

                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Xuất phiếu thành công",
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                        'modelsDetail' => $modelsDetail,

                    ]),
                    'tcontent' => 'Xuất phiếu thành công',
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"])
                ];
            } else {
                Yii::$app->session->setFlash('error', 'Failed.');
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }
    }



    /* public function actionSubmit($id)
    {
        $model = $this->findModel($id);

        // var_dump('Request method:', Yii::$app->request->method);
        // var_dump('Post data:', Yii::$app->request->post());

        if (Yii::$app->request->post('hieu_luc') === 'CHODUYET') {

            $model->hieu_luc = 'CHODUYET';

            if ($model->save(false)) {
                // var_dump('Status updated successfully');

                Yii::$app->session->setFlash('success', 'Hiệu lực được cập nhật sang chờ phê duyệt.');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Lỗi cập nhật hiệu lực.');
            }
        } else {
            // var_dump('Status is not pending');
        }

        return $this->redirect(['view', 'id' => $model->id]);
    } */

    // public function actionSendRequest($id)
    // {
    //     $model = $this->findModel($id);

    //     if (Yii::$app->request->post('hieu_luc') === 'CHODUYET') {

    //         $model->hieu_luc = Yii::$app->request->post('hieu_luc');
    //         $model->id_nguoi_gui = Yii::$app->request->post('YeuCauVanHanh')['id_nguoi_gui'];
    //         $model->ngay_gui = Yii::$app->request->post('YeuCauVanHanh')['ngay_gui'];
    //         $model->noi_dung_gui = Yii::$app->request->post('YeuCauVanHanh')['noi_dung_gui'];

    //         if ($model->save(false)) {
    //             Yii::$app->session->setFlash('success', 'Successfully.');
    //             return $this->redirect(['index']);
    //         } else {
    //             Yii::$app->session->setFlash('error', 'Failed.');
    //         }
    //     }

    //     return $this->renderAjax('send-request', [
    //         'model' => $model,
    //     ]);

    //     // return $this->redirect(['view', 'id' => $model->id]);
    // }



    /**
     * Delete an existing YeuCauVanHanh model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id, $forceDelete=false)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model = $this->findModel($id);
            //check forceDelete valid
            if($forceDelete){
                if(User::hasRole('admin', true)){
                    $forceDelete = true;
                } else {
                    $forceDelete = false;
                }
            }
            if($model!=null){
                if(!$forceDelete && ($model->hieu_luc==YeuCauVanHanh::STATUS_DADUYET || $model->hieu_luc==$model->sauDuyet())){
                    return [
                        'title' => "Xóa yêu cầu vận hành thiết bị",
                        'content' => '<span class="text-danger">Không thể xóa do yêu cầu vận hành đã được duyệt hoặc đang vận hành!</span>'
                        . (User::hasRole('admin', true) ? ('<br/>' . Html::a('<i class="fas fa-trash-alt"></i>  Xóa quyền bằng quyền admin',[
                                '/taisan/yeu-cau-van-hanh/delete', 'id'=>$id, 'forceDelete'=>1
                            ], [
                                'role'=>'modal-remote',
                                'data-request-method'=>'post',
                                'data-confirm-title'=>'Xác nhận xóa dữ liệu?',
                                'data-confirm-message'=>'Bạn có chắc chắn thực hiện hành động này?',
                                'data-bs-placement'=>'top',
                                'data-bs-toggle'=>'tooltip-secondary',
                                'class'=>'btn ripple btn-secondary btn-sm'
                            ])) : ''),
                        'footer' => Html::button('Đóng', [
                            'class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal",
                        ])
                    ];
                } else {
                    if($model->delete()){
                        return [
                            'forceClose' => true, 
                            'forceReload' => '#crud-datatable-pjax',
                            'tcontent' => 'Xóa yêu cầu thành công!',
                        ];
                    }
                }
            } else {
                return [
                    'title' => "Xóa yêu cầu vận hành thiết bị",
                    'content' => 'Yêu cầu vận hành không tồn tại!',
                    'footer' => Html::button('Đóng', [
                        'class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal",
                    ])
                ];
            }
            
        } else {
            return $this->redirect(['index']);
        }
    }




    /**
     * Delete multiple existing YeuCauVanHanh model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            //check all data valid
            $checkOk = true;
            $listCheckNotOk = array();
            foreach ($pks as $pk) {
                $model = $this->findModel($pk);
                if($model->hieu_luc==YeuCauVanHanh::STATUS_DADUYET || $model->hieu_luc==$model->sauDuyet()){
                    $checkOk = false;
                    $listCheckNotOk[] = $model->id;
                }
            }
            if(!$checkOk){
                return [
                    'title' => "Xóa danh sách yêu cầu vận hành thiết bị",
                    'content' => '<span class="text-danger">Không thể xóa danh sách yêu cầu, Lỗi: P-' . implode(', P-', $listCheckNotOk) . '</span>',
                    'tcontent' => 'Có lỗi xảy ra!',
                    'footer' => Html::button('Đóng', [
                        'class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal",
                    ])
                ];
            }
            
            //check ok delete real
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
            
            return [
                'forceClose' => true, 'forceReload' => '#crud-datatable-pjax',
                'tcontent' => $delOk == true ? 'Xóa thành công!' : ('Không thể xóa:' . implode('<br/>', $fList)),
            ];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the YeuCauVanHanh model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return YeuCauVanHanh the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = YeuCauVanHanh::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /* SOFT DELETE */
    /*     
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->deleted_at = time();
        $model->save(false);

        return $this->redirect(['index']);
    } 
    */

    public function actionPrintView($id)
    {
        // Render the view you want to print
        return $this->renderPartial('print', [
            'model' => $this->findModel($id)
        ]);
    }
}
