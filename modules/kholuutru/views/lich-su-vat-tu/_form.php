<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\kholuutru\models\LichSuVatTu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lich-su-vat-tu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_vat_tu')->textInput() ?>

    <?= $form->field($model, 'so_luong_cu')->textInput() ?>

    <?= $form->field($model, 'so_luong_moi')->textInput() ?>

    <?= $form->field($model, 'so_luong')->textInput() ?>

    <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'nguoi_tao')->textInput() ?>

    <?= $form->field($model, 'ngay_tao')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
