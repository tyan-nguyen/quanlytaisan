<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\bophan\models\NhomDoiTac */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nhom-doi-tac-search">

    <?php $form = ActiveForm::begin([
        	'id'=>'myFilterForm',
            'method' => 'post',
            'options' => [
                'class' => 'myFilterForm'
            ]
      	]); ?>

    <?= $form->field($model, 'ma_nhom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ten_nhom')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Tìm kiếm',['class' => 'btn btn-primary']) ?>
	        <?= Html::resetButton('Xóa tìm kiếm', ['class' => 'btn btn-outline-secondary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
