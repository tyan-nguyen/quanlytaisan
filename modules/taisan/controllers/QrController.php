<?php

namespace app\modules\taisan\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\modules\taisan\models\ThietBi;
use yii\web\Response;
use yii\helpers\Html;
use app\modules\taisan\models\LoaiThietBi;
use app\modules\bophan\models\BoPhan;

/**
 * Default controller for the `taisan` module
 */
class QrController extends Controller
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
    
    /**
     * In QR cho nhieu thiet bi
     * @return mixed
     */
    public function actionInQrs()
    {
        $request = Yii::$app->request;
        //var_dump($request->post( 'pks' ));
        //$pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        $models = ThietBi::find()->where('id IN ('. $request->post( 'pks' ) . ')')->all();
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            $tieuDe = 'Theo danh sách chọn';
            return [
                'title'=> "In QR nhiều thiết bị",
                'content'=>$this->renderAjax('_print_qrs', compact('models', 'tieuDe')),
                'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                Html::button('Print',['class'=>'btn btn-primary pull-right', 'onClick'=>'printQr()'])
            ];
        }
        
    }
    
    /**
     * In QR cho loai thiet bi
     * @param integer $id
     * @return mixed
     */
    public function actionInLoai($idLoai=NULL){
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($idLoai == NULL){
                return [
                    'title'=> "Chọn loại thiết bị",
                    'content'=>$this->renderAjax('in-loai', [
                        'model' => LoaiThietBi::getDanhSach(),
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"])
                ];
            } else {
                $ltb = LoaiThietBi::findOne($idLoai);
                if($ltb != null){
                    $models = ThietBi::find()->where(['id_loai_thiet_bi'=>$idLoai])->all();
                    $tieuDe = $ltb->ten_loai;
                    return [
                        'title'=> "In QR nhiều thiết bị",
                        'content'=>$this->renderAjax('_print_qrs', compact('models', 'tieuDe')),
                        'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                        Html::button('Print',['class'=>'btn btn-primary pull-right', 'onClick'=>'printQr()'])
                    ];
                }
            }
        }
    }
}