<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use app\modules\taisan\models\ViTri;
use app\widgets\forms\SwitchWidget;

/* @var $this yii\web\View */
/* @var $model app\modules\taisan\models\ViTri */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vi-tri-search">

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

    <?= $form->field($model, 'ma_vi_tri')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ten_vi_tri')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'truc_thuoc')->widget(Select2::classname(), [
         'data' => (new ViTri())->getListTree(),
	     'options' => ['placeholder' => 'Chọn '. $model->getAttributeLabel('truc_thuoc') .'...'],
	     'pluginOptions' => [
	         'allowClear' => true,
	         //'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'), 
	     ],
	 ]);
    ?>
    
    <?= SwitchWidget::widget([
	    'model'=>$model,
	    'attr'=>'da_ngung_hoat_dong',
	    'inForm'=>false
	]) ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Tìm kiếm',['class' => 'btn btn-primary']) ?>
	        <?= Html::resetButton('Xóa tìm kiếm', ['class' => 'btn btn-outline-secondary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
