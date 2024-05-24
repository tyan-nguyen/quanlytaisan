<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use app\modules\bophan\models\BoPhan;
use app\widgets\forms\SwitchWidget;

/* @var $this yii\web\View */
/* @var $model app\modules\bophan\models\NhanVien */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
/*fixed select2 search conflict select2 form*/
.select2-container--krajee-bs5 .select2-selection--single {
    padding: 5px 1rem 5px 5px !important;
}
</style>

<div class="nhan-vien-search">

    <?php $form = ActiveForm::begin([
            'id'=>'myFilterForm',
            'method' => 'post',
            'options' => [
                'class' => 'myFilterForm form-horizontal'
            ],
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => '<div class="col-sm-4">{label}</div><div class="col-sm-8">{input}{error}</div>',
                'labelOptions' => ['class' => 'col-md-12 control-label'],
            ],
      	]); ?>

    <?= $form->field($model, 'id_bo_phan')->widget(Select2::classname(), [
                'data' => (new BoPhan())->getListTree(),
    		     'options' => [
    		         'placeholder' => 'Chọn '. $model->getAttributeLabel('id_bo_phan') .'...',
    		         'data-dropdown-parent'=>"#offcanvasRight"
    		     ],
    		     'pluginOptions' => [
    		         'allowClear' => true,
    		         //'dropdownParent' => new yii\web\JsExpression('$("#offcanvasRight")'), 
    		     ],
    		 ]);
    	 ?>

    <?= $form->field($model, 'ma_nhan_vien')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ten_nhan_vien')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'ngay_sinh')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'gioi_tinh')->textInput() ?>

    <?= $form->field($model, 'ten_truy_cap')->textInput(['maxlength' => true]) ?>

    <?= SwitchWidget::widget([
	    'model'=>$model,
	    'attr'=>'da_thoi_viec',
	    'inForm'=>false
	]) ?>
	
    <?= $form->field($model, 'dien_thoai')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'dia_chi')->textarea(['rows' => 6]) ?>
    
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Tìm kiếm',['class' => 'btn btn-primary']) ?>
	        <?= Html::resetButton('Xóa tìm kiếm', ['class' => 'btn btn-outline-secondary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>