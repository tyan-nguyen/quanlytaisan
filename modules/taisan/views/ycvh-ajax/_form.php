<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\modules\taisan\models\ThietBi;
use kartik\date\DatePicker;
use app\modules\dungchung\models\CustomFunc;

/* @var $this yii\web\View */
/* @var $model app\models\TsYeuCauVanHanhCt */
/* @var $form yii\widgets\ActiveForm */
if(!$model->isNewRecord){
    $custom = new CustomFunc();
    $model->ngay_bat_dau = $custom->convertYMDHISToDMY($model->ngay_bat_dau);
    $model->ngay_ket_thuc = $custom->convertYMDHISToDMY($model->ngay_ket_thuc);
}
?>

<div class="ts-yeu-cau-van-hanh-ct-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?=$form->field($model, 'id_thiet_bi')->widget(Select2::classname(), [
         'data' => ArrayHelper::map(ThietBi::find()->all(), 'id', 'ten_thiet_bi'),
        'language' => 'vi',
        'options' => [
            'placeholder' => 'Chọn thiết bị...',
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'width' => '100%',
            'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal2")'),
        ],
    ]);?>

     <?= $form->field($model, 'ngay_bat_dau')->widget(DatePicker::classname(), [
            'options' => [
                'placeholder' => 'Nhập ngày ...',
                'class' => 'date-picker'
    
            ],
            'pluginOptions' => [
                'width' => '100%',
                'autoclose' => true,
                'format' => 'dd/mm/yyyy',
                'todayHighlight' => true
            ]
        ]) ?>

    <?= $form->field($model, 'ngay_ket_thuc')->widget(DatePicker::classname(), [
            'options' => [
                'placeholder' => 'Nhập ngày ...',
                'class' => 'date-picker'
    
            ],
            'pluginOptions' => [
                'width' => '100%',
                'autoclose' => true,
                'format' => 'dd/mm/yyyy',
                'todayHighlight' => true
            ]
        ]) ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
