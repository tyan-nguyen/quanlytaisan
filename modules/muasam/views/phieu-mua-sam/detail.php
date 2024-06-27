<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use cangak\ajaxcrud\CrudAsset; 
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use app\modules\taisan\models\ThietBiBase;  
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\PhieuSuaChua */

$this->title = 'Phiếu mua sắm ';
//$this->params['breadcrumbs'] = ['label' => 'Employees', 'url' => ['index'],'template' => "<li><b>{link}</b></li>\n"];
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
Yii::$app->params['showSearch'] = true;
Yii::$app->params['showExport'] = true;

?>

<style>
body .select2-container {
    z-index: 9 !important;
}
</style>

<div class="card custom-card" id="tabstyle">
    <!-- <div class="card-header rounded-bottom-0">
        <h5 class="mt-2">Tabs Style</h5>
    </div> -->
    <div class="card-body">
    <div class="panel panel-primary">
            <div class="tab-menu-heading">
                <div class="tabs-menu1">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs" role="tablist">

                        <li><a href="#tab25" class="active" data-bs-toggle="tab" aria-selected="true" role="tab">
                                Thông tin phiếu mua sắm
                            </a></li>
                            <?php if(!in_array($model->trang_thai,['draft','rejected','submited'] )){ ?>
                        <li><a href="#tab26" data-bs-toggle="tab" aria-selected="false" role="tab" class=""
                                tabindex="-1">Báo giá</a></li>
                                <li><a href="#tab28" data-bs-toggle="tab" aria-selected="false" role="tab" class=""
                                tabindex="-1">Lịch sử báo giá</a></li>
                                <?php } ?>
                        <?php if($baoGia->trang_thai=='approved'){ ?>
                        <li><a href="#tab27" data-bs-toggle="tab" aria-selected="false" role="tab" class=""
                                tabindex="-1">Phiếu nhập hàng</a></li>
                        <?php } ?>
                        
                        
                    </ul>
                </div>
            </div>
            <div class="panel-body tabs-menu-body ps">
                <div class="tab-content">
                    <div class="tab-pane active show" id="tab25" role="tabpanel">
                        <?= $this->render('update', [
                            'model' => $model,
                            'searchModel' => $searchModelCt,
                            'dataProvider' => $dataProviderCt
                        ]) ?>

                    </div>
                    <div class="tab-pane" id="tab26" role="tabpanel">
                        
                        <?= $this->render('../bao-gia-mua-sam/update', [
                            'model' => $model,
                            'baoGia'=>$baoGia,
                            'searchModel' => $searchModelBg,
                            'dataProvider' => $dataProviderBg
                        ]) ?>
                    </div>
                    <div class="tab-pane" id="tab27" role="tabpanel">
                    <?= $this->render('../phieu-nhap-hang/update', [
                            'model' => $model,
                            'searchModel' => $searchModelPn,
                            'dataProvider' => $dataProviderPn
                        ]) ?>
                    </div>
                    <div class="tab-pane" id="tab28" role="tabpanel">
                        <?= $this->render('./lich-su-bao-gia', [
                            "model"=>$model
                        ]) ?>
                    </div>
                    <!-- <div class="tab-pane" id="tab28" role="tabpanel">
                        321
                    </div>
                    <div class="tab-pane" id="tab29" role="tabpanel">
                        3123
                    </div>
                    <div class="tab-pane" id="tab30" role="tabpanel">
                        213
                    </div> -->

                </div>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
$this->registerJsFile("@web/js/bootstrap-rating.js",[
/*     'depends' => [
        \yii\web\JqueryAsset::className()
    ], */
    'position' => \yii\web\View::POS_END 
]);
$this->registerJsFile("@web/assets/plugins/sumoselect/jquery.sumoselect.js",[
/*     'depends' => [
        \yii\web\JqueryAsset::className()
    ], */
    'position' => \yii\web\View::POS_END 
]);

$this->registerCssFile('@web/css/bootstrap-rating.css', [
    //'depends' => [\yii\web\JqueryAsset::className()]
    'position' => \yii\web\View::POS_END
]);

?>

<?php Modal::begin([
   'options' => [
        'id'=>'ajaxCrudModal',
        'tabindex' => false // important for Select2 to work properly
   ],
   'dialogOptions'=>['class'=>'modal-lg'],
   'closeButton'=>['label'=>'<span aria-hidden=\'true\'>×</span>'],
   'id'=>'ajaxCrudModal',
    'footer'=>'',// always need it for jquery plugin
])?>

<?php Modal::end(); ?>

<?php Modal::begin([
   'options' => [
        'id'=>'ajaxCrudModal2',
        'tabindex' => false // important for Select2 to work properly
   ],
   'dialogOptions'=>['class'=>'modal-lg'],
   'closeButton'=>['label'=>'<span aria-hidden=\'true\'>×</span>'],
   'id'=>'ajaxCrudModal2',
    'footer'=>'',// always need it for jquery plugin
])?>

<?php Modal::end(); ?>