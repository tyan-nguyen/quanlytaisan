<?php

namespace app\modules\taisan\controllers;

use Yii;
use app\modules\taisan\models\YeuCauVanHanh;
use app\modules\taisan\models\YeuCauVanHanhCt;
use app\modules\taisan\models\GuiYeuCauVanHanhSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\filters\AccessControl;

/**
 * GuiYeuCauVanHanhController implements the CRUD actions for YeuCauVanHanh model.
 */
class GuiYeuCauVanHanhController extends Controller
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
        Yii::$app->params['modelID'] = 'Phiếu yêu cầu vận hành';

        return parent::beforeAction($action);
    }

    /**
     * Lists all YeuCauVanHanh models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GuiYeuCauVanHanhSearch();
        if (isset($_POST['search']) && $_POST['search'] != null) {
            $dataProvider = $searchModel->search(Yii::$app->request->post(), $_POST['search']);
        } else if ($searchModel->load(Yii::$app->request->post())) {
            $searchModel = new GuiYeuCauVanHanhSearch(); // "reset"
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

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Yêu cầu vận hành",
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                    'modelsDetail' => $modelsDetail,
                ]),
                'footer' => Html::button('Đóng lại', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"])
                // . Html::a('Sửa', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
                'modelsDetail' => $modelsDetail,

            ]);
        }
    }

    /**
     * Creates a new YeuCauVanHanh model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionSendRequest($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->post('hieu_luc') === 'CHODUYET') {

            $model->hieu_luc = Yii::$app->request->post('hieu_luc');
            $model->id_nguoi_gui = Yii::$app->request->post('YeuCauVanHanh')['id_nguoi_gui'];
            $model->ngay_gui = Yii::$app->request->post('YeuCauVanHanh')['ngay_gui'];
            $model->noi_dung_gui = Yii::$app->request->post('YeuCauVanHanh')['noi_dung_gui'];

            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', 'Successfully.');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('error', 'Failed.');
            }
        }
        
        return $this->redirect(['view', 'id' => $model->id]);
    }

    /* public function actionSubmit($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->post('hieu_luc') === 'CHODUYET') {

            $model->hieu_luc = 'CHODUYET';

            if ($model->save(false)) {

                Yii::$app->session->setFlash('success', 'Hiệu lực được cập nhật sang chờ phê duyệt.');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Lỗi cập nhật hiệu lực.');
            }
        }
        return $this->redirect(['view', 'id' => $model->id]);
    } */


    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new YeuCauVanHanh();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Thêm mới YeuCauVanHanh",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng lại', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                        Html::button('Lưu lại', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Thêm mới YeuCauVanHanh",
                    'content' => '<span class="text-success">Thêm mới thành công</span>',
                    'tcontent' => 'Thêm mới thành công!',
                    'footer' => Html::button('Đóng lại', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                        Html::a('Tiếp tục thêm', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                ];
            } else {
                return [
                    'title' => "Thêm mới YeuCauVanHanh",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng lại', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
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
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
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
                    'footer' => Html::button('Đóng lại', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
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
                    'footer' => Html::button('Đóng lại', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                        Html::a('Sửa', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Cập nhật YeuCauVanHanh",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng lại', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
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
