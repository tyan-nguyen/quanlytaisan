<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\kholuutru\models\DmVatTu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dm-vat-tu-search">

    <?php $form = ActiveForm::begin([
        	'id'=>'myFilterForm',
            'method' => 'post',
            'options' => [
                'class' => 'myFilterForm'
            ]
      	]); ?>

    <?= $form->field($model, 'ten_vat_tu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'so_luong')->textInput() ?>

    <?= $form->field($model, 'id_kho')->textInput() ?>

    <?= $form->field($model, 'don_vi_tinh')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trang_thai')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'don_gia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ngay_tao')->textInput() ?>

    <?= $form->field($model, 'nguoi_tao')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Tìm kiếm',['class' => 'btn btn-primary']) ?>
	        <?= Html::resetButton('Xóa tìm kiếm', ['class' => 'btn btn-outline-secondary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
