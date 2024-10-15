<?php

namespace app\modules\taisan\controllers;

use Yii;
use app\modules\taisan\models\YeuCauVanHanh;
use app\modules\taisan\models\TheoDoiVanHanhSearch;
use app\modules\taisan\models\YeuCauVanHanhCt;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\filters\AccessControl;
use app\modules\dungchung\models\CustomFunc;

/**
 * TheoDoiVanHanhController implements the CRUD actions for YeuCauVanHanh model.
 */
class TheoDoiVanHanhController extends Controller
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
        Yii::$app->params['moduleID'] = 'Module Theo dõi vận hành thiết bị';
        Yii::$app->params['modelID'] = 'Theo dõi vận hành thiết bị';

        return parent::beforeAction($action);
    }

    /**
     * Lists all YeuCauVanHanh models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new TheoDoiVanHanhSearch();
        if (isset($_POST['search']) && $_POST['search'] != null) {
            $dataProvider = $searchModel->search(Yii::$app->request->post(), $_POST['search']);
        } else if ($searchModel->load(Yii::$app->request->post())) {
            $searchModel = new TheoDoiVanHanhSearch(); // "reset"
            $dataProvider = $searchModel->search(Yii::$app->request->post());
        } else {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function getColorByNgayTra($ngayTraThucTe, $ngayTra){
        $color = 'green';
        if($ngayTraThucTe != null){//da tra
            $ngayTraThucTe = date('Y-m-d', strtotime($ngayTraThucTe));
            $ngayTra = date('Y-m-d', strtotime($ngayTra));
            if($ngayTraThucTe > $ngayTra){
                $color = 'orange'; //da tra nhung tre han
            }else{
                $color = '#ddd'; //da tra dung han
            }
        } else {//chua tra
            $today = date('Y-m-d');
            $ngayTra = date('Y-m-d', strtotime($ngayTra));
            if($today > $ngayTra){//tre han
                $color = 'yellow';
            } else {
                $color = 'green';//con trong han
            }
        }
        return $color;
    }
    
    public function getNgayKetThuc($ngayTraThucTe, $ngayTra){
        $ngayKT = NULL;
        if($ngayTraThucTe != NULL){//da tra
            $ngayKT = date('Y-m-d', strtotime($ngayTra));
        } else {
            $today = date('Y-m-d');
            $ngayTra = date('Y-m-d', strtotime($ngayTra));
            if($today <= $ngayTra){
                $ngayKT = $ngayTra;
            } else {
                $ngayKT = $today;
            }
        }
        return $ngayKT;
    }

    public function actionEvents()
    {
        $custom = new CustomFunc();
        Yii::$app->response->format = Response::FORMAT_JSON;
        $requests = YeuCauVanHanhCt::find()
            // ->joinWith('YeuCauVanHanh')
            ->joinWith(['yeuCauVanHanh' => function ($query) {
                $query->alias('ycvh');
            }])
            ->where(['ycvh.hieu_luc' => ['VANHANH', 'DATRA']])
            ->all();

        $events = [];

        foreach ($requests as $detail) {
            //$eventColor = $detail->yeuCauVanHanh->hieu_luc == 'DATRA' ? 'red' : null;
            //$eventColor = $detail->ngay_tra_thuc_te!=NULL ? 'yellow' : 'red';
            $eventColor = $this->getColorByNgayTra($detail->ngay_tra_thuc_te??NULL, $detail->ngay_ket_thuc);
            $events[] = [
                'id' => $detail->id_yeu_cau_van_hanh,
                'title' => $detail->thietBi->ten_thiet_bi,
                'start' => $custom->convertYMDHISToYMD($detail->ngay_bat_dau),
                //'end' => $custom->convertYMDHISToYMD($detail->ngay_ket_thuc),
                'end'=>$this->getNgayKetThuc($detail->ngay_tra_thuc_te??NULL, $detail->ngay_ket_thuc),
                'url' => Yii::$app->urlManager->createUrl(['/taisan/theo-doi-van-hanh/view','id' => $detail->id_yeu_cau_van_hanh, 'idItem'=>$detail->id ]),
                'color' => $eventColor,
                'textColor' => 'black',
                'backgroundColor' => $eventColor,
                //'eventColor' => '#378006'
                'eventColor' => $eventColor
            ];
        }
        return $events;
    }

    // public function actionListCalendar()
    // {
    //     return $this->render('list-calendar');
    // }


    /**
     * Displays a single YeuCauVanHanh model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $idItem)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Theo dõi vận hành",
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                    'modelsDetail' => $model->details,
                    'idItem'=>$idItem
                ]),
                'footer' => Html::button('Đóng lại', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"])
                // .Html::a('Sửa', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
                'modelsDetail' => $model->details,
            ]);
        }
    }

    /**
     * Creates a new YeuCauVanHanh model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
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
