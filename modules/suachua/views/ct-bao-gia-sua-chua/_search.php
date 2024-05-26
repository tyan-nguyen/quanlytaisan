<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\CtBaoGiaSuaChua */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ct-bao-gia-sua-chua-search">

    <?php $form = ActiveForm::begin([
        	'id'=>'myFilterForm',
            'method' => 'post',
            'options' => [
                'class' => 'myFilterForm'
            ]
      	]); ?>

    <?= $form->field($model, 'id_bao_gia')->textInput() ?>

    <?= $form->field($model, 'id_dm_bao_gia')->textInput() ?>

    <?= $form->field($model, 'ten_danh_muc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'so_luong')->textInput() ?>

    <?= $form->field($model, 'don_vi_tinh')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'don_gia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'thanh_tien')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ngay_tao')->textInput() ?>

    <?= $form->field($model, 'nguoi_tao')->textInput() ?>

    <?= $form->field($model, 'ngay_cap_nhat')->textInput() ?>

    <?= $form->field($model, 'nguoi_cap_nhat')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Tìm kiếm',['class' => 'btn btn-primary']) ?>
	        <?= Html::resetButton('Xóa tìm kiếm', ['class' => 'btn btn-outline-secondary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
