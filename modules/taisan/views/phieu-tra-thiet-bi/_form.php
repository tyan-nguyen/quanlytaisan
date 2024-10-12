<?php

use app\modules\bophan\models\NhanVien;
use app\modules\dungchung\models\CustomFunc;
use app\modules\taisan\models\ThietBi;
use app\modules\taisan\models\YeuCauVanHanh;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormAsset;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use app\modules\taisan\models\PhieuTraThietBiBase;
use app\widgets\SummaryAlert;

/* @var $this yii\web\View */
/* @var $model app\models\TsPhieuTraThietBi */
/* @var $form yii\widgets\ActiveForm */

//DynamicFormAsset::register($this);

$newArr = [];
$cus = new CustomFunc();


?>

<style>
    .legend {
        font-size: 14px;
        font-weight: bold;
        margin: 0px;
        padding: 0px;
    }
</style>


<div class="ts-phieu-tra-thiet-bi-form container-fluid formInput">

    <?php $form = ActiveForm::begin([
        'id' => 'dynamic-form',
        'action'=>(!$model->isNewRecord?'/taisan/phieu-tra-thiet-bi/update?id='.$model->id:'/taisan/phieu-tra-thiet-bi/create'),
        'options' => ['class' => 'form-horizontal', 'data-return-id' => $model->isNewRecord ? '' : $model->id],
        'fieldConfig' => [
            'template' => '<div class="col-sm-12">{label}</div><div class="col-sm-12">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-md-12 control-label'],
        ],
        
    ]); ?>

    <div class="row">

        <fieldset class="border p-2" style="margin:3px;">
            <legend class="legend">
                Thông tin phiếu trả
            </legend>
            <div class="row">
            	<div class="col-4">
            		<?= $form->field($model, 'id_nguoi_tra')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(NhanVien::find()->all(), 'id', 'ten_nhan_vien'),
                        'language' => 'vi',
                        'options' => ['placeholder' => 'Chọn...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'width' => '100%'
                        ],
                    ]); ?>
                    
                     <?= $form->field($model, 'id_nguoi_nhan')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(NhanVien::find()->all(), 'id', 'ten_nhan_vien'),
                        'language' => 'vi',
                        'options' => ['placeholder' => 'Chọn...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'width' => '100%'
                        ],
                    ]); ?>
                    
            	</div>
              
                   
               
                <div class="col-3">
                    <?php
                    $requests = YeuCauVanHanh::find()
                    ->where(['hieu_luc' => 'VANHANH'])
                    ->all();
                    
                    $formattedRequests = [];

                    foreach ($requests as $request) {
                        $formattedId = 'P-' . str_pad($request->id, 6, '0', STR_PAD_LEFT);
                        $formattedRequests[$request->id] = $formattedId;
                    }

                    ?>

                    <?= $form->field($model, 'id_yeu_cau_van_hanh')->widget(Select2::className(), [
                        'data' => $formattedRequests,
                        'language' => 'vi',
                        'options' => [
                            'placeholder' => 'Chọn...',
                            // 'data-dropdown-parent' => "#offcanvasRight"
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                            'width' => '100%'
                        ],
                    ]) ?>
                </div>

                <div class="col-8">
                    <?= $form->field($model, 'noi_dung_tra')->textArea(['rows' => 5]) ?>
                </div>
            </div>
        </fieldset>
    </div>
    
    
     <?php if(!$model->isNewRecord && $model->hieu_luc==PhieuTraThietBiBase::STATUS_NHAP){ ?>      
    <!-- chi tiet thiet bi sua -->
    <div class="row">
    	<div class="col-md-12 mt-2">
       		<?= !$model->details ? SummaryAlert::widget([
			    'textMain'=>'',
			    'textSummary'=>'Vui lòng thêm thiết bị vào phiếu.'
			]) : '' ?>
       </div>   
    	<div class="col-md-12" id="chiTietBlock">
        	<?= $this->render('_form_chi_tiet', ['model'=>$model, 'modelDetail'=>$model->details]) ?>
        </div>
    </div>
	<?php } else if($model->hieu_luc==PhieuTraThietBiBase::STATUS_DATRA){ ?>    
    <!-- chi tiet thiet bi -->
    <div class="row">  
    	<div class="col-md-12" id="chiTietBlock">
        	<?= $this->render('_form_chi_tiet_view', ['model'=>$model, 'modelDetail'=>$model->details]) ?>
        </div>
    </div>
	<?php }?>
	
	
    <!-- Them Chi tiet Thiet bi -->

    <?php /* DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.container-items',
        'widgetItem' => '.item',
        'limit' => 10,
        'min' => 1,
        'insertButton' => '.add-item',
        'deleteButton' => '.remove-item',
        'model' => $modelsDetail[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'id_thiet_bi',
            'ngay_tra',
        ],
    ]); ?>

    <?= Html::hiddenInput('return-id', $model->id, ['id' => 'return-id']) ?>

    <div class="container-items mt-4">
        <?php foreach ($modelsDetail as $i => $modelDetail) : ?>
            <div class="item panel panel-default">
                <div class="panel-heading text-primary bg-transparent">
                    <h3 class="panel-title pull-left m-2">Chi tiết thiết bị</h3>
                    <div class="pull-right">
                        <button type="button" class="add-item btn btn-primary btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                        <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <?php
                    // necessary for update action.
                    if (!$modelDetail->isNewRecord) {
                        echo Html::activeHiddenInput($modelDetail, "[{$i}]id");
                    }
                    ?>

                    <div class="row">
                        <div class="col">
                            
                            <?= $form->field($modelDetail, "[{$i}]id_thiet_bi")->dropDownList(
                                ArrayHelper::map(ThietBi::find()->where(['trang_thai' => 'VANHANH'])->all(), 'id', 'ten_thiet_bi'),
                                ['prompt' => '-- Chọn --'],

                            ) ?>
                        </div>
                        <div class="col">
                            <?= $form->field($modelDetail, "[{$i}]ngay_tra")->widget(DatePicker::classname(), [
                                'options' => [
                                    'placeholder' => 'Nhập ngày ...',
                                    'class' => 'return-date-picker'
                                ],
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd/mm/yyyy',
                                    'todayHighlight' => true
                                ]
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php DynamicFormWidget::end(); */ ?>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
    $(document).ready(function() {
    console.log("outside");
    $('.dynamicform_wrapper').on('afterInsert', function(e, item) {
        console.log("Event triggered");
        console.log("Lenght: " + $(this).find('.return-date-picker').length);

        $(item).find('.return-date-picker').each(function() {
            $(this).kvDatepicker({
                autoclose: true,
                format: 'dd-mm-yyyy',
                todayHighlight: true
            });
        });
    });
});
JS;

$this->registerJs($script);
?>