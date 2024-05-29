<?php

namespace app\modules\taisan\controllers;

use Yii;
use app\modules\taisan\models\YeuCauVanHanh;
use app\modules\taisan\models\YeuCauVanHanhCt;
use app\modules\taisan\models\YeuCauVanHanhSearch;
use Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\filters\AccessControl;
use yii\base\Model;
use yii\db\ActiveRecord;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
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

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Yêu cầu vận hành",
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                    'modelsDetail' => $modelsDetail,
                ]),
                'footer' => Html::button('Đóng lại', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                    Html::a('Sửa', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
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
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                        Html::button('Nháp', ['class' => 'btn btn-primary', 'type' => "submit"]),
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
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"])
                        . Html::button('Lưu nháp', ['class' => 'btn btn-primary', 'type' => "submit", 'id' => 'draft-button']),
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
                                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                                    Html::a('Update', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote']),
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
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"]),
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
}
