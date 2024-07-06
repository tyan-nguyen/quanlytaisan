<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\bophan\models\DmDvBaoGia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dm-dv-bao-gia-search">

    <?php $form = ActiveForm::begin([
        	'id'=>'myFilterForm',
            'method' => 'post',
            'options' => [
                'class' => 'myFilterForm'
            ]
      	]); ?>

    <?= $form->field($model, 'ten_don_vi')->textInput(['maxlength' => true]) ?>

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
