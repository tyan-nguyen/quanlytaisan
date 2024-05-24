<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\dungchung\models\TaiLieu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tai-lieu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'loai')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_tham_chieu')->textInput() ?>

    <?= $form->field($model, 'ten_tai_lieu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'duong_dan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ten_file_luu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_extension')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_size')->textInput() ?>

    <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'thoi_gian_tao')->textInput() ?>

    <?= $form->field($model, 'nguoi_tao')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
