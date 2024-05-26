<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\DmTTSuaChua */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dm-ttsua-chua-search">

    <?php $form = ActiveForm::begin([
        	'id'=>'myFilterForm',
            'method' => 'post',
            'options' => [
                'class' => 'myFilterForm'
            ]
      	]); ?>

    <?= $form->field($model, 'ten_tt_sua_chua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dien_thoai1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dien_thoai2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dia_chi')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'nguoi_lien_he')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'danh_gia')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Tìm kiếm',['class' => 'btn btn-primary']) ?>
	        <?= Html::resetButton('Xóa tìm kiếm', ['class' => 'btn btn-outline-secondary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
