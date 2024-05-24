<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use app\modules\taisan\models\HeThong;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\taisan\models\HeThong */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="he-thong-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ma_he_thong')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ten_he_thong')->textInput(['maxlength' => true]) ?>

     <?= $form->field($model, 'truc_thuoc')->widget(Select2::classname(), [
             'data' => (new HeThong())->getListTree(),
		     'options' => ['placeholder' => 'Chọn '. $model->getAttributeLabel('truc_thuoc') .'...'],
		     'pluginOptions' => [
		         'allowClear' => true,
		         'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'), 
		     ],
		 ]);
	 ?>

    <?= $form->field($model, 'mo_ta')->textarea(['rows' => 6]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
