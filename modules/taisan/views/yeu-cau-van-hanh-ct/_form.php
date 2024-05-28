<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TsYeuCauVanHanhCt */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ts-yeu-cau-van-hanh-ct-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_thiet_bi')->textInput() ?>

    <?= $form->field($model, 'id_yeu_cau_van_hanh')->textInput() ?>

    <?= $form->field($model, 'ngay_bat_dau')->textInput() ?>

    <?= $form->field($model, 'ngay_ket_thuc')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
