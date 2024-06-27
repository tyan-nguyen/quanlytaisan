<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\BaoGiaMuaSam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bao-gia-mua-sam-search">

    <?php $form = ActiveForm::begin([
        	'id'=>'myFilterForm',
            'method' => 'post',
            'options' => [
                'class' => 'myFilterForm'
            ]
      	]); ?>

    <?= $form->field($model, 'id_phieu_mua_sam')->textInput() ?>

    <?= $form->field($model, 'so_bao_gia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'flag_index')->textInput() ?>

    <?= $form->field($model, 'ngay_bao_gia')->textInput() ?>

    <?= $form->field($model, 'ngay_ket_thuc')->textInput() ?>

    <?= $form->field($model, 'ngay_gui_bg')->textInput() ?>

    <?= $form->field($model, 'trang_thai')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tong_tien')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ghi_chu_bg1')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ghi_chu_bg2')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'nguoi_tao')->textInput() ?>

    <?= $form->field($model, 'ngay_tao')->textInput() ?>

    <?= $form->field($model, 'nguoi_cap_nhat')->textInput() ?>

    <?= $form->field($model, 'ngay_cap_nhat')->textInput() ?>

    <?= $form->field($model, 'nguoi_duyet_bg')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Tìm kiếm',['class' => 'btn btn-primary']) ?>
	        <?= Html::resetButton('Xóa tìm kiếm', ['class' => 'btn btn-outline-secondary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
