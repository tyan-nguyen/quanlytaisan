<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use app\modules\taisan\models\HeThong;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\taisan\models\HeThong */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="he-thong-search">

    <?php $form = ActiveForm::begin([
        	'id'=>'myFilterForm',
            'method' => 'post',
            'options' => [
                'class' => 'myFilterForm'
            ]
      	]); ?>

    <?= $form->field($model, 'ma_he_thong')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ten_he_thong')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'truc_thuoc')->widget(Select2::classname(), [
             'data' => (new HeThong())->getListTree(),
		     'options' => [
		         'placeholder' => 'Chọn '. $model->getAttributeLabel('truc_thuoc') .'...',
		         'data-dropdown-parent'=>"#offcanvasRight"
		     ],
		     'pluginOptions' => [
		         'allowClear' => true,
		         //'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'), 
		     ],
		 ]);
	 ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Tìm kiếm',['class' => 'btn btn-primary']) ?>
	        <?= Html::resetButton('Xóa tìm kiếm', ['class' => 'btn btn-outline-secondary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
