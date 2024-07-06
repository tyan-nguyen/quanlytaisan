<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\bophan\models\DmDvBaoGia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dm-dv-bao-gia-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-12">
            <?=$form->field($model, 'ten_don_vi')->textInput(['maxlength' => true])?>
        </div>

    </div>
    <div class="row">
        <div class="col-6">
            <?=$form->field($model, 'dien_thoai1')->textInput(['maxlength' => true])?>
        </div>
        <div class="col-6">
            <?=$form->field($model, 'dien_thoai2')->textInput(['maxlength' => true])?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <?=$form->field($model, 'nguoi_lien_he')->textInput(['maxlength' => true])?>
        </div>
        
    </div>
    <div class="row">
        <div class="col-12">
            <?=$form->field($model, 'dia_chi')->textarea(['rows' => 6])?>
        </div>
    </div>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
