<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\modules\taisan\models\ThietBi;
use kartik\date\DatePicker;
use app\modules\dungchung\models\CustomFunc;
use app\modules\taisan\models\YeuCauVanHanh;
use app\widgets\forms\SwitchWidget;

/* @var $this yii\web\View */
/* @var $model app\models\TsYeuCauVanHanhCt */
/* @var $form yii\widgets\ActiveForm */
if(!$model->isNewRecord){
    $custom = new CustomFunc();
    $model->ngay_tra = $custom->convertYMDHISToDMY($model->ngay_tra);
}
?>

<div class="ts-yeu-cau-van-hanh-ct-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php /*$form->field($model, 'id_thiet_bi')->widget(Select2::classname(), [
        //'data' => ArrayHelper::map(ThietBi::find()->where(['trang_thai' => 'VANHANH'])->all(), 'id', 'ten_thiet_bi'),
        'data' => ThietBi::getListThietBiDangVanHanh(),
        'language' => 'vi',
        'options' => [
            'placeholder' => 'Chọn thiết bị...',
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'width' => '100%',
            'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal2")'),
        ],
    ]); */ ?>
    
    <?=$form->field($model, 'id_ycvhct')->widget(Select2::classname(), [
        'data' => YeuCauVanHanh::getListThietBiByIDChiTiet(),
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

     <?= $form->field($model, 'ngay_tra')->widget(DatePicker::classname(), [
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
        
     <?= SwitchWidget::widget([
	    'model'=>$model,
	    'attr'=>'tra_khong_ve_kho'
	]) ?>   
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
