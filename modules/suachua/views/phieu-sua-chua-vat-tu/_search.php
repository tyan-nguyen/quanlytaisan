<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\PhieuSuaChuaVatTu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phieu-sua-chua-vat-tu-search">

    <?php $form = ActiveForm::begin([
        	'id'=>'myFilterForm',
            'method' => 'post',
            'options' => [
                'class' => 'myFilterForm'
            ]
      	]); ?>

    <?= $form->field($model, 'id_phieu_sua_chua')->textInput() ?>

    <?= $form->field($model, 'id_vat_tu')->textInput() ?>

    <?= $form->field($model, 'so_luong')->textInput() ?>

    <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'don_vi_tinh')->textInput(['maxlength' => true]) ?>

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
