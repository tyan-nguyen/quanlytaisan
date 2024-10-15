<?php

namespace app\modules\taisan\controllers;

use Yii;
use app\models\TsYeuCauVanHanhCt;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use \yii\web\Response;
use yii\helpers\Html;
use app\modules\taisan\models\PhieuTraThietBiCt;
use app\modules\taisan\models\YeuCauVanHanhCt;

/**
 * YeuCauVanHanhCtController implements the CRUD actions for TsYeuCauVanHanhCt model.
 */
class YcttbAjaxController extends Controller
{
    /**
     * Finds the TsYeuCauVanHanhCt model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TsYeuCauVanHanhCt the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PhieuTraThietBiCt::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * Displays a single VHCT model.
     * @param integer $id
     * @return mixed
     */
   /*  public function actionView($id)
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title'=> "Chi tiết Phiếu trả",
                'content'=>$this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                Html::a('Sửa',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote-2'])
            ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id)
            ]);
        }
    } */
    
    /**
     * Creates a new VHCT model from other modules.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idYeuCau)
    {
        $request = Yii::$app->request;
        $model = new PhieuTraThietBiCt();
        $model->id_phieu_tra_thiet_bi = $idYeuCau;
        
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Thêm Chi tiết phiếu trả thiết bị",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal2"]).
                    Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                    
                ];
            }else if($model->load($request->post())){
                //check exist thiet bi
                $check = PhieuTraThietBiCt::find()->where(['id_phieu_tra_thiet_bi'=>$idYeuCau, 'id_thiet_bi'=>$model->id_thiet_bi])->one();
                if($check){
                    $model->addError('id_thiet_bi', 'Thiết bị đã tồn tại trong danh sách, vui lòng kiểm tra lại!');
                    return [
                        'title'=> "Thêm Chi tiết phiếu trả thiết bị",
                        'content'=>$this->renderAjax('create', [
                            'model' => $model,
                        ]),
                        'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                        Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                        
                    ];
                }
                if($model->save()){
                    return [
                        'forceClose'=>true,
                        'dungChungReload'=>'#chiTietBlock',
                        'tcontent'=>'Thêm mới thành công!',
                        'dungChungType'=>'vanHanh',
                        'dungChungContent'=>$this->renderAjax('@app/modules/taisan/views/phieu-tra-thiet-bi/_form_chi_tiet', ['model'=>$model->phieuTraThietBi]),
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
     * Updates an existing VHCT model from other modules.
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
                    'title'=> "Cập nhật Chi tiết yêu cầu",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                    Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post())){
                //if($oldModel->id_thiet_bi != $model->id_thiet_bi){
                $idThietBi = NULL;
                if($oldModel->id_ycvhct != $model->id_ycvhct){
                    $ycvhct = YeuCauVanHanhCt::findOne($model->id_ycvhct);
                    if($ycvhct){
                        $idThietBi = $ycvhct->id_thiet_bi;
                    }
                }
                if($idThietBi != NULL){
                    //check exist thiet bi
                    $check = PhieuTraThietBiCt::find()->where(['id_phieu_tra_thiet_bi'=>$model->id_phieu_tra_thiet_bi, 'id_thiet_bi'=>$model->id_thiet_bi])->one();
                    if($check){
                        $model->addError('id_ycvhct', 'Thiết bị thay đổi đã tồn tại trong danh sách, vui lòng kiểm tra lại!');
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
                if($model->save()){
                    return [
                        'forceClose'=>true,
                        'dungChungReload'=>'#chiTietBlock',
                        'tcontent'=>'Cập nhật thành công!',
                        'dungChungType'=>'vanHanh',
                        'dungChungContent'=>$this->renderAjax('@app/modules/taisan/views/phieu-tra-thiet-bi/_form_chi_tiet', ['model'=>$model->phieuTraThietBi]),
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
                'dungChungType'=>'vanHanh',
                'dungChungContent'=>$this->renderAjax('@app/modules/taisan/views/phieu-tra-thiet-bi/_form_chi_tiet', ['model'=>$model->phieuTraThietBi]),
            ];
        }else{
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
        
        
    }
    
}