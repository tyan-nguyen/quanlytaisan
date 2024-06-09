<?php

namespace app\modules\taisan\controllers;

use Yii;
// use app\models\YeuCauVanHanh;
use app\modules\taisan\models\YeuCauVanHanh;
use app\modules\taisan\models\PheDuyetYeuCauVanHanhSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\filters\AccessControl;

/**
 * PheDuyetYeuCauVanHanhController implements the CRUD actions for YeuCauVanHanh model.
 */
class PheDuyetYeuCauVanHanhController extends Controller
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
        $searchModel = new PheDuyetYeuCauVanHanhSearch();
        if (isset($_POST['search']) && $_POST['search'] != null) {
            $dataProvider = $searchModel->search(Yii::$app->request->post(), $_POST['search']);
        } else if ($searchModel->load(Yii::$app->request->post())) {
            $searchModel = new PheDuyetYeuCauVanHanhSearch(); // "reset"
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

        $hieuLuc = $model->hieu_luc ?? null;
        $isPending = true;
        if ($hieuLuc !== null && $hieuLuc !== 'CHODUYET') {
            $isPending = false;
        }

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Phê duyệt yêu cầu",
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                    'modelsDetail' => $modelsDetail,
                ]),
                'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"])
                    . Html::button('Phê duyệt', [
                        'class' => 'btn btn-primary',
                        'type' => 'submit',
                        'form' => 'approve-form',
                        'hidden' => !$isPending
                    ])
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
                'modelsDetail' => $modelsDetail,
            ]);
        }
    }

    public function actionApprove($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if (Yii::$app->request->post('hieu_luc') === 'DADUYET') {
                $model->hieu_luc = Yii::$app->request->post('hieu_luc');
                $model->id_nguoi_duyet = Yii::$app->user->identity->id;
                $model->ngay_duyet = date('Y-m-d H:i:s');
                $model->noi_dung_duyet = Yii::$app->request->post('YeuCauVanHanh')['noi_dung_duyet'];

                // var_dump($model->hieu_luc);
                // var_dump(Yii::$app->request->post('YeuCauVanHanh')['id_nguoi_duyet']);
                // var_dump(Yii::$app->request->post('ngay_duyet'));

                // var_dump($model->validate());

                // if ($model->validate() && $model->save(false)) {
                //     return [
                //         'success' => true,
                //         'message' => 'Successfully approved.',
                //     ];
                // } else {
                //     return [
                //         'success' => false,
                //         'errors' => $model->errors,
                //         'message' => 'Failed to approve.',
                //     ];
                // }

                if ($model->save(false)) {
                    Yii::$app->session->setFlash('success', 'Successfully.');
                    return $this->redirect(['index']);
                } else {
                    Yii::$app->session->setFlash('error', 'Failed.');
                }
            }
        }
        return $this->redirect(['index']);

        // return $this->redirect(['view', 'id' => $model->id]);

        // if ($model->hieu_luc === 'CHODUYET') {
        //     $model->hieu_luc = 'DADUYET';
        //     if ($model->save(false)) {
        //         Yii::$app->session->setFlash('success', 'approved.');
        //     } else {
        //         Yii::$app->session->setFlash('error', 'Failed.');
        //     }
        // }
    }


    /**
     * Updates an existing YeuCauVanHanh model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Cập nhật YeuCauVanHanh",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                        Html::button('Lưu lại', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "YeuCauVanHanh",
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'tcontent' => 'Cập nhật thành công!',
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                        Html::a('Sửa', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Cập nhật YeuCauVanHanh",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                        Html::button('Lưu lại', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
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
     * Delete an existing YeuCauVanHanh model.
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
}
