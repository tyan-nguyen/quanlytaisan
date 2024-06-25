<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\CtBaoGiaMuaSam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ct-bao-gia-mua-sam-search">

    <?php $form = ActiveForm::begin([
        	'id'=>'myFilterForm',
            'method' => 'post',
            'options' => [
                'class' => 'myFilterForm'
            ]
      	]); ?>

    <?= $form->field($model, 'id_bao_gia')->textInput() ?>

    <?= $form->field($model, 'id_ct_phieu_mua_sam')->textInput() ?>

    <?= $form->field($model, 'nam_san_xuat')->textInput() ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'xuat_xu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dac_tinh_ky_thuat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'han_bao_hanh')->textInput() ?>

    <?= $form->field($model, 'so_luong')->textInput() ?>

    <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'don_gia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'thanh_tien')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nguoi_tao')->textInput() ?>

    <?= $form->field($model, 'ngay_tao')->textInput() ?>

    <?= $form->field($model, 'nguoi_cap_nhat')->textInput() ?>

    <?= $form->field($model, 'ngay_cap_nhat')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Tìm kiếm',['class' => 'btn btn-primary']) ?>
	        <?= Html::resetButton('Xóa tìm kiếm', ['class' => 'btn btn-outline-secondary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
