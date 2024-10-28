<?php

namespace app\modules\taisan\controllers;

use Yii;
use app\models\TsYeuCauVanHanhCt;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use \yii\web\Response;
use yii\helpers\Html;
use app\modules\taisan\models\YeuCauVanHanhCt;
use app\modules\taisan\models\ThietBiVatTu;
use app\modules\kholuutru\models\DmVatTu;

/**
 * ThietBiVatTuAjaxController implements the CRUD actions for ThietBiVatTu model.
 */
class ThietBiVatTuAjaxController extends Controller
{
    /**
     * Finds the ThietBiVatTuAjax model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ThietBiVatTu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ThietBiVatTu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * Displays a single TBVT model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title'=> "Chi tiết vật tư của tài sản",
                'content'=>$this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"])/* .
                Html::a('Sửa',['/taisan/thiet-bi-vat-tu-ajax/update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote-2']) */
            ];
        }
    }
    
    /**
     * Creates a new TBVT model from other modules.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idThietBi)
    {
        $request = Yii::$app->request;
        $model = new ThietBiVatTu();
        $model->id_thiet_bi = $idThietBi;
        
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Thêm mới chi tiết vật tư của tài sản",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=>  Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                    Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                    
                ];
            }else if($model->load($request->post())){
                //check kho neu tuy chon tru kho
                if($model->tru_ton_kho && $model->id_vat_tu){
                    $check = DmVatTu::findOne($model->id_vat_tu);
                    if($check->so_luong < 1){
                        $model->addError('id_vat_tu', 'Số lượng tồn kho của vật tư không đủ, vui lòng kiểm tra lại!');
                        return [
                            'title'=> "Thêm mới Chi tiết yêu cầu",
                            'content'=>$this->renderAjax('create', [
                                'model' => $model,
                            ]),
                            'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal2"]).
                            Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                            
                        ];
                    }
                }

                if($model->save()){
                    return [
                        'forceClose'=>true,
                        'dungChungReload'=>'#chiTietBlock',
                        'tcontent'=>'Thêm mới thành công!',
                        'dungChungType'=>'thietBiVatTu',
                        'dungChungContent'=>$this->renderAjax('@app/modules/taisan/views/thiet-bi/_form_ds_vat_tu', ['model'=>$model->thietBi]),
                    ];
                }else{
                    return [
                        'title'=> "Thêm mới Chi tiết yêu cầu",
                        'content'=>$this->renderAjax('create', [
                            'model' => $model,
                        ]),
                        'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                        Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                        
                    ];
                }
            }else{
                return [
                    'title'=> "Thêm mới Chi tiết yêu cầu",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                    Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                    
                ];
            }
        }        
    }
    
    /**
     * Updates an existing TBVT model from other modules.
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
                    'title'=> "Cập nhật chi tiết vật tư của tài sản",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                    Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceClose'=>true,
                    'dungChungReload'=>'#chiTietBlock',
                    'tcontent'=>'Cập nhật thành công!',
                    'dungChungType'=>'thietBiVatTu',
                    'dungChungContent'=>$this->renderAjax('@app/modules/taisan/views/thiet-bi/_form_ds_vat_tu', ['model'=>$model->thietBi]),
                ];
            }else{
                return [
                    'title'=> "Cập nhật Chi tiết yêu cầu",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                    Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }
        }
    }
    /**
     * TraLaiKho update an existing VHCT model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteVaTraLaiKho($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        if($model->delete()){
            $model->vatTu->so_luong = $model->vatTu->so_luong + 1;
            $model->vatTu->ghiChuThayDoi = 'Trả lại vật tư về kho từ thiết bị '.$model->thietBi->ten_thiet_bi;
            $model->vatTu->save();
        }
        
        if($request->isAjax){
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'forceClose'=>true,
                'dungChungReload'=>'#chiTietBlock',
                'tcontent'=>'Cập nhật thành công!',
                'dungChungType'=>'thietBiVatTu',
                'dungChungContent'=>$this->renderAjax('@app/modules/taisan/views/thiet-bi/_form_ds_vat_tu', ['model'=>$model->thietBi]),
            ];
        }else{
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
        
        
    }
    /**
     * Delete an existing VHCT model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $model->delete();
        
        if($request->isAjax){
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'forceClose'=>true,
                'dungChungReload'=>'#chiTietBlock',
                'tcontent'=>'Cập nhật thành công!',
                'dungChungType'=>'thietBiVatTu',
                'dungChungContent'=>$this->renderAjax('@app/modules/taisan/views/thiet-bi/_form_ds_vat_tu', ['model'=>$model->thietBi]),
            ];
        }else{
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
        
        
    }
    
}